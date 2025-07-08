<?php

describe(\GovukComponents\Blocks\Button\Block::class, function () {
	beforeEach(function () {
		$this->block = new GovukComponents\Blocks\Button\Block();
	});

	it('implements the iBlock interface', function () {
		expect($this->block)->toBeAnInstanceOf(\GovukComponents\Blocks\iBlock::class);
	});
});
