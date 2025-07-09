<?php

namespace GovukComponents;

class Scripts implements \Dxw\Iguana\Registerable
{
	public function register(): void
	{
		add_action('enqueue_block_editor_assets', [$this, 'govukComponentsBlockVariations']);
	}

	public function govukComponentsBlockVariations(): void
	{
		wp_enqueue_script(
			'govuk-components-block-variations',
			plugin_dir_url(__DIR__) . 'assets/js/blocks/block-variations.js',
			[
				'wp-blocks',
				'wp-dom-ready',
				'wp-i18n'
			],
			'',
			true
		);
	}
}
