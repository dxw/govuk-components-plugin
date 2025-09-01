<?php

describe(\GovukComponents\Components\PhaseBanner::class, function () {
	beforeEach(function () {
		$this->banner = new \GovukComponents\Components\PhaseBanner();
	});

	it('is registerable', function () {
		expect($this->banner)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds the actions', function () {
			allow('add_action')->toBeCalled();
			expect('add_action')->toBeCalled()->once();
			expect('add_action')->toBeCalled()->with('dxw_flatpack_before_header', [$this->banner, 'displayPhaseBanner']);
			$this->banner->register();
		});
	});

	describe('->displayPhaseBanner)', function () {
		beforeEach(function () {
			allow('esc_html')->toBeCalled()->andRun(function ($val) {
				return $val;
			});
			allow('esc_url')->toBeCalled()->andRun(function ($val) {
				return $val;
			});
		});
		context('The phase banner is switched off in options', function () {
			it('does nothing', function () {
				allow('get_field')->toBecalled()->andReturn(
					'off',
					''
				);
				$expected = '';
				ob_start();
				$this->banner->displayPhaseBanner();
				$result = ob_get_clean();
				expect($result)->toEqual($expected);
			});
		});
		context('The phase banner is switched on in options', function () {
			it('renders the phase banner', function () {
				allow('get_field')->toBecalled()->andReturn(
					'alpha',
					'https://example.com'
				);
				$expected = <<<HTML
<div class="govuk-phase-banner">
    <p class="govuk-phase-banner__content">
        <strong class="govuk-tag govuk-phase-banner__content__tag">ALPHA</strong>
        <span class="govuk-phase-banner__text">This is a new service - your <a class="govuk-link" href="https://example.com">feedback</a> will help us to improve it.</span>
    </p>
</div>

HTML;
				ob_start();
				$this->banner->displayPhaseBanner();
				$result = ob_get_clean();
				expect($result)->toEqual($expected);
			});
		});
	});
});
