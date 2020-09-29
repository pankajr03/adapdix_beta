<?php
/**
 * Fired during plugin updates
 *
 * @link       https://shapedplugin.com/
 * @since      2.0.5
 *
 * @package    WP_Team
 * @subpackage WP_Team/includes
 */

// don't call the file directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fired during plugin updates.
 *
 * This class defines all code necessary to run during the plugin's updates.
 *
 * @since      2.0.5
 * @package    WP_Team
 * @subpackage WP_Team/includes
 * @author     ShapedPlugin <support@shapedplugin.com>
 */
class WP_Team_Updates {

	/**
	 * DB updates that need to be run
	 *
	 * @var array
	 */
	private static $updates = [
		'2.0.5' => 'updates/update-2.0.5.php',
	];

	/**
	 * Binding all events
	 *
	 * @since 2.0.5
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'do_updates' ) );
	}

	/**
	 * Check if need any update
	 *
	 * @since 2.0.5
	 *
	 * @return boolean
	 */
	public function is_needs_update() {
		$installed_version = get_option( 'sp_wp_team_version' );

		if ( false === $installed_version ) {
			update_option( 'sp_wp_team_version', SPT_PLUGIN_VERSION );
			update_option( 'sp_wp_team_db_version', SPT_PLUGIN_VERSION );
		}

		if ( version_compare( $installed_version, SPT_PLUGIN_VERSION, '<' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Do updates.
	 *
	 * @since 2.0.5
	 *
	 * @return void
	 */
	public function do_updates() {
		$this->perform_updates();
	}

	/**
	 * Perform all updates
	 *
	 * @since 2.0.5
	 *
	 * @return void
	 */
	public function perform_updates() {
		if ( ! $this->is_needs_update() ) {
			return;
		}

		$installed_version = get_option( 'sp_wp_team_version' );

		foreach ( self::$updates as $version => $path ) {
			if ( version_compare( $installed_version, $version, '<' ) ) {
				include $path;
				update_option( 'sp_wp_team_version', $version );
			}
		}

		update_option( 'sp_wp_team_version', SPT_PLUGIN_VERSION );

	}

}
new WP_Team_Updates();
