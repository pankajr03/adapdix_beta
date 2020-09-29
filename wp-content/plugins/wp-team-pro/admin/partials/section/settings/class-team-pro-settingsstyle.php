<?php
/**
 * Custom CSS/JS section in settings page.
 *
 * @since      2.0.0
 * @version    2.0.0
 *
 * @package    WP_Team_Pro
 * @subpackage WP_Team_Pro/admin
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

// Cannot access directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * This class is responsible for Custom CSS/JS in Settings page.
 *
 * @since      2.0.0
 */
class SPTP_SettingsStyle {

	/**
	 * Custom CSS/JS settings.
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_settings.
	 */
	public static function section( $prefix ) {
		SPF::createSection(
			$prefix,
			array(
				'id'     => 'custom_style',
				'title'  => __( 'Custom CSS & JS', 'wp-team-pro' ),
				'icon'   => 'fa fa-css3',
				'fields' => array(
					array(
						'id'       => 'custom_css',
						'type'     => 'code_editor',
						'title'    => __( 'Custom CSS' ),
						'settings' => array(
							'icon'  => 'fa fa-sliders',
							'theme' => 'mbo',
							'mode'  => 'css',
						),
					),
					array(
						'id'       => 'custom_js',
						'type'     => 'code_editor',
						'title'    => __( 'Custom JS' ),
						'settings' => array(
							'theme' => 'mbo',
							'mode'  => 'javascript',
						),
					),

				),
			)
		);

	}
}
