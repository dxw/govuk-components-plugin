<?php

namespace GovukComponents;

final class Options implements \Dxw\Iguana\Registerable
{
	private $blockController;

	public function __construct(BlockController $blockController)
	{
		$this->blockController = $blockController;
	}

	#[\Override]
	public function register(): void
	{
		/** @psalm-suppress HookNotFound */
		add_action('acf/init', [$this, 'addPage']);

		/** @psalm-suppress HookNotFound */
		add_action('acf/init', [$this, 'registerOptions']);

		/** @psalm-suppress HookNotFound */
		add_action('acf/init', [$this, 'apply']);

		/** @psalm-suppress HookNotFound */
		add_filter('acf/validate_save_post', [$this, 'validatePhaseBannerOptions']);

		add_filter('plugin_action_links_govuk-components-plugin/index.php', [$this, 'addSettingsLink']);

		/** @psalm-suppress HookNotFound */
		add_filter('acf/load_field/name=govuk_components_notification_banner_border_colour', [$this, 'addDefaultThemeColours']);
		/** @psalm-suppress HookNotFound */
		add_filter('acf/load_field/name=govuk_components_notification_banner_heading_text_colour', [$this, 'addDefaultThemeColours']);

	}

	/**
	 * Adds a settings link to the plugin on the plugins page.
	 * @param string[] $actions
	 * @return string[]
	 */
	public function addSettingsLink(array $actions): array
	{
		$link = 'Settings';
		/** @var string */
		$url = admin_url('options-general.php?page=acf-options-gov-uk-components');

		array_unshift($actions, sprintf('<a href="%s">%s</a>', esc_url($url), esc_html($link)));
		return $actions;
	}

	public function addPage(): void
	{
		if (function_exists('acf_add_options_page')) {
			acf_add_options_page([
				'page_title' => 'GOV.UK Components',
				'capability' => 'edit_users',
				'parent_slug' => 'options-general.php'
			]);
		}
	}

	public function registerOptions(): void
	{
		if (function_exists('acf_add_local_field_group')):

			acf_add_local_field_group([
				'key' => 'group_60117c47385e6',
				'title' => 'Choose which GOV.UK Blocks to Make Available',
				'fields' => [
					[
						'key' => 'field_60117c7564efc',
						'label' => 'Enable component blocks',
						'name' => 'govuk_components_enable_component_blocks',
						'type' => 'checkbox',
						'instructions' => 'Tick the checkboxes for the component blocks you would like available in the block editor.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
						'choices' => $this->blockController->getAvailableBlockOptions(),
						'allow_custom' => 0,
						'default_value' => $this->blockController->getDefaultBlockOptions(),
						'layout' => 'vertical',
						'toggle' => 0,
						'return_format' => 'value',
						'save_custom' => 0,
					],
				],
				'location' => [
					[
						[
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'acf-options-gov-uk-components',
						],
					],
				],
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			]);

			acf_add_local_field_group([
				'key' => 'govuk_phase_banner_group',
				'title' => 'Phase Banner Settings',
				'fields' => [
					[
						'key' => 'govuk_components_phase_banner_phase',
						'label' => 'Service Phase',
						'name' => 'govuk_components_phase_banner_phase',
						'type' => 'radio',
						'instructions' => 'Select the current development phase of the service.',
						'required' => 1,
						'choices' => [
							'off' => 'N/A - do not display banner',
							'alpha' => 'Alpha',
							'beta' => 'Beta',
						],
						'default_value' => 'off',
						'layout' => 'vertical',
						'return_format' => 'Value',
					],
					[
						'key' => 'govuk_components_phase_banner_feedback_url',
						'label' => 'Feedback URL',
						'name' => 'govuk_components_phase_banner_feedback_url',
						'type' => 'url',
						'instructions' => 'Enter the URL for the feedback page.',
						'required' => 0,
						'placeholder' => 'https://www.example.com/feedback',
						'conditional_logic' => [
							[
								[
									'field' => 'govuk_components_phase_banner_phase',
									'operator' => '!=',
									'value' => 'off',
								],
							],
						],
					],
					[
						'key' => 'govuk_components_phase_banner_feedback_email',
						'label' => 'Feedback Email Address',
						'name' => 'govuk_components_phase_banner_feedback_email',
						'type' => 'email',
						'instructions' => 'Enter the email address for feedback.',
						'required' => 0,
						'placeholder' => 'feedback@example.com',
						'conditional_logic' => [
							[
								[
									'field' => 'govuk_components_phase_banner_phase',
									'operator' => '!=',
									'value' => 'off',
								],
							],
						],
					],
				],
				'location' => [
					[
						[
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'acf-options-gov-uk-components',
						],
					],
				],
				'menu_order' => 1,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			]);

			acf_add_local_field_group([
				'key' => 'govuk_components_notification_banner_group',
				'title' => 'Notification Banner Settings',
				'fields' => [
					[
						'key' => 'govuk_components_notification_banner_show',
						'label' => 'Show Notification Banner',
						'name' => 'govuk_components_notification_banner_show',
						'type' => 'radio',
						'instructions' => 'Choose to show or hide the notification banner on all pages.',
						'required' => 1,
						'choices' => [
							'off' => 'Banner off (default)',
							'on' => 'Banner on',
						],
						'default_value' => 'off',
						'layout' => 'vertical',
						'return_format' => 'Value',
					],
					[
						'key' => 'govuk_components_notification_banner_heading',
						'label' => 'Heading',
						'name' => 'govuk_components_notification_banner_heading',
						'type' => 'text',
						'prefix' => '',
						'instructions' => 'Enter the heading for the banner (default: Important).',
						'required' => 0,
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
						'default_value' => 'Important',
						'placeholder' => 'Important',
						'conditional_logic' => [
							[
								[
									'field' => 'govuk_components_notification_banner_show',
									'operator' => '!=',
									'value' => 'off',
								],
							],
						],
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
					],
					[
						'key' => 'govuk_components_notification_banner_content',
						'label' => 'Content',
						'name' => 'govuk_components_notification_banner_content',
						'type' => 'wysiwyg',
						'instructions' => 'Enter rich text content for the banner. You can use headings, links, and other HTML here.',
						'required' => 0,
						'conditional_logic' => [
							[
								[
									'field' => 'govuk_components_notification_banner_show',
									'operator' => '!=',
									'value' => 'off',
								],
							],
						],
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					],
					[
						'key' => 'govuk_components_notification_banner_border_colour',
						'label' => 'Border colour',
						'name' => 'govuk_components_notification_banner_border_colour',
						'type' => 'select',
						'instructions' => 'Select border colour for the notification banner.',
						'required' => 1,
						'conditional_logic' => [
							[
								[
									'field' => 'govuk_components_notification_banner_show',
									'operator' => '!=',
									'value' => 'off',
								],
							],
						],
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					],
					[
						'key' => 'govuk_components_notification_banner_heading_text_colour',
						'label' => 'Heading text colour',
						'name' => 'govuk_components_notification_banner_heading_text_colour',
						'type' => 'select',
						'instructions' => 'Select heading text colour for the notification banner.',
						'required' => 1,
						'conditional_logic' => [
							[
								[
									'field' => 'govuk_components_notification_banner_show',
									'operator' => '!=',
									'value' => 'off',
								],
							],
						],
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					],
				],
				'location' => [
					[
						[
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'acf-options-gov-uk-components',
						],
					],
				],
				'menu_order' => 2,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => 'A field group for global site content.',
			]);

		endif;
	}

	public function apply(): void
	{
		/** @var list<string>|null */
		$activeBlocks = get_field('govuk_components_enable_component_blocks', 'option');
		if (is_null($activeBlocks)) {
			$activeBlocks = $this->blockController->getDefaultBlockOptions();
		}
		/** @var list<string> $activeBlocks */
		$this->blockController->activateBlocks($activeBlocks);
	}

	public function validatePhaseBannerOptions(): void
	{
		$phase = isset($_POST['acf']['govuk_components_phase_banner_phase']) ? $_POST['acf']['govuk_components_phase_banner_phase'] : '';
		$feedback_url = isset($_POST['acf']['govuk_components_phase_banner_feedback_url']) ? $_POST['acf']['govuk_components_phase_banner_feedback_url'] : '';
		$feedback_email = isset($_POST['acf']['govuk_components_phase_banner_feedback_email']) ? $_POST['acf']['govuk_components_phase_banner_feedback_email'] : '';

		if (($phase === 'alpha' || $phase === 'beta')) {
			if (empty($feedback_url) && empty($feedback_email)) {
				acf_add_validation_error('acf[govuk_components_phase_banner_phase]', 'Please provide EITHER a URL or an email address for feedback.');
			}
			if (!empty($feedback_url) && !empty($feedback_email)) {
				acf_add_validation_error('acf[govuk_components_phase_banner_phase]', 'Please provide EITHER a URL or an email address for feedback, but not both.');
			}
		}
	}

	public function addDefaultThemeColours(array $field): array
	{
		/**
		 * @var array{
		 *   color?: array{
		 *     palette?: array{
		 *       theme?: list<array{
		 *         slug: string,
		 *         name: string,
		 *         color: string
		 *       }>
		 *     },
		 *   },
		 * } $globalSettings
		 */
		$globalSettings = wp_get_global_settings();
		if (isset($globalSettings['color']['palette']['theme'])) {
			$colours = $globalSettings['color']['palette']['theme'];
			$choices = [];
			foreach ($colours as $colour) {
				$choices[$colour['slug']] = $colour['name'];
			}
			$field['choices'] = $choices;
		}
		return $field;
	}
}
