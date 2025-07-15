<?php

describe(\GovukComponents\Blocks\TabPanel\Block::class, function () {
	beforeEach(function () {
		$this->block = new GovukComponents\Blocks\TabPanel\Block();
	});

	it('implements the iBlock interface', function () {
		expect($this->block)->toBeAnInstanceOf(\GovukComponents\Blocks\iBlock::class);
	});
});
