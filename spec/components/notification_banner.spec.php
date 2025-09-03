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
			expect('add_action')->toBeCalled()->once();
			expect('add_action')->toBeCalled()->with('govuk-components-notification-banner-render', [$this->banner, 'displayNotificationBanner'], 10, 0);
			$this->banner->register();
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
			it('renders the phase banner', function () {
				allow('get_field')->toBecalled()->andReturn(
					'on',
					'<p><em>GODZILLA IS APPROACHING!</em></p>'
				);
				$expected = <<<HTML
<div class="govuk-notification-banner" role="region" aria-labelledby="govuk-notification-banner-title" data-module="govuk-notification-banner">
  <div class="govuk-notification-banner__header">
    <h2 class="govuk-notification-banner__title" id="govuk-notification-banner-title">
      Important
    </h2>
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
