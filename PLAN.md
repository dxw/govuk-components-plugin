# Plan: Migrate legacy static block content to dynamic block format

## Problem

Four blocks (Accordion, AccordionRow, Details, InsetText) were converted from
static to dynamic blocks. Backward compatibility is currently provided two ways:

1. Client-side `deprecated.js` in each block, matched by `@wordpress/blocks`
   when the editor loads old content (migrates on save if the post is opened
   and re-saved).
2. Server-side `render.php` in each block, which detects "old shape" markup in
   `$content` (e.g. `strpos($content, '<details')`) and echoes it verbatim
   instead of rendering from attributes.

Because many posts are never re-opened/re-saved in the editor, their
`post_content` in the database still contains the *old* serialized block
markup indefinitely. To retire the deprecated versions and the render.php
compatibility branches, we need to rewrite `post_content` for all affected
posts, converting old-format block instances to the current dynamic format
(attributes-driven, no baked-in wrapper markup).

## Old vs new format (per block)

- **InsetText**: old = wrapper `<div class="govuk-inset-text ...">` around
  inner blocks. New = no wrapper markup at all (dynamic render adds it), no
  attribute changes.
- **Details**: old = full `<details>...<summary>...<span class="govuk-details__summary-text">HTML</span>...<div class="govuk-details__text">innerblocks</div></details>` markup baked in, with `summary` sourced from HTML and `previewOpen` as a stored comment attribute. New = bare inner blocks only; `summary` and `previewOpen` become plain stored attributes on the block comment.
- **Accordion**: old = full `<div data-module="govuk-accordion" class="govuk-accordion" id="accordion-default">` wrapper with accordion-row inner blocks; no `showAll`/`uniqueID` attributes existed. New = bare inner blocks only, with `showAll` (default `false`) and `uniqueID` (must be generated) as stored attributes.
- **AccordionRow**: old = full section markup (`.govuk-accordion__section-header`/`-content` divs) with `header` sourced from HTML, `index`/`isSelected` sometimes present, sometimes missing (per the `migrate()` fallback logic already in `deprecated.js`). New = bare inner blocks only; `header`, `index`, `isSelected` become plain stored attributes.
- Per your decision: AccordionRow is migrated only while walking its parent Accordion block (it never appears outside one in practice), not as an independent top-level pass.

## Approach

Add a single new WP-CLI command to the plugin (new `app/Commands/` namespace,
registered conditionally when `defined('WP_CLI')`, following the existing
`Dxw\Iguana` registrar/DI pattern used in `app/di.php`):

```
wp govuk-components migrate-blocks
    [--blocks=accordion,details,inset-text]   # default: all three top-level blocks (accordion-row handled implicitly)
    [--post-type=post,page]                   # default: all public post types
    [--status=publish,private]                # default: publish,private; --status=any to widen
    [--include-drafts] [--include-revisions]  # opt-in widen of scope, per your "configurable" choice
    [--dry-run]                               # report only, no DB writes (default off = writes)
    [--log=/path/to/report.csv]               # CSV of post ID, block, before/after summary
```

Implementation, per post:

1. Fetch candidate posts via `WP_Query`/`get_posts` filtered by post type/status,
   further filtered to those whose `post_content` contains one of the target
   block comment names (`<!-- wp:govuk-components/accordion`, `.../details`,
   `.../inset-text`) as a cheap pre-filter before full parsing.
2. `parse_blocks($post->post_content)` to get the block tree (WP core
   function, always available — no Node/JS dependency needed at runtime).
3. Recursively walk the tree. For each block matching one of our 4 names,
   detect old-vs-new shape using the **same marker check already used in
   render.php** (e.g. `str_contains($block['innerHTML'], '<details')`) so
   detection logic has one canonical source of truth per block.
4. For an old-shape match, run a per-block extractor/rebuilder class
   (`GovukComponents\Migrations\Accordion`, `...\AccordionRow`, `...\Details`,
   `...\InsetText`) that:
   - Parses `innerHTML` with `DOMDocument`/`DOMXPath` to pull out the bits
     that map to new attributes (`summary`, `header`), mirroring exactly the
     `selector`s already declared in each block's `deprecated.js` (documented
     in each extractor as a code comment referencing the source file/line).
   - Reuses/derives `previewOpen`, `index`, `isSelected` from the block's
     existing parsed attributes when present, else applies the same
     fallback defaults encoded in `deprecated.js`'s `migrate()` (e.g.
     `index` defaults to sibling position, `isSelected` defaults to `false`).
   - Generates `uniqueID` for Accordion (e.g. `wp_generate_uuid4()`) since no
     old equivalent exists.
   - Rebuilds the block as `['blockName' => ..., 'attrs' => [...new attrs...],
     'innerBlocks' => [...recursively migrated children...], 'innerHTML' =>
     '', 'innerContent' => [null, null, ...] ]` — i.e. bare inner blocks, no
     wrapper HTML, matching what the current `save.js` produces.
   - For Accordion specifically, each AccordionRow child is migrated in the
     same pass (nested-only handling).
5. Reassemble `post_content` with WordPress's `serialize_blocks()` core
   function once all matched blocks in the tree have been rebuilt.
6. If not `--dry-run`: update the post via `wp_update_post` (bumps revision
   automatically, matching normal WP editorial behaviour — no custom backup
   mechanism needed beyond core's built-in revisions).
7. Always emit a summary row per changed post: post ID, blocks migrated,
   old attribute count found, warnings (e.g. "could not find summary text,
   left attribute empty") if extraction was ambiguous.
8. Write the CSV log (post ID / URL / blocks changed / dry-run or applied)
   regardless of dry-run, so the same command run in `--dry-run` mode
   doubles as a pre-migration audit report.

## Files/structure to add

- `app/Commands/MigrateBlocksCommand.php` — WP-CLI command class, argument
  parsing, orchestration, CSV writer.
- `app/Migrations/BlockMigrator.php` — shared tree-walk/serialize glue.
- `app/Migrations/AccordionMigrator.php`
- `app/Migrations/AccordionRowMigrator.php`
- `app/Migrations/DetailsMigrator.php`
- `app/Migrations/InsetTextMigrator.php`
- Wire the command into `app/di.php` / a new `app/commands.php`, guarded by
  `if (defined('WP_CLI') && WP_CLI) { ... }`.
- `spec/commands/migrate_blocks_command.spec.php` and
  `spec/migrations/*.spec.php` — Kahlan tests, each with realistic legacy
  `post_content` fixtures (built from the actual old `save.js`/deprecated
  output) asserting the exact serialized output after migration.

## Testing/validation

- Kahlan unit tests per migrator class using literal legacy block markup
  fixtures (covering: default attributes, missing `index`/`isSelected`,
  multiple accordion rows, nested paragraphs/headings/lists/images inside
  rows, edge cases like empty summary/header).
- Round-trip test: migrated output re-parsed and rendered through the real
  `render.php` for each block, asserting output markup is unchanged from
  before migration (i.e. the migration is visually/semantically inert).
- Manual dry-run against a copy of a real site's DB (or WP-CLI
  `--url`/local environment) before running for real, reviewing the CSV log.

## Explicitly out of scope (per your answers)

- Removing `deprecated.js` / the render.php old-format branches — left for a
  follow-up once the migration has been run against all affected sites and
  verified.
- Handling AccordionRow blocks that exist outside of an Accordion parent
  (not expected to occur; the walker will simply leave any such orphan
  block alone and log a warning if encountered, rather than silently
  dropping it).

## Open implementation details to confirm during build (not blocking the plan)

- Exact CSV log column set and file location/naming convention.
- Whether "any post type" should include custom post types registered by
  other plugins/themes on the eventual target sites (a `--post-type=any`
  flag covers this either way).
