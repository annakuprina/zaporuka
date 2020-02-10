<?php
/**
 * U-Design WooCommerce Integration
 *
 * Make U-Design theme compatible with WooCommerce.
 *
 * @link       https://themeforest.net/user/andondesign
 * @since      1.0.0
 *
 * @package    U_Design_Core
 * @subpackage U_Design_Core/includes/shortcodes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'U_Design_Core_Woocommerce' ) ) {

	/**
	 * U-Design Core Woocommerce
	 *
	 * This class makes U-Design compatible with WooCommerce.
	 *
	 * @since 1.0.0
	 */
	class U_Design_Core_Woocommerce {

		/**
		 * The version of this plugin.
		 *
		 * @since 1.0.0
		 * @access private
		 * @var string $version The current version of this plugin.
		 */
		private $version;

		/**
		 * Main Constructor
		 *
		 * @since 1.0.0
		 * @access public
		 * @param string $version The version of this plugin.
		 */
		public function __construct( $version ) {

			$this->version = $version;

		}


		/**
		 * Admin notice for removing the old 'U-Design WooCommerce Integration' plugin.
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function udesign_core_remove_old_ud_wc_plugin_admin_notice() {
			// Determine whether the 'U-Design WooCommerce Integration' plugin is currently active.
			$udesign_woocommerce_plugin = ( in_array( 'u-design-woocommerce/u-design-woocommerce.class.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) ? true : false;

			if ( current_user_can( 'manage_options' ) && $udesign_woocommerce_plugin ) {
				/**
				 * Display the admin notice.
				 */
				function udesign_core_remove_old_ud_wc_plugin_notice() {
					?>
					<div class="notice notice-warning is-dismissible">
						<p><strong>U-DESIGN THEME MESSAGE:</strong> Please deactivate and delete the <strong>U-Design WooCommerce Integration</strong> plugin, it's functionality has been included with the <strong>U-Design Core</strong> plugin hence making it obsolete.</p>
					</div>
					<?php
				}
				add_action( 'admin_notices', 'udesign_core_remove_old_ud_wc_plugin_notice' );
			}
		}


		/**
		 * Enqueue plugin files.
		 *
		 * @global type $udesign_options
		 */
		public function udesign_core_woocommerce_enqueue_assets() {
			wp_enqueue_style( 'u-design-woocommerce-styles', plugin_dir_url( __FILE__ ) . 'css/udesign-woocommerce-style.css', false, $this->version );
			global $udesign_options;
			if ( $udesign_options['enable_responsive'] ) {
				wp_enqueue_style( 'u-design-woocommerce-responsive', plugin_dir_url( __FILE__ ) . 'css/udesign-woocommerce-responsive.css', false, $this->version );
			}
			if ( is_shop() || is_product() || is_product_category() || is_product_tag() ) {
				// Remove theme's default breadcrumbs from WC's shop and products pages.
				remove_action( 'udesign_page_content_top', 'udesign_display_breadcrumbs' );
				/**
				 * Remove default WC title on single products pages.
				 */
				function udesign_core_remove_default_wc_title() {
					return false;
				}
				add_filter( 'woocommerce_show_page_title', 'udesign_core_remove_default_wc_title' );
			}
		}

		/**
		 * Main function that facilitates the U-Design theme compatibility with WooCommerce plugin.
		 *
		 * @return mixed
		 */
		public function udesign_core_woocommerce() {

			/**
			 * Declare WooCommerce support for the theme.
			 */
			add_theme_support( 'woocommerce' );

			/**
			 * Load respective lightbox gallery for single product pages.
			 */
			if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
				/**
				 * Prevent prettyPhoto script from being loaded twice,
				 * once by the theme and once by the WooCommerce plugin.
				 * Dequeue the ones loaded by WooCommerce.
				 */
				function udesign_core_wc_init_scripts() {
					if ( wp_script_is( 'prettyPhoto' ) || wp_style_is( 'prettyPhoto-init' ) ) {
						wp_dequeue_script( 'prettyPhoto' );
						wp_dequeue_script( 'prettyPhoto-init' );
					}
				}
				/**
				 * WooCommerce prettyPhoto styles.
				 */
				function udesign_core_wc_init_styles() {
					if ( wp_style_is( 'woocommerce_prettyPhoto_css' ) ) {
						wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
					}
				}
				add_action( 'wp_enqueue_scripts', 'udesign_core_wc_init_styles', 12 );
				add_action( 'wp_enqueue_scripts', 'udesign_core_wc_init_scripts', 12 );

				/**
				 * Change data-rel to rel for the prettyPhoto link attribute.
				 *
				 * @param string $image_thumbnail_html The image HTML.
				 * @return string The image HTML.
				 */
				function udesign_core_change_rel_attr_for_wc_prettyPhoto( $image_thumbnail_html ) {
					$pattern     = '/' . preg_quote( 'data-rel="prettyPhoto', '/' ) . '/';
					$replacement = 'rel="prettyPhoto';
					return preg_replace( $pattern, $replacement, $image_thumbnail_html );
				}
				add_filter( 'woocommerce_single_product_image_html', 'udesign_core_change_rel_attr_for_wc_prettyPhoto', 20 );
				add_filter( 'woocommerce_single_product_image_thumbnail_html', 'udesign_core_change_rel_attr_for_wc_prettyPhoto', 20 );
			} else { // if WooCommerce > v3.0.0.
				/**
				 * Added in WC 3.0.0 (2017-04-04)
				 * New gallery on single product pages with better mobile support, using PhotoSwipe and Zoom.
				 * Declare support with add_theme_support() – wc-product-gallery-zoom, wc-product-gallery-lightbox, wc-product-gallery-slider
				 */
				add_theme_support( 'wc-product-gallery-zoom' );
				add_theme_support( 'wc-product-gallery-lightbox' );
				add_theme_support( 'wc-product-gallery-slider' );
			}

			/**
			 * Styling the "Quantity" input type number.
			 */
			function udesign_core_style_cart_quantity_number() {
				ob_start();
				?>
				<script type="text/javascript">
					// <![CDATA[
					jQuery(document).ready(function($){
						function addQuantityNav(){
							$('.woocommerce .quantity').each(function() {
								var $this = $(this),
									input = $this.find('input[type="number"]');

								// Add the "+" "-" markup right after the input field.
								if ( ! $this.find('.quantity-nav').length ) {
									$('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter( input );
								}

								// Define the rest of variables.
								var btnUp = $this.find('.quantity-up'),
									btnDown = $this.find('.quantity-down'),
									min = input.attr('min'),
									max = (input.attr('max')) ? input.attr('max') : 1000000; // If max has not been set that means no upper limit so just assign it to a very high value.

								btnUp.click(function() {
									var oldValue = parseFloat(input.val());
									if (oldValue >= max) {
										var newVal = oldValue;
									} else {
										var newVal = oldValue + 1;
									}
									$this.find("input").val(newVal);
									$this.find("input").trigger("change");
								});

								btnDown.click(function() {
									var oldValue = parseFloat(input.val());
									if (oldValue <= min) {
										var newVal = oldValue;
									} else {
										var newVal = oldValue - 1;
									}
									$this.find("input").val(newVal);
									$this.find("input").trigger("change");
								});
							})
							// Automatically Update Cart on Quantity Change.
							.on('change', 'input.qty', function(){
								setTimeout(function() {
									$('[name="update_cart"]').trigger('click');
								}, 500 );
							});
						}
						addQuantityNav();

						// Add +/- buttons to quantity input after update cart ajax call.
						$( document.body ).on( 'updated_cart_totals', function(){
							addQuantityNav();
						});

					});
					// ]]>
				</script>
				<?php
				echo ob_get_clean();
			}
			add_action( 'woocommerce_after_add_to_cart_form', 'udesign_core_style_cart_quantity_number' );
			add_action( 'woocommerce_after_cart_contents', 'udesign_core_style_cart_quantity_number' );

			/**
			 * Register WPBakery Page Builder elements.
			 */
			require_once plugin_dir_path( __FILE__ ) . 'vc-elements/udesign-wc-vc-elements.php';

			/**
			 * Add post thumbnails support for 'product' post type.
			 */
			function udesign_core_wc_post_thumbnails_setup() {
				remove_theme_support( 'post-thumbnails' );
				add_theme_support( 'post-thumbnails', array( 'post', 'page', 'movie', 'product' ) );
			}
			add_action( 'after_setup_theme', 'udesign_core_wc_post_thumbnails_setup' );

			/**
			 * Remove the WooCommerce Logout link from main menu.
			 */
			remove_filter( 'wp_nav_menu_items', 'woocommerce_nav_menu_items' );

			/**
			 * Modify the woocommerce page markup to adopt the theme's layout with the proper content wrappers.
			 */
			// First unhook the WooCommerce wrappers.
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
			/**
			 * Opening wrapper divs for main content.
			 */
			function udesign_core_main_content_wrapper_start() {
				global $udesign_options;
				$content_position = ( 'left' === $udesign_options['pages_sidebar_8'] ) ? 'grid_16 push_8' : 'grid_16';
				echo '<div id="content-container" class="container_24">';
				echo '    <div id="main-content" class="' . esc_attr( $content_position ) . '">';
				echo '        <div class="main-content-padding">';
			}
			/**
			 * Closing wrapper divs for main content.
			 */
			function udesign_core_main_content_wrapper_end() {
				echo '        </div><!-- end main-content-padding -->';
				echo '    </div><!-- end main-content -->';
				if ( sidebar_exist( 'PagesSidebar8' ) ) {
					get_sidebar( 'PagesSidebar8' ); }
				echo '</div><!-- end content-container -->';
			}
			// Then hook in functions to display the wrappers the "U-Design" theme requires.
			add_action( 'woocommerce_before_main_content', 'udesign_core_main_content_wrapper_start', 10 );
			add_action( 'woocommerce_after_main_content', 'udesign_core_main_content_wrapper_end', 10 );

			/**
			 * Remove the woocommerce default sidebar.
			 */
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

			/**
			 * Replace default WooCommerce Breadcrumb.
			 * Note: see "udesign_core_woocommerce_enqueue_assets()" above for the removeal of theme's default breadcrumbs on shop and products pages.
			 */
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
			add_action( 'udesign_page_content_top', 'udesign_core_wc_breadcrumbs' );

			/**
			 * Handle the case for shop pages when breadcrumbs are visible.
			 */
			function udesign_core_wc_breadcrumbs() {
				global $udesign_options;

				// Individual page option to toggle breadcrumbs.
				$disable_breadcrumbs_new = udesign_check_page_breadcrumbs_option( 'disable_breadcrumbs' );
				// Backward compatibility: this is the old deprecated option name.
				$disable_breadcrumbs = get_post_meta( get_the_ID(), '_udesign_disable_breadcrumbs', true );
				// Decide which option to use.
				$disable_breadcrumbs = ( $disable_breadcrumbs ) ? ( $disable_breadcrumbs ) : $disable_breadcrumbs_new;
				// Get the option for "Move Breadcrumbs to title area".
				$move_breadcrumbs_to_title = udesign_check_page_breadcrumbs_option( 'move_to_title' );

				if ( isset( $udesign_options['show_breadcrumbs'] ) && $udesign_options['show_breadcrumbs'] == 'yes' && ! $disable_breadcrumbs && ! $move_breadcrumbs_to_title ) {
					add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 9 );
				} else {
					/**
					 * Handle the case for shop pages when no breadcrumbs option is selected.
					 */
					function udesign_core_wc_no_breadcrumbs() {
						echo '<div class="no-breadcrumbs-padding"></div>';
					}
					add_action( 'woocommerce_before_main_content', 'udesign_core_wc_no_breadcrumbs', 9 );
				}
			}

			/**
			 * Update woocommerce breadcrumb defaults according to the theme's requirements.
			 *
			 * @return array
			 */
			function udesign_core_woocommerce_breadcrumbs() {
				$delimiter = ( is_rtl() ) ? '&larr;' : '&rarr;';
				return array(
					'delimiter'   => '<span class="breadarrow"> ' . $delimiter . ' </span>',
					'wrap_before' => '<nav id="breadcrumbs-container" class="container_24"><p class="breadcrumbs" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
					'wrap_after'  => '</p></nav>',
					'before'      => '',
					'after'       => '',
					'home'        => __( 'Home', 'u-design-core' ),
				);
			}
			add_filter( 'woocommerce_breadcrumb_defaults', 'udesign_core_woocommerce_breadcrumbs' );

			/**
			 * Set WooCommerce image dimensions.
			 */
			global $pagenow;
			if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' === $pagenow ) {
				add_action( 'init', 'udesign_core_wc_general_images_settings', 1 );
			}
			/**
			 * Set WooCommerce general images' settings.
			 */
			function udesign_core_wc_general_images_settings() {
				update_option( 'woocommerce_catalog_image_width', '180' );
				update_option( 'woocommerce_catalog_image_height', '180' );
				update_option( 'woocommerce_single_image_width', '442' );
				update_option( 'woocommerce_single_image_height', '442' );
				update_option( 'woocommerce_thumbnail_image_width', '200' );
				update_option( 'woocommerce_thumbnail_image_height', '200' );

				// Hard Crop [0 = false, 1 = true].
				update_option( 'woocommerce_catalog_image_crop', 0 );
				update_option( 'woocommerce_single_image_crop', 0 );
				update_option( 'woocommerce_thumbnail_image_crop', 0 );
			}

			/**
			 * Change number of related products.
			 *
			 * @param array $args Related Products Arguments.
			 * @return array An array of updated arguments.
			 */
			function udesign_core_change_number_related_products( $args ) {
				$args['posts_per_page'] = 3; // Number of related products.
				$args['columns']        = 3; // Number of columns per row.
				$args['orderby']        = 'rand'; // Display products in random order.
				return $args;
			}
			add_filter( 'woocommerce_output_related_products_args', 'udesign_core_change_number_related_products' );

			/**
			 * Style the WooCommerce Login Widget with the consisntent for the theme bullet list style.
			 *
			 * @param array $params Widget parameters.
			 * @return array Widget parameters.
			 */
			function udesign_core_woocommerce_filter_widget( $params ) {
				switch ( _get_widget_id_base( $params[0]['widget_id'] ) ) {
					case 'woocommerce_login':
					case 'product_categories':
					case 'woocommerce_product_categories':
						// Add the 'custom-formatting' class.
						$params[0]['before_widget'] = str_replace( 'substitute_widget_class', 'custom-formatting', $params[0]['before_widget'] );
						return $params;
					default:
						return $params;
				}
			}
			add_filter( 'dynamic_sidebar_params', 'udesign_core_woocommerce_filter_widget' );

			/**
			 * Fix the bullet padding for "Product Categories" widget when empty.
			 *
			 * @param array $cat_args Categories Widget parameters.
			 * @return array Categories Widget parameters.
			 */
			function udesign_core_wc_product_cats_widget_args( $cat_args ) {
				$cat_args['show_option_none'] = '<span style="padding:5px 5px 5px 22px; display:block;">' . __( 'No product categories exist.', 'u-design-core' ) . '</span>';
				return $cat_args;
			}
			add_filter( 'woocommerce_product_categories_widget_args', 'udesign_core_wc_product_cats_widget_args' );

			/**
			 * Fix the posts' count under a product category into the a-tag when listing the categories.
			 *
			 * @param string $html Category Widget HTML.
			 * @return string Modified Category Widget HTML.
			 */
			function udesign_core_woocommerce_product_categories_widget_args( $html ) {
				$html = preg_replace( '/\<\/a\> \<span class=\"count\"\>\((.*)\)\<\/span\>/', ' <span class="posts-counter">($1)</span></a>', $html );
				return $html;
			}
			add_filter( 'wp_list_categories', 'udesign_core_woocommerce_product_categories_widget_args' );

			/**
			 * Remove the product rating display on product loops.
			 */
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

			/**
			 * Add Dynamic Styles.
			 */
			function udesign_core_wc_insert_dynamic_css() {
				global $udesign_options;
				$css  = "\r\n";
				$css .= '<style type="text/css">';
				$css .= 'ul.products li.product .price .from, .order-info mark  { color:#' . $udesign_options['body_text_color'] . '; }';
				$css .= '</style>';
				echo $css;
			}
			add_action( 'wp_head', 'udesign_core_wc_insert_dynamic_css' );

			/**
			 * Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php).
			 *
			 * @param mixed $fragments Shopping Cart Content as fragments.
			 */
			function udesign_core_woocommerce_header_add_to_cart_fragment( $fragments ) {
				ob_start();
				?>
					<a class="udesign-wc-cart-contents cart-contents-count-<?php echo WC()->cart->get_cart_contents_count(); ?>" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'u-design-core' ); ?>">
						<?php
						echo sprintf(
							/* translators: 1: cart total, 2: cart contents count */
							__( 'Cart: %1$s %2$s ', 'u-design-core' ),
							WC()->cart->get_cart_total(),
							'<span class="ud-wc-cart-num-items">( ' . WC()->cart->get_cart_contents_count() . ' )</span>'
						);
						?>
					</a>
				<?php
				$fragments['a.udesign-wc-cart-contents'] = ob_get_clean();
				return $fragments;
			}
			add_filter( 'woocommerce_add_to_cart_fragments', 'udesign_core_woocommerce_header_add_to_cart_fragment' );

			/**
			 * Add custom pagination with WP-PageNavi.
			 */
			if ( function_exists( 'wp_pagenavi' ) ) {
				remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );
				/**
				 * Update the WooCommerce navigation.
				 */
				function udesign_core_woocommerce_pagination() {
					wp_pagenavi( array( 'wrapper_tag' => 'nav' ) );
				}
				add_action( 'woocommerce_pagination', 'udesign_core_woocommerce_pagination', 10 );
			}

			/**
			 * Remove custom frame from WooCommerce widget images when this option is enabled for theme's "Blog Section".
			 */
			function udesign_core_wc_widget_thumbnails_cleanup() {
				if ( has_filter( 'post_thumbnail_html', 'udesign_post_image_html' ) ) {
					/**
					 * Filter the "Featured Image" with this theme's custom image frame with alignment.
					 * Exclude the WooCommerce widget images.
					 *
					 * @param string $html The post image HTML.
					 * @param int    $post_id The post ID.
					 * @param int    $post_image_id The image ID.
					 * @return string The post image HTML.
					 */
					function udesign_core_woocommerce_post_image_html( $html, $post_id, $post_image_id ) {
						if ( ! preg_match( '/shop_thumbnail|shop_catalog/', $html ) ) {
							$html = preg_replace( '/title=\"(.*?)\"/', '', $html );
							preg_match( '/aligncenter|alignleft|alignright/', $html, $matches );
							$image_alignment = ( isset( $matches[0] ) ) ? $matches[0] : '';
							$html            = preg_replace( '/aligncenter|alignleft|alignright/', 'alignnone', $html );
							$html            = '<span class="custom-frame ' . $image_alignment . '">' . $html . '</span>';
							if ( 'aligncenter' === $image_alignment ) {
								$html = '<div style="text-align:center;">' . $html . '</div>';
							}
						}
						return $html;
					}
					remove_filter( 'post_thumbnail_html', 'udesign_post_image_html' );
					add_filter( 'post_thumbnail_html', 'udesign_core_woocommerce_post_image_html', 10, 3 );
				}
			}
			add_action( 'after_setup_theme', 'udesign_core_wc_widget_thumbnails_cleanup' );

			/**
			 * Setup U-Design WooComm Cart Dropdown for the top area.
			 */
			function udesign_core_wc_cart_dropdown() {

				// Check whether the cart widget dropdown needs to be added to the page.
				$is_udesign_wc_widget_active = ( is_active_widget( false, false, 'udesign-wc-cart-widget', true ) ) ? true : false;
				if ( ! $is_udesign_wc_widget_active || is_cart() || is_checkout() ) {
					return;
				}

				/**
				 * Get an instance of the WC Cart widget.
				 */
				function udesign_core_get_wc_cart() {

					// The widget's class name.
					$widget = esc_html( 'WC_Widget_Cart' );

					// The current widget instance's settings.
					$instance = array(
						'title'         => esc_html__( 'Cart', 'u-design-core' ),
						'hide_if_empty' => 0,
					);

						// Generate random ID.
						$id = rand( 1000, 1999 );

						// Widget's custom arguments.
						$args = array(
							'widget_id'     => 'arbitrary-instance-' . $id,
							'before_widget' => '<div class="widget udesign-wc-cart-dropdown woocommerce widget_shopping_cart substitute_widget_class">',
							'after_widget'  => '</div>',
							'before_title'  => '<h3 class="widgettitle">',
							'after_title'   => '</h3>',
						);

						ob_start();
						the_widget( $widget, $instance, $args );
						return ob_get_clean();

				}
				ob_start();
				?>
					<div class="u-design-wc-cart-speech-bubble">
						<script type="text/javascript">
							// <![CDATA[
							jQuery(document).ready(function($){
									var $cartDropdown = $(".u-design-wc-cart-speech-bubble"),
										hoverOff = false; // describes the event when the mouse hovers away from the element of interest (eg. the link or cart dropdown)
									// Handle the case when the mouse enters and leaves the cart link
									$(".social-media-area .udesign-wc-cart-dropdown-wrapper")
											.mouseenter(function() {
												hoverOff = false;
												var offsetTop = $(this).offset().top + 25;
												var offsetLeft = $(this).offset().left;
												// .outerWidth() takes into account border and padding.
												var width = $(this).outerWidth();
												// Show the dropdown directly below the cart link element.
												$cartDropdown.css({
													position: "absolute",
													zIndex: "999",
													top: offsetTop + "px",
													left: ( offsetLeft - width - 25 ) + "px"
												}).fadeIn();
											})
											.mouseleave(function() {
												hoverOff = true;
												setTimeout( mouseOutEvent, 500 );
											});
									// Handle the case when the mouse enters and leaves the cart dropdown
									$cartDropdown
											.mouseenter(function() {
												hoverOff = false;
											})
											.mouseleave(function() {
												hoverOff = true;
												setTimeout(function(){
													$cartDropdown.fadeOut(200);
												}, 500);
											});
									// This function is used to decide whether to hide the cart dropdown
									function mouseOutEvent() {
										if ( hoverOff ) {
											$cartDropdown.fadeOut(200);
										}
									}
							});
							// ]]>
						</script>
						<?php
						// Get the Cart widget.
						echo udesign_core_get_wc_cart();
						?>
					</div>
				<?php
				echo ob_get_clean();
			}
			add_action( 'udesign_body_bottom', 'udesign_core_wc_cart_dropdown', 9 );

		}
	}
}
