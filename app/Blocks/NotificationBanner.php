<?php

namespace GovukComponents\Blocks;

class NotificationBanner implements iBlock
{
    public $templatePath = '/templates/notification_banner.php';

    public $count = 0;

    protected const DISPLAY_NAME = 'Notification Banner';

    /* NOTE: changing this could affect which */
    /* components a user has activated */
    protected const OPTION_NAME = 'notification_banner';

    public function init()
    {
        add_action('init', [$this, 'registerBlock']);
        add_action('init', [$this, 'registerFields']);
    }

    public function registerBlock()
    {
        if (function_exists('acf_register_block_type')) {
            acf_register_block_type([
                'name'              => 'notification_banner',
                'title'             => 'Notification Banner',
                'render_callback'   => [$this, 'render'],
                'mode' => 'auto',
                'category'          => 'formatting',
                'icon'              => 'info',
                'keywords'          => [ 'notification', 'banner' ],
            ]);
        }
    }

    public function registerFields()
    {
        if (function_exists('acf_add_local_field_group')):

            acf_add_local_field_group([
                'key' => 'group_600acaec166e4',
                'title' => 'Notification Banner',
                'fields' => [
                    [
                        'key' => 'field_600acaf76848d',
                        'label' => 'Title',
                        'name' => 'notification_banner_title',
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
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_600acaf96248d',
                        'label' => 'Text',
                        'name' => 'notification_banner_text',
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
                            'value' => 'acf/notification-banner',
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
            'govuk-components-notification-banner-count' => $this->count
        ]);
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
