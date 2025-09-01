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
	}
}
