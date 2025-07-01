<?php

use Kahlan\Arg;

describe(\GovukComponents\Blocks2025\Details\Block::class, function () {
	beforeEach(function () {
		$this->block = new \GovukComponents\Blocks2025\Details\Block();
	});

	it('implements the register interface', function () {
		expect($this->block)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('it registers the callback to register the block', function () {
			allow('add_action')->toBeCalled();

			expect('add_action')->toBeCalled()->once()->with('init', [$this->block, 'registerBlock'], 10, 0);

			$this->block->register();
		});
	});

	describe('->registerBlock()', function () {
		it('registers the block', function () {
			allow('register_block_type')->toBeCalled();

			expect('register_block_type')->toBeCalled()->once()->with(Arg::toBeA('string'));

			$this->block->registerBlock();
		});
	});
});
