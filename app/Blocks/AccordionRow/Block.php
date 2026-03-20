<?php

namespace GovukComponents\Blocks\AccordionRow;

final class Block implements \GovukComponents\Blocks\iBlock
{
	protected const DISPLAY_NAME = 'Accordion Row';

	protected const OPTION_NAME = 'accordion_row';

	#[\Override]
	public function init(): void
	{
		add_action('init', [$this, 'registerBlock'], 10, 0);
		
	}

	public function registerBlock(): void
	{
		register_block_type(__DIR__ . '/build');
		add_action('admin_enqueue_scripts', [$this, 'passData']);
    add_action('wp_enqueue_scripts', [$this, 'passData']);
	}

	public function passData()
	{
		$data = 'const myData = "this here"';
		$data = TEST_DATA;
		wp_add_inline_script('govuk-components-accordion-row-editor-script', $data, 'before');
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
