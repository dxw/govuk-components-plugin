<?php

use Kahlan\Arg;
use Kahlan\Plugin\Double;

describe(\GovukComponents\Options::class, function () {
	beforeEach(function () {
		$this->blockController = Double::instance([
			'extends' => 'GovukComponents\BlockController',
			'magicMethods' => true
		]);
		$this->options = new \GovukComponents\Options($this->blockController);
	});

	it('is registerable', function () {
		expect($this->options)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});


	describe('->register()', function () {
		it('adds the actions', function () {
			allow('add_action')->toBeCalled();
			allow('add_filter')->toBeCalled();
			expect('add_action')->toBeCalled()->times(3);
			expect('add_filter')->toBeCalled()->times(4);
			expect('add_action')->toBeCalled()->with('acf/init', [$this->options, 'addPage']);
			expect('add_action')->toBeCalled()->with('acf/init', [$this->options, 'registerOptions']);
			expect('add_action')->toBeCalled()->with('acf/init', [$this->options, 'apply']);
			expect('add_filter')->toBeCalled()->with('acf/validate_save_post', [$this->options, 'validatePhaseBannerOptions']);
			expect('add_filter')->toBeCalled()->with('plugin_action_links_govuk-components-plugin/index.php', [$this->options, 'addSettingsLink']);
			expect('add_filter')->toBeCalled()->with('acf/load_field/name=govuk_components_notification_banner_border_colour', [$this->options, 'addDefaultThemeColours']);
			expect('add_filter')->toBeCalled()->with('acf/load_field/name=govuk_components_notification_banner_heading_text_colour', [$this->options, 'addDefaultThemeColours']);

			$this->options->register();
		});
	});

	describe('->addSettingsLink()', function () {
		it('adds the link to the settings page page', function () {
			allow('admin_url')->toBeCalled()->andReturn('https://example.com/wp-admin/acf_get_options_page_url');
			allow('esc_html')->toBeCalled()->andRun(function ($val) {
				return $val;
			});
			allow('esc_url')->toBeCalled()->andRun(function ($val) {
				return $val;
			});
			$result = $this->options->addSettingsLink([]);
			expect($result)->toEqual(['<a href="https://example.com/wp-admin/acf_get_options_page_url">Settings</a>']);
		});
	});


	describe('->addPage()', function () {
		it('adds the options page', function () {
			allow('function_exists')->toBeCalled()->andReturn(true);
			allow('acf_add_options_page')->toBeCalled();
			expect('acf_add_options_page')->toBeCalled()->once();
			expect('acf_add_options_page')->toBeCalled()->with(Arg::toBeAn('array'));
			$this->options->addPage();
		});
	});

	describe('->registerOptions()', function () {
		it('adds the options', function () {
			allow('function_exists')->toBeCalled()->andReturn(true);
			allow($this->blockController)->toReceive('getAvailableBlockOptions')->andReturn([
				'block_1_option_name' => 'Block 1 Display Name',
				'block_2_option_name' => 'Block 2 Display Name'
			]);
			expect($this->blockController)->toReceive('getAvailableBlockOptions')->once();
			allow($this->blockController)->toReceive('getDefaultBlockOptions')->andReturn([
				0 => 'block_1_option_name',
				1 => 'block_2_option_name'
			]);
			expect($this->blockController)->toReceive('getDefaultBlockOptions')->once();
			allow('acf_add_local_field_group')->toBeCalled();
			expect('acf_add_local_field_group')->toBeCalled()->times(3);
			expect('acf_add_local_field_group')->toBeCalled()->with(Arg::toBeAn('array'));
			$this->options->registerOptions();
		});
	});

	describe('->apply()', function () {
		context('the options have been saved', function () {
			it('calls the BlockController with a list of the plugins to activate', function () {
				allow('get_field')->toBeCalled()->andReturn([
					'enabled_block_option_name_1',
					'enabled_block_option_name_2'
				]);
				expect('get_field')->toBeCalled()->once()->with('govuk_components_enable_component_blocks', 'option');
				allow($this->blockController)->toReceive('activateBlocks');
				expect($this->blockController)->toReceive('activateBlocks')->once()->with([
					'enabled_block_option_name_1',
					'enabled_block_option_name_2'
				]);
				$this->options->apply();
			});
		});
		context('the options have not been saved (so get_field returns null)', function () {
			it('returns the list of default block options', function () {
				allow('get_field')->toBeCalled()->andReturn(null);
				expect('get_field')->toBeCalled()->once()->with('govuk_components_enable_component_blocks', 'option');
				allow($this->blockController)->toReceive('getDefaultBlockOptions')->andReturn([
					0 => 'default_block_1',
					1 => 'default_block_2'
				]);
				expect($this->blockController)->toReceive('getDefaultBlockOptions')->once();
				allow($this->blockController)->toReceive('activateBlocks');
				expect($this->blockController)->toReceive('activateBlocks')->once()->with([
					0 => 'default_block_1',
					1 => 'default_block_2'
				]);
				$this->options->apply();
			});
		});
	});

	describe('->validatePhaseBannerOptions()', function () {
		beforeEach(function () {
			allow('sanitize_text_field')->toBecalled()->andRun(function ($val) {
				return $val;
			});
		});
		context('the POST request contains no relevant information', function () {
			it('does nothing', function () {
				global $_POST;
				$_POST = [];
				expect('acf_add_validation_error')->not->toBeCalled();
				$this->options->validatePhaseBannerOptions();
				unset($_POST);
			});
		});
		context('the phase banner is off', function () {
			it('does nothing', function () {
				global $_POST;
				$_POST = [
					'acf' => [
						'govuk_components_phase_banner_phase' => 'off',
						'govuk_components_phase_banner_feedback_url' => '',
						'govuk_components_phase_banner_feedback_email' => ''
					]
				];
				expect('acf_add_validation_error')->not->toBeCalled();
				$this->options->validatePhaseBannerOptions();
				unset($_POST);
			});
		});
		context('the phase banner is on and exactly one feedback mechanism has been set', function () {
			it('does nothing', function () {
				global $_POST;
				$_POST = [
					'acf' => [
						'govuk_components_phase_banner_phase' => 'alpha',
						'govuk_components_phase_banner_feedback_url' => 'https://example.com',
						'govuk_components_phase_banner_feedback_email' => ''
					]
				];
				allow('acf_add_validation_error')->toBeCalled();
				expect('acf_add_validation_error')->not->toBeCalled();
				$this->options->validatePhaseBannerOptions();
				unset($_POST);
			});
			it('does nothing', function () {
				global $_POST;
				$_POST = [
					'acf' => [
						'govuk_components_phase_banner_phase' => 'beta',
						'govuk_components_phase_banner_feedback_url' => '',
						'govuk_components_phase_banner_feedback_email' => 'admin@example.com'
					]
				];
				allow('acf_add_validation_error')->toBeCalled();
				expect('acf_add_validation_error')->not->toBeCalled();
				$this->options->validatePhaseBannerOptions();
				unset($_POST);
			});
		});
		context('the phase banner is on but no feedback mechanism has been set', function () {
			it('generates a validation error', function () {
				global $_POST;
				$_POST = [
					'acf' => [
						'govuk_components_phase_banner_phase' => 'alpha',
						'govuk_components_phase_banner_feedback_url' => '',
						'govuk_components_phase_banner_feedback_email' => ''
					]
				];
				allow('acf_add_validation_error')->toBeCalled();
				expect('acf_add_validation_error')->toBeCalled()->once();
				$this->options->validatePhaseBannerOptions();
				unset($_POST);
			});
		});
		context('the phase banner is on and both feedback mechanisms hav been set', function () {
			it('generates a validation error', function () {
				global $_POST;
				$_POST = [
					'acf' => [
						'govuk_components_phase_banner_phase' => 'beta',
						'govuk_components_phase_banner_feedback_url' => 'http://example.com',
						'govuk_components_phase_banner_feedback_email' => 'admin@example.com'
					]
				];
				allow('acf_add_validation_error')->toBeCalled();
				expect('acf_add_validation_error')->toBeCalled()->once();
				$this->options->validatePhaseBannerOptions();
				unset($_POST);
			});
		});
	});
});
