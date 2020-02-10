<?php
/**
 * Fired during plugin activation
 *
 * @link       https://themeforest.net/user/andondesign
 * @since      1.0.0
 *
 * @package    U_Design_Core
 * @subpackage U_Design_Core/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    U_Design_Core
 * @subpackage U_Design_Core/includes
 * @author     AndonDesign <https://themeforest.net/user/andondesign#contact>
 */
class U_Design_Core_Activator {

	/**
	 * Code necessary to run during the plugin's activation.
	 *
	 * Upon activation we need to remove the original "U-Design Shortcodes Button" and
	 * "U-Design WooCommerce Integration" plugins as they are now bundled with this plugin.
	 *
	 * @since 1.0.0
	 */
	public static function activate() {

		// Remove the old "U-Design Shortcodes Button" plugin.
		self::udesign_core_remove_old_plugin( 'udesign-shortcodes-button/udesign-shortcodes-button.php' );

		// Remove the old "U-Design WooCommerce Integration" plugin.
		self::udesign_core_remove_old_plugin( 'u-design-woocommerce/u-design-woocommerce.class.php' );

	}

	/**
	 * Uninstall an remove a plugin using the WordPress Filesystem API.
	 *
	 * @since 1.0.0
	 * @param string $plugin_file Path to the plugin file relative to the plugins directory.
	 * @return bool True on success, otherwise false.
	 */
	public static function udesign_core_remove_old_plugin( $plugin_file ) {

		if ( $plugin_file ) {

			$access_type = get_filesystem_method();

			if ( 'direct' === $access_type ) {

				$creds = request_filesystem_credentials( esc_url_raw( site_url() ) . '/wp-admin/', '', false, false, array() );

				// Initialize the API.
				if ( ! WP_Filesystem( $creds ) ) {
					// Any problems and we exit.
					return false;
				}

				global $wp_filesystem;

				// Get the base plugin folder.
				$plugins_dir = $wp_filesystem->wp_plugins_dir();
				if ( empty( $plugins_dir ) ) {
					return new WP_Error( 'fs_no_plugins_dir', __( 'Unable to locate WordPress plugin directory.', 'u-design-core' ) );
				}

				$plugins_dir = trailingslashit( $plugins_dir );

				// Run Uninstall hook.
				if ( is_uninstallable_plugin( $plugin_file ) ) {
					uninstall_plugin( $plugin_file );
				}

				$this_plugin_dir = trailingslashit( dirname( $plugins_dir . $plugin_file ) );

				// Deactivate the plugin first.
				deactivate_plugins( $plugin_file, true );

				if ( $wp_filesystem->exists( $this_plugin_dir ) ) { // Check if plugin file exists.
					// If plugin is in its own directory, recursively delete the directory.
					if ( strpos( $plugin_file, '/' ) && $this_plugin_dir !== $plugins_dir ) { // Base check on if plugin includes directory separator AND that it's not the root plugin folder.
						$deleted = $wp_filesystem->delete( $this_plugin_dir, true );
					} else {
						$deleted = $wp_filesystem->delete( $plugins_dir . $plugin_file );
					}

					if ( ! $deleted ) {
						return false;
					}
				}

				// Remove deleted plugins from the plugin updates list.
				if ( $current = get_site_transient( 'update_plugins' ) ) {
					unset( $current->response[ $plugin_file ] );
					set_site_transient( 'update_plugins', $current );
				}

				return true;

			}
		}

		return false;

	}

}
