<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if(!class_exists('NHP_Options')){
	require_once( dirname( __FILE__ ) . '/options/options.php' );
}

function add_another_section($sections){
	$sections[] = array(
				'title' => __('A Section added by hook', 'nhp-opts'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'nhp-opts'),
				'icon' => trailingslashit(get_stylesheet_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				'fields' => array()
				);
	return $sections;
}

function setup_framework_options(){
    $args = array();

    //Set it to dev mode to view the class settings/info in the form - default is false
    $args['dev_mode'] = false;

    //Add HTML before the form
    $args['intro_text'] = __('<p>There are settings for your theme.</p>', 'nhp-opts');

    //Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
    $args['opt_name'] = 'ThemeOptions';

    //Custom menu title for options page - default is "Options"
    $args['menu_title'] = __('Theme Options', 'nhp-opts');

    //Custom Page Title for options page - default is "Options"
    $args['page_title'] = __('Theme Options', 'nhp-opts');

    //Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
    $args['page_slug'] = 'theme_options';

    $args['page_type'] = 'menu';

    //custom page location - default 100 - must be unique or will override other items
    $args['page_position'] = 65;

    //Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition
    $args['help_tabs'][] = array(
                                'id' => 'nhp-opts-1',
                                'title' => __('Theme Information 1', 'nhp-opts'),
                                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'nhp-opts')
                            );
    $args['help_tabs'][] = array(
                                'id' => 'nhp-opts-2',
                                'title' => __('Theme Information 2', 'nhp-opts'),
                                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'nhp-opts')
                            );

    //Set the Help Sidebar for the options page - no sidebar by default
    $args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'nhp-opts');

    $sections = array();
    //header
    $sections[] = array(
        'title' => __('Header', 'nhp-opts'),
        'fields' => array(
            array(
                'id' => 'main_phone_number',//1
                'type' => 'text', //builtin fields include:
                //text|textarea|editor|checkbox|multi_checkbox|radio|radio_img|button_set|select|multi_select|color|date|divide|info|upload
                'title' => __('Phone number', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'main_email',//2
                'type' => 'text',
                'title' => __('Email', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
    //            array(
    //                'id' => '6',
    //                'type' => 'upload',
    //                'title' => __('Image', 'nhp-opts'),
    //            ),
        )
    );
    //footer
    $sections[] = array(
        'title' => __('Footer', 'nhp-opts'),
        'fields' => array(
            array(
                'id' => 'main_address_ru', //10
                'type' => 'textarea',
                'title' => __('Адрес', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'main_address_uk', //11
                'type' => 'textarea',
                'title' => __('Адреса', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'main_address_en', //12
                'type' => 'textarea',
                'title' => __('Address', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
        )
    );
    //social acc
    $sections[] = array(
     	'title' => __('Social accounts', 'nhp-opts'),
        'fields' => array(
            array(
                'id' => 'facebook_link', //13
                'type' => 'text',
                'title' => __('Facebook', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'instagram_link', //14
                'type' => 'text',
                'title' => __('Instagram', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'youtube_link', //15
                'type' => 'text',
                'title' => __('Youtube', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
        )
    );
    //popups
    $sections[] = array(
        'title' => __('Popups', 'nhp-opts'),
        'fields' => array(
            array(
                'id' => 'become_partner_ru', //16
                'type' => 'text',
                'title' => __('Стать партнером', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_partner_hover_ru',
                'type' => 'text',
                'title' => __('Стать партнером (ховер) (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_partner_hover_link_text_ru',
                'type' => 'text',
                'title' => __('Стать партнером текст ссылки (ховер) (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_partner_hover_link_ru',
                'type' => 'text',
                'title' => __('Стать партнером ссылка (ховер) (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_partner_uk', //17
                'type' => 'text',
                'title' => __('Стать партнером (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_partner_hover_uk',
                'type' => 'text',
                'title' => __('Стать партнером (ховер) (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_partner_hover_link_text_uk',
                'type' => 'text',
                'title' => __('Стать партнером текст ссылки (ховер) (uk)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_partner_hover_link_uk',
                'type' => 'text',
                'title' => __('Стать партнером ссылка (ховер) (uk)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_partner_en', //18
                'type' => 'text',
                'title' => __('Стать партнером (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_partner_hover_en',
                'type' => 'text',
                'title' => __('Стать партнером (ховер) (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_partner_hover_link_text_en',
                'type' => 'text',
                'title' => __('Стать партнером текст ссылки (ховер) (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_partner_hover_link_en',
                'type' => 'text',
                'title' => __('Стать партнером ссылка (ховер) (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_volunteer_ru', //19
                'type' => 'text',
                'title' => __('Стать волонтером', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_volunteer_hover_ru',
                'type' => 'text',
                'title' => __('Стать волонтером (ховер)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_volunteer_hover_link_text_ru',
                'type' => 'text',
                'title' => __('Стать волонтером текст ссылки (ховер) (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_volunteer_hover_link_ru',
                'type' => 'text',
                'title' => __('Стать волонтером ссылка (ховер) (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_volunteer_uk', //20
                'type' => 'text',
                'title' => __('Стать волонтером (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_volunteer_hover_uk',
                'type' => 'text',
                'title' => __('Стать волонтером (ховер) (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_volunteer_hover_link_text_uk',
                'type' => 'text',
                'title' => __('Стать волонтером текст ссылки (ховер) (uk)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_volunteer_hover_link_uk',
                'type' => 'text',
                'title' => __('Стать волонтером ссылка (ховер) (uk)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_volunteer_en', //21
                'type' => 'text',
                'title' => __('Стать волонтером (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_volunteer_hover_en',
                'type' => 'text',
                'title' => __('Стать волонтером (ховер) (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_volunteer_hover_link_text_en',
                'type' => 'text',
                'title' => __('Стать волонтером текст ссылки (ховер) (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'become_volunteer_hover_link_en',
                'type' => 'text',
                'title' => __('Стать волонтером ссылка (ховер) (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'help_by_sms_ru', //22
                'type' => 'text',
                'title' => __('Помощь по смс', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'help_by_sms_hover_ru',
                'type' => 'text',
                'title' => __('Помощь по смс (ховер) (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'help_by_sms_hover_text_link_ru',
                'type' => 'text',
                'title' => __('Помощь по смс текст ссылки (ховер) (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'help_by_sms_uk', //23
                'type' => 'text',
                'title' => __('Помощь по смс (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'help_by_sms_hover_uk',
                'type' => 'text',
                'title' => __('Помощь по смс ховер (uk)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'help_by_sms_hover_text_link_uk',
                'type' => 'text',
                'title' => __('Помощь по смс текст ссылки (ховер) (uk)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'help_by_sms_en', //24
                'type' => 'text',
                'title' => __('Помощь по смс (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'help_by_sms_hover_en',
                'type' => 'text',
                'title' => __('Помощь по смс ховер (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'help_by_sms_hover_text_link_en',
                'type' => 'text',
                'title' => __('Помощь по смс текст ссылки (ховер) (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'charity_shop_ru',
                'type' => 'text',
                'title' => __('Благотворительный магазин (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'charity_shop_hover_ru',
                'type' => 'text',
                'title' => __('Благотворительный магазин (ховер) (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'charity_shop_hover_link_text_ru',
                'type' => 'text',
                'title' => __('Благотворительный магазин текст ссылки (ховер) (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'charity_shop_hover_link_ru',
                'type' => 'text',
                'title' => __('Благотворительный магазин ссылка (ховер) (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'charity_shop_uk',
                'type' => 'text',
                'title' => __('Благотворительный магазин (uk)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'charity_shop_hover_uk',
                'type' => 'text',
                'title' => __('Благотворительный магазин (ховер) (uk)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'charity_shop_hover_link_text_uk',
                'type' => 'text',
                'title' => __('Благотворительный магазин текст ссылки (ховер) (uk)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'charity_shop_hover_link_uk',
                'type' => 'text',
                'title' => __('Благотворительный магазин ссылка (ховер) (uk)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'charity_shop_en',
                'type' => 'text',
                'title' => __('Благотворительный магазин (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'charity_shop_hover_en',
                'type' => 'text',
                'title' => __('Благотворительный магазин (ховер) (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'charity_shop_hover_link_text_en',
                'type' => 'text',
                'title' => __('Благотворительный магазин текст ссылки (ховер) (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'charity_shop_hover_link_en',
                'type' => 'text',
                'title' => __('Благотворительный магазин ссылка (ховер) (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => '58',
                'type' => 'info',
                'desc' => __('Допомогти по смс', 'nhp-opts')
            ),
            array(
                'id' => 'popup_sms_title_ru', //4
                'type' => 'text',
                'title' => __('Title (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'popup_sms_text_ru', //5
                'type' => 'textarea',
                'title' => __('Text (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'popup_sms_link_ru',
                'type' => 'text',
                'title' => __('Link (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'popup_sms_title_uk', //6
                'type' => 'text',
                'title' => __('Title (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'popup_sms_text_uk', //7
                'type' => 'textarea',
                'title' => __('Text (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'popup_sms_link_uk',
                'type' => 'text',
                'title' => __('Link (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'popup_sms_title_en', //8
                'type' => 'text',
                'title' => __('Title (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'popup_sms_text_en', //9
                'type' => 'textarea',
                'title' => __('Text (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'popup_sms_link_en',
                'type' => 'text',
                'title' => __('Link (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'placeholders',
                'type' => 'info',
                'desc' => __('Форма помощи', 'nhp-opts')
            ),
            array(
                'id' => 'title_help_block_uk',
                'type' => 'text',
                'title' => __('Title (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'title_help_block_ru',
                'type' => 'text',
                'title' => __('Title (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'title_help_block_en',
                'type' => 'text',
                'title' => __('Title (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'sum_help_block_uk',
                'type' => 'text',
                'title' => __('Сума внеску (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'sum_help_block_ru',
                'type' => 'text',
                'title' => __('Сума внеску (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'sum_help_block_en',
                'type' => 'text',
                'title' => __('Сума внеску (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'name_help_block_uk',
                'type' => 'text',
                'title' => __('ФИО (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'name_help_block_ru',
                'type' => 'text',
                'title' => __('ФИО (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'name_help_block_en',
                'type' => 'text',
                'title' => __('ФИО (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'phone_help_block_uk',
                'type' => 'text',
                'title' => __('Phone (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'phone_help_block_ru',
                'type' => 'text',
                'title' => __('Phone (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'phone_help_block_en',
                'type' => 'text',
                'title' => __('Phone (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'payonce_help_block_uk',
                'type' => 'text',
                'title' => __('Одноразово (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'payonce_help_block_ru',
                'type' => 'text',
                'title' => __('Одноразово (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'payonce_help_block_en',
                'type' => 'text',
                'title' => __('Одноразово (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'monthly_help_block_uk',
                'type' => 'text',
                'title' => __('Помесячно (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'monthly_help_block_ru',
                'type' => 'text',
                'title' => __('Помесячно (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'monthly_help_block_en',
                'type' => 'text',
                'title' => __('Помесячно (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'text_help_block_uk',
                'type' => 'text',
                'title' => __('Text (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'text_help_block_ru',
                'type' => 'text',
                'title' => __('Text (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'text_help_block_en',
                'type' => 'text',
                'title' => __('Text (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'agree_help_block_uk',
                'type' => 'text',
                'title' => __('Оферта согласен текст до ссылки(ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'agree_help_block_ru',
                'type' => 'text',
                'title' => __('Оферта согласен текст  до ссылки(ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'agree_help_block_en',
                'type' => 'text',
                'title' => __('Оферта согласен текст  до ссылки(en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'agree_link_text_block_uk',
                'type' => 'text',
                'title' => __('Оферта согласен текст ссылки(ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'agree_link_text_block_ru',
                'type' => 'text',
                'title' => __('Оферта согласен текст ссылки(ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'agree_link_text_block_en',
                'type' => 'text',
                'title' => __('Оферта согласен текст ссылки(en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'agree_link_block_uk',
                'type' => 'text',
                'title' => __('Оферта согласен ссылка(ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'agree_link_block_ru',
                'type' => 'text',
                'title' => __('Оферта согласен текст ссылка(ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'agree_link_block_en',
                'type' => 'text',
                'title' => __('Оферта согласен текст ссылка(en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_text_block_uk',
                'type' => 'text',
                'title' => __('текст ссылки "Отменить подписку" (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_text_block_ru',
                'type' => 'text',
                'title' => __('текст ссылки "Отменить подписку" (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_text_block_en',
                'type' => 'text',
                'title' => __('текст ссылки "Отменить подписку" (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_link_block_uk',
                'type' => 'text',
                'title' => __('ссылка "Отменить подписку" (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_link_block_ru',
                'type' => 'text',
                'title' => __('ссылка "Отменить подписку" (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_link_block_en',
                'type' => 'text',
                'title' => __('ссылка "Отменить подписку" (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_form',
                'type' => 'info',
                'desc' => __('Форма отмены подписки', 'nhp-opts')
            ),
            array(
                'id' => 'cancel_subscription_form_title_block_uk',
                'type' => 'text',
                'title' => __('заголофок формы "Отменить подписку" (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_form_title_block_ru',
                'type' => 'text',
                'title' => __('заголофок формы "Отменить подписку" (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_form_title_block_en',
                'type' => 'text',
                'title' => __('заголофок формы "Отменить подписку" (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_form_submit_button_uk',
                'type' => 'text',
                'title' => __('текст кнопки "Отменить" (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_form_submit_button_ru',
                'type' => 'text',
                'title' => __('текст кнопки "Отменить" (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_form_submit_button_en',
                'type' => 'text',
                'title' => __('текст кнопки "Отменить" (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),

            array(
                'id' => 'cancel_subscription_text_after_uk',
                'type' => 'text',
                'title' => __('текст после отмены подписки (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_text_after_ru',
                'type' => 'text',
                'title' => __('текст после отмены подписки (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_text_after_en',
                'type' => 'text',
                'title' => __('текст после отмены подписки (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_text_after_again_uk',
                'type' => 'text',
                'title' => __('текст после повторной отмены подписки (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_text_after_again_ru',
                'type' => 'text',
                'title' => __('текст после повторной отмены подписки (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'cancel_subscription_text_after_again_en',
                'type' => 'text',
                'title' => __('текст после повторной отмены подписки (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'help_text_contact_page',
                'type' => 'info',
                'desc' => __('Текст допомоги на сторiнцi контактiв', 'nhp-opts')
            ),
            array(
                'id' => 'help_text_contact_page_uk',
                'type' => 'textarea',
                'title' => __('текст допомоги на сторiнцi контактiв (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'help_text_contact_page_ru',
                'type' => 'textarea',
                'title' => __('текст допомоги на сторiнцi контактiв (ru)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'help_text_contact_page_en',
                'type' => 'textarea',
                'title' => __('текст допомоги на сторiнцi контактiв (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
        )
    );
    //copyrights
    $sections[] = array(
        'title' => __('Copyrights', 'nhp-opts'),
        'fields' => array(
            array(
                'id' => '25',
                'type' => 'info',
                'desc' => __('Column 1', 'nhp-opts')
            ),
            array(
                'id' => 'column_1_text_ru', //26
                'type' => 'text',
                'title' => __('Text', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_1_text_uk', //27
                'type' => 'text',
                'title' => __('Text (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_1_text_en', //28
                'type' => 'text',
                'title' => __('Text (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => '29',
                'type' => 'info',
                'desc' => __('Column 2', 'nhp-opts')
            ),
            array(
                'id' => 'column_2_title_ru', //30
                'type' => 'text',
                'title' => __('Title', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_2_link_ru', //31
                'type' => 'text',
                'title' => __('Link', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_2_title_uk', //32
                'type' => 'text',
                'title' => __('Title (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_2_link_uk', //33
                'type' => 'text',
                'title' => __('Link (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_2_title_en', //34
                'type' => 'text',
                'title' => __('Title (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_2_link_en', //35
                'type' => 'text',
                'title' => __('Link (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => '36',
                'type' => 'info',
                'desc' => __('Column 3', 'nhp-opts')
            ),
            array(
                'id' => 'column_3_title_ru', //37
                'type' => 'text',
                'title' => __('Title', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_3_link_ru', //38
                'type' => 'text',
                'title' => __('Link', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_3_title_uk', //39
                'type' => 'text',
                'title' => __('Title (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_3_link_uk', //40
                'type' => 'text',
                'title' => __('Link (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_3_title_en', //41
                'type' => 'text',
                'title' => __('Title (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_3_link_en', //42
                'type' => 'text',
                'title' => __('Link (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => '43',
                'type' => 'info',
                'desc' => __('Column 4', 'nhp-opts')
            ),
            array(
                'id' => 'column_4_title', //44
                'type' => 'text',
                'title' => __('Title', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_4_link', //45
                'type' => 'text',
                'title' => __('Link', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => '46',
                'type' => 'info',
                'desc' => __('Column 5', 'nhp-opts')
            ),
            array(
                'id' => 'column_5_title', //47
                'type' => 'text',
                'title' => __('Title', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => 'column_5_link', //48
                'type' => 'text',
                'title' => __('Link', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),

        )
    );
    //404
    $sections[] = array(
        'title' => __('Page 404', 'nhp-opts'),
        'fields' => array(
            array(
                'id' => '404_title_ru', //49
                'type' => 'text',
                'title' => __('Заголовок', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => '404_title_uk', //50
                'type' => 'text',
                'title' => __('Заголовок (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => '404_title_en', //51
                'type' => 'text',
                'title' => __('Заголовок (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => '404_subtitle_ru', //52
                'type' => 'text',
                'title' => __('Подзаголовок', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => '404_subtitle_uk', //53
                'type' => 'text',
                'title' => __('Подзаголовок (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => '404_subtitle_en', //54
                'type' => 'text',
                'title' => __('Подзаголовок (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => '404_back_main_ru', //55
                'type' => 'text',
                'title' => __('Вернутся на главную', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => '404_back_main_uk', //56
                'type' => 'text',
                'title' => __('Вернутся на главную (ua)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
            array(
                'id' => '404_back_main_en', //57
                'type' => 'text',
                'title' => __('Вернутся на главную (en)', 'nhp-opts'),
                'std' => __('', 'nhp-opts'),
            ),
        )
    );

	$tabs = array();
	if(file_exists(trailingslashit(get_stylesheet_directory()).'README.html')){
        $tabs['theme_docs'] = array(
                                'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_071_book.png',
                                'title' => __('Documentation', 'nhp-opts'),
                                'content' => nl2br(file_get_contents(trailingslashit(get_stylesheet_directory()).'README.html'))
                            );
	}

	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;

	if( $value == false ){
	    $value = $value;
		$error = true;
		if( empty($field['msg']) ){
		    $field['msg'] = 'Error';
		}
	}
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}

function validate_paypal_sandbox($field, $value, $existing_value){
        $error = false;

	if( $value == false ){
		$value = $value;
		$error = true;
		if( empty($field['msg']) ){
		    $field['msg'] = 'Error';
		}
	}
	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
}
