<?php

namespace GovukComponents\Blocks;

class WarningText implements \Dxw\Iguana\Registerable
{
    public $templatePath = '/templates/warning_text.php';

    public function register()
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
                'category'          => 'formatting',
                'icon'              => 'warning',
                'keywords'          => [ 'warning', 'text', 'notification' ],
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
}
