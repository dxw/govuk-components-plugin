<?php

describe(\GovukComponents\Translation::class, function () {
	beforeEach(function () {
		$this->translation = new \GovukComponents\Translation();
	});

	it('implements the registerable interface', function () {
		expect($this->translation)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('registers the actions', function () {
			allow('add_action')->toBeCalled();

			expect('add_action')->toBeCalled()->once()->with('init', [$this->translation, 'loadScriptTranslations'], 11, 0);

			$this->translation->register();
		});
	});
});
