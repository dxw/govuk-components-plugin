<?php

use Kahlan\Arg;

describe(\GovukComponents\Blocks\InsetText::class, function () {
	beforeEach(function () {
		$this->insetText = new \GovukComponents\Blocks\InsetText();
	});

	it('implements iBlock', function () {
		expect($this->insetText)->toBeAnInstanceOf(\GovukComponents\Blocks\iBlock::class);
	});

	describe('->init()', function () {
		it('adds the actions', function () {
			allow('add_action')->toBeCalled();
			expect('add_action')->toBeCalled()->once()->with('init', [$this->insetText, 'registerBlock']);
			expect('add_action')->toBeCalled()->once()->with('init', [$this->insetText, 'registerFields']);
			$this->insetText->init();
		});
	});

	describe('->registerBlock()', function () {
		it('adds the block', function () {
			allow('function_exists')->toBeCalled()->andReturn(true);
			allow('acf_register_block_type')->toBeCalled();
			expect('acf_register_block_type')->toBeCalled()->once()->with(Arg::toBeAn('array'));
			$this->insetText->registerBlock();
		});
	});

	describe('->registerFields()', function () {
		it('registers the fields', function () {
			allow('function_exists')->toBeCalled()->andReturn(true);
			allow('acf_add_local_field_group')->toBeCalled();
			expect('acf_add_local_field_group')->toBeCalled()->once()->with(Arg::toBeAn('array'));
			$this->insetText->registerFields();
		});
	});

	describe('->render()', function () {
		it('loads the template', function () {
			allow('plugin_dir_path')->toBeCalled()->andReturn('/path/to/wp-content/plugins/govuk-components-plugin/app/Blocks');
			allow('dirname')->toBeCalled()->andReturn('/path/to/wp-content/plugins/govuk-components-plugin');
			expect('dirname')->toBeCalled()->once()->with('/path/to/wp-content/plugins/govuk-components-plugin/app/Blocks', 2);
			allow('load_template')->toBeCalled();
			expect('load_template')->toBeCalled()->once()->with('/path/to/wp-content/plugins/govuk-components-plugin' . $this->insetText->templatePath, false);
			$this->insetText->render();
		});
	});

	describe('->getOptionName()', function () {
		it('returns the option name', function () {
			expect($this->insetText->getOptionName())->toEqual('inset_text');
		});
	});

	describe('->getDisplayName()', function () {
		it('returns a string', function () {
			expect($this->insetText->getDisplayName())->toBeA('string');
		});
	});
});
