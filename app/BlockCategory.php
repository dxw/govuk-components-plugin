<?php

namespace GovukComponents;

final class BlockCategory implements \Dxw\Iguana\Registerable
{
	#[\Override]
	public function register(): void
	{
		add_filter('block_categories_all', [$this, 'newBlocksCategory'], 10, 1);
	}

	/**
	 * @param array<array-key, array<array-key, mixed>> $categories
	 * @return array<array-key, array<array-key, mixed>>
	 */
	public function newBlocksCategory(array $categories): array
	{
		$block_category = [ 'title' => 'GOV.UK Design System', 'slug' => 'govuk-components' ];
		$category_slugs = array_column($categories, 'slug');

		if (! in_array($block_category['slug'], $category_slugs, true)) {
			$categories = array_merge(
				[
					[
						'title' => $block_category['title'],
						'slug'  => $block_category['slug'],
					],
				],
				$categories
			);
		}

		return $categories;
	}
}
