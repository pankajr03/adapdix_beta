<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      2.0.0
 * @package   WP_Team
 * @subpackage Team/includes
 */
class WP_Team_Activator {
	/**
	 * When plugin activate a extra column `order` add to term_taxonomy table
	 *
	 * @since      2.0.0
	 */
	public static function activate() {

		deactivate_plugins( 'wp-team-pro/wp-team-pro.php' );
	}

}
