<?php

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
});
