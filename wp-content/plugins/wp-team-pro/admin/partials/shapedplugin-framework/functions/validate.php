<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.
/**
 *
 * Email validate
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_validate_email' ) ) {
	function spf_validate_email( $value ) {

		if ( ! filter_var( $value, FILTER_VALIDATE_EMAIL ) ) {
			 return esc_html__( 'Please write a valid email address!', 'spf' );
		}

	}
}

/**
 *
 * Numeric validate
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_validate_numeric' ) ) {
	function spf_validate_numeric( $value ) {

		if ( ! is_numeric( $value ) ) {
			return esc_html__( 'Please write a numeric data!', 'spf' );
		}

	}
}

/**
 *
 * Required validate
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_validate_required' ) ) {
	function spf_validate_required( $value ) {

		if ( empty( $value ) ) {
			  return esc_html__( 'Error! This field is required!', 'spf' );
		}

	}
}

/**
 *
 * URL validate
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_validate_url' ) ) {
	function spf_validate_url( $value ) {

		if ( ! filter_var( $value, FILTER_VALIDATE_URL ) ) {
			 return esc_html__( 'Please write a valid url!', 'spf' );
		}

	}
}

/**
 *
 * Email validate for Customizer
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_customize_validate_email' ) ) {
	function spf_customize_validate_email( $validity, $value, $wp_customize ) {

		if ( ! sanitize_email( $value ) ) {
			$validity->add( 'required', esc_html__( 'Please write a valid email address!', 'spf' ) );
		}

		return $validity;

	}
}

/**
 *
 * Numeric validate for Customizer
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_customize_validate_numeric' ) ) {
	function spf_customize_validate_numeric( $validity, $value, $wp_customize ) {

		if ( ! is_numeric( $value ) ) {
			$validity->add( 'required', esc_html__( 'Please write a numeric data!', 'spf' ) );
		}

		return $validity;

	}
}

/**
 *
 * Required validate for Customizer
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_customize_validate_required' ) ) {
	function spf_customize_validate_required( $validity, $value, $wp_customize ) {

		if ( empty( $value ) ) {
			  $validity->add( 'required', esc_html__( 'Error! This field is required!', 'spf' ) );
		}

		return $validity;

	}
}

/**
 *
 * URL validate for Customizer
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_customize_validate_url' ) ) {
	function spf_customize_validate_url( $validity, $value, $wp_customize ) {

		if ( ! filter_var( $value, FILTER_VALIDATE_URL ) ) {
			$validity->add( 'required', esc_html__( 'Please write a valid url!', 'spf' ) );
		}

		return $validity;

	}
}

/**
 *
 * Editor validate
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_validate_editor' ) ) {
	function spf_validate_editor( $value ) {

		if ( strlen( $value ) > 100 ) {
			return esc_html__( 'Please write under 100 characters!', 'spf' );
		}

	}
}

/**
 *
 * Skill validate
 *
 * @since 2.0
 * @version 2.0
 * @author ShapeedPlugin <support@shapedplugin.com>
 */
if ( ! function_exists( 'csf_validate_skill' ) ) {
	function csf_validate_skill( $values ) {
		if ( count( $values ) > 0 ) {
			foreach ( $values as $key => $value ) {
				if ( '' !== $value['sptp_skill_name'] ) {
					if ( empty( $value['sptp_skill_percentage'] ) ) {
						return esc_html__( 'Please add skill and respective percentages!', 'spf' );
					} else {
						if ( ( $value['sptp_skill_percentage'] < 0 ) || ( $value['sptp_skill_percentage'] > 100 ) ) {
							return esc_html__( 'Please add valid skill percentages!', 'spf' );
						}
					}
				}
			}
		}
	}
}
/**
 *
 * Social validate
 *
 * @since 2.0
 * @version 2.0
 * @author ShapeedPlugin <support@shapedplugin.com>
 */
if ( ! function_exists( 'csf_validate_social' ) ) {
	function csf_validate_social( $value ) {
		foreach ( $value as $skill => $percentage ) {
			if ( empty( $percentage['social_group'] ) || empty( $percentage['social_link'] ) ) {
				// return esc_html__( 'Please check social group and link!', 'spf' );
			}
		}
	}
}
