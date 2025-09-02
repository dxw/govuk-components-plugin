# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- Psalm as a dev dependency
- Block dependency functionality to BlockController to handle parent and ancestor relationships
- GOV.UK style variations for the core/button block
- GOV.UK Warning Text block for the block editor
- GOV.UK Inset Text block for the block editor
- GOV.UK Accordion Row block for the block editor
- GOV.UK Accordion block for the block editor
- GOV.UK Details block for the block editor
- GOV.UK Phase banner component and settings
- Add link to components options page from plugins page
- Phase banner appears in response to wp_body_open hook

### Removed

- Old Notification Banner that requries ACF
- PHP v7.4 from github action to ensure compatibility with dependencies
- Old Button block that requires ACF
- Old Warning Text block that requires ACF
- Old Inset Text block that requries ACF
- Old Accordion block that requires ACF
- Old Details block that requires ACF
- `aria-labelledby` attribute from `<div>` element with no specified role.

### Changed

- Category title and slug updated from 'Custom' / 'govuk-custom' to 'GOV.UK Design System' / 'govuk-components'

## [0.4.3] - 2024-09-09

### Fixed
- Upgrade iguana for PHP 8 compatibility
- Accordion ACF warning

## [0.4.2] - 2024-06-18

### Fixed
- block_categories hook deprecation since v5.8.0

## [0.4.1] - 2023-02-09

### Fixed
- Field access calls in button template made less ambiguous.

## [0.4.0] - 2022-08-10

### Added
- Option to attach editable IDs to accordion section headings

## [0.3.0] - 2021-11-23

### Added
- Previews and descriptions for blocks

## [0.2.0] - 2021-02-23

### Added
- Warning Text block
- Option for admins to each block type on or off on a site-wide basis

## [0.1.0] - 2021-01-26

Initial release.

### Added
- Accordion block
- Button block
- Details block
- Inset Text block
- Notification Banner block
