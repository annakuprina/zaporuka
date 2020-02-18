<?php
/**
 * Theme functions and definitions.
 *
 * @package WordPress
 * @subpackage U-Design
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }
define( 'CHILD_DIR', get_stylesheet_directory_uri() );
define("THEME_DIR", get_stylesheet_directory());
define("THEME_INCLUDES", THEME_DIR . "/inc");
/**
 * Right-to-left (RTL) Support.
 * Determines whether the current locale is right-to-left (RTL).
 * If yes then load the parent rtl.css file.
 * 
 */
function udesign_child_theme_styles() {
	// Load the rtl.css stylesheet.
	if ( is_rtl() ) {
		wp_enqueue_style( 'u-design-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}    
    wp_enqueue_style( 'slick', CHILD_DIR . '/assets/slick/slick.css' );
    wp_enqueue_style( 'slick-lightbox-css', CHILD_DIR . '/assets/slick/slick-lightbox.css' );
    wp_enqueue_style( 'slick-theme', CHILD_DIR . '/assets/slick/slick-theme.css' );
    wp_enqueue_style( 'main', CHILD_DIR . '/assets/css/main.css' );
    wp_enqueue_style( 'reset-child', CHILD_DIR . '/assets/css/reset.css' );
    wp_enqueue_style( 'anna-child', CHILD_DIR . '/assets/css/anna.css' );
    wp_enqueue_style( 'yana-child', CHILD_DIR . '/assets/css/yana.css' );    
    wp_enqueue_script( 'validate-js', CHILD_DIR . '/assets/js/jquery.validate.min.js' );
    wp_enqueue_script( 'slick-js', CHILD_DIR . '/assets/slick/slick.min.js' );
    wp_enqueue_script( 'slick-lightbox-js', CHILD_DIR . '/assets/slick/slick-lightbox.min.js' );
    wp_enqueue_script( 'main-js', CHILD_DIR . '/assets/js/main.js' );
    wp_enqueue_script( 'yana-js', CHILD_DIR . '/assets/js/custom_scrypt_yana.js' );
    wp_enqueue_script( 'anya-js', CHILD_DIR . '/assets/js/custom_scrypt_anya.js' );
    wp_enqueue_script( 'jquery-ui-js', CHILD_DIR . '/assets/js/jquery-ui.min.js' );

//    if ( is_page('pro-nas') ){
//        wp_enqueue_script( 'artabr_lm_ajax', CHILD_DIR . '/assets/js/ajax.js', true );
//        wp_enqueue_script( 'historyjs', CHILD_DIR . '/assets/js/history.js', true );
//
//        // Add parameters for the JS
//        global $wp_query;
//        $max   = $wp_query->max_num_pages;
//        $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
//        wp_localize_script(
//            'artabr_lm_ajax',
//            'mts_ajax_loadposts',
//            array(
//                'startPage'     => $paged,
//                'maxPages'      => $max,
//                'nextLink'      => next_posts( $max, false )
//            )
//        );
//    }
}
add_action( 'wp_enqueue_scripts', 'udesign_child_theme_styles', 99 );

/***************** BEGIN ADDING YOUR CODE BELOW: *****************/


// Add category metabox to page
function voras_category_for_page() {    
    register_taxonomy_for_object_type('category', 'page');  
}
add_action( 'init', 'voras_category_for_page' );
 if( is_admin() ){
     /**
     * Theme options.
     */
     require_once THEME_INCLUDES . '/options/theme-options.php';
 }
require_once THEME_INCLUDES . '/shortcodes.php';
require_once THEME_INCLUDES . '/custom_functions.php';
require_once THEME_INCLUDES . '/custom_ajax.php';

// Secondary navigation bar.


    // Insert Secondary Navigation bar at the very top.
    function udesign_add_secondary_navigation_bar_custom() {
        $options = get_option('ThemeOptions');
        $phone_number = !empty($options['main_phone_number']) ? $options['main_phone_number'] : false;
        $email = !empty($options['main_email']) ? $options['main_email'] : false;
        $help_with_sms_label = !empty($options['popup_sms_title_' . ICL_LANGUAGE_CODE]) ? $options['popup_sms_title_' . ICL_LANGUAGE_CODE] : false;
        ?>
        <nav id="custom-top-bar">
            <div class="container_24">
                <div id="custom-top-bar-content">
                    <div class="custom-top-bar-content-left">
                        <div class="top-bar-tel-block"><a href="tel:<?php echo $phone_number; ?>" class="tel-block-a"><i class="fa fa-phone" aria-hidden="true"></i></i><?php echo $phone_number; ?></a></div>
                        <div class="top-bar-email-block"><a href="mailto:<?php echo $email; ?>" class="email-block-a"><i class="top-bar-mail-icon"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="7" viewBox="0 0 10 7"><g><g opacity=".4"><path fill="#333" d="M1.55 1.195L4.646 4.23c.193.19.509.19.703 0l3.101-3.035a.25.25 0 1 1 .352.356L6.773 3.539l2.024 1.902a.25.25 0 0 1-.344.364L6.418 3.887l-.719.703a1.01 1.01 0 0 1-1.406 0l-.711-.7-2.035 1.915a.25.25 0 0 1-.344-.364l2.02-1.902-2.024-1.988a.25.25 0 1 1 .352-.356zM0 .75v5.5c0 .415.335.75.75.75h8.5c.415 0 .75-.335.75-.75V.75A.748.748 0 0 0 9.25 0H.75A.748.748 0 0 0 0 .75z"/></g></g></svg></i><?php echo $email; ?></a></div>
                    </div>
                    <div class="custom-top-bar-content-right">
                        <span class="top-bar-help-block"><a href="#"><?php echo $help_with_sms_label; ?></a></span>
                    </div>
                </div>
            </div>
        </nav>
        <div class="clear"></div>
        <?php
    }
    add_action( 'udesign_top_wrapper_top', 'udesign_add_secondary_navigation_bar_custom', 10);

//add 5 column to footer
register_sidebar(array(
                'name' => esc_html__('Основание 5', 'u-design'),
                'id' => 'bottom-widget-area-5',
                'description' => esc_html__('Область виджета, используемая как 5я колонка в Нижней части (над футером).', 'u-design'),
                'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
                'before_title' => '<h3 class="bottom-col-title">',
                'after_title' => '</h3>',
                'after_widget' => '</div>',
));


//add widget for footer mobile menu
register_sidebar(array(
                'name' => esc_html__('Футер моб левая секция', 'u-design'),
                'id' => 'widget-footer-mob-left',
                'description' => esc_html__('Область виджета, используемая как левая колонка в мобильной версии футера', 'u-design'),
                'before_widget' => '<div class="bottom-col-content %2$s custom-formatting">',
                'before_title' => '<h3 class="bottom-col-title">',
                'after_title' => '</h3>',
                'after_widget' => '</div>',
));



add_action('init', function() {
  pll_register_string('u-design-child', 'Таймлайн проекту');
  pll_register_string('u-design-child', 'Залишилось  зiбрати:');
  pll_register_string('u-design-child', 'залучено');
  pll_register_string('u-design-child', 'Допомогти');
  pll_register_string('u-design-child', 'Проекти');
});



add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
function change_existing_currency_symbol( $currency_symbol, $currency ) {
    if(ICL_LANGUAGE_CODE=='uk'){
        $symbol =  'грн.';
    }
    elseif(ICL_LANGUAGE_CODE=='ru'){
        $symbol =  'грн.';
    }
    elseif(ICL_LANGUAGE_CODE=='en'){
        $symbol =  '₴';
    }
    switch( $currency ) {
      case 'UAH': $currency_symbol =  $symbol; break;
    }
    return $currency_symbol;
}



/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;

    ob_start();
    if($woocommerce->cart->cart_contents_count > 0):
    ?>
    <span class="cart-customlocation cart-count"><span class="plus"></span><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></span>
    <?php
    else: ?>
        <span class="cart-customlocation cart-count"></span>
    <?php 
    endif;

    $fragments['span.cart-customlocation.cart-count'] = ob_get_clean();
    return $fragments;
}


/*   Remove zoom effect on WooCommerce product image   */
function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );


/* Add custom column "ON home" to post type projects  */
add_filter( 'manage_projects_posts_columns', 'set_custom_projects_columns' );
function set_custom_projects_columns( $columns ) {
  $columns['displayOnHome'] = __( 'На главной' );
  return $columns;
}

/* Add the data to the custom columns for the book post type:*/
add_action( 'manage_projects_posts_custom_column' , 'set_custom_projects_columns_data', 10, 2 );
function set_custom_projects_columns_data( $column ) {
    global $post;
    if ( 'displayOnHome' === $column ) {
        $display_mark =  get_field("show-on-home-page", $post->ID);
        if ($display_mark[0]=="Да"){
            echo "Да";
        }
        else{
            echo "-";
        }      
    }

}

/*  Add langeages for  wc ukr shipping*/
add_filter('wc_ukr_shipping_language', function ($lang) {
    if (pll_current_language() === 'uk') {
        return 'uk';
    }
    if (pll_current_language() === 'en') {
        return 'en';
    }

    return 'ua';
});


/*  Add translations for  wc ukr shipping*/
add_filter('wc_ukr_shipping_get_nova_poshta_translates', function ($translates) {
    $currentLanguage = wp_doing_ajax() ? $_COOKIE['pll_language'] : pll_current_language();
  
    if ($currentLanguage === 'ru') {
        return [
            'method_title' => 'Доставка службой Новая почта',
            'block_title' => 'Укажите отделение Новой почты',
            'placeholder_area' => 'Выберите область',
            'placeholder_city' => 'Выберите город',
            'placeholder_warehouse' => 'Выберите отделение',
            'address_title' => 'Нужна адресная доставка?',
            'address_placeholder' => 'Введите адрес доставки'
        ];
    }

    if ($currentLanguage === 'en') {
        return [
            'method_title' => 'Nova Posta',
            'block_title' => 'Enter Nova Posta department',
            'placeholder_area' => 'Select region',
            'placeholder_city' => 'Select City',
            'placeholder_warehouse' => 'Select department',
            'address_title' => 'Need address delivery?',
            'address_placeholder' => 'Enter shipping address'
        ];
    }
  

    return [
        'method_title' => 'Доставка службою Нова пошта',
        'block_title' => 'Вкажіть відділення Нової пошти',
        'placeholder_area' => 'Оберіть область',
        'placeholder_city' => 'Оберіть місто',
        'placeholder_warehouse' => 'Оберіть відділення',
        'address_title' => 'Потрібна адресна доставка?',
        'address_placeholder' => 'Введіть адресу доставки'
    ];
   
});
