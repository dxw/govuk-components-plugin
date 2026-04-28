<?php
/**
 * @var string $content
 */

// Check if this is an old block that already has the accordion markup saved
if (strpos($content, '<div data-module="govuk-accordion"') !== false) {
	// Old block format - content already contains full markup, return as-is
	echo wp_kses_post($content);
	return;
}

$wrapper_attributes = get_block_wrapper_attributes([
	'class' => 'govuk-accordion',
	'data-module' => 'govuk-accordion',
	'id' => 'accordion-default', 
]);
?>

<div <?php echo $wrapper_attributes; ?>>
	<?php echo wp_kses_post($content); ?>
</div>