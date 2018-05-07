<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.coffeecreamthemes.com/
 * @since             1.0.0
 * @package           Evnt_Vc_Extensions
 *
 * @wordpress-plugin
 * Plugin Name:       Evnt VC Extensions
 * Plugin URI:        http://www.coffeecreamthemes.com/
 * Description:       Evnt Cisual Composer extensions files
 * Version:           1.2.9
 * Author:            Coffeecream Themes
 * Author URI:        http://www.coffeecreamthemes.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       evnt-vc-extensions
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-evnt-vc-extensions-activator.php
 */
function activate_evnt_vc_extensions() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-evnt-vc-extensions-activator.php';
	Evnt_Vc_Extensions_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-evnt-vc-extensions-deactivator.php
 */
function deactivate_evnt_vc_extensions() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-evnt-vc-extensions-deactivator.php';
	Evnt_Vc_Extensions_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_evnt_vc_extensions' );
register_deactivation_hook( __FILE__, 'deactivate_evnt_vc_extensions' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-evnt-vc-extensions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_evnt_vc_extensions() {

	$plugin = new Evnt_Vc_Extensions();
	$plugin->run();

}
run_evnt_vc_extensions();
