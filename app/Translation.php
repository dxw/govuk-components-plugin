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
		wp_set_script_translations(
			'govuk-components-warning-text-editor-script',
			'govuk-components',
			plugin_dir_path(__DIR__) . 'languages'
		);
	}
}
