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

});
