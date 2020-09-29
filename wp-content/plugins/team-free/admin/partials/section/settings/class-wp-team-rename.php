<?php
/**
 * Rename section in settings page.
 *
 * @since      2.0.0
 * @version    2.0.0
 *
 * @package    WP_Team
 * @subpackage WP_Team/admin
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

// Cannot access directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * This class is responsible for Rename in Settings page.
 *
 * @since      2.0.0
 */
class SPTP_Rename {

	/**
	 * Rename settings.
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_settings.
	 */
	public static function section( $prefix ) {
		SPF::createSection(
			$prefix,
			array(
				'id'     => 'dashboard_menu_rename',
				'title'  => __( 'Rename Menus', 'wp-team' ),
				'icon'   => 'fa fa-tachometer',
				'fields' => array(
					array(
						'id'      => 'rename_member_singular',
						'type'    => 'text',
						'title'   => __( 'Member singular name', 'wp-team' ),
						'default' => __( 'Member', 'wp-team' ),
					),
					array(
						'id'      => 'rename_member_plural',
						'type'    => 'text',
						'title'   => __( 'Member plural name', 'wp-team' ),
						'default' => __( 'Members', 'wp-team' ),
					),
					array(
						'id'      => 'rename_team',
						'type'    => 'text',
						'title'   => __( 'Plural name', 'wp-team' ),
						'default' => __( 'Team', 'wp-team' ),
					),
				),
			)
		);

	}
}
