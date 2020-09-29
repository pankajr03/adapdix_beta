<?php
if ( ! defined( 'ABSPATH' ) ) {
	die;} // Cannot access directly.


/**
 * SPTP_Generator class for admin generators page
 *
 * @link       https://shapedplugin.com
 * @since      2.0
 *
 * @package    WP_Team
 * @subpackage WP_Team/admin/partials
 */
class SPTP_Generator {
	public static function layout_metaboxes( $prefix ) {
		SPF::createMetabox(
			$prefix,
			array(
				'title'     => __( 'Team Generator Layout ', 'wp-team' ),
				'post_type' => 'sptp_generator',
			)
		);

		SPTP_Layout::section( $prefix );
	}

	public static function metaboxes( $prefix ) {
		SPF::createMetabox(
			$prefix,
			array(
				'title'     => __( 'Team Generator Settings', 'wp-team' ),
				'post_type' => 'sptp_generator',
				'theme'     => 'light',
				'class'     => 'sptp-generator-tabs',
			)
		);

		SPTP_General::section( $prefix );
		SPTP_Carousel::section( $prefix );
		SPTP_GeneratorStyle::section( $prefix );
		SPTP_Image::section( $prefix );
		SPTP_Modal::section( $prefix );
		SPTP_Typography::section( $prefix );
	}

	public static function output_metaboxes( $prefix ) {
		SPF::createMetabox(
			$prefix,
			array(
				'title'     => __( 'Team Generator Shortcode', 'wp-team' ),
				'post_type' => 'sptp_generator',
			)
		);
		SPTP_Output::section( $prefix );
	}
}
