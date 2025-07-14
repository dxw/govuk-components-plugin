<?php

describe(\GovukComponents\BlockCategory::class, function () {
	beforeEach(function () {
		$this->blockCategory = new \GovukComponents\BlockCategory();
	});

	describe('->register()', function () {
		it('adds the filter', function () {
			allow('add_filter')->toBeCalled();
			expect('add_filter')->toBeCalled()->once()->with(
				'block_categories_all',
				[ $this->blockCategory, 'newBlocksCategory' ],
				10,
				1
			);
			$this->blockCategory->register();
		});
	});

	describe('->newBlocksCategory()', function () {
		context('the new category is not in the array', function () {
			it('appends a new value to the array, and returns it', function () {
				$categories = [
					[
						'slug'  => 'text',
						'title' => 'Text'
					],
					[
						'slug'  => 'media',
						'title' => 'Media'
					],
					[
						'slug'  => 'design',
						'title' => 'Design'
					],
				];

				$result = $this->blockCategory->newBlocksCategory($categories);
				expect($result)->toEqual([
					[
						"title" => "GOV.UK Design System",
						"slug"  => "govuk-components"
					],
					[
						'slug'  => 'text',
						'title' => 'Text'
					],
					[
						'slug'  => 'media',
						'title' => 'Media'
					],
					[
						'slug'  => 'design',
						'title' => 'Design'
					]
				]);
			});
		});
		context('the new category is in the array', function () {
			it('returns the array unchanged', function () {
				$categories = [
					[
						"title" => "GOV.UK Design System",
						"slug"  => "govuk-components"
					],
					[
						'slug'  => 'text',
						'title' => 'Text'
					],
					[
						'slug'  => 'media',
						'title' => 'Media'
					],
					[
						'slug'  => 'design',
						'title' => 'Design'
					],
				];

				$result = $this->blockCategory->newBlocksCategory($categories);
				expect($result)->toEqual($categories);
			});
		});
	});
});
