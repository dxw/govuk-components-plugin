<?php

namespace GovukComponents\Blocks\WarningText;

class Block implements \GovukComponents\Blocks\iBlock
{
	protected const DISPLAY_NAME = 'Warning Text';

	protected const OPTION_NAME = 'warning-text';

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
