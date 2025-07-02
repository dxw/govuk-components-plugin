<?php

describe(\GovukComponents\Blocks\Details\Block::class, function () {
	beforeEach(function () {
		$this->block = new GovukComponents\Blocks\Details\Block();
	});

	it('implements the iBlock interface', function () {
		expect($this->block)->toBeAnInstanceOf(GovukComponents\Blocks\iBlock::class);
	});
});
