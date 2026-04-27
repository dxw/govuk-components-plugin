<?php
/**
 *
 * @var array $attributes
 * @var string $content
 */

// Check if this is an old block that already has the details markup saved
if (strpos($content, '<details') !== false) {
	// Old block format - content already contains full markup, return as-is
	echo wp_kses_post($content);
	return;
}

// New blocks: render from attributes
/** @var string $summary */
$summary = $attributes['summary'] ?? '';
$wrapper_attributes = get_block_wrapper_attributes(['class' => 'govuk-details']);

?>
<details <?php echo $wrapper_attributes; ?>>
	<summary class="govuk-details__summary">
		<span class="govuk-details__summary-text">
			<?php echo wp_kses_post($summary); ?>
		</span>
	</summary>
	<div class="govuk-details__text">
		<?php echo wp_kses_post($content); ?>
	</div>
</details>