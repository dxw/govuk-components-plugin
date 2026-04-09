<?php

describe(\GovukComponents\Blocks\Details\Renderer::class, function () {
	beforeEach(function () {
		$this->renderer = new GovukComponents\Blocks\Details\Renderer();
	});

	describe('->render()', function () {
		describe('old block format (static saved markup)', function () {
			it('detects old block format by <details tag', function () {
				$oldMarkup = '<details><summary>Old</summary><div>Content</div></details>';

				allow('wp_kses_post')->toBeCalled()->with($oldMarkup)->andReturn($oldMarkup);

				$result = $this->renderer->render([], $oldMarkup);
				expect($result)->toBeA('string');
				expect($result)->not->toBeEmpty();
			});

			it('handles old markup with extra attributes', function () {
				$oldMarkup = '<details open class="old"><summary>Summary</summary></details>';

				allow('wp_kses_post')->toBeCalled()->with($oldMarkup)->andReturn($oldMarkup);

				$result = $this->renderer->render([], $oldMarkup);
				expect($result)->toBeA('string');
				expect($result)->not->toBeEmpty();
			});

			it('does not render new structure for old blocks', function () {
				$oldMarkup = '<details>Content</details>';

				allow('wp_kses_post')->toBeCalled()->with($oldMarkup)->andReturn($oldMarkup);

				$result = $this->renderer->render(['summary' => 'Ignored'], $oldMarkup);
				expect($result)->toBe($oldMarkup);
			});
		});

		describe('new block format (dynamic rendering)', function () {
			it('renders HTML structure with summary and content', function () {
				$attributes = ['summary' => 'Test Summary'];
				$content = 'Inner content here';
				allow('get_block_wrapper_attributes')->toBeCalled()->andReturn('class="govuk-details"');
				allow('wp_kses_post')->toBeCalled()->andReturn('Test Summary', 'Inner content here');


				$result = $this->renderer->render($attributes, $content);

				expect($result)->toContain('<details');
				expect($result)->toContain('</details>');
				expect($result)->toContain('<summary');
				expect($result)->toContain('<span class="govuk-details__summary-text">');
				expect($result)->toContain('Test Summary');
				expect($result)->toContain('Inner content here');
				expect($result)->toContain('<div class="govuk-details__text">');
			});

			it('handles missing summary attribute', function () {
				$attributes = [];
				$content = 'Content';
				allow('get_block_wrapper_attributes')->toBeCalled()->andReturn('class="govuk-details"');
				allow('wp_kses_post')->toBeCalled()->andReturn('Content');

				$result = $this->renderer->render($attributes, $content);

				expect($result)->toContain('<summary class="govuk-details__summary">');
				expect($result)->toContain('<details');
			});

			it('renders complete HTML structure', function () {
				allow('get_block_wrapper_attributes')->toBeCalled()->andReturn('class="govuk-details"');
				allow('wp_kses_post')->toBeCalled()->andReturn('Click to expand', 'Details content here');

				$result = $this->renderer->render(
					['summary' => 'Click to expand'],
					'Details content here'
				);
				expect($result)->toContain('<details');
				expect($result)->toContain('<summary class="govuk-details__summary">');
				expect($result)->toContain('<span class="govuk-details__summary-text">');
				expect($result)->toContain('Click to expand');
				expect($result)->toContain('</span>');
				expect($result)->toContain('</summary>');
				expect($result)->toContain('<div class="govuk-details__text">');
				expect($result)->toContain('Details content here');
				expect($result)->toContain('</div>');
				expect($result)->toContain('</details>');
			});

			it('returns a string', function () {
				$attributes = ['summary' => 'Test'];
				$content = 'Content';
				allow('get_block_wrapper_attributes')->toBeCalled()->andReturn('class="govuk-details"');
				allow('wp_kses_post')->toBeCalled()->andReturn($content);

				$result = $this->renderer->render($attributes, $content);

				expect($result)->toBeA('string');
				expect($result)->not->toBeEmpty();
			});
		});

		describe('edge cases', function () {
			it('handles empty summary', function () {
				allow('get_block_wrapper_attributes')->toBeCalled()->andReturn('class="govuk-details"');
				allow('wp_kses_post')->toBeCalled()->andReturn('Content');

				$result = $this->renderer->render(['summary' => ''], 'Content');
				expect($result)->toBeA('string');
				expect($result)->toContain('<details');
				expect($result)->toContain('</details>');
			});

			it('handles empty content', function () {
				allow('get_block_wrapper_attributes')->toBeCalled()->andReturn('class="govuk-details"');
				allow('wp_kses_post')->toBeCalled()->andReturn('Summary', '');

				$result = $this->renderer->render(['summary' => 'Summary'], '');
				expect($result)->toBeA('string');
				expect($result)->toContain('<details');
				expect($result)->toContain('Summary');
			});

			it('handles content with special characters', function () {
				$content = 'Content with <b>HTML</b> and &amp; entities';
				$attributes = ['summary' => 'Test'];
				allow('get_block_wrapper_attributes')->toBeCalled()->andReturn('class="govuk-details"');
				allow('wp_kses_post')->toBeCalled()->andReturn($content);

				$result = $this->renderer->render($attributes, $content);

				expect($result)->toContain('<details');
				expect($result)->not->toBeEmpty();
			});

			it('handles summary with special characters', function () {
				$summary = 'Summary with &amp; and <span>HTML</span>';
				$attributes = ['summary' => $summary];
				$content = 'Content';
				allow('get_block_wrapper_attributes')->toBeCalled()->andReturn('class="govuk-details"');
				allow('wp_kses_post')->toBeCalled()->andReturn($content);

				$result = $this->renderer->render($attributes, $content);

				expect($result)->toContain('<details');
				expect($result)->not->toBeEmpty();
			});
		});
	});
});
