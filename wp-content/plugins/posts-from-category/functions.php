<?php 

if ( ! function_exists( 'pfc_custom_limit_words' ) ) :

	/**
	 * Returns post excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $length      Excerpt length in words.
	 * @param WP_Post $post_object The post object.
	 * @return string Post excerpt.
	 */
	function pfc_custom_limit_words( $length = 0, $post_object = null ) {
		global $post;

		if ( is_null( $post_object ) ) {
			$post_object = $post;
		}

		$length = absint( $length );
		if ( 0 === $length ) {
			return;
		}

		$source_content = $post_object->post_content;

		if ( ! empty( $post_object->post_excerpt ) ) {
			$source_content = $post_object->post_excerpt;
		}

		$source_content = strip_shortcodes( $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );
		return $trimmed_content;
	}

endif;


add_filter( 'wp_dropdown_cats', 'wp_dropdown_cats_multiple', 10, 2 );

function wp_dropdown_cats_multiple( $output, $r ) {

    if( isset( $r['multiple'] ) && $r['multiple'] ) {

         $output = preg_replace( '/^<select/i', '<select multiple', $output );

        $output = str_replace( "name='{$r['name']}'", "name='{$r['name']}[]'", $output );

        foreach ( array_map( 'trim', explode( ",", $r['selected'] ) ) as $value )
            $output = str_replace( "value=\"{$value}\"", "value=\"{$value}\" selected", $output );

    }

    return $output;
}