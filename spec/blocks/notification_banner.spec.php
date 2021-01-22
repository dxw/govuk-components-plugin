<?php

use Kahlan\Arg;

describe(\GovukComponents\Blocks\NotificationBanner::class, function () {
    beforeEach(function () {
        $this->notificationBanner = new \GovukComponents\Blocks\NotificationBanner();
    });

    it('is registerable', function () {
        expect($this->notificationBanner)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('adds the actions', function () {
            allow('add_action')->toBeCalled();
            expect('add_action')->toBeCalled()->once()->with('init', [$this->notificationBanner, 'registerBlock']);
            expect('add_action')->toBeCalled()->once()->with('init', [$this->notificationBanner, 'registerFields']);
            $this->notificationBanner->register();
        });
    });

    describe('->registerBlock', function () {
        it('registers the block', function () {
            allow('function_exists')->toBeCalled()->andReturn(true);
            allow('acf_register_block_type')->toBeCalled();
            expect('acf_register_block_type')->toBeCalled()->once()->with(Arg::toBeAn('array'));
            $this->notificationBanner->registerBlock();
        });
    });

    describe('->registerFields()', function () {
        it('registers the fields', function () {
            allow('function_exists')->toBeCalled()->andReturn(true);
            allow('acf_add_local_field_group')->toBeCalled();
            expect('acf_add_local_field_group')->toBeCalled()->once()->with(Arg::toBeAn('array'));
            $this->notificationBanner->registerFields();
        });
    });

    describe('->render()', function () {
        it('increments the count value by one', function () {
            expect($this->notificationBanner->count)->toEqual(0);
            allow('plugin_dir_path')->toBeCalled();
            allow('dirname')->toBeCalled();
            allow('load_template')->toBeCalled();
            $this->notificationBanner->render();
            expect($this->notificationBanner->count)->toEqual(1);
            $this->notificationBanner->render();
            expect($this->notificationBanner->count)->toEqual(2);
        });
        it('loads the template and passes the count of banners rendered', function () {
            allow('plugin_dir_path')->toBeCalled()->andReturn('/path/to/wp-content/plugins/govuk-components-plugin/app/Blocks');
            allow('dirname')->toBeCalled()->andReturn('/path/to/wp-content/plugins/govuk-components-plugin');
            expect('dirname')->toBeCalled()->once()->with('/path/to/wp-content/plugins/govuk-components-plugin/app/Blocks', 2);
            allow('load_template')->toBeCalled();
            expect('load_template')->toBeCalled()->once()->with('/path/to/wp-content/plugins/govuk-components-plugin' . $this->notificationBanner->templatePath, false, [
                'govuk-components-notification-banner-count' => 1
            ]);
            $this->notificationBanner->render();
        });
    });
});
