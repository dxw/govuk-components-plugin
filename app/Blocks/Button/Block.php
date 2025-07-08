<?php

namespace GovukComponents\Blocks\Button;

class Block implements \GovukComponents\Blocks\iBlock
{
	public function init(): void
	{
		add_action('init', [$this, 'registerBlock']);
	}

	public function getDisplayName(): string
	{

	}

	public function getOptionName(): string
	{

	}
}
