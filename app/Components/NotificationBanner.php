<?php

namespace GovukComponents\Components;

final class NotificationBanner implements \Dxw\Iguana\Registerable
{
	#[\Override]
	public function register(): void
	{
		/** @psalm-suppress HookNotFound */
		add_action('govuk-components-notification-banner-render', [$this, 'displayNotificationBanner'], 10, 0);
		add_action('wp_head', [$this, 'enqueueDynamicStyles'], 10, 0);
	}

	private function isBannerOn(): bool
	{
		/** @var string $show */
		$show = get_field('govuk_components_notification_banner_show', 'option');
		return $show === 'off';
	}

	public function enqueueDynamicStyles(): void
	{
		if ($this->isBannerOn()) {
			return;
		}

		/** @var string $borderColour */
		$borderColour = get_field('govuk_components_notification_banner_border_colour', 'option') ?? '';
		/** @var string $headingColour */
		$headingColour = get_field('govuk_components_notification_banner_heading_text_colour', 'option') ?? '';

		$customCSS = "<style>
  .govuk-notification-banner {
    background-color: var(--wp--preset--color--" . esc_attr($borderColour) .");
    border-color: var(--wp--preset--color--" . esc_attr($borderColour) .");
  }
  .govuk-notification-banner__title {
    color: var(--wp--preset--color--" . esc_attr($headingColour) . ");
  }
</style>
";
		echo $customCSS;
	}

	public function displayNotificationBanner(): void
	{
		if ($this->isBannerOn()) {
			return;
		}

		/** @var string $heading*/
		$heading = get_field('govuk_components_notification_banner_heading', 'option') ?? 'Important';

		/** @var string $content */
		$content = get_field('govuk_components_notification_banner_content', 'option');

		?>
<div class="govuk-notification-banner" role="region" aria-labelledby="govuk-notification-banner-title" data-module="govuk-notification-banner">
  <div class="govuk-notification-banner__header">
    <h2 class="govuk-notification-banner__title" id="govuk-notification-banner-title">
<?= esc_html($heading); ?>
    </h2>
  </div>
  <div class="govuk-notification-banner__content">
<?= wp_kses_post($content); ?>
  </div>
</div>
<?php
	}
}
