<?php
/**
 * The header for the 404 page.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Set some theme global variables.
global $udesign_options, $current_slider, $udesign_responsive;
$current_slider = $udesign_options['current_slider'];
$udesign_responsive = ( isset( $udesign_options['enable_responsive'] ) && $udesign_options['enable_responsive'] ) ? $udesign_options['enable_responsive'] : '';
$udesign_responsive_body_class = ( $udesign_responsive ) ? 'u-design-responsive-on' : '';
$udesign_menu_auto_arrows = ( isset( $udesign_options['submenu_arrows'] ) && $udesign_options['submenu_arrows'] !== 'none' ) ? 'u-design-submenu-arrows-on' : '';
$udesign_menu_drop_shadows = ( isset( $udesign_options['show_menu_drop_shadows'] ) && $udesign_options['show_menu_drop_shadows'] == 'yes' ) ? 'u-design-menu-drop-shadows-on' : '';
$udesign_fixed_main_menu = ( isset( $udesign_options['fixed_main_menu'] ) && $udesign_options['fixed_main_menu'] ) ? 'u-design-fixed-menu-on' : '';
$udesign_responsive_pinch_to_zoom = ( isset( $udesign_options['responsive_pinch_to_zoom'] ) && $udesign_options['responsive_pinch_to_zoom'] ) ? '' : ', maximum-scale=1.0';
set_theme_mod( 'udesign_include_container', ! udesign_check_page_layout_option( 'no_container' ) ); // Page specific layout options based on "U-Design Options" metabox selection.
?>
<?php udesign_html_before(); // The DOCTYPE is inserted via this hook in functions.php. ?>
<html <?php language_attributes(); ?>>
    <head>
        <?php udesign_head_top(); ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0<?php echo ( isset( $udesign_responsive ) && $udesign_responsive ) ? $udesign_responsive_pinch_to_zoom : ''; ?>">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php wp_head(); ?>
        <?php udesign_head_bottom(); ?>
    </head>
<body <?php udesign_inside_body_tag(); ?> <?php body_class( array ( $udesign_responsive_body_class, $udesign_menu_auto_arrows, $udesign_menu_drop_shadows, $udesign_fixed_main_menu ) ); ?>>
<?php do_action( 'wp_body_open' ); // Since WordPress 5.2 ?>
