<?php

describe(\GovukComponents\Blocks2025\Details\Block::class, function () {
	beforeEach(function () {
		$this->block = new \GovukComponents\Blocks2025\Details\Block();
	});

	it('implements the register interface', function () {
		expect($this->block)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});
});
