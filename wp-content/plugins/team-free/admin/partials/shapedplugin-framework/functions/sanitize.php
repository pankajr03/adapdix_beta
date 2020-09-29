<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Sanitize
 * Replace letter a to letter b
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_sanitize_replace_a_to_b' ) ) {
	function spf_sanitize_replace_a_to_b( $value ) {
		return str_replace( 'a', 'b', $value );
	}
}

/**
 *
 * Sanitize title
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_sanitize_title' ) ) {
	function spf_sanitize_title( $value ) {
		return sanitize_title( $value );
	}
}
