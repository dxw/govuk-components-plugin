<?php

namespace GovukComponents\Blocks;

interface iBlock
{
	public function init();

	public function getDisplayName(): string;

	public function getOptionName(): string;
}
