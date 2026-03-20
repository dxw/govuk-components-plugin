<?php

namespace GovukComponents\Blocks\Details;

final class Block implements \GovukComponents\Blocks\iBlock
{
	protected const DISPLAY_NAME = 'Details';

	protected const OPTION_NAME = 'details';

	#[\Override]
	public function init(): void
	{
		add_action('init', [$this, 'registerBlock'], 10, 0);
	}

	public function registerBlock(): void
	{
		register_block_type(__DIR__ . '/build', [
			'render_callback' => [$this, 'render']
		]);
	}

	public function render(array $attributes, string $content): string
	{
		$summary = $attributes['summary'] ?? '';
		$wrapper_attributes = get_block_wrapper_attributes(['class' => 'govuk-details']);

		ob_start();
		?>
		<details <?= $wrapper_attributes ?>>
			<summary class="govuk-details__summary">
				<span class="govuk-details__summary-text">
					<?= wp_kses_post($summary) ?>
				</span>
			</summary>
			<div class="govuk-details__text">
				<?= $content ?>
			</div>
		</details>
		<?php
		return (string) ob_get_clean();
	}

	#[\Override]
	public function getDisplayName(): string
	{
		return self::DISPLAY_NAME;
	}

	#[\Override]
	public function getOptionName(): string
	{
		return self::OPTION_NAME;
	}
}
