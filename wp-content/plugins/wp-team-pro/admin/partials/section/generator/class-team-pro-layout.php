<?php
/**
 * Layout section in team page.
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
 * This class is responsible for layout section in Team page.
 *
 * @since      2.0.0
 */
class SPTP_Layout {

	/**
	 * Team layout settings.
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_generator_layout.
	 */
	public static function section( $prefix ) {
		SPF::createSection(
			$prefix,
			array(
				'fields' => array(
					array(
						'type'  => 'subheading',
						'image' => SPTP_PLUGIN_ROOT . 'admin/img/wp-team-logo.png',
						'after' => '<i class="fa fa-life-ring"></i> Support',
						'link'  => 'https://shapedplugin.com/support/',
						'class' => 'sptp-admin-bg',
					),
					array(
						'id'      => 'layout_preset',
						'type'    => 'image_select',
						'class'   => 'sptp-layout-preset',
						'title'   => __( 'Layout Presets', 'wp-team-pro' ),
						'options' => array(
							'carousel'        => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/carousel.png',
								'option_name' => __( 'Carousel', 'wp-team-pro' ),
							),
							'grid'            => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/grid.png',
								'option_name' => __( 'Grid', 'wp-team-pro' ),
							),
							'filter'          => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/filter.png',
								'option_name' => __( 'Filter', 'wp-team-pro' ),
							),
							'list'            => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/list.png',
								'option_name' => __( 'List', 'wp-team-pro' ),
							),
							'mosaic'          => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/mosaic.png',
								'option_name' => __( 'Mosaic', 'wp-team-pro' ),
							),
							'inline'          => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/inline.png',
								'option_name' => __( 'Inline', 'wp-team-pro' ),
							),
							'table'           => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/table.png',
								'option_name' => __( 'Table', 'wp-team-pro' ),
							),
							'thumbnail-pager' => array(
								'image'       => SPTP_PLUGIN_ROOT . 'admin/img/thumbnail-pager.png',
								'option_name' => __( 'Thumbnails Pager', 'wp-team-pro' ),
							),
						),
						'default' => 'carousel',
					),
					array(
						'id'          => 'filter_members',
						'type'        => 'select',
						'title'       => __( 'Filter Members', 'wp-team-pro' ),
						'placeholder' => '',
						'options'     => array(
							'newest'   => __( 'Newest', 'wp-team-pro' ),
							'group'    => __( 'Groups', 'wp-team-pro' ),
							'specific' => __( 'Specific', 'wp-team-pro' ),
							'exclude'  => __( 'Exclude', 'wp-team-pro' ),
						),
						'default'     => 'newest',
					),
					array(
						'id'            => 'filter_group',
						'type'          => 'select',
						'title'         => __( 'Select Group', 'wp-team-pro' ),
						'placeholder'   => __( 'Select Group', 'wp-team-pro' ),
						'options'       => 'categories',
						'multiple'      => true,
						'chosen'        => true,
						'sortable'      => true,
						'class'         => 'sptp-layout-group',
						'query_args'    => array(
							'type'     => 'sptp_member',
							'taxonomy' => 'sptp_group',
						),
						'dependency'    => array( 'filter_members', '==', 'group' ),
						'empty_message' => __( 'There are no group', 'wp-team-pro' ),
					),
					array(
						'id'          => 'group_relation',
						'type'        => 'select',
						'title'       => __( 'Group Relation Type', 'wp-team-pro' ),
						'placeholder' => '',
						'options'     => array(
							'in'     => __( 'IN', 'wp-team-pro' ),
							'and'    => __( 'AND', 'wp-team-pro' ),
							'not_in' => __( 'NOT IN', 'wp-team-pro' ),
						),
						'default'     => 'in',
						'dependency'  => array( 'filter_members', '==', 'group' ),
						'help'        => __( 'IN - Show members which associate with one or more terms<br>AND - Show members which match all terms<br/>NOT IN - Show members which don&#39;t match the terms', 'wp-team-pro' ),
						'class'       => 'sptp-help-select',
					),
					array(
						'id'          => 'filter_specific',
						'type'        => 'select',
						'title'       => __( 'Specific members', 'wp-team-pro' ),
						'placeholder' => __( 'Specific members', 'wp-team-pro' ),
						'multiple'    => true,
						'chosen'      => true,
						'sortable'    => true,
						'class'       => 'sptp-layout-group',
						'options'     => 'posts',
						'query_args'  => array(
							'post_type'      => 'sptp_member',
							'post_status'    => 'publish',
							'posts_per_page' => -1,
						),
						'dependency'  => array( 'filter_members', '==', 'specific' ),
					),
					array(
						'id'          => 'filter_exclude',
						'type'        => 'select',
						'title'       => __( 'Exclude members', 'wp-team-pro' ),
						'placeholder' => __( 'Exclude members', 'wp-team-pro' ),
						'multiple'    => true,
						'chosen'      => true,
						'class'       => 'sptp-layout-group',
						'options'     => 'posts',
						'query_args'  => array(
							'post_type'      => 'sptp_member',
							'post_status'    => 'publish',
							'posts_per_page' => -1,
						),
						'dependency'  => array( 'filter_members', '==', 'exclude' ),
					),

				),
			)
		);

	}
}
