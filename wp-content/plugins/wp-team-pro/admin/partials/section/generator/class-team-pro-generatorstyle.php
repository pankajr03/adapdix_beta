<?php
/**
 * Display settings tab.
 *
 * @since      2.0.0
 * @version    2.0.0
 *
 * @package    WP_Team_Pro
 * @subpackage WP_Team_Pro/admin
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
				'title'  => __( 'Display Options', 'wp-team-pro' ),
				'icon'   => 'fa fa-th-large',
				'fields' => array(

					array(
						'id'         => 'style_title',
						'type'       => 'switcher',
						'title'      => __( 'Team Section Title', 'wp-team-pro' ),
						'subtitle'   => __( 'Show/Hide team section title.', 'wp-team-pro' ),
						'text_on'    => __( 'Show', 'wp-team-pro' ),
						'text_off'   => __( 'Hide', 'wp-team-pro' ),
						'default'    => true,
						'text_width' => 75,
					),
					array(
						'id'         => 'style_title_margin_bottom',
						'type'       => 'spacing',
						'title'      => __( 'Section Title Margin Bottom', 'wp-team-pro' ),
						'subtitle'   => __( 'Set margin bottom for team section title. Default value is 25px.', 'wp-team-pro' ),
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
						'title'    => __( 'Margin Between Members', 'wp-team-pro' ),
						'subtitle' => __( 'Set space or margin between members. Default value is 24px.', 'wp-team-pro' ),
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
						'title'    => __( 'Member Content Position', 'wp-team-pro' ),
						'options'  => array(
							'top_img_bottom_content' => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/below-content.png',
								'option_name' => __( 'Below Content', 'wp-team-pro' ),
							),
							'top_content_bottom_img' => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/above-content.png',
								'option_name' => __( 'Above Content', 'wp-team-pro' ),
							),
							'left_img_right_content' => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/right-content.png',
								'option_name' => __( 'Right Content', 'wp-team-pro' ),
							),
							'left_content_right_img' => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/left-content.png',
								'option_name' => __( 'Left Content', 'wp-team-pro' ),
							),
							'content_over_image'     => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/content-over-image.png',
								'option_name' => __( 'Overlay Content', 'wp-team-pro' ),
							),
						),
						'default'  => 'top_img_bottom_content',
						'subtitle' => __( 'Select a position or layout for member content and image.', 'wp-team-pro' ),
					),
					array(
						'id'       => 'style_member_content_position_list',
						'class'    => 'member_content_position_list',
						'type'     => 'image_select',
						'title'    => __( 'Member Content Position', 'wp-team-pro' ),
						'options'  => array(
							'left_img_right_content' => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/right-content.png',
								'option_name' => __( 'Right Content', 'wp-team-pro' ),
							),
							'left_content_right_img' => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/left-content.png',
								'option_name' => __( 'Left Content', 'wp-team-pro' ),
							),
						),
						'default'  => 'left_img_right_content',
						'subtitle' => __( 'Select a position or layout for member content and image.', 'wp-team-pro' ),
					),
					array(
						'id'         => 'border_bg_around_member',
						'class'      => 'sptp-border-bg-group',
						'type'       => 'fieldset',
						'dependency' => array( 'style_member_content_position', '!=', 'content_over_image' ),
						'fields'     => array(
							array(
								'id'       => 'border_around_member',
								'class'    => 'border_around',
								'type'     => 'border',
								'title'    => __( 'Border', 'wp-team-pro' ),
								'subtitle' => __( 'Set border for the member.', 'wp-team-pro' ),
								'all'      => true,
								'default'  => array(
									'all'   => 0,
									'style' => 'none',
									'unit'  => 'px',
									'color' => 'transparent',
								),
							),
							array(
								'id'       => 'border_around_member_inline',
								'class'    => 'border_around_inline',
								'type'     => 'border',
								'title'    => __( 'Border', 'wp-team-pro' ),
								'subtitle' => __( 'Set border for the member.', 'wp-team-pro' ),
								'all'      => true,
								'default'  => array(
									'all'   => 1,
									'style' => 'solid',
									'unit'  => 'px',
									'color' => '#dddddd',
								),
							),
							array(
								'id'       => 'border_radius_around_member',
								'class'    => 'border_radius_around',
								'type'     => 'spinner',
								'title'    => __( 'Border Radius', 'wp-team-pro' ),
								'subtitle' => __( 'Set border radius for the member.', 'wp-team-pro' ),
								'default'  => 0,
								'unit'     => 'px',
							),
							array(
								'id'       => 'bg_color_around_member',
								'class'    => 'bg_color_around',
								'type'     => 'color',
								'title'    => __( 'Background Color', 'wp-team-pro' ),
								'subtitle' => __( 'Set background color for the member.', 'wp-team-pro' ),
								'default'  => 'transparent',
							),
						),
					),
					array(
						'id'         => 'member_content_padding',
						'class'      => 'member_content_padding',
						'type'       => 'spacing',
						'title'      => __( 'Member Content Padding', 'wp-team-pro' ),
						'subtitle'   => __( 'Set member content padding.', 'wp-team-pro' ),
						'default'    => array(
							'top'    => '0',
							'right'  => '0',
							'bottom' => '0',
							'left'   => '0',
							'unit'   => 'px',
						),
						'units'      => array( 'px' ),
						'dependency' => array( 'layout_preset', '==', 'list', 'all' ),
					),
					array(
						'id'         => 'overlay_on_image',
						'type'       => 'checkbox',
						'title'      => __( 'Overlay inside Image', 'wp-team-pro' ),
						'subtitle'   => __( 'Check to make overlay only on image. Defaultly, overlay show on full area.', 'wp-team-pro' ),
						'default'    => false,
						'dependency' => array( 'style_member_content_position', '==', 'content_over_image' ),
					),
					array(
						'id'         => 'overlay_bg_color',
						'type'       => 'color',
						'title'      => __( 'Overlay Background Color', 'wp-team-pro' ),
						'subtitle'   => __( 'Set overlay background color.', 'wp-team-pro' ),
						'default'    => 'rgba(0, 0, 0, 0.40)',
						'dependency' => array( 'style_member_content_position', '==', 'content_over_image' ),
					),
					array(
						'id'         => 'overlay_content_type',
						'type'       => 'button_set',
						'title'      => __( 'Overlay Content Type', 'wp-team-pro' ),
						'subtitle'   => __( 'Choose overlay content type.', 'wp-team-pro' ),
						'multiple'   => false,
						'options'    => array(
							'covered' => __( 'Fully Covered', 'wp-team-pro' ),
							'lower'   => __( 'Caption Style', 'wp-team-pro' ),
						),
						'default'    => array( 'covered' ),
						'dependency' => array( 'style_member_content_position', '==', 'content_over_image' ),
					),
					array(
						'id'         => 'overlay_content_position',
						'type'       => 'button_set',
						'title'      => __( 'Overlay Content Position', 'wp-team-pro' ),
						'subtitle'   => __( 'Choose overlay content position.', 'wp-team-pro' ),
						'multiple'   => false,
						'options'    => array(
							'top'    => __( 'Top', 'wp-team-pro' ),
							'middle' => __( 'Middle', 'wp-team-pro' ),
							'bottom' => __( 'Bottom', 'wp-team-pro' ),
						),
						'default'    => array( 'middle' ),
						'dependency' => array( 'style_member_content_position|overlay_content_type', '==|==', 'content_over_image|lower' ),
					),
					array(
						'id'         => 'overlay_content_visibility',
						'type'       => 'button_set',
						'title'      => __( 'Overlay Content Visibility', 'wp-team-pro' ),
						'subtitle'   => __( 'Choose overlay content visibility.', 'wp-team-pro' ),
						'multiple'   => false,
						'options'    => array(
							'always' => __( 'Always', 'wp-team-pro' ),
							'hover'  => __( 'On Hover', 'wp-team-pro' ),
						),
						'default'    => array( 'always' ),
						'dependency' => array( 'style_member_content_position', '==', 'content_over_image' ),
					),
					array(
						'id'         => 'overlay_clickable',
						'type'       => 'checkbox',
						'title'      => __( 'Make the Overlay Clickable', 'wp-team-pro' ),
						'subtitle'   => __( 'Check to make the overlay clickable.', 'wp-team-pro' ),
						'default'    => true,
						'dependency' => array( 'style_member_content_position', '==', 'content_over_image' ),
					),
					array(
						'id'         => 'disable_overlay_small_screen',
						'type'       => 'checkbox',
						'title'      => __( 'Disable Overlay on Small Screens', 'wp-team-pro' ),
						'subtitle'   => __( 'Check to disable overlay on small screens (less than 480 pixels)', 'wp-team-pro' ),
						'default'    => true,
						'dependency' => array( 'style_member_content_position', '==', 'content_over_image' ),
					),
					array(
						'id'         => 'image_animation',
						'type'       => 'select',
						'title'      => __( 'Animation', 'wp-team-pro' ),
						'options'    => array(
							'fadeIn'       => __( 'fadeIn', 'wp-team-pro' ),
							'fadeInUp'     => __( 'fadeInUp', 'wp-team-pro' ),
							'fadeInDown'   => __( 'fadeInDown', 'wp-team-pro' ),
							'fadeInLeft'   => __( 'fadeInLeft', 'wp-team-pro' ),
							'fadeInRight'  => __( 'fadeInRight', 'wp-team-pro' ),
							'flip'         => __( 'flip', 'wp-team-pro' ),
							'flipInX'      => __( 'flipInX', 'wp-team-pro' ),
							'flipInY'      => __( 'flipInY', 'wp-team-pro' ),
							'rotateIn'     => __( 'rotateIn', 'wp-team-pro' ),
							'rotateOut'    => __( 'rotateOut', 'wp-team-pro' ),
							'slideInUp'    => __( 'slideInUp', 'wp-team-pro' ),
							'slideInDown'  => __( 'slideInDown', 'wp-team-pro' ),
							'slideInLeft'  => __( 'slideInLeft', 'wp-team-pro' ),
							'slideInRight' => __( 'slideInRight', 'wp-team-pro' ),
							'ZoomIn'       => __( 'ZoomIn', 'wp-team-pro' ),
							'bounceIn'     => __( 'bounceIn', 'wp-team-pro' ),
						),
						'default'    => 'fadeIn',
						'dependency' => array( 'style_member_content_position|overlay_content_visibility', '==|==', 'content_over_image|hover' ),
					),
					array(
						'id'      => 'mosaic_bg_color',
						'class'   => 'mosaic_bg_color',
						'type'    => 'color',
						'title'   => __( 'Mosaic Background Color', 'wp-team-pro' ),
						'default' => '#63a37b',
					),
					array(
						'id'         => 'icon_switch',
						'type'       => 'switcher',
						'title'      => __( 'Meta Icon', 'wp-team-pro' ),
						'subtitle'   => __( 'Show/Hide small icon meta fields. e.g. email, mobile, location icon.', 'wp-team-pro' ),
						'text_on'    => __( 'Show', 'wp-team-pro' ),
						'text_off'   => __( 'Hide', 'wp-team-pro' ),
						'text_width' => 75,
						'default'    => true,
					),
					array(
						'id'       => 'style_members',
						'type'     => 'sortable',
						'title'    => __( 'Member Detail Fields (Sortable)', 'wp-team-pro' ),
						'subtitle' => __( 'Show/Hide member meta fields. These fields are also sortable.', 'wp-team-pro' ),
						'class'    => 'style_generator_sortable',
						'default'  => array(
							'image_switch'        => true,
							'name_switch'         => true,
							'job_position_switch' => true,
							'bio_switch'          => true,
							'bio_switch_mosaic'   => false,
							'email_switch'        => false,
							'mobile_switch'       => false,
							'phone_switch'        => false,
							'location_switch'     => false,
							'website_switch'      => false,
							'skill_switch'        => false,
							'social_switch'       => true,
						),
						'fields'   => array(
							array(
								'id'         => 'image_switch',
								'type'       => 'switcher',
								'title'      => __( 'Photo/Image', 'wp-team-pro' ),
								'text_on'    => __( 'Show', 'wp-team-pro' ),
								'text_off'   => __( 'Hide', 'wp-team-pro' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'name_switch',
								'type'       => 'switcher',
								'title'      => __( 'Member Name', 'wp-team-pro' ),
								'text_on'    => __( 'Show', 'wp-team-pro' ),
								'text_off'   => __( 'Hide', 'wp-team-pro' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'job_position_switch',
								'type'       => 'switcher',
								'title'      => __( 'Position/Job Title', 'wp-team-pro' ),
								'text_on'    => __( 'Show', 'wp-team-pro' ),
								'text_off'   => __( 'Hide', 'wp-team-pro' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'bio_switch',
								'class'      => 'bio_switch',
								'type'       => 'switcher',
								'title'      => __( 'Short Bio', 'wp-team-pro' ),
								'text_on'    => __( 'Show', 'wp-team-pro' ),
								'text_off'   => __( 'Hide', 'wp-team-pro' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'bio_switch_mosaic',
								'class'      => 'bio_switch_mosaic',
								'type'       => 'switcher',
								'title'      => __( 'Short Bio', 'wp-team-pro' ),
								'text_on'    => __( 'Show', 'wp-team-pro' ),
								'text_off'   => __( 'Hide', 'wp-team-pro' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'email_switch',
								'type'       => 'switcher',
								'title'      => __( 'Email', 'wp-team-pro' ),
								'text_on'    => __( 'Show', 'wp-team-pro' ),
								'text_off'   => __( 'Hide', 'wp-team-pro' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'mobile_switch',
								'type'       => 'switcher',
								'title'      => __( 'Mobile (personal)', 'wp-team-pro' ),
								'text_on'    => __( 'Show', 'wp-team-pro' ),
								'text_off'   => __( 'Hide', 'wp-team-pro' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'phone_switch',
								'type'       => 'switcher',
								'title'      => __( 'Phone (business)', 'wp-team-pro' ),
								'text_on'    => __( 'Show', 'wp-team-pro' ),
								'text_off'   => __( 'Hide', 'wp-team-pro' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'location_switch',
								'type'       => 'switcher',
								'title'      => __( 'Location', 'wp-team-pro' ),
								'text_on'    => __( 'Show', 'wp-team-pro' ),
								'text_off'   => __( 'Hide', 'wp-team-pro' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'website_switch',
								'type'       => 'switcher',
								'title'      => __( 'Website', 'wp-team-pro' ),
								'text_on'    => __( 'Show', 'wp-team-pro' ),
								'text_off'   => __( 'Hide', 'wp-team-pro' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'skill_switch',
								'type'       => 'switcher',
								'title'      => __( 'Skill Bars', 'wp-team-pro' ),
								'text_on'    => __( 'Show', 'wp-team-pro' ),
								'text_off'   => __( 'Hide', 'wp-team-pro' ),
								'text_width' => 75,
							),
							array(
								'id'         => 'social_switch',
								'type'       => 'switcher',
								'title'      => __( 'Social Profiles', 'wp-team-pro' ),
								'text_on'    => __( 'Show', 'wp-team-pro' ),
								'text_off'   => __( 'Hide', 'wp-team-pro' ),
								'text_width' => 75,
							),
						),
					),
					array(
						'id'         => 'icon_over_img',
						'class'      => 'icon_over_img',
						'type'       => 'checkbox',
						'title'      => __( 'Overlay Icon', 'wp-team-pro' ),
						'subtitle'   => __( 'Check to place a hover icon on member image.', 'wp-team-pro' ),
						'default'    => true,
						'dependency' => array( 'style_member_content_position|image_switch', '!=|==', 'content_over_image|true' ),
					),
					array(
						'id'         => 'icon_over_img_type',
						'class'      => 'icon_over_img_type',
						'type'       => 'button_set',
						'title'      => __( 'Overlay Icon Style', 'wp-team-pro' ),
						'subtitle'   => __( 'Choose a icon on hover image.', 'wp-team-pro' ),
						'multiple'   => false,
						'options'    => array(
							'plus'   => '<i class="fa fa-plus"></i>',
							'search' => '<i class="fa fa-search"></i>',
							'zoom'   => '<i class="fa fa-search-plus"></i>',
							'eye'    => '<i class="fa fa-eye"></i>',
							'info'   => '<i class="fa fa-info"></i>',
							'angle'  => '<i class="fa fa-angle-right"></i>',
						),
						'default'    => array( 'plus' ),
						'dependency' => array( 'style_member_content_position|icon_over_img|image_switch', '!=|==|==', 'content_over_image|true|true' ),
					),
					array(
						'id'         => 'icon_over_img_color',
						'class'      => 'icon_over_img_color',
						'type'       => 'color_group',
						'title'      => __( 'Icon Color', 'wp-team-pro' ),
						'subtitle'   => __( 'Set icon color and hover color.', 'wp-team-pro' ),
						'options'    => array(
							'color'      => __( 'Color', 'wp-team-pro' ),
							'hove_color' => __( 'Hover Color', 'wp-team-pro' ),
						),
						'default'    => array(
							'color'       => '#FFFFFF',
							'hover_color' => 'rgba(255,255,255,0.5)',
						),
						'dependency' => array( 'style_member_content_position|icon_over_img|image_switch', '!=|==|==', 'content_over_image|true|true' ),
					),
					array(
						'id'         => 'icon_over_img_bg_color',
						'class'      => 'icon_over_img_bg_color',
						'type'       => 'color',
						'title'      => __( 'Icon Overlay Color', 'wp-team-pro' ),
						'subtitle'   => __( 'Set icon over image background color.', 'wp-team-pro' ),
						'default'    => 'rgba(17, 17, 17, 0.1)',
						'dependency' => array( 'style_member_content_position|icon_over_img|image_switch', '!=|==|==', 'content_over_image|true|true' ),
					),
					array(
						'id'         => 'style_description_character_limit',
						'type'       => 'spinner',
						'title'      => __( 'Member Short Bio Limit', 'wp-team-pro' ),
						'subtitle'   => __( 'Member short bio is fine in 100 characters or less.', 'wp-team-pro' ),
						'default'    => 100,
						'max'        => 200,
						'dependency' => array( 'bio_switch', '==', true ),
					),
					array(
						'id'     => 'skill_settings',
						'type'   => 'fieldset',
						'title'  => __( 'Skill Bars Settings', 'wp-team-pro' ),
						'fields' => array(
							array(
								'id'      => 'progressbar_color_group',
								'type'    => 'color_group',
								'title'   => __( 'Progress Bar Color', 'wp-team-pro' ),
								'options' => array(
									'progress_color'    => __( 'Progress Bar', 'wp-team-pro' ),
									'progress_bg_color' => __( 'Background', 'wp-team-pro' ),
								),
								'default' => array(
									'progress_color'    => '#63a37b',
									'progress_bg_color' => '#c9dfd1',
								),
							),
							array(
								'id'      => 'tooltip_color_group',
								'class'   => 'tooltip_color_group',
								'type'    => 'color_group',
								'title'   => __( 'Toltip Color', 'wp-team-pro' ),
								'options' => array(
									'progress_tooltip_color'    => __( 'Percentage', 'wp-team-pro' ),
									'progress_tooltip_bg_color' => __( 'Tooltip Background', 'wp-team-pro' ),
								),
								'default' => array(
									'progress_tooltip_color'    => '#ffffff',
									'progress_tooltip_bg_color' => '#63a37b',
								),
							),
						),
					), // End of the Skill Settings Fieldset.
					array(
						'id'     => 'social_settings',
						'type'   => 'fieldset',
						'title'  => __( 'Social Settings', 'wp-team-pro' ),
						'fields' => array(
							array(
								'id'      => 'social_position',
								'class'   => 'social_position',
								'type'    => 'button_set',
								'title'   => __( 'Position', 'wp-team-pro' ),
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
								'title' => __( 'Margin', 'wp-team-pro' ),
								'units' => array( 'px' ),
							),
							array(
								'id'      => 'social_icon_shape',
								'class'   => 'social_icon_shape',
								'type'    => 'image_select',
								'title'   => __( 'Social Icon Shape', 'wp-team-pro' ),
								'options' => array(
									'rounded'   => array(
										'image'       => SPTP_PLUGIN_ROOT . 'admin/img/round-icon.png',
										'option_name' => __( 'Rounded', 'wp-team-pro' ),
									),
									'circle'    => array(
										'image'       => SPTP_PLUGIN_ROOT . 'admin/img/circle-icon.png',
										'option_name' => __( 'Circle', 'wp-team-pro' ),
									),
									'square'    => array(
										'image'       => SPTP_PLUGIN_ROOT . 'admin/img/square-icon.png',
										'option_name' => __( 'Square', 'wp-team-pro' ),
									),
									'icon_only' => array(
										'image'       => SPTP_PLUGIN_ROOT . 'admin/img/only-icon.png',
										'option_name' => __( 'Icon only', 'wp-team-pro' ),
									),
								),
								'default' => 'circle',
							),
							array(
								'id'      => 'social_icon_custom_color',
								'type'    => 'checkbox',
								'title'   => __( 'Custom Color', 'wp-team-pro' ),
								'default' => false,
							),
							array(
								'id'         => 'icon_color_group',
								'type'       => 'color_group',
								'title'      => __( 'Icon Color', 'wp-team-pro' ),
								'options'    => array(
									'icon_color'       => __( 'Icon', 'wp-team-pro' ),
									'icon_hover_color' => __( 'Icon Hover', 'wp-team-pro' ),
								),
								'default'    => array(
									'icon_color'       => '#ffffff',
									'icon_hover_color' => '#ffffff',
								),
								'dependency' => array( 'social_icon_custom_color', '==', 'true' ),
							),
							array(
								'id'         => 'icon_bg_color_group',
								'type'       => 'color_group',
								'title'      => __( 'Background Color', 'wp-team-pro' ),
								'options'    => array(
									'icon_bg'       => __( 'Background', 'wp-team-pro' ),
									'icon_bg_hover' => __( 'Background Hover', 'wp-team-pro' ),
								),
								'default'    => array(
									'icon_bg'       => '#63a37b',
									'icon_bg_hover' => 'rgba(99, 163, 123, .95)',
								),
								'dependency' => array( 'social_icon_custom_color|social_icon_shape', '==|!=', 'true|icon_only' ),
							),
							array(
								'id'          => 'icon_border',
								'type'        => 'border',
								'title'       => __( 'Icon Border', 'wp-team-pro' ),
								'all'         => true,
								'hover_color' => true,
								'dependency'  => array( 'social_icon_custom_color', '==', 'true' ),
							),
						),
					), // End of the Social Settings Fieldset.

					array(
						'id'     => 'pagination_fields',
						'type'   => 'fieldset',
						'class'  => 'sptp-pagination-group',
						'fields' => array(
							array(
								'id'       => 'pagination_universal',
								'type'     => 'switcher',
								'title'    => __( 'Pagination', 'wp-team-pro' ),
								'subtitle' => __( 'On/Off pagination', 'wp-team-pro' ),
								'default'  => true,
								'class'    => 'sptp-pagination',
							),
							array(
								'id'         => 'universal_pagination_type',
								'type'       => 'radio',
								'title'      => __( 'Pagination Type', 'wp-team-pro' ),
								'subtitle'   => __( 'Choose a pagination type.', 'wp-team-pro' ),
								'options'    => array(
									'pagination_number' => __( 'Ajax Number Pagination', 'wp-team-pro' ),
									'pagination_btn'    => __( 'Load More Button (Ajax)', 'wp-team-pro' ),
									'pagination_scrl'   => __( 'Load More on Scroll (Ajax)', 'wp-team-pro' ),
									'pagination_normal' => __( 'No Ajax (Normal Pagination)', 'wp-team-pro' ),
								),
								'default'    => 'pagination_number',
								'dependency' => array( 'pagination_universal', '==', 'true' ),
							),
							array(
								'id'         => 'pagination_show_per_page',
								'type'       => 'spinner',
								'title'      => __( 'Number of Member(s) to Show Per Page', 'wp-team-pro' ),
								'subtitle'   => __( 'Set number of member(s) to show in per page.', 'wp-team-pro' ),
								'default'    => 12,
								'dependency' => array( 'pagination_universal|universal_pagination_type', '==|any', 'true|pagination_number,pagination_normal,pagination_scrl' ),
							),
							array(
								'id'         => 'pagination_per_click',
								'type'       => 'spinner',
								'title'      => __( 'Number of Member(s) to Show Per Click', 'wp-team-pro' ),
								'subtitle'   => __( 'Set number of member(s) to show in per click.', 'wp-team-pro' ),
								'default'    => 12,
								'dependency' => array( 'pagination_universal|universal_pagination_type', '==|==', 'true|pagination_btn' ),
							),
							array(
								'id'         => 'load_more_label',
								'type'       => 'text',
								'title'      => __( 'Load more button label', 'wp-team-pro' ),
								'default'    => __( 'Load More', 'wp-team-pro' ),
								'dependency' => array( 'pagination_universal|universal_pagination_type', '==|==', 'true|pagination_btn' ),
							),
							array(
								'id'         => 'scroll_load_more_label',
								'type'       => 'text',
								'title'      => __( 'Scroll Load more button label', 'wp-team-pro' ),
								'default'    => __( 'Scroll to Load More', 'wp-team-pro' ),
								'dependency' => array( 'pagination_universal|universal_pagination_type', '==|==', 'true|pagination_scrl' ),
							),
							array(
								'id'         => 'pagination_color',
								'class'      => 'pagination_color',
								'type'       => 'color_group',
								'title'      => __( 'Pagination Color', 'wp-team-pro' ),
								'subtitle'   => __( 'Set pagination color.', 'wp-team-pro' ),
								'options'    => array(
									'color'        => __( 'Color', 'wp-team-pro' ),
									'hover_color'  => __( 'Hover Color', 'wp-team-pro' ),
									'bg'           => __( 'Background', 'wp-team-pro' ),
									'hover_bg'     => __( 'Hover Background', 'wp-team-pro' ),
									'border'       => __( 'Border', 'wp-team-pro' ),
									'hover_border' => __( 'Hover Border', 'wp-team-pro' ),
								),
								'default'    => array(
									'color'        => '#5e5e5e',
									'hover_color'  => '#ffffff',
									'bg'           => '#ffffff',
									'hover_bg'     => '#63a37b',
									'border'       => '#dddddd',
									'hover_border' => '#63a37b',
								),
								'dependency' => array( 'pagination_universal', '==', 'true' ),
							),
						),
					), // End of the Pagination Settings Fieldset.
				),
			)
		);
	}
}
