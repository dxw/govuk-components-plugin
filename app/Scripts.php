<?php

namespace GovukComponents;

class Scripts implements \Dxw\Iguana\Registerable
{
	public function register(): void
	{
		add_action('enqueue_block_editor_assets', [$this, 'blockVariations']);
	}

	public function blockVariations(): void
	{
		wp_enqueue_script(
			'block-style-variations',
			plugin_dir_url(__DIR__) . 'assets/js/block-variations.js',
			[
				'wp-blocks',
				'wp-dom-ready',
				'wp-edit-post'
			]
		);
	}
}
