<?php

namespace GovukComponents\Blocks;

class InsetText implements iBlock
{
    public $templatePath = '/templates/inset_text.php';

    protected const DISPLAY_NAME = 'Inset Text';

    /* NOTE: changing this could affect which */
    /* components a user has activated */
    protected const OPTION_NAME = 'inset_text';

    public function init()
    {
        add_action('init', [$this, 'registerBlock']);
        add_action('init', [$this, 'registerFields']);
    }

    public function registerBlock()
    {
        if (function_exists('acf_register_block_type')) {
            acf_register_block_type([
                'name'              => 'inset_text',
                'title'             => 'Inset Text',
                'description' => 'Use inset and a highlight bar to differentiate a block of text from the content that surrounds it',
                'render_callback'   => [$this, 'render'],
                'mode' => 'auto',
                'category'          => 'govuk-custom',
                'icon'              => 'align-pull-left',
                'keywords'          => [ 'inset', 'highlight', 'text', 'indent' ],
                'example' => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'inset_text_text' => '<p style="border-left: 10px solid #b1b4b6; padding: 15px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque magna justo, rhoncus vel vestibulum nec, condimentum sit amet nisi.</p>'
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
                'key' => 'group_600abb1ff000d',
                'title' => 'Inset text',
                'fields' => [
                    [
                        'key' => 'field_600abb25cb82c',
                        'label' => 'Text',
                        'name' => 'inset_text_text',
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
                        'new_lines' => '',
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'block',
                            'operator' => '==',
                            'value' => 'acf/inset-text',
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

    public function getOptionName(): string
    {
        return self::OPTION_NAME;
    }
}
