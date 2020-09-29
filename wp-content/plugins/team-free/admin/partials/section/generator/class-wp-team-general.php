<?php
/**
 * General tab.
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
				'title'  => __( 'General Settings', 'wp-team' ),
				'icon'   => 'fa fa-gear',
				'fields' => array(
					array(
						'id'       => 'responsive_columns',
						'class'    => 'responsive_columns',
						'type'     => 'column',
						'title'    => __( 'Column(s)', 'wp-team' ),
						'subtitle' => __( 'Set number of column(s) in different devices for responsive view.', 'wp-team' ),
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
						'title'    => __( 'Column(s)', 'wp-team' ),
						'subtitle' => __( 'Set number of column(s) in different devices for responsive view.', 'wp-team' ),
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
						'title'      => __( 'Total Member(s) To Display', 'wp-team' ),
						'default'    => '12',
						'subtitle'   => __( 'Number of total members to show.', 'wp-team' ),
						'dependency' => array( 'filter_members', 'any', 'newest,group,exclude', 'all' ),
						'min'        => 1,
					),
					array(
						'id'       => 'order_by',
						'type'     => 'select',
						'title'    => __( 'Order By', 'wp-team' ),
						'options'  => array(
							'name'     => __( 'Name', 'wp-team' ),
							'id'       => __( 'ID', 'wp-team' ),
							'date'     => __( 'Date', 'wp-team' ),
							'rand'     => __( 'Random', 'wp-team' ),
							'modified' => __( 'Modified', 'wp-team' ),
						),
						'default'  => 'date',
						'subtitle' => __( 'Select an order by option.', 'wp-team' ),
					),
					array(
						'id'       => 'order',
						'type'     => 'select',
						'title'    => __( 'Order', 'wp-team' ),
						'options'  => array(
							'ASC'  => __( 'Ascending', 'wp-team' ),
							'DESC' => __( 'Descending', 'wp-team' ),
						),
						'default'  => 'DESC',
						'subtitle' => __( 'Select an order option.', 'wp-team' ),
					),
					array(
						'id'       => 'preloader_switch',
						'type'     => 'switcher',
						'title'    => __( 'Preloader', 'wp-team' ),
						'subtitle' => __(
							'Team members will be hidden until page load completed.
						',
							'wp-team'
						),
						'default'  => true,
					),
				),
			)
		);

	}
}
