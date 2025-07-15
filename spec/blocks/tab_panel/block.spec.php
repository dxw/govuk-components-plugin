<?php

describe(\GovukComponents\Blocks\TabPanel\Block::class, function () {
	beforeEach(function () {
		$this->block = new GovukComponents\Blocks\TabPanel\Block();
	});

	it('implements the iBlock interface', function () {
		expect($this->block)->toBeAnInstanceOf(\GovukComponents\Blocks\iBlock::class);
	});

	describe('->init()', function () {
		it('registers the actions', function () {
			allow('add_action')->toBeCalled();

			expect('add_action')->toBeCalled()->once()->with('init', [$this->block, 'registerBlock']);

			$this->block->init();
		});
	});
});
