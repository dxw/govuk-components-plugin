<?php

describe(\GovukComponents\Blocks\Tabs\Block::class, function () {
	beforeEach(function () {
		$this->block = new GovukComponents\Blocks\Tabs\Block();
	});

	it('implements the iBlock interface', function () {
		expect($this->block)->toBeAnInstanceOf(\GovukComponents\Blocks\iBlock::class);
	});
});
