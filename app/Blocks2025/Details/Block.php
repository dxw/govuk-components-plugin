<?php

namespace GovukComponents\Blocks2025\Details;

class Block implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_action('init', [$this, 'registerBlock'], 10, 0);
	}

    public function registerBlock(): void
    {
        register_block_type(__DIR__ . '/build');
    }
}
