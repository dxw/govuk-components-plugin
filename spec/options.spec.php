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
			expect('add_action')->toBeCalled()->times(3);
			expect('add_action')->toBeCalled()->with('acf/init', [$this->options, 'addPage']);
			expect('add_action')->toBeCalled()->with('acf/init', [$this->options, 'registerOptions']);
			expect('add_action')->toBeCalled()->with('acf/init', [$this->options, 'apply']);
			$this->options->register();
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
			expect('acf_add_local_field_group')->toBeCalled()->once();
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
});
