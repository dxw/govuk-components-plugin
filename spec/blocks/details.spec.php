<?php

use Kahlan\Arg;

describe(\GovukComponents\Blocks\Details::class, function () {
    beforeEach(function () {
        $this->details = new \GovukComponents\Blocks\Details();
    });

    it('is registerable', function () {
        expect($this->details)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('adds the actions', function () {
            allow('add_action')->toBeCalled();
            expect('add_action')->toBeCalled()->once()->with('init', [$this->details, 'registerBlock']);
            expect('add_action')->toBeCalled()->once()->with('init', [$this->details, 'registerFields']);
            $this->details->register();
        });
    });

    describe('->registerBlock()', function () {
        it('registers the block', function () {
            allow('function_exists')->toBeCalled()->andReturn(true);
            allow('acf_register_block_type')->toBeCalled();
            expect('acf_register_block_type')->toBeCalled()->once()->with(Arg::toBeAn('array'));
            $this->details->registerBlock();
        });
    });

    describe('->registerFields()', function () {
        it('registers the fields', function () {
            allow('function_exists')->toBeCalled()->andReturn(true);
            allow('acf_add_local_field_group')->toBeCalled();
            expect('acf_add_local_field_group')->toBeCalled()->once()->with(Arg::toBeAn('array'));
            $this->details->registerFields();
        });
    });

    describe('->render()', function () {
        it('loads the template', function () {
            allow('plugin_dir_path')->toBeCalled()->andReturn('/path/to/wp-content/plugins/govuk-components-plugin/app/Blocks');
            allow('dirname')->toBeCalled()->andReturn('/path/to/wp-content/plugins/govuk-components-plugin');
            expect('dirname')->toBeCalled()->once()->with('/path/to/wp-content/plugins/govuk-components-plugin/app/Blocks', 2);
            allow('load_template')->toBeCalled();
            expect('load_template')->toBeCalled()->once()->with('/path/to/wp-content/plugins/govuk-components-plugin' . $this->details->templatePath);
            $this->details->render();
        });
    });
});
