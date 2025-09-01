# GOVUK Components

A WordPress plugin that adds components from the [GOV.UK Design System](https://design-system.service.gov.uk/components/) to the block editor.

This plugin produces the HTML required for the components, but the CSS & JS assets aren't included - you should add those by [implementing the GOV.UK Frontend in your theme](https://frontend.design-system.service.gov.uk/installing-with-npm/#install-with-node-js-package-manager-npm), or use the [dxw GOV.UK theme](https://github.com/dxw/govuk-theme).

## Getting started

### Requirements

- PHP 8.2 or higher 
- Requires [ACF Pro 5.8.0](https://www.advancedcustomfields.com/pro/) or above.

### Installation
1. Ensure **Advanced Custom Fields Pro** is installed and activated.  
2. Clone or download this repository into `wp-content/plugins/`.
3. Ensure your theme provides GOV.UK Frontend assets.

## Usage

Insert the provided blocks/components in the block editor and style them via your theme.

## Development

### Install the dependencies:

```
composer install
```

### Run the tests:

```
vendor/bin/kahlan spec
```

### Run the linters:

```
vendor/bin/php-cs-fixer fix
vendor/bin/psalm --show-info=true --find-unused-psalm-suppress
```

## Type analysis

Note that this project aims to create fully typed code, with no Psalm output.
We use a Psalm plugin to provide type annotation and stubs for WordPress
globals, so the need for explicit annotation should be minimal.

Developers should aim for the output of Psalm to look something like this using
the [strictest error level](https://psalm.dev/docs/running_psalm/error_levels/):

```shell
❯ vendor/bin/psalm --error-level=1 --find-unused-psalm-suppress
Target PHP version: 8.2 (inferred from composer.json).
Scanning files...
Analyzing files...


------------------------------

       No errors found!

------------------------------

Checks took 0.01 seconds and used 6.608MB of memory
No files analyzed
Psalm was able to infer types for 97.7273% of the codebase
```