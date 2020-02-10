<?php
/**
 * Define the widgets
 *
 * Loads and defines the widgets for this plugin.
 *
 * @link       https://themeforest.net/user/andondesign
 * @since      1.0.0
 *
 * @package    U_Design_Core
 * @subpackage U_Design_Core/includes
 */

/**
 * Define the widget functionality.
 *
 * Loads and defines the widgets for this plugin.
 *
 * @since      1.0.0
 * @package    U_Design_Core
 * @subpackage U_Design_Core/includes
 * @author     AndonDesign <https://themeforest.net/user/andondesign#contact>
 */
class U_Design_Core_Widgets {


	/**
	 * Register and load the 'Subpages_Widget' widget.
	 *
	 * @since 1.0.0
	 */
	public function subpages_load_widgets() {
		register_widget( 'Subpages_Widget' );
	}


	/**
	 * Register and load the 'Login_Form_Widget' widget.
	 *
	 * @since 1.0.0
	 */
	public function login_form_load_widgets() {
		register_widget( 'Login_Form_Widget' );
	}


	/**
	 * Register and load the 'Custom_Category_Widget' widget.
	 *
	 * @since 1.0.0
	 */
	public function custom_category_load_widgets() {
		register_widget( 'Custom_Category_Widget' );
	}


	/**
	 * Register and load the 'Google_Map_Widget' widget.
	 *
	 * @since 1.0.0
	 */
	public function google_map_load_widgets() {
		register_widget( 'Google_Map_Widget' );
	}


	/**
	 * Register and load the 'Latest_Posts_Widget' widget.
	 *
	 * @since 1.0.0
	 */
	public function latest_posts_load_widgets() {
		register_widget( 'Latest_Posts_Widget' );
	}


	/**
	 * Register and load the 'U_Design_Core_Woocommerce_Cart_Widget' widget.
	 *
	 * @since 1.0.0
	 */
	public function udesign_core_woocommerce_account_load_widgets() {
		register_widget( 'U_Design_Core_Woocommerce_Cart_Widget' );
	}

	/**
	 * Load the plugin widgets.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_widgets() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/class-custom-category-widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/class-google-map-widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/class-latest-posts-widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/class-login-form-widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/class-subpages-widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/class-u-design-core-woocommerce-cart-widget.php';

	}


}
