<?php

namespace GovukComponents;

final class BlockController
{
	/** @var list<\GovukComponents\Blocks\iBlock> $blocks */
	private $blocks;

	public function __construct(array $blocks)
	{
		/** @var list<\GovukComponents\Blocks\iBlock> $blocks */
		$this->blocks = $blocks;
	}

	public function getAvailableBlockOptions(): array
	{
		$options = [];
		foreach ($this->blocks as $block) {

			$displayName = $block->getDisplayName();

			if (!$this->hasParent($displayName)) {
				$options[$block->getOptionName()] = $displayName;
			}
		}
		return $options;
	}

	public function getDefaultBlockOptions(): array
	{
		$options = [];
		foreach ($this->blocks as $block) {
			$options[] = $block->getOptionName();
		}
		return $options;
	}

	public function activateBlocks(array $blockOptionNames): void
	{
		foreach ($this->blocks as $block) {
			if (in_array($block->getOptionName(), $blockOptionNames)) {
				$block->init();
			}

			$displayName = $block->getDisplayName();

			if ($this->hasParent($displayName)) {
				$block->init();
			}
		}
	}

	public function hasParent(string $displayName): bool
	{
		$dirName = str_replace(' ', '', $displayName);

		$path = plugin_dir_path(__FILE__) . '/Blocks/' . $dirName . '/src/block.json';

		if (!file_exists($path)) {
			return false;
		}
		/** @var string */
		$contents = file_get_contents($path);

		/** @var array */
		$data = json_decode($contents, true);

		return !empty($data['parent']) || !empty($data['ancestor']);
	}
}
