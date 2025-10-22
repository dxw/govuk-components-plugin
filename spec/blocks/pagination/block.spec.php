<?php

use Kahlan\Arg;

describe(\GovukComponents\Blocks\Pagination\Block::class, function () {
	beforeEach(function () {
		$this->block = new GovukComponents\Blocks\Pagination\Block();
	});

	it('implements the iBlock interface', function () {
		expect($this->block)->toBeAnInstanceOf(GovukComponents\Blocks\iBlock::class);
	});

	describe('->init()', function () {
		it('registers actions to register the block', function () {
			allow('add_action')->toBeCalled();

			expect('add_action')->toBeCalled()->once()->with('init', [$this->block, 'registerBlock']);
			expect('add_action')->toBeCalled()->once()->with('wp_enqueue_scripts', [$this->block, 'enqueueBlockStyles']);

			$this->block->init();
		});
	});

	describe('->registerBlock()', function () {
		it('registers the block', function () {
			allow('register_block_type')->toBeCalled();

			expect('register_block_type')->toBeCalled()->once()->with(Arg::toBeA('string'), Arg::toBeA('array'));

			$this->block->registerBlock();
		});
	});

	describe('->enqueueBlockStyles()', function () {
		it('adds the block styles', function () {
			allow('wp_enqueue_style')->toBeCalled();
			allow('plugin_dir_url')->toBeCalled();

			expect('wp_enqueue_style')->toBeCalled()->once()->with(Arg::toBeA('string'), Arg::toBeA('string'));

			$this->block->enqueueBlockStyles();
		});
	});

	describe('->getDisplayName()', function () {
		it('returns the display name', function () {
			expect($this->block->getDisplayName())->toBe('Pagination');
		});
	});

	describe('->getOptionName()', function () {
		it('returns the option name', function () {
			expect($this->block->getOptionName())->toBe('pagination');
		});
	});
});
