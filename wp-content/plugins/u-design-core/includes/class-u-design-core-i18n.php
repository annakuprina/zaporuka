<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://themeforest.net/user/andondesign
 * @since      1.0.0
 *
 * @package    U_Design_Core
 * @subpackage U_Design_Core/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    U_Design_Core
 * @subpackage U_Design_Core/includes
 * @author     AndonDesign <https://themeforest.net/user/andondesign#contact>
 */
class U_Design_Core_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$textdomain = 'u-design-core'; // Make sure that the textdomain matches the file name for the *.mo and *.po files {textdomain}-{locale}.mo, exameple: "u-design-core-de_DE.po" ).
		load_plugin_textdomain(
			$textdomain,
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

		/**
		 * Filters translated strings prepared for TinyMCE for the U-Design Shortcodes Button.
		 *
		 * @param array $mce_translation Key/value pairs of strings.
		 * @return array $mce_translation Key/value pairs of strings.
		 */
		function udesign_core_shortcodes_button_add_locale( $mce_translation ) {

			include plugin_dir_path( dirname( __FILE__ ) ) . 'languages/u-design-core-shortcodes-button-strings.php';

			$strings = udesign_core_shortcodes_button_translation();
			foreach ( (array) $strings as $key => $value ) {
				$mce_translation[ $key ] = $value;
			}

			return $mce_translation;
		}
		add_filter( 'wp_mce_translation', 'udesign_core_shortcodes_button_add_locale' );

	}


}
