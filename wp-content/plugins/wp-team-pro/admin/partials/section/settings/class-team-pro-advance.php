<?php
/**
 * Advance section in settings page.
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
class SPTP_Advance {

	/**
	 * Advanced settings (script/style enqueue/dequeue, remove data) in Settings page
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_settings.
	 */
	public static function section( $prefix ) {
		SPF::createSection(
			$prefix,
			array(
				'id'     => 'advance_settings',
				'title'  => __( 'Advanced Settings', 'wp-team-pro' ),
				'icon'   => 'fa fa-cogs',
				'fields' => array(
					array(
						'id'       => 'delete_on_remove',
						'type'     => 'checkbox',
						'title'    => __( 'Remove Data when Delete', 'wp-team-pro' ),
						'subtitle' => __( 'Check this box if you would like WP Team Pro to completely remove all of its data when the plugin is deleted.', 'wp-team-pro' ),
						'default'  => false,
					),
					array(
						'id'         => 'enqueue_google_font',
						'type'       => 'switcher',
						'title'      => __( 'Google Fonts', 'wp-team-pro' ),
						'subtitle'   => __( "Enqueue/Dequeue google font. If google font is dequeued, the typography tab google fonts won't work.", 'wp-team-pro' ),
						'default'    => true,
						'text_on'    => __( 'Enqueue', 'wp-team-pro' ),
						'text_off'   => __( 'Dequeue', 'wp-team-pro' ),
						'text_width' => 100,
					),
					array(
						'type'    => 'subheading',
						'content' => __( 'Enqueue or Dequeue JS', 'wp-team-pro' ),
					),
					array(
						'id'         => 'enqueue_swiper_js',
						'type'       => 'switcher',
						'title'      => __( 'Swiper JS', 'wp-team-pro' ),
						'default'    => true,
						'text_on'    => __( 'Enqueue', 'wp-team-pro' ),
						'text_off'   => __( 'Dequeue', 'wp-team-pro' ),
						'text_width' => 100,
					),
					array(
						'id'         => 'enqueue_simplebar_js',
						'type'       => 'switcher',
						'title'      => __( 'Simplebar JS', 'wp-team-pro' ),
						'default'    => true,
						'text_on'    => __( 'Enqueue', 'wp-team-pro' ),
						'text_off'   => __( 'Dequeue', 'wp-team-pro' ),
						'text_width' => 100,
					),
					array(
						'id'         => 'enqueue_isotope_js',
						'type'       => 'switcher',
						'title'      => __( 'Isotope JS', 'wp-team-pro' ),
						'default'    => true,
						'text_on'    => __( 'Enqueue', 'wp-team-pro' ),
						'text_off'   => __( 'Dequeue', 'wp-team-pro' ),
						'text_width' => 100,
					),
					array(
						'type'    => 'subheading',
						'content' => __( 'Enqueue or Dequeue CSS', 'wp-team-pro' ),
					),
					array(
						'id'         => 'enqueue_fontawesome',
						'type'       => 'switcher',
						'title'      => __( 'Font Awesome', 'wp-team-pro' ),
						'default'    => true,
						'text_on'    => __( 'Enqueue', 'wp-team-pro' ),
						'text_off'   => __( 'Dequeue', 'wp-team-pro' ),
						'text_width' => 100,
					),
					array(
						'id'         => 'enqueue_swiper',
						'type'       => 'switcher',
						'title'      => __( 'Swiper CSS', 'wp-team-pro' ),
						'default'    => true,
						'text_on'    => __( 'Enqueue', 'wp-team-pro' ),
						'text_off'   => __( 'Dequeue', 'wp-team-pro' ),
						'text_width' => 100,
					),
				),
			)
		);
	}
}
