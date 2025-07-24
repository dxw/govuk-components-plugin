<?php

namespace GovukComponents\Blocks\Button;

final class Block implements \GovukComponents\Blocks\iBlock
{
	protected const DISPLAY_NAME = 'Button';

	protected const OPTION_NAME = 'button';

	#[\Override]
	public function init(): void
	{
		add_action('enqueue_block_editor_assets', [$this, 'blockStyleVariations'], 10, 0);
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
