<?php

namespace GovukComponents\Blocks;

class Button implements iBlock
{
    /* the path to the template for this block from the root of the plugin */
    public $templatePath = '/templates/button.php';

    protected const DISPLAY_NAME = 'Button';

    /* NOTE: changing this could affect which */
    /* components a user has activated */
    protected const OPTION_NAME = 'button';

    public function init()
    {
        add_action('init', [$this, 'registerBlock']);
        add_action('init', [$this, 'registerFields']);
    }

    public function registerBlock()
    {
        if (function_exists('acf_register_block_type')) {
            acf_register_block_type([
                'name'            => 'button',
                'title'           => 'Button',
                'description'     => 'Help users carry out an action like starting an application or saving their information.',
                'render_callback' => [$this, 'render'],
                'category'        => 'govuk-custom',
                'icon'            => 'button',
                'keywords'        => ['button', 'link'],
                'mode'            => 'auto',
                'example' => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'text' => 'Press this button',
                            'button_link' => '#',
                            'style' => ''
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
                    'key' => 'group_button_block',
                    'title' => 'Button',
                    'fields' => [
                        [
                            'key' => 'button_text',
                            'label' => 'Text',
                            'name' => 'text',
                            'type' => 'text',
                            'required' => 0,
                            'conditional_logic' => 0,
                        ],
                        [
                            'key' => 'button_link',
                            'label' => 'Link',
                            'name' => 'link',
                            'type' => 'link',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'return_format' => 'url',
                        ],
                        [
                            'key' => 'button_style',
                            'label' => 'Style',
                            'name' => 'style',
                            'type' => 'select',
                            'choices' => [
                                '' => 'Default',
                                'govuk-button--secondary' => 'Secondary',
                                'govuk-button--warning' => 'Warning',
                                'govuk-button--start' => 'Start',
                            ],
                            'default_value' => false,
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 0,
                            'return_format' => 'value',
                        ],
                    ],
                    'location' => [
                        [
                            [
                                'param' => 'block',
                                'operator' => '==',
                                'value' => 'acf/button',
                            ],
                        ],
                    ],
                    'menu_order' => 0,
                    'position' => 'normal',
                    'style' => 'default',
                    'label_placement' => 'top',
                    'instruction_placement' => 'label',
                    'active' => true,
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
