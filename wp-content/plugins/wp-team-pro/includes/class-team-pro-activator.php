<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      2.0.0
 * @package    WP_Team_Pro
 * @subpackage Team_Pro/includes
 */
class Team_Pro_Activator {
	/**
	 * When plugin activate a extra column `order` add to term_taxonomy table
	 *
	 * @since      2.0
	 */
	public static function activate() {
		global $wpdb;
		$order_column_query = $wpdb->query( "ALTER TABLE `{$wpdb->term_taxonomy}` ADD COLUMN `order` INT (11) NOT NULL DEFAULT 0" );
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $order_column_query );

		deactivate_plugins( 'team-free/team-free.php' );
	}

}
