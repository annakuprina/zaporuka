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

/*social links*/
$options = get_option('ThemeOptions');
$facebook_link = !empty($options['facebook_link']) ? $options['facebook_link'] : false;
$instagram_link = !empty($options['instagram_link']) ? $options['instagram_link'] : false;
$youtube_link = !empty($options['youtube_link']) ? $options['youtube_link'] : false;

$help_with_sms_label = !empty($options['popup_sms_title_' . ICL_LANGUAGE_CODE]) ? $options['popup_sms_title_' . ICL_LANGUAGE_CODE] : false;
$help_label = !empty($options['title_help_block_' . ICL_LANGUAGE_CODE]) ? $options['title_help_block_' . ICL_LANGUAGE_CODE] : 'Допомогти';
$phone_number = !empty($options['main_phone_number']) ? $options['main_phone_number'] : false;
$email = !empty($options['main_email']) ? $options['main_email'] : false;
$logo_mob_img_url = $udesign_options['fixed_menu_logo'];
$logo_img_url = $udesign_options['custom_logo_img'];
$copyright_text = !empty($options['column_1_text_' . ICL_LANGUAGE_CODE]) ? $options['column_1_text_' . ICL_LANGUAGE_CODE] : false;
$privacy_policy_text = !empty($options['column_2_title_' . ICL_LANGUAGE_CODE]) ? $options['column_2_title_' . ICL_LANGUAGE_CODE] : false;
$privacy_policy_link = !empty($options['column_2_link_' . ICL_LANGUAGE_CODE]) ? $options['column_2_link_' . ICL_LANGUAGE_CODE] : false;
$disclaimer_text = !empty($options['column_3_title_' . ICL_LANGUAGE_CODE]) ? $options['column_3_title_' . ICL_LANGUAGE_CODE] : false;
$disclaimer_link = !empty($options['column_3_link_' . ICL_LANGUAGE_CODE]) ? $options['column_3_link_' . ICL_LANGUAGE_CODE] : false;

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
			<header id="top-wrapper" class="animated fadeIn faster delay-1s">
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
			</header>

			<header id="header-mob">
				<div class="header-mob-top">
					<div class="header-mob-logo">
						<a href="/"><img class="active header-mob-logo-black" src="<?php echo $logo_img_url ?>" alt=""></a>
						<a href="/"><img class="header-mob-logo-white" src="<?php echo $logo_mob_img_url ?>" alt=""></a>
					</div>
					<div class="header-mob-nav">
						<div class="hamburger active">
							<span></span>
							<span></span>
							<span></span>
						</div>
						<div class="close"></div>
					</div>
				</div><!--end header-mob-top -->
			
				<div class="header-mob-bottom">
					<div class="header-mob-bottom-wrapper">
						<div class="header-mob-left"><?php echo udesign_nav();?></div>
						<div class="header-mob-right">
							<div class="help-header-link"><a href="#"><span><?php echo $help_label; ?></span></a></div>
							<div class="top-bar-help-block"><a href="#"><span><?php echo $help_with_sms_label; ?></span></a></div>
							<div class="top-bar-tel-block"><a href="tel:<?php echo $phone_number; ?>" class="tel-block-a"><i class="fa fa-phone" aria-hidden="true"></i></i><?php echo $phone_number; ?></a></div>
							<div class="top-bar-email-block"><a href="mailto:<?php echo $email; ?>" class="email-block-a"><i class="top-bar-mail-icon"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="7" viewBox="0 0 10 7"><g><g opacity=".4"><path fill="#333" d="M1.55 1.195L4.646 4.23c.193.19.509.19.703 0l3.101-3.035a.25.25 0 1 1 .352.356L6.773 3.539l2.024 1.902a.25.25 0 0 1-.344.364L6.418 3.887l-.719.703a1.01 1.01 0 0 1-1.406 0l-.711-.7-2.035 1.915a.25.25 0 0 1-.344-.364l2.02-1.902-2.024-1.988a.25.25 0 1 1 .352-.356zM0 .75v5.5c0 .415.335.75.75.75h8.5c.415 0 .75-.335.75-.75V.75A.748.748 0 0 0 9.25 0H.75A.748.748 0 0 0 0 .75z"/></g></g></svg></i><?php echo $email; ?></a></div>
							<div class="header-mob-socials">
								<li><a class="header-mob-soc-fb" href="<?php echo $facebook_link;?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a class="header-mob-soc-youtube" href="<?php echo $youtube_link;?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
								<li><a class="header-mob-soc-insta" href="<?php echo $instagram_link;?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							</div>
							<div class="header-mob-lang-wrapper">
								<a href="#pll_switcher" class="sf-with-ul header-mob-lang-switcher"><span><?php echo pll_current_language( 'name' );?></span>
									<span class="expand-button" href="#"></span>
								</a>
									<ul class="header-mob-lang">
										<?php pll_the_languages();?>
									</ul>
							</div><!-- end header-mob-lang-wrapper -->
						</div><!-- end header-mob-right -->


						<div class="header-mob-bottom-links">
							<span><a href="<?php echo $privacy_policy_link; ?>" class="privacy-policy"><?php echo $privacy_policy_text; ?></a></span>
							<span><a href="<?php echo $disclaimer_link; ?>" class="disclaimer"><?php echo $disclaimer_text; ?></a></span>
							<span class="copyright"><?php echo $copyright_text; ?></span>
						</div>
					</div><!--end header-mob-bottom-wrapper -->
				</div><!--end header-mob-bottom -->

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
