<?php

namespace GovukComponents\Components;

final class NotificationBanner implements \Dxw\Iguana\Registerable
{
	#[\Override]
	public function register(): void
	{
		/** @psalm-suppress HookNotFound */
		add_action('dxw_flatpack_before_header', [$this, 'displayNotificationBanner'], 10, 0);
		add_action('wp_body_open', [$this, 'displayNotificationBanner'], 10, 0);
	}

	public function displayNotificationBanner(): void
	{
	}
}
