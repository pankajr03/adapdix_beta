<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://shapedplugin.com
 * @since      2.0.0
 *
 * @package    WP_Team
 * @subpackage WP_Team/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;}

class SPTP_Member {

	public static function metaboxes( $post_type, $prefix, $name ) {
		SPF::createMetabox(
			$prefix,
			array(
				'title'     => __( 'Member Details', 'wp-team' ),
				'post_type' => $post_type,
				'priority'  => 'high',
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
						'content' => wp_sprintf( __( '%s DETAILS', 'wp-team' ), strtoupper( $name ) ),
					),
					
					
					array(
						'id'    => 'sptp_job_type',
						'type'    => 'select',
						'options' 	=> array(
							'Our Team'=> 'Our Team',
							'Board & Advisor' => 'Board & Advisor'
						),
						'title' => __( 'Team Type', 'wp-team' )
						
					),
					array(
						'id'    => 'sptp_job_title',
						'type'  => 'text',
						'title' => __( 'Position/Job Title', 'wp-team' ),
					),
					array(
						'id'       => 'sptp_short_bio',
						'type'     => 'textarea',
						'title'    => __( 'Short Bio', 'wp-team' ),
						'subtitle' => __( 'Member short bio is fine in 100 characters or less.', 'wp-team' ),
						'height'   => '125px',
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
								'options'     => array(
									'facebook'    => 'Facebook',
									'twitter'     => 'Twitter',
									'linkedin'    => 'LinkedIn',
									'pinterest-p' => 'Pinterest',
									'youtube'     => 'Youtube',
									'instagram'   => 'Instagram',
									'medium'      => 'Medium',
									'codepen'     => 'Codepen',
								),
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
				),
			)
		);
	}
}
