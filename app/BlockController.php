<?php

namespace GovukComponents;

class BlockController
{
	private $blocks;

	public function __construct(array $blocks)
	{
		$this->blocks = $blocks;
	}

	public function getAvailableBlockOptions()
	{
		$options = [];
		foreach ($this->blocks as $block) {
			$options[$block->getOptionName()] = $block->getDisplayName();
		}
		return $options;
	}

	public function getDefaultBlockOptions()
	{
		$options = [];
		foreach ($this->blocks as $block) {
			$options[] = $block->getOptionName();
		}
		return $options;
	}

	public function activateBlocks($blockOptionNames)
	{
		foreach ($this->blocks as $block) {
			if (in_array($block->getOptionName(), $blockOptionNames)) {
				$block->init();
			}
		}
	}

	public function hasParent($displayName)
	{
		$dirName = str_replace(' ', '', $displayName);

		$path = plugin_dir_path(__FILE__) . '/Blocks/' . $dirName . '/src/block.json';

		if (!file_exists($path)) {
			return false;
		}
	}
}
