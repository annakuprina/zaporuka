<?php 
/**
 * The header for the U-Design theme.
 *
 * @package WordPress
 * @subpackage U-Design
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
$udesign_custom_classes = 'customize-header';
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
	<?php echo $udesign_options['google_analytics']; ?>
	<?php udesign_head_bottom(); ?>
</head>
<body <?php udesign_inside_body_tag(); ?> <?php body_class( array ( $udesign_responsive_body_class, $udesign_menu_auto_arrows, $udesign_menu_drop_shadows, $udesign_fixed_main_menu, $udesign_custom_classes ) ); ?>>
	<?php do_action( 'wp_body_open' ); // Since WordPress 5.2 ?>
	<?php udesign_body_top(); ?>
    
	<div id="wrapper-1">
		<?php
		udesign_top_wrapper_before();
		
		if( ! udesign_check_page_layout_option( 'no_header' ) ) : 
			?>
			<header id="top-wrapper">
				<?php udesign_top_wrapper_top(); ?>
				<div id="top-elements" class="container_24">
					<?php udesign_top_elements_inside( is_front_page() ); ?>
					<?php udesign_top_wrapper_bottom( is_front_page() ); ?>
					<span class="cart-count-in-main-header">
						<?php if( WC()->cart->get_cart_contents_count() > 0 ): ?>
							<span class="cart-customlocation cart-count"><span class="plus"></span><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span>
						<?php else:?>
							<span class="cart-customlocation cart-count"></span>
						<?php endif;?>	
					</span>
				</div>
				<!-- end top-elements -->
				
			</header>
			<!-- end top-wrapper -->
			<?php 
		endif;
		?>
		<div class="clear"></div>

		<?php
		
		udesign_top_wrapper_after( is_front_page() );
		
		if ( is_front_page() ) : 

			udesign_front_page_slider_before();

			get_template_part( 'template-parts/header/homepage', 'slider' );
			
			udesign_front_page_slider_after();
			?>

			<div class="clear"></div>

			<?php
			// "home-page-before-content" widget area.
			$before_cont_1_is_active = sidebar_exist_and_active( 'home-page-before-content' );
			if ( $before_cont_1_is_active ) : // Hide this area if no widgets.
				?>
				<section id="before-content">
					<div id="before-content-column" class="container_24">
						<div class="home-page-divider"></div>
						<?php
						if ( $before_cont_1_is_active ) {
							echo get_dynamic_column( 'before-cont-box-1', 'column_3_of_3 home-cont-box', 'home-page-before-content' );
						}
						?>
						<div class="home-page-divider"></div>
					</div>
					<!-- end before-content-column -->
				</section>
				<!-- end before-content -->

				<div class="clear"></div>

				<?php 
			endif;
			
			udesign_home_page_content_before();
			?>

			<section id="home-page-content">

			<?php
			udesign_home_page_content_top();
		else : // Not front page.
			
			udesign_page_content_before();
			?>
			
			<section id="page-content">
			
			<?php
			udesign_page_content_top(); // Note: this hook is used to insert the breadcrumbs.

		endif;
