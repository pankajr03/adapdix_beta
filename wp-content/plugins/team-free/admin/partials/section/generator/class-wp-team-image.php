<?php
/**
 * Image tab.
 *
 * @since      2.0.0
 * @version    2.0.0
 *
 * @package    WP_Team
 * @subpackage WP_Team/admin
 */

// Cannot access directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * This class is responsible for Image tab in Team page.
 *
 * @since      2.0.0
 */
class SPTP_Image {

	/**
	 * SPTP_Image class for setting image in Admin->Team Pro->Team Generator Page.
	 * Here, this class is responsible for image settings tab.
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_generator.
	 */
	public static function section( $prefix ) {
		SPF::createSection(
			$prefix,
			array(
				'title'  => __( 'Image Settings', 'wp-team' ),
				'icon'   => 'fa fa-image',
				'fields' => array(
					array(
						'id'         => 'image_on_off',
						'type'       => 'switcher',
						'title'      => __( 'Photo/Image', 'wp-team' ),
						'subtitle'   => __( 'Show/Hide member photo or image.', 'wp-team' ),
						'text_on'    => __( 'Show', 'wp-team' ),
						'text_off'   => __( 'Hide', 'wp-team' ),
						'text_width' => 75,
						'default'    => true,
					),
					array(
						'id'         => 'image_size',
						'class'      => 'image_size',
						'type'       => 'select',
						'title'      => __( 'Image Sizes', 'wp-team' ),
						'subtitle'   => __( 'Set member image size.', 'wp-team' ),
						'options'    => 'img_sizes',
						'default'    => 'original',
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'image_shape',
						'class'      => 'image_shape',
						'type'       => 'image_select',
						'title'      => __( 'Image Shape', 'wp-team' ),
						'subtitle'   => __( 'Choose an image shape for member.', 'wp-team' ),
						'options'    => array(
							'sptp-square'  => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/square.png',
								'option_name' => __( 'Square', 'wp-team' ),
								'class'       => 'free-feature',
							),
							'sptp-rounded' => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/rounded.png',
								'option_name' => __( 'Rounded', 'wp-team' ),
								'class'       => 'pro-feature',
							),
							'sptp-circle'  => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/circle.png',
								'option_name' => __( 'Circle', 'wp-team' ),
								'class'       => 'pro-feature',
							),
						),
						'default'    => 'sptp-square',
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'image_border',
						'type'       => 'checkbox',
						'title'      => __( 'Border', 'wp-team' ),
						'subtitle'   => __( 'Check to show border around member image.', 'wp-team' ),
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'border',
						'type'       => 'border',
						'title'      => __( 'Border', 'wp-team' ),
						'subtitle'   => __( 'Set border.', 'wp-team' ),
						'all'        => true,
						'dependency' => array( 'image_on_off|image_border', '==|==', 'true|true' ),
						'default'    => array(
							'style' => 'none',
						),
					),
					array(
						'id'         => 'background',
						'type'       => 'color',
						'title'      => __( 'Background', 'wp-team' ),
						'subtitle'   => __( 'Set background for member image.', 'wp-team' ),
						'default'    => '#FFFFFF',
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'image_zoom',
						'type'       => 'select',
						'title'      => __( 'Zoom', 'wp-team' ),
						'subtitle'   => __( 'Select a zoom effect for image.', 'wp-team' ),
						'options'    => array(
							'none'     => __( 'None', 'wp-team' ),
							'zoom_in'  => __( 'Zoom In', 'wp-team' ),
							'zoom_out' => __( 'Zoom Out', 'wp-team' ),
						),
						'default'    => 'none',
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
				),
			)
		);
	}
}
