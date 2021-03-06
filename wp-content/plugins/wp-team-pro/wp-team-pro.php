<?php
/**
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://shapedplugin.com
 * @since             2.0.0
 * @package           WP_Team_Pro
 *
 * Plugin Name:       WP Team Pro
 * Plugin URI:        https: //shapedplugin.com/plugin/wp-team-pro/
 * Description:       The most versatile and industry leading WordPress team showcase plugin built to create and manage team members showcases with excellent design and multiple options.
 * Version:           2.0.4
 * Author:            ShapedPlugin
 * Author URI:        https://shapedplugin.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-team-pro
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'SPTP_PLUGIN_NAME', 'wp-team-pro' );
define( 'SPTP_PLUGIN_VERSION', '2.0.4' );
define( 'SPTP_PLUGIN_ROOT', plugin_dir_url( __FILE__ ) );

if ( ! function_exists( 'activate_team_pro' ) ) {
	/**
	 * The code that runs during plugin activation.
	 * This action is documented in includes/class-team-pro-activator.php
	 */
	function activate_team_pro() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-team-pro-activator.php';
		Team_Pro_Activator::activate();
	}
}

if ( ! function_exists( 'deactivate_team_pro' ) ) {
	/**
	 * The code that runs during plugin deactivation.
	 * This action is documented in includes/class-team-pro-deactivator.php
	 */
	function deactivate_team_pro() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-team-pro-deactivator.php';
		Team_Pro_Deactivator::deactivate();
	}
}

register_activation_hook( __FILE__, 'activate_team_pro' );
register_deactivation_hook( __FILE__, 'deactivate_team_pro' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-team-pro.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_team_pro() {
	$plugin = new Team_Pro();
	$plugin->run();
}
if ( class_exists( 'Team_Pro' ) ) {
	run_team_pro();
}
