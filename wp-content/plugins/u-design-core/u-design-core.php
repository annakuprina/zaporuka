<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themeforest.net/user/andondesign
 * @since             1.0.0
 * @package           U_Design_Core
 *
 * @wordpress-plugin
 * Plugin Name:       U-Design Core
 * Plugin URI:        https://themeforest.net/item/udesign-responsive-wordpress-theme/253220
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.1
 * Author:            AndonDesign
 * Author URI:        https://themeforest.net/user/andondesign
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       u-design-core
 * Domain Path:       /languages
 * WC requires at least: 3.0.0
 * WC tested up to: 3.6.4
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 * Uses SemVer - https://semver.org
 * Update the line below as new new version is released.
 */
define( 'U_DESIGN_CORE_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-u-design-core-activator.php
 */
function activate_u_design_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-u-design-core-activator.php';
	U_Design_Core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-u-design-core-deactivator.php
 */
function deactivate_u_design_core() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-u-design-core-deactivator.php';
	U_Design_Core_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_u_design_core' );
register_deactivation_hook( __FILE__, 'deactivate_u_design_core' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-u-design-core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_u_design_core() {

	$plugin = new U_Design_Core();
	$plugin->run();

}
run_u_design_core();
