<?php

namespace GovukComponents\Blocks;

class Accordion implements iBlock
{
	/* the path to the template for this block from the root of the plugin */
	public $templatePath = '/templates/accordion.php';

	public $count = 0;

	protected const DISPLAY_NAME = 'Accordion';

	/* NOTE: changing this could affect which */
	/* components a user has activated */
	protected const OPTION_NAME = 'accordion';

	public function init()
	{
		add_action('init', [$this, 'registerBlock']);
		add_action('init', [$this, 'registerFields']);
	}

	public function registerBlock()
	{
		if (function_exists('acf_register_block_type')) {
			acf_register_block_type([
				'name'              => 'accordion',
				'title'             => 'Accordion',
				'description' => 'Let users show and hide sections of related content on a page.',
				'render_callback'   => [$this, 'render'],
				'mode' => 'auto',
				'category'          => 'govuk-custom',
				'icon'              => 'list-view',
				'keywords'          => [ 'accordion' ],
				'example' => [
					'attributes' => [
						'mode' => 'preview',
						'data' => [
							"accordion_sections_0_accordion_section_heading" => "",
							"_accordion_sections_0_accordion_section_heading" => "field_60081b8cdb418",
							"accordion_sections_0_accordion_section_content" => '<img src="' . esc_url(plugins_url('/examples/accordion.png', __FILE__)) . '" >',
							"_accordion_sections_0_accordion_section_content" => "field_60081b94db419",
							"accordion_sections" => 1,
							"_accordion_sections" => "field_600819addb417"
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
				'key' => 'group_600819a94d98b',
				'title' => 'Accordion',
				'fields' => [
					[
						'key' => 'field_600819addb417',
						'label' => 'Sections',
						'name' => 'accordion_sections',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
						'collapsed' => '',
						'min' => 1,
						'max' => 0,
						'layout' => 'block',
						'button_label' => 'Add Section',
						'sub_fields' => [
							[
								'key' => 'field_60081b8cdb418',
								'label' => 'Section heading',
								'name' => 'accordion_section_heading',
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
								'key' => 'field_62f105ff0cbac',
								'label' => 'Attach ID to heading?',
								'name' => 'attach_id_to_accordion_section_heading',
								'type' => 'true_false',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => [
									'width' => '',
									'class' => '',
									'id' => '',
								],
								'message' => '',
								'default_value' => 0,
								'ui' => 0,
								'ui_on_text' => '',
								'ui_off_text' => '',
							],
							[
								'key' => 'field_62f106170cbad',
								'label' => 'ID',
								'name' => 'accordion_section_heading_id',
								'type' => 'text',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => [
									[
										[
											'field' => 'field_62f105ff0cbac',
											'operator' => '==',
											'value' => '1',
										],
									],
								],
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
								'key' => 'field_60081b94db419',
								'label' => 'Section content',
								'name' => 'accordion_section_content',
								'type' => 'wysiwyg',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
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
					],
				],
				'location' => [
					[
						[
							'param' => 'block',
							'operator' => '==',
							'value' => 'acf/accordion',
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
		$this->count = $this->count + 1;
		load_template(dirname(plugin_dir_path(__FILE__), 2) . $this->templatePath, false, [
			'govuk-components-accordion-count' => $this->count
		]);
	}

	public function getDisplayName(): string
	{
		return self::DISPLAY_NAME;
	}

	public function getOptionName(): string
	{
		return self::OPTION_NAME;
	}
}
