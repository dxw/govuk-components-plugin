<?php

namespace GovukComponents\Blocks\Button;

class Block implements \GovukComponents\Blocks\iBlock
{
	protected const DISPLAY_NAME = 'Button';

	protected const OPTION_NAME = 'button';

	public function init(): void
	{
		add_action('enqueue_block_editor_assets', [$this, 'blockStyleVariations']);
	}

	public function blockStyleVariations(): void
	{
		wp_enqueue_script(
			'block-style-variations',
			plugin_dir_url(dirname(__DIR__, 2)) . 'assets/js/blocks/core/button/block-style-variations.js',
			[
				'wp-blocks',
				'wp-dom-ready',
				'wp-edit-post'
			],
			'',
			true
		);
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
