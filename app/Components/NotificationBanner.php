<?php

namespace GovukComponents\Components;

final class NotificationBanner implements \Dxw\Iguana\Registerable
{
	#[\Override]
	public function register(): void
	{
		/** @psalm-suppress HookNotFound */
		add_action('govuk-components-notification-banner-render', [$this, 'displayNotificationBanner'], 10, 0);
	}


	public function displayNotificationBanner(): void
	{
		/** @var string $show */
		$show = get_field('govuk_components_notification_banner_show', 'option');

		if ($show === 'off') {
			return;
		}

		/** @var string $content */
		$content = get_field('govuk_components_notification_banner_content', 'option');

		?>
<div class="govuk-notification-banner" role="region" aria-labelledby="govuk-notification-banner-title" data-module="govuk-notification-banner">
  <div class="govuk-notification-banner__header">
    <h2 class="govuk-notification-banner__title" id="govuk-notification-banner-title">
      Important
    </h2>
  </div>
  <div class="govuk-notification-banner__content">
<?= wp_kses_post($content); ?>
  </div>
</div>
<?php
	}
}
