<?php
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      2.0.0
 * @package   WP_Team
 * @subpackage Team/includes
 */
class WP_Team_Deactivator {

	/**
	 * When plugin activate drop `order` column from term_taxonomy table.
	 *
	 * @since    2.0.0
	 */
	public static function deactivate() {
	}

}
