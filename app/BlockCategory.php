<?php
namespace GovukComponents;

class BlockCategory implements \Dxw\Iguana\Registerable
{
    public function register()
    {
        add_filter('block_categories', [$this, 'newBlocksCategory'], 10, 1);
    }

    public function newBlocksCategory($categories)
    {
        $block_category = [ 'title' => 'Custom', 'slug' => 'govuk-custom' ];
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
