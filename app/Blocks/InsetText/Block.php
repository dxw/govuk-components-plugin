<?php

namespace GovukComponents\Blocks\InsetText;

final class Block implements \GovukComponents\Blocks\iBlock
{
	protected const DISPLAY_NAME = 'Inset Text';

	protected const OPTION_NAME = 'inset_text';

	#[\Override]
	public function init(): void
	{
		add_action('init', [$this, 'registerBlock'], 10, 0);
	}

	public function registerBlock(): void
	{
		register_block_type(__DIR__ . '/build');
	}

	#[\Override]
	public function getDisplayName(): string
	{
		return self::DISPLAY_NAME;
	}

	#[\Override]
	public function getOptionName(): string
	{
		return self::OPTION_NAME;
	}
}
