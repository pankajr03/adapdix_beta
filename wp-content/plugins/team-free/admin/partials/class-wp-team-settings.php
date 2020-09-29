<?php

if ( ! defined( 'ABSPATH' ) ) {
	die; }

class SPTP_Settings {

	public static function metaboxes( $prefix ) {
		SPF::createOptions(
			$prefix,
			array(
				'menu_title'              => __( 'Settings', 'wp-team' ),
				'show_bar_menu'           => false,
				'menu_slug'               => 'team_settings',
				'menu_parent'             => 'edit.php?post_type=sptp_member',
				'framework_title'         => __( 'WP Team', 'wp-team' ),
				'menu_type'               => 'submenu',
				'admin_bar_menu_priority' => 5,
				'show_search'             => false,
				'show_all_options'        => false,
				'show_reset_section'      => true,
				'show_footer'             => false,
				'theme'                   => 'light',
				'framework_class'         => 'sptp-option-settings',
			)
		);
		SPTP_Advance::section( $prefix );
		SPTP_SettingsStyle::section( $prefix );
		SPTP_Rename::section( $prefix );
		SPTP_Accessibility::section( $prefix );
	}
}
