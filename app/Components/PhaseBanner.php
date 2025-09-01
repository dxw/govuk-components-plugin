<?php

namespace GovukComponents\Components;

final class PhaseBanner implements \Dxw\Iguana\Registerable
{
	#[\Override]
	public function register(): void
	{
		/** @psalm-suppress HookNotFound */
		add_action('dxw_flatpack_before_header', [$this, 'displayPhaseBanner'], 10, 0);
	}

	public function displayPhaseBanner(): void
	{
		/** @var string $phase */
		$phase = get_field('govuk_components_phase_banner_phase', 'option');
		/** @var string $feedbackUrl */
		$feedbackUrl = get_field('govuk_components_phase_banner_feedback_url', 'option');

		if ($phase === 'off' || empty($phase)) {
			return;
		}

		$phaseText = strtoupper(trim($phase));
		$message = 'This is a new service - your <a class="govuk-link" href="' . esc_url($feedbackUrl) . '">feedback</a> will help us to improve it.';

		?>
<div class="govuk-phase-banner">
    <p class="govuk-phase-banner__content">
        <strong class="govuk-tag govuk-phase-banner__content__tag"><?= esc_html($phaseText); ?></strong>
        <span class="govuk-phase-banner__text"><?= $message; ?></span>
    </p>
</div>
<?php
	}
}
