<?php

namespace GovukComponents\Components;

final class PhaseBanner implements \Dxw\Iguana\Registerable
{
	#[\Override]
	public function register(): void
	{
		/** @psalm-suppress HookNotFound */
		add_action('dxw_flatpack_before_header', [$this, 'displayPhaseBanner'], 10, 0);
		add_action('wp_body_open', [$this, 'displayPhaseBanner'], 10, 0);
	}

	public function displayPhaseBanner(): void
	{
		/** @var string $phase */
		$phase = get_field('govuk_components_phase_banner_phase', 'option');

		if ($phase === 'off' || empty($phase)) {
			return;
		}

		/** @var string $feedbackUrl */
		$feedbackUrl = get_field('govuk_components_phase_banner_feedback_url', 'option');
		/** @var string $feedbackEmail */
		$feedbackEmail = get_field('govuk_components_phase_banner_feedback_email', 'option');

		$phaseText = strtoupper(trim($phase));

		$url = '#';
		$target = '';
		$feedbackText = 'give your feedback by email';
		if (!empty($feedbackUrl)) {
			$url = esc_url(trim($feedbackUrl));
			$feedbackText = 'give your feedback (opens in a new tab)';
			$target = 'target="_blank"';
		} elseif (!empty($feedbackEmail)) {
			$url = esc_url('mailto:' . trim($feedbackEmail));
		}
		$message = sprintf(
			'This is a new service. Help us improve it and <a class="govuk-link" href="%s" %s>%s</a>.',
			$url,
			$target,
			$feedbackText
		);

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
