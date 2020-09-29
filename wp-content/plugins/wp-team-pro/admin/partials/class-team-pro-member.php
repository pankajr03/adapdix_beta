<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://shapedplugin.com
 * @since      2.0
 *
 * @package    Team_Pro
 * @subpackage Team_Pro/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;}

class SPTP_Member {

	public static function metaboxes( $post_type, $prefix, $name ) {
		SPF::createMetabox(
			$prefix,
			array(
				'title'     => __( 'Member Details', 'wp-team-pro' ),
				'post_type' => $post_type,
				'priority'  => 'high',
				'context'   => 'normal',
				'class'     => '_sptp_member_metabox',
			)
		);

		SPF::createSection(
			$prefix,
			array(
				'fields' => array(
					array(
						'type'    => 'subheading',
						/* translators: %s is replaced with 'Member' */
						'content' => wp_sprintf( __( '%s DETAILS', 'wp-team-pro' ), strtoupper( $name ) ),
					),
					array(
						'id'    => 'sptp_job_title',
						'type'  => 'text',
						'title' => __( 'Position/Job Title', 'wp-team-pro' ),
					),
					array(
						'id'       => 'sptp_short_bio',
						'type'     => 'textarea',
						'title'    => __( 'Short Bio', 'wp-team-pro' ),
						'subtitle' => __( 'Member short bio is fine in 100 characters or less.', 'wp-team-pro' ),
						'height'   => '125px',
					),
					array(
						'type'    => 'subheading',
						'content' => __( 'ADDITIONAL INFORMATION', 'wp-team-pro' ),
					),
					array(
						'id'    => 'sptp_email',
						'type'  => 'text',
						'title' => __( 'Email Address', 'wp-team-pro' ),
					),
					array(
						'id'    => 'sptp_mobile',
						'type'  => 'text',
						'title' => __( 'Mobile (personal)', 'wp-team-pro' ),
					),
					array(
						'id'    => 'sptp_phone',
						'type'  => 'text',
						'title' => __( 'Telephone (office)', 'wp-team-pro' ),
					),
					array(
						'id'    => 'sptp_location',
						'type'  => 'text',
						'title' => __( 'Location', 'wp-team-pro' ),
					),
					array(
						'id'    => 'sptp_website',
						'type'  => 'text',
						'title' => __( 'Website', 'wp-team-pro' ),
					),
					array(
						'id'      => 'sptp_user_profile',
						'type'    => 'select',
						'title'   => __( 'User/Author Profile', 'wp-team-pro' ),
						'after'   => __( 'If this member is associated with a account, select it here. Might be used to fetch latest published posts in the single member page', 'wp-team-pro' ),
						'options' => 'users',
						'default' => 'Select',
						// 'chosen'  => true,
						'class'   => 'spf-after',
					),
					array(
						'type'    => 'subheading',
						'content' => wp_sprintf( '%s SKILLS', strtoupper( $name ) ),
					),
					array(
						'id'       => 'sptp_skills',
						'type'     => 'repeater',
						'title'    => __( 'Skill Label', 'wp-team-pro' ),
						'class'    => 'inline-repeater-skill',
						'sort'     => true,
						'clone'    => false,
						'remove'   => true,
						'fields'   => array(
							array(
								'id'          => 'sptp_skill_name',
								'type'        => 'text',
								'placeholder' => __( 'e.g. Python', 'wp-team-pro' ),
								'class'       => 'repeater-text',
							),
							array(
								'id'    => 'sptp_skill_percentage',
								'type'  => 'spinner',
								'unit'  => '%',
								'class' => 'repeater-select',
							),
						),
						'default'  => array(
							array(),
						),
						'validate' => 'csf_validate_skill',
					),
					array(
						'type'    => 'subheading',
						'content' => wp_sprintf( '%s SOCIAL PROFILES', strtoupper( $name ) ),
					),
					array(
						'id'       => 'sptp_member_social',
						'type'     => 'repeater',
						'title'    => 'Social Icon',
						'class'    => 'inline-repeater-social',
						'sort'     => true,
						'clone'    => false,
						'remove'   => true,
						'fields'   => array(

							array(
								'id'          => 'social_group',
								'type'        => 'select',
								// 'title'   => 'Social Group',
								'options'     => 'wptp_member_social_icons',
								'placeholder' => 'Select',
								'class'       => 'repeater-select',
							),
							array(
								'id'    => 'social_link',
								'type'  => 'text',
								'class' => 'repeater-text',
							),
						),
						'default'  => array(
							array(),
						),
						'validate' => 'csf_validate_social',
					),

					array(
						'type'    => 'subheading',
						'content' => __( 'MEMBER PHOTO GALLERY', 'wp-team-pro' ),
						'content' => wp_sprintf( '%s PHOTO GALLERY', strtoupper( $name ) ),
					),
					array(
						'id'          => 'member_image_gallery',
						'type'        => 'gallery',
						'title'       => __( 'Gallery Images', 'wp-team-pro' ),
						'add_title'   => __( 'Add Image(s)', 'wp-team-pro' ),
						'edit_title'  => __( 'Edit Images', 'wp-team-pro' ),
						'clear_title' => __( 'Remove Images', 'wp-team-pro' ),
					),
				),
			)
		);
	}
}
