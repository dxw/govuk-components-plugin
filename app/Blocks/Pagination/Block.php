<?php

namespace GovukComponents\Blocks\Pagination;

final class Block implements \GovukComponents\Blocks\iBlock
{
	protected const DISPLAY_NAME = 'Pagination';

	protected const OPTION_NAME = 'pagination';

	#[\Override]
	public function init(): void
	{
		add_action('init', [$this, 'registerBlock'], 10, 0);
	}

	public function registerBlock(): void
	{
		$blockPath = __DIR__ . '/build';

		require_once __DIR__ . '/render.php';

		register_block_type($blockPath, [
			'render_callback' => '\GovukComponents\Blocks\Pagination\renderPaginationBlock',
		]);
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
