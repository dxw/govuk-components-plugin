<?php

namespace GovukComponents\Blocks\Details;

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
