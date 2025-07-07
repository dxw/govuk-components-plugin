<?php

describe(\GovukComponents\Blocks\WarningText\Block::class, function () {
	beforeEach(function () {
		$this->block = new GovukComponents\Blocks\WarningText\Block();
	});

	it('implements the iBlock interface', function () {
		expect($this->block)->toBeAnInstanceOf(GovukComponents\Blocks\iBlock::class);
	});
});
