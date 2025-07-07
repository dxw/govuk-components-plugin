<?php

describe(\GovukComponents\Blocks\AccordionRow\Block::class, function () {
	beforeEach(function () {
		$this->block = new GovukComponents\Blocks\AccordionRow\Block();
	});

	it('implements the iBlock interface', function () {
		expect($this->block)->toBeAnInstanceOf(\GovukComponents\Blocks\iBlock::class);
	});
});
