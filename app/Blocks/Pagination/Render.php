<?php

namespace GovukComponents\Blocks\Pagination;

function renderPaginationLink($post, $isPrev = true)
{
	if (!$post) {
		return '';
	}

	$class = $isPrev ? 'govuk-pagination__prev' : 'govuk-pagination__next';
	$rel = $isPrev ? 'prev' : 'next';
	$titleText = $isPrev ? 'Previous page' : 'Next page';
	$url = get_permalink($post);
	$label = get_the_title($post);

	$svg = $isPrev
			? '<svg class="govuk-pagination__icon govuk-pagination__icon--prev" xmlns="http://www.w3.org/2000/svg" height="13" width="15" aria-hidden="true" focusable="false" viewBox="0 0 15 13"><path d="m6.5938-0.0078125-6.7266 6.7266 6.7441 6.4062 1.377-1.449-4.1856-3.9768h12.896v-2h-12.984l4.2931-4.293-1.414-1.414z"></path></svg>'
			: '<svg class="govuk-pagination__icon govuk-pagination__icon--next" xmlns="http://www.w3.org/2000/svg" height="13" width="15" aria-hidden="true" focusable="false" viewBox="0 0 15 13"><path d="m8.107-0.0078125-1.4136 1.414 4.2926 4.293h-12.986v2h12.896l-4.1855 3.9766 1.377 1.4492 6.7441-6.4062-6.7246-6.7266z"></path></svg>';

	ob_start();
	?>
    <div class="<?= esc_attr($class) ?>">
        <?php if ($url): ?>
            <a class="govuk-link govuk-pagination__link" href="<?= esc_url($url) ?>" rel="<?= esc_attr($rel) ?>">
                <?= $svg ?>
                <span class="govuk-pagination__link-title"><?= esc_html($titleText) ?></span>
                <span class="govuk-visually-hidden">:</span>
                <span class="govuk-pagination__link-label"><?= esc_html($label) ?></span>
            </a>
        <?php else: ?>
            <span class="govuk-pagination__link">
                <?= $svg ?>
                <span class="govuk-pagination__link-title"><?= esc_html($titleText) ?></span>
                <span class="govuk-visually-hidden">:</span>
                <span class="govuk-pagination__link-label"><?= esc_html($label) ?></span>
            </span>
        <?php endif; ?>
    </div>
    <?php
	return ob_get_clean();
}

function renderPaginationBlock()
{
	$post_id = get_the_ID();
	$post = get_post($post_id);

	$parent_id = $post->post_parent ?: $post_id;
	$parent_page = get_post($parent_id);

	$children = get_pages([
			'parent' => $parent_id,
			'sort_column' => 'menu_order',
			'sort_order' => 'asc',
	]);

	$pages = [$parent_page];
	foreach ($children as $child) {
		if ($child->ID !== $parent_id) {
			$pages[] = $child;
		}
	}

	$pages_ids = wp_list_pluck($pages, 'ID');
	$index = array_search($post_id, $pages_ids);

	$prev = ($index > 0) ? $pages[$index - 1] : null;
	$next = ($index < count($pages) - 1) ? $pages[$index + 1] : null;

	ob_start();
	?>
    <nav class="govuk-pagination govuk-pagination--block" aria-label="Pagination">
        <?= renderPaginationLink($prev, true) ?>
        <?= renderPaginationLink($next, false) ?>
    </nav>
    <?php
	return ob_get_clean();
}
