<?php
/**
 * Orion Login With SMS Main File.
 *
 * @package Orion Login With SMS
 */

/*
Plugin Name:  Orion Login With SMS
Plugin URI:   https://codeytek.com/login-with-sms/
Description:  This plugin allows you to Login with OTP/SMS/Verification Code with supported forms
Version:      1.0.1
Author:       Imran Sayed, Smit Patadiya
Author URI:   https://imransayed.com/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  orion-login
Domain Path:  /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

// Define Constants.
define( 'OLWS_URI', plugins_url( 'orion-login-with-sms' ) );
define( 'OLWS_PLUGIN_PATH', __FILE__ );
define( 'OLWS_TEMPLATE_PATH', plugin_dir_path( __FILE__ ) . 'templates/' );
define( 'OLWS_JS_URI', plugins_url( 'orion-login-with-sms' ) . '/js/' );
define( 'OLWS_JS_DIST_URI', plugins_url( 'orion-login-with-sms' ) . '/dist/' );
define( 'OLWS_CSS_URI', plugins_url( 'orion-login-with-sms' ) . '/css/' );
define( 'OLWS_IMAGE_URI', plugins_url( 'orion-login-with-sms' ) . '/images/' );

// Include plugin files.
require 'inc/custom-functions.php';
require 'inc/class-olws-add-settings-page.php';

// Include APIs.
require 'inc/api/class-olws-twilio-api.php';
require 'inc/api/class-olws-msg91-international-api.php';
require 'inc/api/class-olws-msg91-standard-api.php';
require 'inc/api/class-olws-nexmo-api.php';
require 'inc/api/class-olws-clicksend-api.php';
require 'inc/api/class-olws-clickatell-api.php';
require 'inc/api/class-olws-ringcaptcha-api.php';



require 'inc/class-olws-handle-messaging.php';
require 'inc/class-olws-enqueue-scripts.php';
require 'inc/class-olws-get-user-data.php';
require 'inc/class-olws-authenticate-user.php';
require 'inc/class-olws-ajax-request-handler.php';
require 'inc/class-olws-wp-footer.php';
