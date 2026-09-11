# GOVUK Components

A WordPress plugin that adds components from the [GOV.UK Design System](https://design-system.service.gov.uk/components/) to the block editor.

This plugin produces the HTML required for the components, but the CSS & JS assets aren't included - you should add those by [implementing the GOV.UK Frontend in your theme](https://frontend.design-system.service.gov.uk/installing-with-npm/#install-with-node-js-package-manager-npm), or use the [dxw GOV.UK theme](https://github.com/dxw/govuk-theme).

Currently supports GovUK Frontend v6 (tested up to 6.1.0), so that's what your theme should be using. Support for other major versions is not guaranteed.

Requires [ACF Pro 5.8.0](https://www.advancedcustomfields.com/pro/) or above.

## Development

### Install the dependencies:

```
composer install
```

### Run the tests:

```
vendor/bin/kahlan spec
```

### Run the linter:

```
vendor/bin/php-cs-fixer fix
```
