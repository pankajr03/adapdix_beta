<?php
/**
 * Link section in settings page.
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
 * This class is responsible for Link settings in Settings page.
 *
 * @since      2.0.0
 */
class SPTP_Link {

	/**
	 * Link settings.
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_settings.
	 */
	public static function section( $prefix ) {
		SPF::createSection(
			$prefix,
			array(
				'id'     => 'link_settings',
				'title'  => __( 'Link Settings', 'wp-team-pro' ),
				'icon'   => 'fa fa-link',
				'fields' => array(
					array(
						'id'    => 'link_mailto',
						'type'  => 'checkbox',
						'title' => __( 'Mailto Active', 'wp-team-pro' ),
					),
					array(
						'id'    => 'no_follow',
						'type'  => 'checkbox',
						'title' => __( 'No-follow links', 'wp-team-pro' ),
					),
					array(
						'id'    => 'link_telephone',
						'type'  => 'checkbox',
						'title' => __( 'Telephone', 'wp-team-pro' ),
					),
					array(
						'id'    => 'link_css',
						'type'  => 'text',
						'title' => __( 'CSS class for links', 'wp-team-pro' ),
					),
				),
			)
		);

	}
}
