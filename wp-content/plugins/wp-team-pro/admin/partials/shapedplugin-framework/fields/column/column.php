<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: column
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! class_exists( 'SPF_Field_column' ) ) {
	class SPF_Field_column extends spf_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'desktop_icon'        => '<i class="fa fa-desktop"></i>',
					'laptop_icon'         => '<i class="fa fa-laptop"></i>',
					'tablet_icon'         => '<i class="fa fa-tablet"></i>',
					'mobile_icon'         => '<i class="fa fa-mobile"></i>',
					'all_text'            => '<i class="fa fa-arrows"></i>',
					'desktop_placeholder' => esc_html__( 'Desktop', 'spf' ),
					'laptop_placeholder'  => esc_html__( 'Small Desktop', 'spf' ),
					'tablet_placeholder'  => esc_html__( 'Tablet', 'spf' ),
					'mobile_placeholder'  => esc_html__( 'Mobile', 'spf' ),
					'all_placeholder'     => esc_html__( 'all', 'spf' ),
					'desktop'             => true,
					'laptop'              => true,
					'tablet'              => true,
					'mobile'              => true,
					'unit'                => false,
					'all'                 => false,
					'units'               => array( 'px', '%', 'em' ),
				)
			);

			$default_values = array(
				'desktop' => '4',
				'laptop'  => '3',
				'tablet'  => '2',
				'mobile'  => '1',
				'all'     => '',
				'unit'    => 'px',
			);

			$value = wp_parse_args( $this->value, $default_values );

			echo $this->field_before();

			if ( ! empty( $args['all'] ) ) {

				$placeholder = ( ! empty( $args['all_placeholder'] ) ) ? ' placeholder="' . $args['all_placeholder'] . '"' : '';

				echo '<div class="spf--input">';
				echo ( ! empty( $args['all_text'] ) ) ? '<span class="spf--label spf--label-icon">' . $args['all_text'] . '</span>' : '';
				echo '<input type="number" name="' . $this->field_name( '[all]' ) . '" value="' . $value['all'] . '"' . $placeholder . ' class="spf-number" />';
				echo ( count( $args['units'] ) === 1 && ! empty( $args['unit'] ) ) ? '<span class="spf--label spf--label-unit">' . $args['units'][0] . '</span>' : '';
				echo '</div>';

			} else {

				$properties = array();

				foreach ( array( 'desktop', 'laptop', 'tablet', 'mobile' ) as $prop ) {
					if ( ! empty( $args[ $prop ] ) ) {
						$properties[] = $prop;
					}
				}

				$properties = ( $properties === array( 'laptop', 'mobile' ) ) ? array_reverse( $properties ) : $properties;

				foreach ( $properties as $property ) {

					$placeholder = ( ! empty( $args[ $property . '_placeholder' ] ) ) ? ' placeholder="' . $args[ $property . '_placeholder' ] . '"' : '';

					echo '<div class="spf--input">';
					echo ( ! empty( $args[ $property . '_icon' ] ) ) ? '<span class="spf--label spf--label-icon">' . $args[ $property . '_icon' ] . '</span>' : '';
					echo '<input type="number" name="' . $this->field_name( '[' . $property . ']' ) . '" value="' . $value[ $property ] . '"' . $placeholder . ' class="spf-number" />';
					echo ( count( $args['units'] ) === 1 && ! empty( $args['unit'] ) ) ? '<span class="spf--label spf--label-unit">' . $args['units'][0] . '</span>' : '';
					echo '</div>';

				}
			}

			if ( ! empty( $args['unit'] ) && count( $args['units'] ) > 1 ) {
				echo '<select name="' . $this->field_name( '[unit]' ) . '">';
				foreach ( $args['units'] as $unit ) {
					$selected = ( $value['unit'] === $unit ) ? ' selected' : '';
					echo '<option value="' . $unit . '"' . $selected . '>' . $unit . '</option>';
				}
				echo '</select>';
			}

			echo $this->field_after();

		}

		public function output() {

			$output    = '';
			$element   = ( is_array( $this->field['output'] ) ) ? join( ',', $this->field['output'] ) : $this->field['output'];
			$important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
			$unit      = ( ! empty( $this->value['unit'] ) ) ? $this->value['unit'] : 'px';

			$mode = ( ! empty( $this->field['output_mode'] ) ) ? $this->field['output_mode'] : 'padding';
			$mode = ( $mode === 'relative' || $mode === 'absolute' || $mode === 'none' ) ? '' : $mode;
			$mode = ( ! empty( $mode ) ) ? $mode . '-' : '';

			if ( ! empty( $this->field['all'] ) && isset( $this->value['all'] ) && $this->value['all'] !== '' ) {

				$output  = $element . '{';
				$output .= $mode . 'desktop:' . $this->value['all'] . $unit . $important . ';';
				$output .= $mode . 'laptop:' . $this->value['all'] . $unit . $important . ';';
				$output .= $mode . 'tablet:' . $this->value['all'] . $unit . $important . ';';
				$output .= $mode . 'mobile:' . $this->value['all'] . $unit . $important . ';';
				$output .= '}';

			} else {

				$desktop = ( isset( $this->value['desktop'] ) && $this->value['desktop'] !== '' ) ? $mode . 'desktop:' . $this->value['desktop'] . $unit . $important . ';' : '';
				$laptop  = ( isset( $this->value['laptop'] ) && $this->value['laptop'] !== '' ) ? $mode . 'laptop:' . $this->value['laptop'] . $unit . $important . ';' : '';
				$tablet  = ( isset( $this->value['tablet'] ) && $this->value['tablet'] !== '' ) ? $mode . 'tablet:' . $this->value['tablet'] . $unit . $important . ';' : '';
				$mobile  = ( isset( $this->value['mobile'] ) && $this->value['mobile'] !== '' ) ? $mode . 'mobile:' . $this->value['mobile'] . $unit . $important . ';' : '';

				if ( $desktop !== '' || $laptop !== '' || $tablet !== '' || $mobile !== '' ) {
					$output = $element . '{' . $desktop . $laptop . $tablet . $mobile . '}';
				}
			}

			$this->parent->output_css .= $output;

			return $output;

		}

	}
}
