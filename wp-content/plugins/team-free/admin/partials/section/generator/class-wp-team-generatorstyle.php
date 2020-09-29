<?php
/**
 * Display settings tab.
 *
 * @since      2.0.0
 * @version    2.0.0
 *
 * @package    WP_Team
 * @subpackage WP_Team/admin
 * @author     ShapedPlugin<support@shapedplugin.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * This class is responsible for Style tab in Team page.
 *
 * @since      2.0.0
 */
class SPTP_GeneratorStyle {

	/**
	 * Member Display Settings.
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_generator.
	 */
	public static function section( $prefix ) {
		SPF::createSection(
			$prefix,
			array(
				'title'  => __( 'Display Options', 'wp-team' ),
				'icon'   => 'fa fa-th-large',
				'fields' => array(

					array(
						'id'         => 'style_title',
						'type'       => 'switcher',
						'title'      => __( 'Team Section Title', 'wp-team' ),
						'subtitle'   => __( 'Show/Hide team section title.', 'wp-team' ),
						'text_on'    => __( 'Show', 'wp-team' ),
						'text_off'   => __( 'Hide', 'wp-team' ),
						'default'    => true,
						'text_width' => 75,
					),
					array(
						'id'         => 'style_title_margin_bottom',
						'type'       => 'spacing',
						'title'      => __( 'Section Title Margin Bottom', 'wp-team' ),
						'subtitle'   => __( 'Set margin bottom for team section title. Default value is 25px.', 'wp-team' ),
						'default'    => array(
							'top'    => '0',
							'right'  => '0',
							'bottom' => '25',
							'left'   => '0',
							'unit'   => 'px',
						),
						'top'        => false,
						'right'      => false,
						'left'       => false,
						'units'      => array( 'px' ),
						'dependency' => array( 'style_title', '==', 'true' ),
					),
					array(
						'id'       => 'style_margin_between_member',
						'class'    => 'style_margin_between_member',
						'type'     => 'spacing',
						'title'    => __( 'Margin Between Members', 'wp-team' ),
						'subtitle' => __( 'Set space or margin between members. Default value is 24px.', 'wp-team' ),
						'all'      => true,
						'units'    => array( 'px' ),
						'all_text' => '<i class="fa fa-arrows-h"></i>',
						'default'  => array(
							'all' => 24,
						),
					),
					array(
						'id'       => 'style_member_content_position',
						'class'    => 'member_content_position',
						'type'     => 'image_select',
						'title'    => __( 'Member Content Position', 'wp-team' ),
						'options'  => array(
							'top_img_bottom_content' => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/below-content.png',
								'option_name' => __( 'Below Content', 'wp-team' ),
								'class'       => 'free-feature',
							),
							'top_content_bottom_img' => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/above-content.png',
								'option_name' => __( 'Above Content', 'wp-team' ),
								'class'       => 'pro-feature',
							),
							'left_img_right_content' => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/right-content.png',
								'option_name' => __( 'Right Content', 'wp-team' ),
								'class'       => 'pro-feature',
							),
							'left_content_right_img' => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/left-content.png',
								'option_name' => __( 'Left Content', 'wp-team' ),
								'class'       => 'pro-feature',
							),
							'content_over_image'     => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/content-over-image.png',
								'option_name' => __( 'Overlay content', 'wp-team' ),
								'class'       => 'pro-feature',
							),
						),
						'default'  => 'top_img_bottom_content',
						'subtitle' => __( 'Select a position or layout for member content and image.', 'wp-team' ),
					),
					array(
						'id'       => 'style_member_content_position_list',
						'class'    => 'member_content_position_list',
						'type'     => 'image_select',
						'title'    => __( 'Member Content Position', 'wp-team' ),
						'options'  => array(
							'left_img_right_content' => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/right-content.png',
								'option_name' => __( 'Right Content', 'wp-team' ),
								'class'       => 'free-feature',
							),
							'left_content_right_img' => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/left-content.png',
								'option_name' => __( 'Left Content', 'wp-team' ),
								'class'       => 'pro-feature',
							),
						),
						'default'  => 'left_img_right_content',
						'subtitle' => __( 'Select a position or layout for member content and image.', 'wp-team' ),
					),
					array(
						'id'     => 'border_bg_around_member',
						'type'   => 'fieldset',
						'class'  => 'sptp-border-bg-group',
						'fields' => array(
							array(
								'id'       => 'border_around_member',
								'class'    => 'border_around',
								'type'     => 'border',
								'title'    => __( 'Border', 'wp-team' ),
								'subtitle' => __( 'Set border for the member.', 'wp-team' ),
								'all'      => true,
								'default'  => array(
									'all'         => 0,
									'style'       => 'none',
									'unit'        => 'px',
									'color'       => '#ddd',
									'hover_color' => '#444',
								),
							),
							array(
								'id'       => 'border_radius_around_member',
								'class'    => 'border_radius_around',
								'type'     => 'spinner',
								'title'    => __( 'Border Radius', 'wp-team' ),
								'subtitle' => __( 'Set border radius for the member.', 'wp-team' ),
								'default'  => 0,
								'unit'     => 'px',
							),
							array(
								'id'       => 'bg_color_around_member',
								'class'    => 'bg_color_around',
								'type'     => 'color',
								'title'    => __( 'Background Color', 'wp-team' ),
								'subtitle' => __( 'Set background color for the member.', 'wp-team' ),
								'default'  => 'transparent',
							),
						),
					),
					array(
						'id'       => 'style_members',
						'class'    => 'style_generator_list',
						'type'     => 'fieldset',
						'title'    => __( 'Member Detail Fields', 'wp-team' ),
						'subtitle' => __( 'Show/Hide member meta fields.', 'wp-team' ),
						'default'  => array(
							'image_switch'        => true,
							'name_switch'         => true,
							'job_position_switch' => true,
							'bio_switch'          => true,
							'social_switch'       => true,
						),
						'fields'   => array(
							array(
								'id'         => 'image_switch',
								'type'       => 'switcher',
								'title'      => __( 'Photo/Image', 'wp-team' ),
								'text_on'    => __( 'Show', 'wp-team' ),
								'text_off'   => __( 'Hide', 'wp-team' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'name_switch',
								'type'       => 'switcher',
								'title'      => __( 'Member Name', 'wp-team' ),
								'text_on'    => __( 'Show', 'wp-team' ),
								'text_off'   => __( 'Hide', 'wp-team' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'job_position_switch',
								'type'       => 'switcher',
								'title'      => __( 'Position/Job Title', 'wp-team' ),
								'text_on'    => __( 'Show', 'wp-team' ),
								'text_off'   => __( 'Hide', 'wp-team' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'bio_switch',
								'class'      => 'bio_switch',
								'type'       => 'switcher',
								'title'      => __( 'Short Bio', 'wp-team' ),
								'text_on'    => __( 'Show', 'wp-team' ),
								'text_off'   => __( 'Hide', 'wp-team' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'social_switch',
								'type'       => 'switcher',
								'title'      => __( 'Social Profiles', 'wp-team' ),
								'text_on'    => __( 'Show', 'wp-team' ),
								'text_off'   => __( 'Hide', 'wp-team' ),
								'text_width' => 75,
							),
						),
					),
					array(
						'id'     => 'social_settings',
						'type'   => 'fieldset',
						'title'  => __( 'Social Settings', 'wp-team' ),
						'fields' => array(
							array(
								'id'      => 'social_position',
								'class'   => 'social_position',
								'type'    => 'button_set',
								'title'   => __( 'Position', 'wp-team' ),
								'options' => array(
									'left'   => '<i class="fa fa-align-left" title="Left"></i>',
									'center' => '<i class="fa fa-align-center" title="Center"></i>',
									'right'  => '<i class="fa fa-align-right" title="Right"></i>',
								),
								'default' => 'center',
							),
							array(
								'id'    => 'social_margin',
								'type'  => 'spacing',
								'title' => __( 'Margin', 'wp-team' ),
								'units' => array( 'px' ),
							),
							array(
								'id'      => 'social_icon_shape',
								'class'   => 'social_icon_shape',
								'type'    => 'image_select',
								'title'   => __( 'Social Icon Shape', 'wp-team' ),
								'options' => array(
									'rounded' => array(
										'image'       => SPT_PLUGIN_ROOT . 'admin/img/round-icon.png',
										'option_name' => __( 'Rounded', 'wp-team' ),
										'class'       => 'free-feature',
									),
									'circle'  => array(
										'image'       => SPT_PLUGIN_ROOT . 'admin/img/circle-icon.png',
										'option_name' => __( 'Circle', 'wp-team' ),
										'class'       => 'free-feature',
									),
								),
								'default' => 'rounded',
							),
						),
					),
				),
			)
		);
	}
}
