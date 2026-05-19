<?php

use Kahlan\Arg;

describe(\GovukComponents\Translation::class, function () {
	beforeEach(function () {
		$this->translation = new \GovukComponents\Translation();
	});

	it('implements the registerable interface', function () {
		expect($this->translation)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('registers the actions', function () {
			allow('add_action')->toBeCalled();

			expect('add_action')->toBeCalled()->once()->with('init', [$this->translation, 'loadScriptTranslations'], 11, 0);

			$this->translation->register();
		});
	});

	describe('->loadScriptTranslations()', function () {
		it('loads the plugin text domain to translate text', function () {
			allow('wp_set_script_translations')->toBeCalled();
			allow('plugin_dir_path')->toBeCalled();

			expect('wp_set_script_translations')->toBeCalled()->once()->with(Arg::toBeA('string'), 'govuk-components', Arg::toBeA('string'));

			$this->translation->loadScriptTranslations();
		});
	});
});
