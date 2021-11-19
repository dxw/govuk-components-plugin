<?php

namespace GovukComponents\Blocks;

class WarningText implements iBlock
{
    public $templatePath = '/templates/warning_text.php';

    protected const DISPLAY_NAME = "Warning Text";

    /* NOTE: changing this could affect which */
    /* components a user has activated */
    protected const OPTION_NAME = 'warning_text';

    public function init()
    {
        add_action('init', [$this, 'registerBlock']);
        add_action('init', [$this, 'registerFields']);
    }

    public function registerBlock()
    {
        if (function_exists('acf_register_block_type')) {
            acf_register_block_type([
                'name'              => 'warning_text',
                'title'             => 'Warning Text',
                'render_callback'   => [$this, 'render'],
                'mode' => 'auto',
                'category'          => 'govuk-custom',
                'icon'              => 'warning',
                'keywords'          => [ 'warning', 'text', 'notification' ],
                'example' => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'warning_text_text' => '<img src="' . esc_url(plugins_url('/examples/warning_text.png', __FILE__)) . '" >'
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
                'key' => 'group_600ffbcc8c97f',
                'title' => 'Warning Text',
                'fields' => [
                    [
                        'key' => 'field_600ffbdcab718',
                        'label' => 'Text',
                        'name' => 'warning_text_text',
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
                ],
                'location' => [
                    [
                        [
                            'param' => 'block',
                            'operator' => '==',
                            'value' => 'acf/warning-text',
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

    public function getDisplayName() : string
    {
        return self::DISPLAY_NAME;
    }

    public function getOptionName() : string
    {
        return self::OPTION_NAME;
    }
}
