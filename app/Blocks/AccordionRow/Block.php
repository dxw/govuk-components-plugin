<?php

namespace GovukComponents\Blocks\AccordionRow;

class Block implements \GovukComponents\Blocks\iBlock
{
	protected const DISPLAY_NAME = 'Accordion Row';

	protected const OPTION_NAME = 'accordion_row';

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
