<?php
/**
 * Carousel tab.
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
 * This class is responsible for Carousel tab in Team page.
 *
 * @since      2.0.0
 */
class SPTP_Carousel {

	/**
	 * Carousel settings.
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_generator.
	 */
	public static function section( $prefix ) {
		SPF::createSection(
			$prefix,
			array(
				'title'  => __( 'Carousel Controls', 'wp-team-pro' ),
				'icon'   => 'fa fa-sliders',
				'fields' => array(
					array(
						'id'       => 'carousel_mode',
						'type'     => 'button_set',
						'title'    => __( 'Carousel Mode', 'wp-team-pro' ),
						'options'  => array(
							'standard' => __( 'Standard', 'wp-team-pro' ),
							'ticker'   => __( 'Ticker', 'wp-team-pro' ),
						),
						'subtitle' => __(
							'Set carousel mode. Carousel controls are disabled in the ticker mode.
						',
							'wp-team-pro'
						),
						'default'  => 'standard',
					),
					array(
						'id'         => 'carousel_autoplay',
						'type'       => 'switcher',
						'title'      => __( 'AutoPlay', 'wp-team-pro' ),
						'subtitle'   => __( 'On/Off auto play.', 'wp-team-pro' ),
						'default'    => 'true',
						'dependency' => array( 'carousel_mode', '==', 'standard' ),
					),
					array(
						'id'         => 'carousel_autoplay_speed',
						'type'       => 'spinner',
						'title'      => __( 'Autoplay Speed', 'wp-team-pro' ),
						'subtitle'   => __( 'Set autoplay speed in millisecond.', 'wp-team' ),
						'default'    => 5000,
						'unit'       => 'ms',
						'dependency' => array( 'carousel_mode|carousel_autoplay', '==|==', 'standard|true' ),
					),
					array(
						'id'       => 'carousel_speed',
						'type'     => 'spinner',
						'title'    => __( 'Carousel Speed', 'wp-team-pro' ),
						'subtitle' => __( 'Set carousel speed in millisecond.', 'wp-team' ),
						'default'  => 300,
						'unit'     => 'ms',
					),
					array(
						'id'         => 'carousel_onhover',
						'type'       => 'switcher',
						'title'      => __( 'Stop on Hover', 'wp-team-pro' ),
						'subtitle'   => __( 'On/Off carousel pause on hover.', 'wp-team-pro' ),
						'default'    => 'true',
						'dependency' => array( 'carousel_mode|carousel_autoplay', '==|==', 'standard|true' ),
					),
					array(
						'id'         => 'carousel_loop',
						'type'       => 'switcher',
						'title'      => __( 'Loop', 'wp-team-pro' ),
						'subtitle'   => __( 'On/Off infinite loop mode.', 'wp-team-pro' ),
						'default'    => 'true',
						'dependency' => array( 'carousel_mode', '==', 'standard' ),
					),
					array(
						'id'         => 'carousel_auto_height',
						'type'       => 'switcher',
						'title'      => __( 'Auto Height', 'wp-team-pro' ),
						'subtitle'   => __( 'On/Off auto height for the carousel.', 'wp-team-pro' ),
						'default'    => 'true',
						'dependency' => array( 'carousel_mode', '==', 'standard' ),
					),
					array(
						'type'       => 'subheading',
						'content'    => __( 'Navigation', 'wp-team-pro' ),
						'dependency' => array( 'carousel_mode', '!=', 'ticker' ),
					),
					array(
						'id'         => 'carousel_navigation',
						'type'       => 'switcher',
						'title'      => __( 'Navigation', 'wp-team-pro' ),
						'subtitle'   => __( 'Show/Hide carousel navigation.', 'wp-team-pro' ),
						'dependency' => array( 'carousel_mode', '==', 'standard' ),
						'text_on'    => __( 'Show', 'wp-team-pro' ),
						'text_off'   => __( 'Hide', 'wp-team-pro' ),
						'default'    => true,
						'text_width' => 75,
					),
					array(
						'id'         => 'carousel_navigation_position',
						'type'       => 'select',
						'title'      => __( 'Navigation Position', 'wp-team-pro' ),
						'options'    => array(
							'top-right'               => __( 'Top Right', 'wp-team-pro' ),
							'top-center'              => __( 'Top Center', 'wp-team-pro' ),
							'top-left'                => __( 'Top Left', 'wp-team-pro' ),
							'bottom-left'             => __( 'Bottom Left', 'wp-team-pro' ),
							'bottom-center'           => __( 'Bottom Center', 'wp-team-pro' ),
							'bottom-right'            => __( 'Bottom Right', 'wp-team-pro' ),
							'vertically-center-outer' => __( 'Vertically Center Outer', 'wp-team-pro' ),
							'vertically-center-inner' => __( 'Vertically Center Inner', 'wp-team-pro' ),
						),
						'default'    => 'top-right',
						'dependency' => array( 'carousel_navigation|carousel_mode', '==|==', 'true|standard' ),
						'subtitle'   => __( 'Select a position for the navigation arrows.', 'wp-team-pro' ),
					),
					array(
						'id'         => 'carousel_navigation_color',
						'type'       => 'color_group',
						'title'      => __( 'Navigation Color', 'wp-team-pro' ),
						'subtitle'   => __( 'Set color for the carousel navigation.', 'wp-team-pro' ),
						'options'    => array(
							'color'          => __( 'Color', 'wp-team-pro' ),
							'hover_color'    => __( 'Hover Color', 'wp-team-pro' ),
							'bg_color'       => __( 'Background', 'wp-team-pro' ),
							'bg_hover_color' => __( 'Hover Background', 'wp-team-pro' ),
						),
						'default'    => array(
							'color'          => '#aaaaaa',
							'hover_color'    => '#ffffff',
							'bg_color'       => 'transparent',
							'bg_hover_color' => '#63a37b',
						),
						'dependency' => array( 'carousel_navigation|carousel_mode', '==|==', 'true|standard' ),
					),
					array(
						'id'         => 'carousel_navigation_border',
						'type'       => 'border',
						'title'      => __( 'Navigation Border', 'wp-team-pro' ),
						'subtitle'   => __( 'Set border for the carousel navigation.', 'wp-team-pro' ),
						'all'        => true,
						'default'    => array(
							'all'         => 1,
							'style'       => 'solid',
							'color'       => '#aaaaaa',
							'hover_color' => '#63a37b',
							'unit'        => 'px',
						),
						'dependency' => array( 'carousel_navigation|carousel_mode', '==|==', 'true|standard' ),
					),
					array(
						'type'       => 'subheading',
						'content'    => __( 'Pagination', 'wp-team-pro' ),
						'dependency' => array( 'carousel_mode', '!=', 'ticker' ),
					),
					array(
						'id'         => 'carousel_pagination',
						'type'       => 'switcher',
						'title'      => __( 'Bullets', 'wp-team-pro' ),
						'subtitle'   => __( 'Show/hide pagination bullets.', 'wp-team-pro' ),
						'dependency' => array( 'carousel_mode', '==', 'standard' ),
						'text_on'    => __( 'Show', 'wp-team-pro' ),
						'text_off'   => __( 'Hide', 'wp-team-pro' ),
						'default'    => true,
						'text_width' => 75,
					),
					array(
						'id'         => 'carousel_pagination_color',
						'type'       => 'color_group',
						'title'      => __( 'Bullets Color', 'wp-team-pro' ),
						'subtitle'   => __( 'Set color for the pagination bullets.', 'wp-team-pro' ),
						'options'    => array(
							'color'        => __( 'Color', 'wp-team-pro' ),
							'active_color' => __( 'Active Color', 'wp-team-pro' ),
						),
						'default'    => array(
							'color'        => '#aaaaaa',
							'active_color' => '#63a37b',
						),
						'dependency' => array( 'carousel_pagination|carousel_mode', '==|==', 'true|standard' ),
					),
					array(
						'id'         => 'member_per_slide',
						'type'       => 'column',
						'title'      => __( 'Member(s) Per Slide', 'wp-team-pro' ),
						'default'    => array(
							'desktop' => '4',
							'laptop'  => '3',
							'tablet'  => '2',
							'mobile'  => '1',
						),
						'dependency' => array( 'layout_preset', '==', 'carousel', 'all' ),
					),
				),
			)
		);
	}
}
