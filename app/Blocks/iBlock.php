<?php

namespace GovukComponents\Blocks;

interface iBlock
{
	public function init(): void;

	public function getDisplayName(): string;

	public function getOptionName(): string;
}
