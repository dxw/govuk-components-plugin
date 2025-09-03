<?php

describe(\GovukComponents\Components\NotificationBanner::class, function () {
	beforeEach(function () {
		$this->banner = new \GovukComponents\Components\NotificationBanner();
	});

	it('is registerable', function () {
		expect($this->banner)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
	});

	describe('->register()', function () {
		it('adds the actions', function () {
			allow('add_action')->toBeCalled();
			expect('add_action')->toBeCalled()->times(2);
			expect('add_action')->toBeCalled()->with('dxw_flatpack_before_header', [$this->banner, 'displayNotificationBanner']);
			expect('add_action')->toBeCalled()->with('wp_body_open', [$this->banner, 'displayNotificationBanner']);
			$this->banner->register();
		});
	});

});
