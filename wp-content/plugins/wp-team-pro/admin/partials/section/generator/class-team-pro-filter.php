<?php
/**
 * Filter tab.
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
 * This class is responsible for Filter tab in Team page.
 *
 * @since      2.0.0
 */
class SPTP_Filter {

	/**
	 * Filter settings.
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_generator.
	 */
	public static function section( $prefix ) {
		SPF::createSection(
			$prefix,
			array(
				'title'  => __( 'Filter Settings', 'wp-team-pro' ),
				'icon'   => 'fa fa-filter',
				'fields' => array(
					array(
						'id'       => 'filter_type',
						'type'     => 'button_set',
						'title'    => __( 'Filter Type', 'wp-team-pro' ),
						'subtitle' => __( 'Choose a filter type.', 'wp-team-pro' ),
						'options'  => array(
							'filter_button'   => __( 'Button', 'wp-team-pro' ),
							'filter_dropdown' => __( 'Drop Down', 'wp-team-pro' ),
						),
						'default'  => 'filter_button',
					),
					array(
						'id'         => 'filter_dropdown_align',
						'class'      => 'filter_align',
						'type'       => 'button_set',
						'title'      => __( 'Filter Dropdown Alignment', 'wp-team-pro' ),
						'subtitle'   => __( 'Choose a filter dropdown alignment.', 'wp-team-pro' ),
						'options'    => array(
							'left'  => '<i class="fa fa-align-left" title="Left"></i>',
							'right' => '<i class="fa fa-align-right" title="Right"></i>',
						),
						'default'    => 'right',
						'dependency' => array( 'filter_type', '==', 'filter_dropdown' ),
					),
					array(
						'id'       => 'filter_by',
						'type'     => 'button_set',
						'title'    => __( 'Filter By', 'wp-team-pro' ),
						'subtitle' => __( 'Choose a filter by option.', 'wp-team-pro' ),
						'options'  => array(
							'taxonomy' => __( 'Taxonomy', 'wp-team-pro' ),
							'position' => __( 'Position', 'wp-team-pro' ),
							'location' => __( 'Location', 'wp-team-pro' ),
						),
						'default'  => 'taxonomy',
					),
					array(
						'id'       => 'filter_order',
						'type'     => 'select',
						'title'    => __( 'Filter Order', 'wp-team-pro' ),
						'subtitle' => __( 'Choose a filter by option.', 'wp-team-pro' ),
						'options'  => array(
							'none' => __( 'None', 'wp-team-pro' ),
							'asc' => __( 'Ascending', 'wp-team-pro' ),
							'desc' => __( 'Descending', 'wp-team-pro' ),
						),
						'default'  => 'none',
						'dependency' => array( 'filter_by', '!=', 'taxonomy' ),
					),
					array(
						'id'         => 'filter_btn_colors',
						'type'       => 'color_group',
						'title'      => __( 'Button Color', 'wp-team-pro' ),
						'subtitle'   => __( 'Set button color.', 'wp-team-pro' ),
						'options'    => array(
							'color'                 => __( 'Text color', 'wp-team-pro' ),
							'active_color'          => __( 'Text active color', 'wp-team-pro' ),
							'border'                => __( 'Border color', 'wp-team-pro' ),
							'hover_border'          => __( 'Border hover', 'wp-team-pro' ),
							'bg_color'              => __( 'Background', 'wp-team-pro' ),
							'active_hover_bg_color' => __( 'Active & hover bg', 'wp-team-pro' ),
						),
						'default'    => array(
							'color'                 => '#5e5e5e',
							'active_color'          => '#ffffff',
							'border'                => '#bbbbbb',
							'hover_border'          => '#63a37b',
							'bg_color'              => '#ffffff',
							'active_hover_bg_color' => '#63a37b',
						),
						'dependency' => array( 'filter_type', '==', 'filter_button' ),
					),
					array(
						'id'         => 'filter_btn_align',
						'class'      => 'filter_align',
						'type'       => 'button_set',
						'title'      => __( 'Filter Button Alignment', 'wp-team-pro' ),
						'subtitle'   => __( 'Choose filter button alignment.', 'wp-team-pro' ),
						'options'    => array(
							'left'   => '<i class="fa fa-align-left" title="Left"></i>',
							'center' => '<i class="fa fa-align-center" title="Center"></i>',
							'right'  => '<i class="fa fa-align-right" title="Right"></i>',
						),
						'default'    => 'center',
						'dependency' => array( 'filter_type', '==', 'filter_button' ),
					),
					array(
						'id'         => 'filter_all_btn_switch',
						'type'       => 'switcher',
						'title'      => __( '"All" Button', 'wp-team-pro' ),
						'subtitle'   => __( 'Show/Hide all button.', 'wp-team-pro' ),
						'default'    => 'true',
						'text_on'    => __( 'Show', 'wp-team-pro' ),
						'text_off'   => __( 'Hide', 'wp-team-pro' ),
						'text_width' => 100,
					),
					array(
						'id'         => 'filter_all_btn_text',
						'type'       => 'text',
						'title'      => __( 'Rename "All" Button Label', 'wp-team-pro' ),
						'subtitle'   => __( 'Rename all button text label.', 'wp-team-pro' ),
						'default'    => __( 'All', 'wp-team-pro' ),
						'dependency' => array( 'filter_all_btn_switch', '==', true ),
					),
					array(
						'id'       => 'filter_pagination',
						'type'     => 'switcher',
						'title'    => __( 'Filter Pagination', 'wp-team-pro' ),
						'subtitle' => __( 'On/Off filter load more pagination.', 'wp-team-pro' ),
						'default'  => true,
					),
					array(
						'id'         => 'filter_load_more_btn_text',
						'type'       => 'text',
						'title'      => __( 'Rename "Load More" Button Label', 'wp-team-pro' ),
						'subtitle'   => __( 'Rename load more button text label.', 'wp-team-pro' ),
						'default'    => __( 'Load More', 'wp-team-pro' ),
						'dependency' => array( 'filter_pagination', '==', true ),
					),
					array(
						'id'         => 'filter_pagination_show_per_page',
						'type'       => 'spinner',
						'title'      => __( 'Number of Member(s) to Show Per Page', 'wp-team-pro' ),
						'subtitle'   => __( 'Set number of member(s) to show in per page.', 'wp-team-pro' ),
						'default'    => 12,
						'dependency' => array( 'filter_pagination', '==', true ),
					),
					array(
						'id'         => 'filter_pagination_per_click',
						'type'       => 'spinner',
						'title'      => __( 'Number of Member(s) to Show Per Click', 'wp-team-pro' ),
						'subtitle'   => __( 'Set number of member(s) to show in per click.', 'wp-team-pro' ),
						'default'    => 4,
						'dependency' => array( 'filter_pagination', '==', true ),
					),
				),
			)
		);
	}
}
