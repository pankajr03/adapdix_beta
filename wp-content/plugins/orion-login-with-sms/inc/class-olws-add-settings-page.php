<?php
/**
 * Adds plugin Settings.
 *
 * @package Orion Login with SMS
 */

/**
 * Class OLWS_Add_Settings_Page class.
 */
class OLWS_Add_Settings_Page {
	/**
	 * OLWS_Add_Settings_Page constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'olws_create_menu' ) );
	}

	/**
	 * Creates Menu for Orion Plugin in the dashboard.
	 */
	public function olws_create_menu() {
		$menu_plugin_title = __( 'Orion Login Settings', 'orion-login' );
		// Create new top-level menu.
		add_menu_page(
			__(
				'Orion Login Plugin Settings',
				'orion-login'
			),
			$menu_plugin_title,
			'manage_options',
			'orion-login-settings',
			array( $this, 'olws_plugin_settings_page_content' ),
			'dashicons-admin-generic'
		);
		// Call register settings function.
		add_action( 'admin_init', array( $this, 'register_olws_plugin_settings' ) );
	}

	/**
	 * Register our settings.
	 */
	public function register_olws_plugin_settings() {
		register_setting( 'olws-plugin-settings-group', 'olws_plugin_settings' );
	}

	/**
	 * Settings Page Content for Orion Plugin.
	 */
	public function olws_plugin_settings_page_content() {
		// Check user capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		include_once OLWS_TEMPLATE_PATH . 'settings-form-template.php';
	}
}

new OLWS_Add_Settings_Page();
