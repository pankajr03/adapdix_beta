<?php
/**
 * General tab.
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
 * This class is responsible for General tab in Team page.
 *
 * @since      2.0.0
 */
class SPTP_General {

	/**
	 * General settings.
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_generator.
	 */
	public static function section( $prefix ) {
		SPF::createSection(
			$prefix,
			array(
				'title'  => __( 'General Settings', 'wp-team-pro' ),
				'icon'   => 'fa fa-gear',
				'fields' => array(
					array(
						'id'       => 'responsive_columns',
						'class'    => 'responsive_columns',
						'type'     => 'column',
						'title'    => __( 'Column(s)', 'wp-team-pro' ),
						'subtitle' => __( 'Set number of column(s) in different devices for responsive view.', 'wp-team-pro' ),
						'default'  => array(
							'desktop' => '4',
							'laptop'  => '3',
							'tablet'  => '2',
							'mobile'  => '1',
						),
						'help'     => '<i class="fa fa-desktop"></i> DESKTOP - Screens larger than 1024px.<br/>
						<i class="fa fa-laptop"></i> LAPTOP - Screens smaller than 1024px.<br/>
						<i class="fa fa-tablet"></i> TABLET - Screens smaller than 768px.<br/>
						<i class="fa fa-mobile"></i> MOBILE - Screens smaller than 414px.<br/>',
					),
					array(
						'id'       => 'responsive_columns_list',
						'class'    => 'responsive_columns_list',
						'type'     => 'column',
						'title'    => __( 'Column(s)', 'wp-team-pro' ),
						'subtitle' => __( 'Set number of column(s) in different devices for responsive view.', 'wp-team-pro' ),
						'default'  => array(
							'desktop' => '1',
							'laptop'  => '1',
							'tablet'  => '1',
							'mobile'  => '1',
						),
						'help'     => '<i class="fa fa-desktop"></i> DESKTOP - Screens larger than 1024px.<br/>
						<i class="fa fa-laptop"></i> LAPTOP - Screens smaller than 1024px.<br/>
						<i class="fa fa-tablet"></i> TABLET - Screens smaller than 768px.<br/>
						<i class="fa fa-mobile"></i> MOBILE - Screens smaller than 414px.<br/>',
					),
					array(
						'id'         => 'total_member_display',
						'class'      => 'total_member_display',
						'type'       => 'spinner',
						'title'      => __( 'Total Member(s) To Display', 'wp-team-pro' ),
						'default'    => 12,
						'subtitle'   => __( 'Number of total members to show. Default value is 12. For all leave it empty.', 'wp-team-pro' ),
						'min'        => 1,
					),
					array(
						'id'       => 'order_by',
						'type'     => 'select',
						'title'    => __( 'Order By', 'wp-team-pro' ),
						'options'  => array(
							'menu_order' => __( 'Drag & Drop', 'wp-team-pro' ),
							'name'       => __( 'Name', 'wp-team-pro' ),
							'id'         => __( 'ID', 'wp-team-pro' ),
							'date'       => __( 'Date', 'wp-team-pro' ),
							'rand'       => __( 'Random', 'wp-team-pro' ),
							'modified'   => __( 'Modified', 'wp-team-pro' ),
						),
						'default'  => 'menu_order',
						'subtitle' => __( 'Select an order by option.', 'wp-team-pro' ),
					),
					array(
						'id'       => 'order',
						'type'     => 'select',
						'title'    => __( 'Order', 'wp-team-pro' ),
						'options'  => array(
							'ASC'  => __( 'Ascending', 'wp-team-pro' ),
							'DESC' => __( 'Descending', 'wp-team-pro' ),
						),
						'default'  => 'DESC',
						'subtitle' => __( 'Select an order option.', 'wp-team-pro' ),
						'dependency' => array( 'order_by', '!=', 'menu_order' ),
					),
					array(
						'id'       => 'preloader_switch',
						'type'     => 'switcher',
						'title'    => __( 'Preloader', 'wp-team-pro' ),
						'subtitle' => __(
							'Team members will be hidden until page load completed and ajax pagination.
						',
							'wp-team-pro'
						),
						'default'  => true,
					),
				),
			)
		);

	}
}
