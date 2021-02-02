<?php

use Kahlan\Arg;

describe(\GovukComponents\Blocks\Button::class, function () {
    beforeEach(function () {
        $this->button = new \GovukComponents\Blocks\Button();
    });

    it('implements iBlock', function () {
        expect($this->button)->toBeAnInstanceOf(\GovukComponents\Blocks\iBlock::class);
    });

    describe('->init()', function () {
        it('adds the actions', function () {
            allow('add_action')->toBeCalled();
            expect('add_action')->toBeCalled()->once()->with('init', [$this->button, 'registerBlock']);
            expect('add_action')->toBeCalled()->once()->with('init', [$this->button, 'registerFields']);
            $this->button->init();
        });
    });

    describe('->registerBlock()', function () {
        it('registers the ACF block', function () {
            allow('function_exists')->toBeCalled()->andReturn('true');
            allow('acf_register_block_type')->toBeCalled();
            allow('plugin_dir_path')->toBeCalled()->andReturn('/path/to/wp-content/plugins/govuk-components-plugin/app/Blocks');
            expect('acf_register_block_type')->toBeCalled()->once()->with(Arg::toBeAn('array'));
            $this->button->registerBlock();
        });
    });

    describe('->registerFields()', function () {
        it('adds the fields', function () {
            allow('function_exists')->toBeCalled()->andReturn(true);
            allow('acf_add_local_field_group')->toBeCalled();
            expect('acf_add_local_field_group')->toBeCalled()->once()->with(Arg::toBeAn('array'));
            $this->button->registerFields();
        });
    });

    describe('->render()', function () {
        it('loads the template', function () {
            allow('plugin_dir_path')->toBeCalled()->andReturn('/path/to/wp-content/plugins/govuk-components-plugin/app/Blocks');
            allow('dirname')->toBeCalled()->andReturn('/path/to/wp-content/plugins/govuk-components-plugin');
            expect('dirname')->toBeCalled()->once()->with('/path/to/wp-content/plugins/govuk-components-plugin/app/Blocks', 2);
            allow('load_template')->toBeCalled();
            expect('load_template')->toBeCalled()->once()->with('/path/to/wp-content/plugins/govuk-components-plugin' . $this->button->templatePath, false);
            $this->button->render();
        });
    });

    describe('->getOptionName()', function () {
        it('returns the option name', function () {
            expect($this->button->getOptionName())->toEqual('button');
        });
    });

    describe('->getDisplayName()', function () {
        it('returns a string', function () {
            expect($this->button->getDisplayName())->toBeA('string');
        });
    });
});
