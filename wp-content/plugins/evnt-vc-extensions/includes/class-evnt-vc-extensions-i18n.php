<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.coffeecreamthemes.com/
 * @since      1.0.0
 *
 * @package    Evnt_Vc_Extensions
 * @subpackage Evnt_Vc_Extensions/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Evnt_Vc_Extensions
 * @subpackage Evnt_Vc_Extensions/includes
 * @author     Coffeecream Themes <stanislawskiwaldemar@gmail.com>
 */
class Evnt_Vc_Extensions_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'evnt-vc-extensions',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
