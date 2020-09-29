<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://lakshman.com.np
 * @since             1.0.0
 * @package           Featured_Posts_Pro
 *
 * @wordpress-plugin
 * Plugin Name:       Featured Posts Pro
 * Plugin URI:        http://lakshman.com.np
 * Description:       This plugin gives Administrator/Editor an easy option to mark posts, pages & custom posts as featured posts and provides a widget to list the recent featured posts.
 * Version:           1.4
 * Author:            Laxman Thapa
 * Author URI:        http://lakshman.com.np
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       featured_posts_pro
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-featured_posts_pro-activator.php
 */
function activate_featured_posts_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-featured_posts_pro-activator.php';
	Featured_Posts_Pro_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-featured_posts_pro-deactivator.php
 */
function deactivate_featured_posts_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-featured_posts_pro-deactivator.php';
	Featured_Posts_Pro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_featured_posts_pro' );
register_deactivation_hook( __FILE__, 'deactivate_featured_posts_pro' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-featured_posts_pro.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_featured_posts_pro() {
	$plugin = new Featured_Posts_Pro();
    $plugin->run();
}
//add_action('init', function() use ($plugin){
    run_featured_posts_pro();
//});


    
    