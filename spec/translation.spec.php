<?php

describe(\GovukComponents\Translation::class, function () {
	beforeEach(function () {
		$this->translation = new \GovukComponents\Translation();
	});

	it('implements the registerable interface', function () {
		expect($this->translation)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});
});
