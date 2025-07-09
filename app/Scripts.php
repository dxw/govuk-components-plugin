<?php

namespace GovukComponents;

class Scripts implements \Dxw\Iguana\Registerable
{
	public function register(): void
	{
		add_action('enqueue_block_editor_assets', [$this, 'govukComponentsBlockVariations']);
	}
}
