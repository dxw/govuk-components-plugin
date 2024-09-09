<?php

namespace GovukComponents;

class Options implements \Dxw\Iguana\Registerable
{
	private $blockController;

	public function __construct(BlockController $blockController)
	{
		$this->blockController = $blockController;
	}

	public function register()
	{
		add_action('acf/init', [$this, 'addPage']);
		add_action('acf/init', [$this, 'registerOptions']);
		add_action('acf/init', [$this, 'apply']);
	}

	public function addPage()
	{
		if (function_exists('acf_add_options_page')) {
			acf_add_options_page([
				'page_title' => 'GOV.UK Components',
				'capability' => 'edit_users',
				'parent_slug' => 'options-general.php'
			]);
		}
	}

	public function registerOptions()
	{
		if (function_exists('acf_add_local_field_group')):

			acf_add_local_field_group([
				'key' => 'group_60117c47385e6',
				'title' => 'Options',
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

		endif;
	}

	public function apply()
	{
		$activeBlocks = get_field('govuk_components_enable_component_blocks', 'option');
		if (is_null($activeBlocks)) {
			$activeBlocks = $this->blockController->getDefaultBlockOptions();
		}
		$this->blockController->activateBlocks($activeBlocks);
	}
}
