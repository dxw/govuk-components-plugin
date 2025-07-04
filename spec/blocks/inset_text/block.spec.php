<?php

describe(\GovukComponents\Blocks\InsetText\Block::class, function () {
	beforeEach(function () {
		$this->block = new GovukComponents\Blocks\InsetText\Block();
	});

	it('implements the iBlock interface', function () {
		expect($this->block)->toBeAnInstanceOf(\GovukComponents\Blocks\iBlock::class);
	});
});
