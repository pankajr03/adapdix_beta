<?php
/**
 * Layout section in team page.
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
						'image' => SPT_PLUGIN_ROOT . 'admin/img/wp-team-logo.png',
						'after' => '<i class="fa fa-life-ring"></i> Support',
						'link'  => 'https://shapedplugin.com/support-forum/',
						'class' => 'sptp-admin-bg',
					),
					array(
						'id'      => 'layout_preset',
						'type'    => 'image_select',
						'class'   => 'sptp-layout-preset',
						'title'   => __( 'Layout Presets', 'wp-team' ),
						'options' => array(
							'carousel'        => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/carousel.png',
								'option_name' => __( 'Carousel', 'wp-team' ),
								'class'       => 'free-feature',
							),
							'grid'            => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/grid.png',
								'option_name' => __( 'Grid', 'wp-team' ),
								'class'       => 'free-feature',
							),
							'list'            => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/list.png',
								'option_name' => __( 'List', 'wp-team' ),
								'class'       => 'free-feature',
							),
							'filter'          => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/filter.png',
								'option_name' => __( 'Filter', 'wp-team' ),
								'class'       => 'pro-feature',
							),
							'mosaic'          => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/mosaic.png',
								'option_name' => __( 'Mosaic', 'wp-team' ),
								'class'       => 'pro-feature',
							),
							'inline'          => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/inline.png',
								'option_name' => __( 'Inline', 'wp-team' ),
								'class'       => 'pro-feature',
							),
							'table'           => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/table.png',
								'option_name' => __( 'Table', 'wp-team' ),
								'class'       => 'pro-feature',
							),
							'thumbnail-pager' => array(
								'image'       => SPT_PLUGIN_ROOT . 'admin/img/thumbnail-pager.png',
								'option_name' => __( 'Thumbnails Pager', 'wp-team' ),
								'class'       => 'pro-feature',
							),
						),
						'default' => 'carousel',
					),
					array(
						'id'          => 'filter_members',
						'class'       => 'filter_members',
						'type'        => 'select',
						'title'       => __( 'Filter Members', 'wp-team' ),
						'placeholder' => '',
						'options'     => array(
							'newest'   => __( 'Newest', 'wp-team' ),
							'group'    => __( 'Groups (Pro)', 'wp-team' ),
							'specific' => __( 'Specific (Pro)', 'wp-team' ),
							'exclude'  => __( 'Exclude (Pro)', 'wp-team' ),
						),
						'default'     => array( 'newest' ),
					),
				),
			)
		);

	}
}
