<?php
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      2.0
 * @package    WP_Team_Pro
 * @subpackage Team_Pro/includes
 */
class Team_Pro_i18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    2.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-team-pro',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}
