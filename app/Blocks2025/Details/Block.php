<?php

namespace GovukComponents\Blocks2025\Details;

class Block implements \Dxw\Iguana\Registerable
{
	public function register()
	{
		add_action('init', [$this, 'registerBlock'], 10, 0);
	}
}
