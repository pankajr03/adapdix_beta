<?php
/**
 * Carousel tab.
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
				'title'  => __( 'Carousel Controls', 'wp-team' ),
				'icon'   => 'fa fa-sliders',
				'fields' => array(
					array(
						'id'       => 'carousel_mode',
						'class'    => 'hidden',
						'type'     => 'button_set',
						'title'    => __( 'Carousel Mode', 'wp-team' ),
						'options'  => array(
							'standard' => __( 'Standard', 'wp-team' ),
							'ticker'   => __( 'Ticker', 'wp-team' ),
						),
						'subtitle' => __(
							'Set carousel mode. Carousel controls are disabled in the ticker mode.
						',
							'wp-team'
						),
						'default'  => 'standard',
					),
					array(
						'id'         => 'carousel_autoplay',
						'type'       => 'switcher',
						'title'      => __( 'AutoPlay', 'wp-team' ),
						'subtitle'   => __( 'On/Off auto play.', 'wp-team' ),
						'default'    => 'true',
						'dependency' => array( 'carousel_mode', '==', 'standard' ),
					),
					array(
						'id'         => 'carousel_autoplay_speed',
						'type'       => 'spinner',
						'title'      => __( 'AutoPlay Speed', 'wp-team' ),
						'subtitle'   => __( 'Set autoplay speed in milliseconds.', 'wp-team' ),
						'default'    => 5000,
						'unit'       => 'ms',
						'dependency' => array( 'carousel_mode|carousel_autoplay', '==|==', 'standard|true' ),
					),
					array(
						'id'       => 'carousel_speed',
						'type'     => 'spinner',
						'title'    => __( 'Carousel Speed', 'wp-team' ),
						'subtitle' => __( 'Set carousel speed in milliseconds.', 'wp-team' ),
						'default'  => 300,
						'unit'     => 'ms',
					),
					array(
						'id'         => 'carousel_onhover',
						'type'       => 'switcher',
						'title'      => __( 'Stop on Hover', 'wp-team' ),
						'subtitle'   => __( 'On/Off carousel pause on hover.', 'wp-team' ),
						'default'    => 'true',
						'dependency' => array( 'carousel_mode|carousel_autoplay', '==|==', 'standard|true' ),
					),
					array(
						'id'         => 'carousel_loop',
						'type'       => 'switcher',
						'title'      => __( 'Loop', 'wp-team' ),
						'subtitle'   => __( 'On/Off infinite loop mode.', 'wp-team' ),
						'default'    => 'true',
						'dependency' => array( 'carousel_mode', '==', 'standard' ),
					),
					array(
						'id'         => 'carousel_auto_height',
						'type'       => 'switcher',
						'title'      => __( 'Auto Height', 'wp-team' ),
						'subtitle'   => __( 'On/Off auto height for the carousel.', 'wp-team' ),
						'default'    => 'true',
						'dependency' => array( 'carousel_mode', '==', 'standard' ),
					),
					array(
						'type'    => 'subheading',
						'content' => __( 'Navigation', 'wp-team' ),
					),
					array(
						'id'         => 'carousel_navigation',
						'type'       => 'switcher',
						'title'      => __( 'Navigation', 'wp-team' ),
						'subtitle'   => __( 'Show/Hide carousel navigation.', 'wp-team' ),
						'dependency' => array( 'carousel_mode', '==', 'standard' ),
						'text_on'    => __( 'Show', 'wp-team' ),
						'text_off'   => __( 'Hide', 'wp-team' ),
						'default'    => true,
						'text_width' => 75,
					),
					array(
						'id'         => 'carousel_navigation_color',
						'type'       => 'color_group',
						'title'      => __( 'Navigation Color', 'wp-team' ),
						'subtitle'   => __( 'Set color for the carousel navigation.', 'wp-team' ),
						'options'    => array(
							'color'          => __( 'Color', 'wp-team' ),
							'hover_color'    => __( 'Hover Color', 'wp-team' ),
							'bg_color'       => __( 'Background', 'wp-team' ),
							'bg_hover_color' => __( 'Hover Background', 'wp-team' ),
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
						'title'      => __( 'Navigation Border', 'wp-team' ),
						'subtitle'   => __( 'Set border for the carousel navigation.', 'wp-team' ),
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
						'type'    => 'subheading',
						'content' => __( 'Pagination', 'wp-team' ),
					),
					array(
						'id'         => 'carousel_pagination',
						'type'       => 'switcher',
						'title'      => __( 'Bullets', 'wp-team' ),
						'subtitle'   => __( 'Show/Hide pagination bullets or dots.', 'wp-team' ),
						'dependency' => array( 'carousel_mode', '==', 'standard' ),
						'text_on'    => __( 'Show', 'wp-team' ),
						'text_off'   => __( 'Hide', 'wp-team' ),
						'default'    => true,
						'text_width' => 75,
					),
					array(
						'id'         => 'carousel_pagination_color',
						'type'       => 'color_group',
						'title'      => __( 'Bullets Color', 'wp-team' ),
						'subtitle'   => __( 'Set color for the pagination bullets.', 'wp-team' ),
						'options'    => array(
							'color'        => __( 'Color', 'wp-team' ),
							'active_color' => __( 'Active Color', 'wp-team' ),
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
						'title'      => __( 'Member(s) Per Slide', 'wp-team' ),
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
