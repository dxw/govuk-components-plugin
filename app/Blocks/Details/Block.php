<?php

namespace GovukComponents\Blocks\Details;

final class Block implements \GovukComponents\Blocks\iBlock
{
	protected const DISPLAY_NAME = 'Details';

	protected const OPTION_NAME = 'details';

	private Renderer $renderer;

	public function __construct()
	{
		$this->renderer = new Renderer();
	}

	#[\Override]
	public function init(): void
	{
		add_action('init', [$this, 'registerBlock'], 10, 0);
	}

	public function registerBlock(): void
	{
		register_block_type(__DIR__ . '/build', [
			'render_callback' => [$this, 'render']
		]);
	}

	public function render(array $attributes, string $content): string
	{
		return $this->renderer->render($attributes, $content);
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
