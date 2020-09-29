<?php
/**
 * Dynamic styles.
 *
 * @package WP_Team_Pro
 * @since 2.0
 */
class Dynamic_CSS {
	public function __construct() {

	}
}
if ( ! function_exists( 'dynamic_css' ) ) {
	function dynamic_css() {
		$css       = array(
			'#sptp-' . $generator_id . ' .sptp-member-avatar-img' => array(
				'border'           => $border,
				'padding'          => $image_padding_css,
				'background-color' => $image_bg,
			),
		);
		$final_css = '';
		foreach ( $css as $style => $style_array ) {
			$final_css .= $style . '{';
			foreach ( $style_array as $property => $value ) {
				$final_css .= $property . ':' . $value . ';';
			}
			$final_css .= '}';
		}
		return $final_css;
	}
}
