<?php

use Kahlan\Arg;

describe(\GovukComponents\Blocks\Button\Block::class, function () {
	beforeEach(function () {
		$this->block = new GovukComponents\Blocks\Button\Block();
	});

	it('implements the iBlock interface', function () {
		expect($this->block)->toBeAnInstanceOf(\GovukComponents\Blocks\iBlock::class);
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

	describe('->getDisplayName()', function () {
		it('returns the display name', function () {
			expect($this->block->getDisplayName())->toBe('Button');
		});
	});

	describe('->getOptionName()', function () {
		it('returns the option name', function () {
			expect($this->block->getOptionName())->toBe('button');
		});
	});
});
