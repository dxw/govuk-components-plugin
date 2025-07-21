<?php

use Kahlan\Arg;
use Kahlan\Matcher\ToReceive;
use Kahlan\Plugin\Double;

describe(\GovukComponents\BlockController::class, function () {
	beforeEach(function () {
		$this->block1 = Double::instance(
			['implements' => 'GovukComponents\Blocks\iBlock']
		);
		$this->block2 = Double::instance(
			['implements' => 'GovukComponents\Blocks\iBlock']
		);
		allow($this->block1)->toReceive('getOptionName')->andReturn('foo_bar');
		allow($this->block1)->toReceive('getDisplayName')->andReturn('Foo Bar');
		allow($this->block2)->toReceive('getOptionName')->andReturn('dumb_struck');
		allow($this->block2)->toReceive('getDisplayName')->andReturn('Dumb Struck');
		$this->blockController = new \GovukComponents\BlockController([
			$this->block1,
			$this->block2
		]);
	});

	describe('->getAvailableBlockOptions()', function () {
		it('returns a key-value array of the blocks, where the key is the block OPTION_NAME, and the value the DISPLAY_NAME', function () {
			$result = $this->blockController->getAvailableBlockOptions();
			expect($result)->toEqual([
				'foo_bar' => 'Foo Bar',
				'dumb_struck' => 'Dumb Struck'
			]);
		});
	});

	describe('->getDefaultBlockOptions()', function () {
		it('returns a numerically indexed array of the blocks ordered as injected, where each value is the block OPTION_NAME', function () {
			$result = $this->blockController->getDefaultBlockOptions();
			expect($result)->toEqual([
				0 => 'foo_bar',
				1 => 'dumb_struck'
			]);
		});
	});

	describe('->activateBlocks()', function () {
		it('calls the init() method of each block that has an option matching a value in the array it is given', function () {
			allow($this->block1)->toReceive('init');
			expect($this->block1)->toReceive('init')->once();
			$this->blockController->activateBlocks([
				'foo_bar',
			]);
		});
		it('does not call the init() method of blocks that do not have an option matching a value in the array it is given', function () {
			allow($this->block1)->toReceive('init');
			allow($this->block2)->toReceive('init');
			expect($this->block1)->not->toReceive('init');
			expect($this->block2)->toReceive('init')->once();
			$this->blockController->activateBlocks([
				'dumb_struck',
			]);
		});
	});

	describe('->hasParent()', function () {
		beforeEach(function () {
			allow('plugin_dir_path')->toBeCalled();
		});

		it('looks for the block config in the expected path', function () {
			expect('plugin_dir_path')->toBeCalled()->once()->with(Arg::toBeA('string'));

			$this->blockController->hasParent('Custom Block');
		});

		context('if the block config does not exist', function () {
			it('returns false', function () {
				allow('file_exists')->toBeCalled()->andReturn(false);

				expect($this->blockController->hasParent('Custom Block'))->toBe(false);
			});
		});

		context('if the block config exist', function () {
			beforeEach(function () {
				allow('file_exists')->toBeCalled()->andReturn(true);
			});

			it('returns true if the block has a parent', function () {
				allow('file_get_contents')->toBeCalled()->andReturn('{
					"parent": [ "parent-block" ]
				}');

				expect($this->blockController->hasParent('Custom Block'))->toBe(true);
			});

			it('returns false if the block does not have a parent', function () {
				allow('file_get_contents')->toBeCalled()->andReturn('{}');

				expect($this->blockController->hasParent('Custom Block'))->toBe(false);
			});
		});
	});
});
