<?php

use Kahlan\Arg;

describe(\GovukComponents\Blocks\Details\Block::class, function () {
	beforeEach(function () {
		$this->block = new GovukComponents\Blocks\Details\Block();
	});

	it('implements the iBlock interface', function () {
		expect($this->block)->toBeAnInstanceOf(GovukComponents\Blocks\iBlock::class);
	});

	describe('->init()', function () {
		it('registers actions to register the block', function () {
			allow('add_action')->toBeCalled();

			expect('add_action')->toBeCalled()->once()->with('init', [$this->block, 'registerBlock']);

			$this->block->init();
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
