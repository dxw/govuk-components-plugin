# Block Migration Guide

## Overview

To improve both the editing experience for content authors and the accuracy of frontend previews, we’ve migrated several custom blocks from ACF to Gutenberg. This change ensures that what editors see in the WordPress block editor more closely matches the published site. The old ACF templates have been kept for reference should they be needed as examples of how they were previously structured.

## Blocks

The following blocks were rebuilt from ACF to native blocks. The old versions are no longer registered but their templates remain as a reference:

- Accordion
- Button
- Details
- Inset Text
- Warning Text

Notes: 
- the Notification Banner block was removed as its usage outlined in Design System did not align with the other blocks.
- the Accordion is rebuilt as two blocks, the Accordion and the Accordion Row blocks.

## Editing Blocks

To ensure consistency and make future updates easier, all custom Gutenberg blocks follow the same structure and workflow.

### Activation & Deactivation
Blocks can be activated or deactivated through the WordPress admin dashboard under:
```
Settings > GOV.UK Components
```
Similar to how it was managed before the rebuild.

### Structure
Each block now has its own folder under `app/Blocks` and would contain:
- `Block.php` - to register the block to enable activation/deactivation in the settings page
- `block.json` - to configure the settings for the block
- `index.js` - defines the block's behviour by loading the edit and save function
    - `edit.js` - defines how the block looks and works in the editor
    - `save.js` - handles how content is saved to the database and displayed on the frontend. The save function is used for static content and so the blocks are not built to dynamically load content (e.g within a loop).

## References

For more information about GOV\.UK Components, visit [Design System](https://design-system.service.gov.uk/components/).
To extend the plugin and more information about block development, visit the [Block Editor Handbook](https://developer.wordpress.org/block-editor/).

