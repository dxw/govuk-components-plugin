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
		it('registers the actions', function () {
			allow('add_action')->toBeCalled();

			expect('add_action')->toBeCalled()->once()->with('enqueue_block_editor_assets', [$this->block, 'blockStyleVariations']);

			$this->block->init();
		});
	});

	describe('->blockStyleVariations()', function () {
		it('enqueue the script to register the block style variations', function () {
			allow('wp_enqueue_script')->toBeCalled();
			allow('plugin_dir_url')->toBeCalled();

			expect('wp_enqueue_script')->toBeCalled()->once()
			->with('block-style-variations', Arg::toBeA('string'), Arg::toBeAn('array'));

			$this->block->blockStyleVariations();
		});
	});

	describe('->getDisplayName()', function () {
		it('returns the display name', function () {
			expect($this->block->getDisplayName())->toBe('Button');
		});
	});
});
