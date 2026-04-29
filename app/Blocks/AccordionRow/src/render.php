<?php

/**
 * @var string $content
 * @var array $attributes
 */

// Check if this is an old block that already has the accordion row markup saved
if (strpos($content, '<div class="govuk-accordion__section"') !== false) {
	// Old block format - content already contains full markup, return as-is
	echo wp_kses_post($content);
	return;
}

/** @var string $header */
$header = $attributes['header'] ?? '';
/** @var int $index */
$index = $attributes['index'] ?? 0;
$wrapper_attributes = get_block_wrapper_attributes([
	'class' => 'govuk-accordion__section',
]);

?>
<div <?php echo $wrapper_attributes; ?>>
	<div class="govuk-accordion__section-header">
		<h2 class="govuk-accordion__section-heading">
			<span class="govuk-accordion__section-button" id="accordion-default-heading-<?php echo $index; ?>">
				<?php echo wp_kses_post($header); ?>
			</span>
		</h2>
	</div>
	<div class="govuk-accordion__section-content" id="accordion-default-content-<?php echo $index; ?>">
		<?php echo wp_kses_post($content); ?>
	</div>
</div>