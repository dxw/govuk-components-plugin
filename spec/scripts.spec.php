<?php

describe(GovukComponents\Scripts::class, function () {
	beforeEach(function () {
		$this->scripts = new \GovukComponents\Scripts();
	});

	it('implements the Registerable interface', function () {
		expect($this->scripts)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});
});
