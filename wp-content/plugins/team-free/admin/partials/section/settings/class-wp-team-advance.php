<?php
/**
 * Advance section in settings page.
 *
 * @since      2.0.0
 * @version    2.0.0
 *
 * @package    WP_Team
 * @subpackage WP_Team/admin
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
				'title'  => __( 'Advanced Settings', 'wp-team' ),
				'icon'   => 'fa fa-cogs',
				'fields' => array(
					array(
						'id'       => 'delete_on_remove',
						'type'     => 'checkbox',
						'title'    => __( 'Clean-up Data on Deletion', 'wp-team' ),
						'subtitle' => __( 'Check this box if you would like WP Team to completely clean-up all of its data when the plugin is deleted.', 'wp-team' ),
						'default'  => false,
					),
					array(
						'type'    => 'subheading',
						'content' => __( 'Enqueue or Dequeue JS', 'wp-team' ),
					),
					array(
						'id'         => 'enqueue_swiper_js',
						'type'       => 'switcher',
						'title'      => __( 'Swiper JS', 'wp-team' ),
						'default'    => true,
						'text_on'    => __( 'Enqueue', 'wp-team' ),
						'text_off'   => __( 'Dequeue', 'wp-team' ),
						'text_width' => 100,
					),
					array(
						'type'    => 'subheading',
						'content' => __( 'Enqueue or Dequeue CSS', 'wp-team' ),
					),
					array(
						'id'         => 'enqueue_fontawesome',
						'type'       => 'switcher',
						'title'      => __( 'Font Awesome', 'wp-team' ),
						'default'    => true,
						'text_on'    => __( 'Enqueue', 'wp-team' ),
						'text_off'   => __( 'Dequeue', 'wp-team' ),
						'text_width' => 100,
					),
					array(
						'id'         => 'enqueue_swiper',
						'type'       => 'switcher',
						'title'      => __( 'Swiper CSS', 'wp-team' ),
						'default'    => true,
						'text_on'    => __( 'Enqueue', 'wp-team' ),
						'text_off'   => __( 'Dequeue', 'wp-team' ),
						'text_width' => 100,
					),
				),
			)
		);
	}
}
