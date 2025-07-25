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

		$path = realpath(plugin_dir_path(__FILE__) . 'Blocks/' . $dirName . '/src/block.json');

		if ($path === false) {
			return false;
		}

		$contents = file_get_contents($path);
		if ($contents === false) {
			return false;
		}

		$data = json_decode($contents, true);
		if (!is_array($data)) {
			return false;
		}

		return !empty($data['parent']) || !empty($data['ancestor']);
	}
}
