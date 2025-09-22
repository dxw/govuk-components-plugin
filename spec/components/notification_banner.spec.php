<?php

describe(\GovukComponents\Components\NotificationBanner::class, function () {
	beforeEach(function () {
		$this->banner = new \GovukComponents\Components\NotificationBanner();
	});

	it('is registerable', function () {
		expect($this->banner)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds the actions', function () {
			allow('add_action')->toBeCalled();
			expect('add_action')->toBeCalled()->times(2);
			expect('add_action')->toBeCalled()->with('govuk-components-notification-banner-render', [$this->banner, 'displayNotificationBanner'], 10, 0);
			expect('add_action')->toBeCalled()->with('wp_head', [$this->banner, 'enqueueDynamicStyles'], 10, 0);
			$this->banner->register();
		});
	});

	describe('->enqueueDynamicStyles)', function () {
		beforeEach(function () {
			allow('esc_html')->toBeCalled()->andRun(function ($val) {
				return $val;
			});
			allow('esc_attr')->toBeCalled()->andRun(function ($val) {
				return $val;
			});
		});
		context('The banner is switched off in options', function () {
			it('does nothing', function () {
				allow('get_field')->toBecalled()->andReturn(
					'off',
				);
				$expected = '';
				ob_start();
				$this->banner->enqueueDynamicStyles();
				$result = ob_get_clean();
				expect($result)->toEqual($expected);
			});
		});
		context('The banner is switched on in options', function () {
			it('renders custom styles in the header', function () {
				allow('get_field')->toBecalled()->andReturn(
					'on',
					'colour1',
					'colour2'
				);
				$expected = <<<HTML
<style>
  .govuk-notification-banner {
    background-color: var(--wp--preset--color--colour1);
    border-color: var(--wp--preset--color--colour1);
  }
  .govuk-notification-banner__title {
    color: var(--wp--preset--color--colour2);
  }
</style>

HTML;
				ob_start();
				$this->banner->enqueueDynamicStyles();
				$result = ob_get_clean();
				expect($result)->toEqual($expected);
			});
		});
	});

	describe('->displayNotificationBanner)', function () {
		beforeEach(function () {
			allow('wp_kses_post')->toBeCalled()->andRun(function ($val) {
				return $val;
			});
		});
		context('The banner is switched off in options', function () {
			it('does nothing', function () {
				allow('get_field')->toBecalled()->andReturn(
					'off',
					''
				);
				$expected = '';
				ob_start();
				$this->banner->displayNotificationBanner();
				$result = ob_get_clean();
				expect($result)->toEqual($expected);
			});
		});
		context('The banner is switched on in options', function () {
			beforeEach(function () {
				allow('esc_html')->toBeCalled()->andRun(function ($val) {
					return $val;
				});
			});
			context('when the heading has not been set', function () {
				it('renders the notification banner with the default heading', function () {
					allow('get_field')->toBecalled()->andReturn(
						'on',
						null,
						'<p><em>GODZILLA IS APPROACHING!</em></p>'
					);
					$expected = <<<HTML
<div class="govuk-notification-banner" role="region" aria-labelledby="govuk-notification-banner-title" data-module="govuk-notification-banner">
  <div class="govuk-notification-banner__header">
    <h2 class="govuk-notification-banner__title" id="govuk-notification-banner-title">
Important    </h2>
  </div>
  <div class="govuk-notification-banner__content">
<p><em>GODZILLA IS APPROACHING!</em></p>  </div>
</div>

HTML;
					ob_start();
					$this->banner->displayNotificationBanner();
					$result = ob_get_clean();
					expect($result)->toEqual($expected);
				});
			});
			context('when the heading has been set', function () {
				it('renders the notification banner with the configured heading', function () {
					allow('get_field')->toBecalled()->andReturn(
						'on',
						'Importantish',
						'<p><em>GODZILLA IS APPROACHING!</em></p>'
					);
					$expected = <<<HTML
<div class="govuk-notification-banner" role="region" aria-labelledby="govuk-notification-banner-title" data-module="govuk-notification-banner">
  <div class="govuk-notification-banner__header">
    <h2 class="govuk-notification-banner__title" id="govuk-notification-banner-title">
Importantish    </h2>
  </div>
  <div class="govuk-notification-banner__content">
<p><em>GODZILLA IS APPROACHING!</em></p>  </div>
</div>

HTML;
					ob_start();
					$this->banner->displayNotificationBanner();
					$result = ob_get_clean();
					expect($result)->toEqual($expected);
				});
			});
		});
	});
});
