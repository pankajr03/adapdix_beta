<?php
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      2.0
 * @package   WP_Team_Pro
 * @subpackage Team_Pro/includes
 */
class Team_Pro_Deactivator {

	/**
	 * When plugin activate drop `order` column from term_taxonomy table.
	 *
	 * @since    2.0
	 */
	public static function deactivate() {
		global $wpdb;
		$order_column_drop_query = $wpdb->query( "ALTER TABLE `{$wpdb->term_taxonomy}` DROP COLUMN `order`" );
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $order_column_drop_query );
	}

}
