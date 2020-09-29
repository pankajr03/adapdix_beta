<?php
if ( ! defined( 'ABSPATH' ) ) {
	die;} // Cannot access directly.

/**
 * SPTP_Generator class for admin generators page
 *
 * @link       https://shapedplugin.com
 * @since      2.0
 *
 * @package    Team_Pro
 * @subpackage Team_Pro/admin/partials
 */
class SPTP_Generator {
	public static function layout_metaboxes( $prefix ) {
		SPF::createMetabox(
			$prefix,
			array(
				'title'     => __( 'Team Generator Layout ', 'wp-team-pro' ),
				'post_type' => 'sptp_generator',
				'context'   => 'normal',
			)
		);

		SPTP_Layout::section( $prefix );

	}

	public static function metaboxes( $prefix ) {
		SPF::createMetabox(
			$prefix,
			array(
				'title'     => __( 'Team Generator Settings', 'wp-team-pro' ),
				'post_type' => 'sptp_generator',
				'theme'     => 'light',
				'class'     => 'sptp-generator-tabs',
			)
		);

		// Serialized Ahead!
		SPTP_General::section( $prefix );
		SPTP_Carousel::section( $prefix ); // Depend on Carousel layout.
		SPTP_Filter::section( $prefix ); // Dependent on Filter layout.
		SPTP_GeneratorStyle::section( $prefix );
		SPTP_Image::section( $prefix );
		SPTP_Modal::section( $prefix );
		SPTP_Typography::section( $prefix );
	}

	public static function output_metaboxes( $prefix ) {
		SPF::createMetabox(
			$prefix,
			array(
				'title'     => __( 'Team Generator Shortcode', 'wp-team-pro' ),
				'post_type' => 'sptp_generator',
			)
		);
		SPTP_Output::section( $prefix );
	}
}
