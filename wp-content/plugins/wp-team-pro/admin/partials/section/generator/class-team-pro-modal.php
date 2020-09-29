<?php
/**
 * Member Detail Settings tab.
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
				'title'  => __( 'Member Detail Settings', 'wp-team-pro' ),
				'icon'   => 'fa fa-id-card-o',
				'fields' => array(

					array(
						'type'     => 'switcher',
						'id'       => 'link_detail',
						'title'    => __( 'Link To Detail Page', 'wp-team-pro' ),
						'subtitle' => __( 'On/Off for linking member detail page.', 'wp-team-pro' ),
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
								'title'    => __( 'Detail Page Link Type', 'wp-team-pro' ),
								'subtitle' => __( 'Choose member detail page type.', 'wp-team-pro' ),
								'options'  => array(
									'modal'    => __( 'Modal', 'wp-team-pro' ),
									'drawer'   => __( 'Drawer', 'wp-team-pro' ),
									'new_page' => __( 'New Page', 'wp-team-pro' ),
								),
								'default'  => 'modal',
								'inline'   => true,
							),
							array(
								'id'         => 'modal_type',
								'type'       => 'radio',
								'title'      => __( 'Modal Type', 'wp-team-pro' ),
								'subtitle'   => __( 'Choose modal type.', 'wp-team-pro' ),
								'class'      => 'page_link_type_option',
								'options'    => array(
									'single'   => __( 'Single Member', 'wp-team-pro' ),
									'multiple' => __( 'Multiple Member with Navigation', 'wp-team-pro' ),
								),
								'default'    => 'multiple',
								'dependency' => array( 'page_link_type', '==', 'modal' ),
							),
							array(
								'id'         => 'modal_layout',
								'type'       => 'image_select',
								'title'      => __( 'Modal Layout', 'wp-team-pro' ),
								'subtitle'   => __( 'Choose a modal layout.', 'wp-team-pro' ),
								'options'    => array(
									'style-1' => array(
										'image'       => SPTP_PLUGIN_ROOT . 'admin/img/modal-classic.png',
										'option_name' => __( 'Classic Modal', 'wp-team-pro' ),
									),
									'style-3' => array(
										'image'       => SPTP_PLUGIN_ROOT . 'admin/img/modal-left.png',
										'option_name' => __( 'Slide-Ins Left', 'wp-team-pro' ),
									),
									'style-4' => array(
										'image'       => SPTP_PLUGIN_ROOT . 'admin/img/modal-center.png',
										'option_name' => __( 'Slide-Ins Center', 'wp-team-pro' ),
									),
									'style-2' => array(
										'image'       => SPTP_PLUGIN_ROOT . 'admin/img/modal-right.png',
										'option_name' => __( 'Slide-Ins Right', 'wp-team-pro' ),
									),
								),
								'default'    => 'style-1',
								'dependency' => array( 'page_link_type', '==', 'modal' ),
							),
							array(
								'id'         => 'modal_background',
								'type'       => 'color',
								'title'      => __( 'Modal Background', 'wp-team-pro' ),
								'subtitle'   => __( 'Set modal background.', 'wp-team-pro' ),
								'default'    => '#ffffff',
								'dependency' => array( 'page_link_type', '==', 'modal' ),
							),
							array(
								'id'         => 'modal_z_index',
								'type'       => 'spinner',
								'title'      => __( 'Modal Z-index', 'wp-team-pro' ),
								'subtitle'   => __( 'Set modal z-index.', 'wp-team-pro' ),
								'default'    => 99999,
								'dependency' => array( 'page_link_type', '==', 'modal' ),
								'max'        => 99999999,
							),
							array(
								'id'         => 'page_link_open',
								'type'       => 'radio',
								'title'      => __( 'Open Tab in', 'wp-team-pro' ),
								'options'    => array(
									'_blank' => __( 'New Tab', 'wp-team-pro' ),
									'_self'  => __( 'Same Tab', 'wp-team-pro' ),
								),
								'default'    => '_blank',
								'dependency' => array( 'page_link_type', '==', 'new_page' ),
							),
							array(
								'type'    => 'subheading',
								'content' => __( 'Member Detail Fields', 'wp-team-pro' ),
							),

							array(
								'id'       => 'detail_page_fields',
								'type'     => 'checkbox',
								'title'    => __( 'Member Detail Fields Selection', 'wp-team-pro' ),
								'subtitle' => __( 'Check the field(s) to show on modal or detail page.', 'wp-team-pro' ),
								'class'    => 'detail_page_options',
								'options'  => array(
									'img'             => __( 'Photo/Image', 'wp-team-pro' ),
									'name'            => __( 'Member Name', 'wp-team-pro' ),
									'position'        => __( 'Position/Job Title', 'wp-team-pro' ),
									'desc'            => __( 'Description', 'wp-team-pro' ),
									'icon'            => __( 'Meta Icon', 'wp-team-pro' ),
									'email'           => __( 'Email', 'wp-team-pro' ),
									'mobile'          => __( 'Mobile(personal)', 'wp-team-pro' ),
									'phone'           => __( 'Phone(office)', 'wp-team-pro' ),
									'location'        => __( 'Location', 'wp-team-pro' ),
									'website'         => __( 'Website', 'wp-team-pro' ),
									'skills'          => __( 'Skill Bars', 'wp-team-pro' ),
									'social_profiles' => __( 'Social Profiles', 'wp-team-pro' ),
									'author_posts'    => __( 'Author Posts', 'wp-team-pro' ),
								),
								'default'  => array( 'name', 'desc', 'img', 'icon', 'position', 'email', 'mobile', 'location', 'phone', 'website', 'skills', 'social_profiles', 'author_posts' ),
							),
						),
					),
				),
			)
		);
	}
}
