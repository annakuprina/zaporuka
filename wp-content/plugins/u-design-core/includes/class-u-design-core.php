<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themeforest.net/user/andondesign
 * @since      1.0.0
 *
 * @package    U_Design_Core
 * @subpackage U_Design_Core/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    U_Design_Core
 * @subpackage U_Design_Core/includes
 * @author     AndonDesign <https://themeforest.net/user/andondesign#contact>
 */
class U_Design_Core {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      U_Design_Core_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		if ( defined( 'U_DESIGN_CORE_VERSION' ) ) {
			$this->version = U_DESIGN_CORE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'u-design-core';

		$this->load_dependencies();
		$this->set_locale();
		$this->set_widgets();
		$this->set_shortcodes();
		$this->set_woocommerce_compatibility();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - U_Design_Core_Loader. Orchestrates the hooks of the plugin.
	 * - U_Design_Core_i18n. Defines internationalization functionality.
	 * - U_Design_Core_Admin. Defines all hooks for the admin area.
	 * - U_Design_Core_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-u-design-core-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-u-design-core-i18n.php';

		/**
		 * The class responsible for defining all widgets of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/class-u-design-core-widgets.php';

		/**
		 * The class responsible for defining all shortcodes of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/shortcodes/class-u-design-core-shortcodes.php';

		/**
		 * The class responsible for defining shortcodes button for TinyMCE editor.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/shortcodes/class-u-design-core-shortcodes-button.php';

		/**
		 * The class responsible for making the U-Design compatible with WooCommerce.
		 */
		if ( $this->is_udesign_activated() && $this->is_woocommerce_activated() ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/woocommerce/class-u-design-core-woocommerce.php';
		}

		$this->loader = new U_Design_Core_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the U_Design_Core_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new U_Design_Core_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Define the widets.
	 *
	 * Uses the U_Design_Core_Widgets class in order to set the widgets.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_widgets() {

		$plugin_widgets = new U_Design_Core_Widgets();

		$this->loader->add_action( 'plugins_loaded', $plugin_widgets, 'load_plugin_widgets' );

		// Register the widgets.
		$this->loader->add_action( 'widgets_init', $plugin_widgets, 'latest_posts_load_widgets' );
		$this->loader->add_action( 'widgets_init', $plugin_widgets, 'login_form_load_widgets' );
		$this->loader->add_action( 'widgets_init', $plugin_widgets, 'custom_category_load_widgets' );
		$this->loader->add_action( 'widgets_init', $plugin_widgets, 'google_map_load_widgets' );
		$this->loader->add_action( 'widgets_init', $plugin_widgets, 'subpages_load_widgets' );
		if ( $this->is_udesign_activated() && $this->is_woocommerce_activated() ) {
			$this->loader->add_action( 'widgets_init', $plugin_widgets, 'udesign_core_woocommerce_account_load_widgets' );
		}
	}

	/**
	 * Define the shortcodes.
	 *
	 * Uses the U_Design_Core_Shortcodes_Button class in order to set the button.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_shortcodes() {

		$plugin_shortcodes        = new U_Design_Core_Shortcodes();
		$plugin_shortcodes_button = new U_Design_Core_Shortcodes_Button( $this->get_version() );

		// Allows shortcodes to be used in widgets.
		add_filter( 'widget_text', 'do_shortcode' );

		// Add the shortcodes.
		add_shortcode( 'read_more', array( $plugin_shortcodes, 'read_more_func' ) );
		add_shortcode( 'button', array( $plugin_shortcodes, 'button_func' ) );
		add_shortcode( 'small_button', array( $plugin_shortcodes, 'small_button_func' ) );
		add_shortcode( 'round_button', array( $plugin_shortcodes, 'round_button_func' ) );
		add_shortcode( 'custom_button', array( $plugin_shortcodes, 'custom_button_func' ) );
		add_shortcode( 'flat_button', array( $plugin_shortcodes, 'flat_custom_button_func' ) );
		add_shortcode( 'divider', array( $plugin_shortcodes, 'divider_func' ) );
		add_shortcode( 'divider_top', array( $plugin_shortcodes, 'divider_top_func' ) );
		add_shortcode( 'clear', array( $plugin_shortcodes, 'clear_func' ) );
		add_shortcode( 'message', array( $plugin_shortcodes, 'message_box_func' ) );
		add_shortcode( 'pullquote', array( $plugin_shortcodes, 'pullquote_func' ) );
		add_shortcode( 'pullquote2', array( $plugin_shortcodes, 'pullquote2_func' ) );
		add_shortcode( 'dropcap', array( $plugin_shortcodes, 'dropcap_func' ) );
		add_shortcode( 'one_fourth', array( $plugin_shortcodes, 'one_fourth_func' ) );
		add_shortcode( 'one_fourth_last', array( $plugin_shortcodes, 'one_fourth_last_func' ) );
		add_shortcode( 'one_third', array( $plugin_shortcodes, 'one_third_func' ) );
		add_shortcode( 'one_third_last', array( $plugin_shortcodes, 'one_third_last_func' ) );
		add_shortcode( 'one_half', array( $plugin_shortcodes, 'one_half_func' ) );
		add_shortcode( 'one_half_last', array( $plugin_shortcodes, 'one_half_last_func' ) );
		add_shortcode( 'two_third', array( $plugin_shortcodes, 'two_third_func' ) );
		add_shortcode( 'two_third_last', array( $plugin_shortcodes, 'two_third_last_func' ) );
		add_shortcode( 'three_fourth', array( $plugin_shortcodes, 'three_fourth_func' ) );
		add_shortcode( 'three_fourth_last', array( $plugin_shortcodes, 'three_fourth_last_func' ) );
		add_shortcode( 'toggle_content', array( $plugin_shortcodes, 'toggle_content_func' ) );
		add_shortcode( 'tab', array( $plugin_shortcodes, 'tab_func' ) );
		add_shortcode( 'tabs', array( $plugin_shortcodes, 'tabs_func' ) );
		add_shortcode( 'accordion_toggle', array( $plugin_shortcodes, 'accordion_toggle_func' ) );
		add_shortcode( 'accordion', array( $plugin_shortcodes, 'accordion_func' ) );
		add_shortcode( 'custom_list', array( $plugin_shortcodes, 'custom_list_func' ) );
		add_shortcode( 'custom_table', array( $plugin_shortcodes, 'custom_table_func' ) );
		add_shortcode( 'custom_frame_left', array( $plugin_shortcodes, 'custom_frame_left_func' ) );
		add_shortcode( 'custom_frame_right', array( $plugin_shortcodes, 'custom_frame_right_func' ) );
		add_shortcode( 'custom_frame_center', array( $plugin_shortcodes, 'custom_frame_center_func' ) );
		add_shortcode( 'udesign_recent_posts', array( $plugin_shortcodes, 'udesign_recent_posts_func' ) );
		add_shortcode( 'content_block', array( $plugin_shortcodes, 'content_block_func' ) );
		// WooCommerce related shortcodes.
		if ( $this->is_udesign_activated() && $this->is_woocommerce_activated() ) {
			add_shortcode( 'udesign_wc_top_rated_products', array( $plugin_shortcodes, 'udesign_wc_top_rated_products_func' ) );
			add_shortcode( 'udesign_wc_products', array( $plugin_shortcodes, 'udesign_wc_products_func' ) );
		}

		// MCE button for shortcodes stuff goes below.
		if ( is_admin() ) {

			// Dynamic Content in TinyMCE.
			$this->loader->add_action( 'wp_ajax_udesign_save_cats_list', $plugin_shortcodes_button, 'udesign_list_ajax' );
			$this->loader->add_action( 'admin_footer', $plugin_shortcodes_button, 'udesign_save_cats_list' );

			// MCE button.
			$this->loader->add_action( 'admin_init', $plugin_shortcodes_button, 'add_mce_button' );
			// The MCE button related style sheet.
			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_shortcodes_button, 'mce_css' );
		}

		// Admin notice to admins to remove the old 'U-Design Shortcodes Button' plugin if they still have it active.
		$this->loader->add_action( 'plugins_loaded', $plugin_shortcodes_button, 'udesign_core_remove_old_shortcodes_plugin_admin_notice' );

	}

	/**
	 * Make the U-Design theme compatible with WooCommerce plugin.
	 *
	 * Uses the U_Design_Core_Woocommerce class.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_woocommerce_compatibility() {

		if ( $this->is_udesign_activated() && $this->is_woocommerce_activated() ) {
			$plugin_ud_wc_compat = new U_Design_Core_Woocommerce( $this->get_version() );

			if ( ! is_admin() ) {
				$this->loader->add_action( 'wp_enqueue_scripts', $plugin_ud_wc_compat, 'udesign_core_woocommerce_enqueue_assets', 20 );
			}

			$this->loader->add_action( 'plugins_loaded', $plugin_ud_wc_compat, 'udesign_core_woocommerce' );

			// Admin notice to admins to remove the old 'U-Design WooCommerce Integration' plugin if they still have it active.
			$this->loader->add_action( 'plugins_loaded', $plugin_ud_wc_compat, 'udesign_core_remove_old_ud_wc_plugin_admin_notice' );
		}

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    U_Design_Core_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Check whether the currently active theme is "U-Design".
	 *
	 * @return bool
	 */
	public function is_udesign_activated() {
		$curr_theme_name = '';
		// Get the current theme name (always from parent theme).
		$curr_theme_obj = ( function_exists( 'wp_get_theme' ) ) ? wp_get_theme() : false;
		if ( $curr_theme_obj && $curr_theme_obj->exists() ) {
			$curr_theme      = ( $curr_theme_obj->parent() ) ? $curr_theme_obj->parent() : $curr_theme_obj;
			$curr_theme_name = $curr_theme->get( 'Name' );
		}
		return ( 'U-Design' === $curr_theme_name ) ? true : false;
	}

	/**
	 * Check if WooCommerce is activated.
	 *
	 * @return boolean
	 */
	public function is_woocommerce_activated() {
		return ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) ? true : false;
	}

}
