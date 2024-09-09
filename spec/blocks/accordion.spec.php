<?php

use Kahlan\Arg;

describe(\GovukComponents\Blocks\Accordion::class, function () {
	beforeEach(function () {
		$this->accordion = new \GovukComponents\Blocks\Accordion();
	});

	it('implements iBlock', function () {
		expect($this->accordion)->toBeAnInstanceOf(\GovukComponents\Blocks\iBlock::class);
	});

	describe('->init()', function () {
		it('adds the actions', function () {
			allow('add_action')->toBeCalled();
			expect('add_action')->toBeCalled()->once()->with('init', [$this->accordion, 'registerBlock']);
			expect('add_action')->toBeCalled()->once()->with('init', [$this->accordion, 'registerFields']);
			$this->accordion->init();
		});
	});

	describe('->registerBlock()', function () {
		it('registers the ACF block', function () {
			allow('function_exists')->toBeCalled()->andReturn('true');
			allow('acf_register_block_type')->toBeCalled();
			allow('plugin_dir_path')->toBeCalled()->andReturn('/path/to/wp-content/plugins/govuk-components-plugin/app/Blocks');
			allow('esc_url')->toBeCalled();
			allow('plugins_url')->toBeCalled();
			expect('acf_register_block_type')->toBeCalled()->once()->with(Arg::toBeAn('array'));
			$this->accordion->registerBlock();
		});
	});

	describe('->registerFields()', function () {
		it('adds the fields', function () {
			allow('function_exists')->toBeCalled()->andReturn(true);
			allow('acf_add_local_field_group')->toBeCalled();
			expect('acf_add_local_field_group')->toBeCalled()->once()->with(Arg::toBeAn('array'));
			$this->accordion->registerFields();
		});
	});

	describe('->render()', function () {
		it('increments the count property by 1 each time it is called', function () {
			expect($this->accordion->count)->toEqual(0);
			allow('load_template')->toBeCalled();
			allow('dirname')->toBeCalled();
			allow('plugin_dir_path')->toBeCalled();
			$this->accordion->render();
			expect($this->accordion->count)->toEqual(1);
			$this->accordion->render();
			expect($this->accordion->count)->toEqual(2);
		});
		it('calls load_template with the path to the template, and the count value as an argument', function () {
			allow('plugin_dir_path')->toBeCalled()->andReturn('/path/to/wp-content/plugins/govuk-components-plugin/app/Blocks');
			allow('dirname')->toBeCalled()->andReturn('/path/to/wp-content/plugins/govuk-components-plugin');
			expect('dirname')->toBeCalled()->once()->with('/path/to/wp-content/plugins/govuk-components-plugin/app/Blocks', 2);
			allow('load_template')->toBeCalled();
			expect('load_template')->toBeCalled()->once()->with('/path/to/wp-content/plugins/govuk-components-plugin' . $this->accordion->templatePath, false, [
				'govuk-components-accordion-count' => 1
			]);
			$this->accordion->render();
		});
	});

	describe('->getOptionName()', function () {
		it('returns the option name', function () {
			expect($this->accordion->getOptionName())->toEqual('accordion');
		});
	});

	describe('->getDisplayName()', function () {
		it('returns a string', function () {
			expect($this->accordion->getDisplayName())->toBeA('string');
		});
	});
});
