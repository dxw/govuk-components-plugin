<?php

namespace GovukComponents\Blocks\Tabs;

class Block implements \GovukComponents\Blocks\iBlock
{
	protected const DISPLAY_NAME = 'Tabs';

	protected const OPTION_NAME = 'tabs';

	public function init(): void
	{
		add_action('init', [$this, 'registerBlock']);
	}

	public function registerBlock(): void
	{
		register_block_type(__DIR__ . '/build');
	}

	public function getDisplayName(): string
	{
		return self::DISPLAY_NAME;
	}

	public function getOptionName(): string
	{
		return self::OPTION_NAME;
	}
}
