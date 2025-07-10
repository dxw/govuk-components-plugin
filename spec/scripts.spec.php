<?php

use Kahlan\Arg;

describe(\GovukComponents\Scripts::class, function () {
	beforeEach(function () {
		$this->scripts = new GovukComponents\Scripts();
	});

	it('implements the Registerable interface', function () {
		expect($this->scripts)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds the actions', function () {
			allow('add_action')->toBeCalled();

			expect('add_action')->toBeCalled()->once()
			->with('enqueue_block_editor_assets', [$this->scripts, 'blockVariations']);

			$this->scripts->register();
		});
	});

	describe('->blockStyleVariations()', function () {
		it('enqueues block style variations script', function () {
			allow('wp_enqueue_script')->toBeCalled();
			allow('plugin_dir_url')->toBeCalled();

			expect('wp_enqueue_script')->toBeCalled()->once()
			->with('block-style-variations', Arg::toBeA('string'), Arg::toBeAn('array'));

			$this->scripts->blockVariations();
		});
	});
});
