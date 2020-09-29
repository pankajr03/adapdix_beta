<?php
/**
 * Image tab.
 *
 * @since      2.0.0
 * @version    2.0.0
 *
 * @package    WP_Team_Pro
 * @subpackage WP_Team_Pro/admin
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
				'title'  => __( 'Image Settings', 'wp-team-pro' ),
				'icon'   => 'fa fa-image',
				'fields' => array(
					array(
						'id'         => 'image_on_off',
						'type'       => 'switcher',
						'title'      => __( 'Photo/Image', 'wp-team-pro' ),
						'subtitle'   => __( 'Show/Hide member photo or image.', 'wp-team-pro' ),
						'text_on'    => __( 'Show', 'wp-team-pro' ),
						'text_off'   => __( 'Hide', 'wp-team-pro' ),
						'text_width' => 75,
						'default'    => true,
					),
					array(
						'id'         => 'image_size',
						'class'      => 'image_size',
						'type'       => 'select',
						'title'      => __( 'Image Sizes', 'wp-team-pro' ),
						'subtitle'   => __( 'Set member image size.', 'wp-team-pro' ),
						'options'    => 'img_sizes',
						'default'    => 'original',
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'image_size_table',
						'class'      => 'image_size_table',
						'type'       => 'select',
						'title'      => __( 'Image Sizes', 'wp-team-pro' ),
						'subtitle'   => __( 'Set member image size.', 'wp-team-pro' ),
						'options'    => 'img_sizes',
						'default'    => 'thumbnail',
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'custom_image_option',
						'class'      => 'custom_image_option',
						'type'       => 'fieldset',
						'title'      => __( 'Custom Size', 'wp-team-pro' ),
						'fields'     => array(
							array(
								'id'       => 'custom_image_width',
								'type'     => 'spinner',
								'title'    => __( 'Width*', 'wp-team-pro' ),
								'unit'     => 'px',
								'max'      => 99999,
								'validate' => 'SPF_validate_numeric',
							),
							array(
								'id'       => 'custom_image_height',
								'type'     => 'spinner',
								'title'    => __( 'Height*', 'wp-team-pro' ),
								'unit'     => 'px',
								'max'      => 99999,
								'validate' => 'SPF_validate_numeric',
							),
							array(
								'id'    => 'custom_image_crop',
								'type'  => 'switcher',
								'title' => __( 'Hard Crop', 'wp-team-pro' ),
							),
						),
						'dependency' => array( 'image_on_off|image_size', '==|==', 'true|custom' ),
					),
					array(
						'id'         => 'custom_image_option_table',
						'class'      => 'custom_image_option_table',
						'type'       => 'fieldset',
						'title'      => __( 'Custom Size', 'wp-team-pro' ),
						'fields'     => array(
							array(
								'id'       => 'custom_image_width',
								'type'     => 'spinner',
								'title'    => __( 'Width*', 'wp-team-pro' ),
								'unit'     => 'px',
								'max'      => 99999,
								'validate' => 'SPF_validate_numeric',
							),
							array(
								'id'       => 'custom_image_height',
								'type'     => 'spinner',
								'title'    => __( 'Height*', 'wp-team-pro' ),
								'unit'     => 'px',
								'max'      => 99999,
								'validate' => 'SPF_validate_numeric',
							),
							array(
								'id'    => 'custom_image_crop',
								'type'  => 'switcher',
								'title' => __( 'Hard Crop', 'wp-team-pro' ),
							),
						),
						'dependency' => array( 'image_on_off|image_size_table', '==|==', 'true|custom' ),
					),
					array(
						'id'         => 'image_shape',
						'class'      => 'image_shape',
						'type'       => 'image_select',
						'title'      => __( 'Image Shape', 'wp-team-pro' ),
						'subtitle'   => __( 'Choose an image shape for member.', 'wp-team-pro' ),
						'options'    => array(
							'sptp-square'  => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/square.png',
								'option_name' => __( 'Square', 'wp-team-pro' ),
							),
							'sptp-rounded' => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/rounded.png',
								'option_name' => __( 'Rounded', 'wp-team-pro' ),
							),
							'sptp-circle'  => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/circle.png',
								'option_name' => __( 'Circle', 'wp-team-pro' ),
							),
						),
						'default'    => 'sptp-square',
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'image_shape_thumbnail',
						'class'      => 'image_shape_thumbnail',
						'type'       => 'image_select',
						'title'      => __( 'Image Shape', 'wp-team-pro' ),
						'subtitle'   => __( 'Choose an image shape for member.', 'wp-team-pro' ),
						'options'    => array(
							'sptp-square'  => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/square.png',
								'option_name' => __( 'Square', 'wp-team-pro' ),
							),
							'sptp-rounded' => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/rounded.png',
								'option_name' => __( 'Rounded', 'wp-team-pro' ),
							),
							'sptp-circle'  => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/circle.png',
								'option_name' => __( 'Circle', 'wp-team-pro' ),
							),
						),
						'default'    => 'sptp-circle',
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'image_border',
						'type'       => 'checkbox',
						'title'      => __( 'Border', 'wp-team-pro' ),
						'subtitle'   => __( 'Check to show border around member image.', 'wp-team-pro' ),
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'border',
						'type'       => 'border',
						'title'      => __( 'Border', 'wp-team-pro' ),
						'subtitle'   => __( 'Set border.', 'wp-team-pro' ),
						'all'        => true,
						'dependency' => array( 'image_on_off|image_border', '==|==', 'true|true' ),
						'default'    => array(
							'all'         => '1',
							'style'       => 'solid',
							'color'       => '#ddd',
							'hover_color' => '#63a37b',
						),
					),
					array(
						'id'         => 'image_box_shadow',
						'type'       => 'checkbox',
						'title'      => __( 'Box-Shadow', 'wp-team-pro' ),
						'subtitle'   => __( 'Check to show box-shadow around member image.', 'wp-team-pro' ),
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'box',
						'type'       => 'box_shadow',
						'title'      => __( 'Box-shadow', 'wp-team-pro' ),
						'subtitle'   => __( 'Set box-shadow for member image.', 'wp-team-pro' ),
						'dependency' => array( 'image_on_off|image_box_shadow', '==|==', 'true|true' ),
					),
					array(
						'id'         => 'background',
						'type'       => 'color',
						'title'      => __( 'Background', 'wp-team-pro' ),
						'subtitle'   => __( 'Set background for member image.', 'wp-team-pro' ),
						'default'    => '#FFFFFF',
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'padding',
						'type'       => 'spacing',
						'title'      => __( 'Padding', 'wp-team-pro' ),
						'subtitle'   => __( 'Set image padding.', 'wp-team-pro' ),
						'units'      => array( 'px' ),
						'default'    => 0,
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'inner_padding',
						'type'       => 'spacing',
						'title'      => __( 'Inner Padding', 'wp-team-pro' ),
						'subtitle'   => __( 'Set image inner padding.', 'wp-team-pro' ),
						'units'      => array( 'px' ),
						'default'    => 0,
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'image_zoom',
						'type'       => 'select',
						'title'      => __( 'Zoom', 'wp-team-pro' ),
						'subtitle'   => __( 'Select a zoom effect for image.', 'wp-team-pro' ),
						'options'    => array(
							'none'     => __( 'None', 'wp-team-pro' ),
							'zoom_in'  => __( 'Zoom In', 'wp-team-pro' ),
							'zoom_out' => __( 'Zoom Out', 'wp-team-pro' ),
						),
						'default'    => 'none',
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
					array(
						'id'         => 'image_grayscale',
						'type'       => 'select',
						'title'      => __( 'GrayScale', 'wp-team-pro' ),
						'subtitle'   => __( 'Select a grayscale effect for the image.', 'wp-team-pro' ),
						'options'    => array(
							'none'            => __( 'None', 'wp-team-pro' ),
							'normal_on_hover' => __( 'GrayScale and Normal on Hover', 'wp-team-pro' ),
							'on_hover'        => __( 'GrayScale on Hover', 'wp-team-pro' ),
							'always'          => __( 'Always GrayScale', 'wp-team-pro' ),
						),
						'default'    => 'none',
						'dependency' => array( 'image_on_off', '==', 'true' ),
					),
				),
			)
		);
	}
}
