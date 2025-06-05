<?php

namespace GovukComponents\Blocks;

class Details implements iBlock
{
	protected const DISPLAY_NAME = 'Details';

	/* NOTE: changing this could affect which */
	/* components a user has activated */
	protected const OPTION_NAME = 'details';

	public $templatePath = '/templates/details.php';

	public function init()
	{
		add_action('init', [$this, 'registerBlock']);
		add_action('init', [$this, 'registerFields']);
	}

	public function registerBlock()
	{
		if (function_exists('acf_register_block_type')) {
			acf_register_block_type([
				'name'              => 'details',
				'title'             => 'Details',
				'description' => 'Make a page easier to scan by letting users reveal more detailed information only if they need it.',
				'render_callback'   => [$this, 'render'],
				'mode' => 'auto',
				'category'          => 'govuk-custom',
				'icon'              => 'arrow-down',
				'keywords'          => [ 'details', 'accordion' ],
				'example' => [
					'attributes' => [
						'mode' => 'preview',
						'data' => [
							'details_summary' => 'The summary heading',
							'details_text' => 'The main text.'
						]
					]
				]
			]);
		}
	}

	public function registerFields()
	{
		if (function_exists('acf_add_local_field_group')):

			acf_add_local_field_group([
				'key' => 'group_600aa546ee518',
				'title' => 'Details',
				'fields' => [
					[
						'key' => 'field_600aa55198405',
						'label' => 'Summary',
						'name' => 'details_summary',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					],
					[
						'key' => 'field_600aa57398406',
						'label' => 'Text',
						'name' => 'details_text',
						'type' => 'textarea',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'new_lines' => 'br',
					],
				],
				'location' => [
					[
						[
							'param' => 'block',
							'operator' => '==',
							'value' => 'acf/details',
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

		endif;
	}

	public function render()
	{
		load_template(dirname(plugin_dir_path(__FILE__), 2) . $this->templatePath, false);
	}

	public function getOptionName(): string
	{
		return self::OPTION_NAME;
	}

	public function getDisplayName(): string
	{
		return self::DISPLAY_NAME;
	}
}
