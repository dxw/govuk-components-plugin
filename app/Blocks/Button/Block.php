<?php

namespace GovukComponents\Blocks\Button;

class Block implements \GovukComponents\Blocks\iBlock
{
	public function init(): void
	{
		add_action('enqueue_block_editor_assets', [$this, 'blockStyleVariations']);
	}

	public function getDisplayName(): string
	{

	}

	public function getOptionName(): string
	{

	}
}
