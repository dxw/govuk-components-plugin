<?php

namespace GovukComponents\Blocks\Details;

final class Renderer
{
	/**
	 *
	 * @param array $attributes
	 * @param string $content
	 * @return string
	 */
	public function render(array $attributes, string $content): string
	{
		// Check if this is an old block that already has the details markup saved
		// (contains opening <details tag)
		if (strpos($content, '<details') !== false) {
			// Old block format - content already contains full markup, return as-is
			return wp_kses_post($content);
		}

		// New blocks: render from attributes
		/** @var string $summary */
		$summary = $attributes['summary'] ?? '';
		$wrapper_attributes = get_block_wrapper_attributes(['class' => 'govuk-details']);

		ob_start();
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
		<?php
		return (string) ob_get_clean();
	}
}
