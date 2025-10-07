<?php

namespace GovukComponents;

final class Translation implements \Dxw\Iguana\Registerable
{
	#[\Override]
	public function register(): void
	{
		add_action('init', [$this, 'loadScriptTranslations'], 11, 0);
	}

	public function loadScriptTranslations(): void
	{

	}
}
