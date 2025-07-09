<?php

describe(GovukComponents\Scripts::class, function () {
	beforeEach(function () {
		$this->scripts = new \GovukComponents\Scripts();
	});

	it('implements the Registerable interface', function () {
		expect($this->scripts)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds action', function () {
			allow('add_action')->toBeCalled();

			expect('add_action')->toBeCalled()->once()->with('enqueue_block_editor_assets', [$this->scripts, 'govukComponentsBlockVariations']);

			$this->scripts->register();
		});
	});
});
