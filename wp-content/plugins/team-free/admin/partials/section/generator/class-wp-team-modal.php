<?php
/**
 * Member Detail Settings tab.
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
 * This class is responsible for Member Detail tab in Team page.
 *
 * @since      2.0.0
 */
class SPTP_Modal {

	/**
	 * Member Detail Settings.
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_generator.
	 */
	public static function section( $prefix ) {
		SPF::createSection(
			$prefix,
			array(
				'title'  => __( 'Member Detail Settings', 'wp-team' ),
				'icon'   => 'fa fa-id-card-o',
				'fields' => array(

					array(
						'type'     => 'switcher',
						'id'       => 'link_detail',
						'title'    => __( 'Link To Detail Page', 'wp-team' ),
						'subtitle' => __( 'On/Off for linking member detail page.', 'wp-team' ),
						'default'  => true,
					),
					array(
						'id'         => 'link_detail_fields',
						'type'       => 'fieldset',
						'dependency' => array( 'link_detail', '==', 'true' ),
						'fields'     => array(
							array(
								'id'       => 'page_link_type',
								'class'    => 'page_link_type',
								'type'     => 'button_set',
								'title'    => __( 'Detail Page Link Type', 'wp-team' ),
								'subtitle' => __( 'Choose member detail page type.', 'wp-team' ),
								'options'  => array(
									'new_page' => __( 'New Page', 'wp-team' ),
									'modal'    => __( 'Modal', 'wp-team' ),
									'drawer'   => __( 'Drawer', 'wp-team' ),
								),
								'default'  => 'new_page',
								'inline'   => true,
							),
							array(
								'id'         => 'page_link_open',
								'type'       => 'radio',
								'title'      => __( 'Open Tab in', 'wp-team' ),
								'options'    => array(
									'_blank' => __( 'New Tab', 'wp-team' ),
									'_self'  => __( 'Same Tab', 'wp-team' ),
								),
								'default'    => '_blank',
								'dependency' => array( 'page_link_type', '==', 'new_page' ),
							),
							array(
								'type'    => 'subheading',
								'content' => __( 'Member Detail Fields', 'wp-team' ),
							),

							array(
								'id'       => 'detail_page_fields',
								'type'     => 'checkbox',
								'title'    => __( 'Member Detail Fields Selection', 'wp-team' ),
								'subtitle' => __( 'Check the field(s) to show on detail page.', 'wp-team' ),
								'class'    => 'detail_page_options',
								'options'  => array(
									'img'             => __( 'Photo/Image', 'wp-team' ),
									'name'            => __( 'Member Name', 'wp-team' ),
									'position'        => __( 'Position/Job Title', 'wp-team' ),
									'desc'            => __( 'Description', 'wp-team' ),
									'social_profiles' => __( 'Social Profiles', 'wp-team' ),
								),
								'default'  => array( 'name', 'desc', 'img', 'icon', 'position', 'social_profiles' ),
							),
						),
					),
				),
			)
		);
	}
}
