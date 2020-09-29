<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://shapedplugin.com
 * @package           WP_Team
 *
 * Plugin Name:       WP Team
 * Plugin URI:        https: //shapedplugin.com/plugin/wp-team/
 * Description:       The most versatile and industry-leading WordPress team showcase plugin built to create and manage team members showcases with excellent design and multiple options.
 * Version:           2.0.4
 * Author:            ShapedPlugin
 * Author URI:        https://shapedplugin.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-team
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'SPT_PLUGIN_NAME', 'wp-team' );
define( 'SPT_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'SPT_PLUGIN_VERSION', '2.0.4' );
define( 'SPT_PLUGIN_ROOT', plugin_dir_url( __FILE__ ) );

if ( ! function_exists( 'activate_wp_team' ) ) {
	/**
	 * The code that runs during plugin activation.
	 * This action is documented in includes/class-wp-team-activator.php
	 */
	function activate_wp_team() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-team-activator.php';
		WP_Team_Activator::activate();
	}
}

if ( ! function_exists( 'deactivate_wp_team' ) ) {
	/**
	 * The code that runs during plugin deactivation.
	 * This action is documented in includes/class-wp-team-deactivator.php
	 */
	function deactivate_wp_team() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-team-deactivator.php';
		WP_Team_Deactivator::deactivate();
	}
}

register_activation_hook( __FILE__, 'activate_wp_team' );
register_deactivation_hook( __FILE__, 'deactivate_wp_team' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-team.php';

require plugin_dir_path( __FILE__ ) . 'deprecated/deprecated-team.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2.0.0
 */
function run_wp_team() {
	$plugin = new WP_Team();
	$plugin->run();
}
if ( class_exists( 'WP_Team' ) ) {
	run_wp_team();
}
