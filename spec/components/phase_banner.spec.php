<?php

describe(\GovukComponents\Components\PhaseBanner::class, function () {
	beforeEach(function () {
		$this->banner = new \GovukComponents\Components\PhaseBanner();
	});

	it('is registerable', function () {
		expect($this->banner)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});
});
