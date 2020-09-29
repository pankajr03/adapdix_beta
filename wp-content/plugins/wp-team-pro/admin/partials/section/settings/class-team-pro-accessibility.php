<?php
/**
 * Accessibility section in settings page.
 *
 * @since      2.0.0
 * @version    2.0.0
 *
 * @package    WP_Team_Pro
 * @subpackage WP_Team_Pro/admin
 * @author     ShapedPlugin<support@shapedplugin.com>
 */

// Cannot access directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * This class is responsible for Accessibility settings in Settings page.
 *
 * @since      2.0.0
 */
class SPTP_Accessibility {

	/**
	 * Accessibility settings.
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_settings.
	 */
	public static function section( $prefix ) {
		SPF::createSection(
			$prefix,
			array(
				'id'     => 'advance_settings',
				'title'  => __( 'Accessibility', 'wp-team-pro' ),
				'icon'   => 'fa fa-braille',
				'fields' => array(
					array(
						'id'      => 'carousel_accessibility',
						'type'    => 'fieldset',
						'title'   => __( 'Carousel Accessibility', 'wp-team-pro' ),
						'fields'  => array(
							array(
								'id'         => 'accessibility',
								'type'       => 'switcher',
								'title'      => __( 'Accessibility', 'wp-team-pro' ),
								'text_on'    => __( 'Enabled', 'wp-team-pro' ),
								'text_off'   => __( 'Disabled', 'wp-team-pro' ),
								'text_width' => 100,
							),
							array(
								'id'         => 'prev_slide_message',
								'type'       => 'text',
								'title'      => __( 'Previous Slide Message', 'wp-team-pro' ),
								'dependency' => array( 'accessibility', '==', 'true' ),
							),
							array(
								'id'         => 'next_slide_message',
								'type'       => 'text',
								'title'      => __( 'Next Slide Message', 'wp-team-pro' ),
								'dependency' => array( 'accessibility', '==', 'true' ),
							),
							array(
								'id'         => 'first_slide_message',
								'type'       => 'text',
								'title'      => __( 'First Slide Message', 'wp-team-pro' ),
								'dependency' => array( 'accessibility', '==', 'true' ),
							),
							array(
								'id'         => 'last_slide_message',
								'type'       => 'text',
								'title'      => __( 'Last Slide Message', 'wp-team-pro' ),
								'dependency' => array( 'accessibility', '==', 'true' ),
							),
							array(
								'id'         => 'pagination_bullet_message',
								'type'       => 'text',
								'title'      => __( 'Pagination Bullet Message', 'wp-team-pro' ),
								'dependency' => array( 'accessibility', '==', 'true' ),
							),
						),
						'default' => array(
							'accessibility'             => true,
							'prev_slide_message'        => __( 'Previous slide', 'wp-team-pro' ),
							'next_slide_message'        => __( 'Next slide', 'wp-team-pro' ),
							'first_slide_message'       => __( 'This is the first slide', 'wp-team-pro' ),
							'last_slide_message'        => __( 'This is the last slide', 'wp-team-pro' ),
							'pagination_bullet_message' => __( 'Go to slide {{index}}', 'wp-team-pro' ),
						),
					),
				),
			)
		);
	}
}
