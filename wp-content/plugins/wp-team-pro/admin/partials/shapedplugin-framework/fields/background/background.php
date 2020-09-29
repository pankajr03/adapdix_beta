<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: background
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! class_exists( 'SPF_Field_background' ) ) {
	class SPF_Field_background extends SPF_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field, array(
					'background_color'              => true,
					'background_image'              => true,
					'background_position'           => true,
					'background_repeat'             => true,
					'background_attachment'         => true,
					'background_size'               => true,
					'background_origin'             => false,
					'background_clip'               => false,
					'background_blend-mode'         => false,
					'background_gradient'           => false,
					'background_gradient_color'     => true,
					'background_gradient_direction' => true,
					'background_image_preview'      => true,
					'background_image_library'      => 'image',
					'background_image_placeholder'  => esc_html__( 'No background selected', 'spf' ),
				)
			);

			$default_value = array(
				'background-color'              => '',
				'background-image'              => '',
				'background-position'           => '',
				'background-repeat'             => '',
				'background-attachment'         => '',
				'background-size'               => '',
				'background-origin'             => '',
				'background-clip'               => '',
				'background-blend-mode'         => '',
				'background-gradient-color'     => '',
				'background-gradient-direction' => '',
			);

			$default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

			$this->value = wp_parse_args( $this->value, $default_value );

			echo $this->field_before();

			//
			// Background Color.
			if ( ! empty( $args['background_color'] ) ) {

				echo '<div class="spf--block spf--color">';
				echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="spf--title">' . esc_html__( 'From', 'spf' ) . '</div>' : '';

				spf::field(
					array(
						'id'      => 'background-color',
						'type'    => 'color',
						'default' => $default_value['background-color'],
					), $this->value['background-color'], $this->field_name(), 'field/background'
				);

				echo '</div>';

			}

			//
			// Background Gradient Color.
			if ( ! empty( $args['background_gradient_color'] ) && ! empty( $args['background_gradient'] ) ) {

				echo '<div class="spf--block spf--color">';
				echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="spf--title">' . esc_html__( 'To', 'spf' ) . '</div>' : '';

				spf::field(
					array(
						'id'      => 'background-gradient-color',
						'type'    => 'color',
						'default' => $default_value['background-gradient-color'],
					), $this->value['background-gradient-color'], $this->field_name(), 'field/background'
				);

				echo '</div>';

			}

			//
			// Background Gradient Direction.
			if ( ! empty( $args['background_gradient_direction'] ) && ! empty( $args['background_gradient'] ) ) {

				echo '<div class="spf--block spf--gradient">';
				echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="spf--title">' . esc_html__( 'Direction', 'spf' ) . '</div>' : '';

				spf::field(
					array(
						'id'      => 'background-gradient-direction',
						'type'    => 'select',
						'options' => array(
							''          => esc_html__( 'Gradient Direction', 'spf' ),
							'to bottom' => esc_html__( '&#8659; top to bottom', 'spf' ),
							'to right'  => esc_html__( '&#8658; left to right', 'spf' ),
							'135deg'    => esc_html__( '&#8664; corner top to right', 'spf' ),
							'-135deg'   => esc_html__( '&#8665; corner top to left', 'spf' ),
						),
					), $this->value['background-gradient-direction'], $this->field_name(), 'field/background'
				);

				echo '</div>';

			}

			echo '<div class="clear"></div>';

			//
			// Background Image.
			if ( ! empty( $args['background_image'] ) ) {

				echo '<div class="spf--block spf--media">';

				spf::field(
					array(
						'id'          => 'background-image',
						'type'        => 'media',
						'library'     => $args['background_image_library'],
						'preview'     => $args['background_image_preview'],
						'placeholder' => $args['background_image_placeholder'],
					), $this->value['background-image'], $this->field_name(), 'field/background'
				);

				echo '</div>';

				echo '<div class="clear"></div>';

			}

			//
			// Background Position.
			if ( ! empty( $args['background_position'] ) ) {
				echo '<div class="spf--block spf--select">';

				spf::field(
					array(
						'id'      => 'background-position',
						'type'    => 'select',
						'options' => array(
							''              => esc_html__( 'Background Position', 'spf' ),
							'left top'      => esc_html__( 'Left Top', 'spf' ),
							'left center'   => esc_html__( 'Left Center', 'spf' ),
							'left bottom'   => esc_html__( 'Left Bottom', 'spf' ),
							'center top'    => esc_html__( 'Center Top', 'spf' ),
							'center center' => esc_html__( 'Center Center', 'spf' ),
							'center bottom' => esc_html__( 'Center Bottom', 'spf' ),
							'right top'     => esc_html__( 'Right Top', 'spf' ),
							'right center'  => esc_html__( 'Right Center', 'spf' ),
							'right bottom'  => esc_html__( 'Right Bottom', 'spf' ),
						),
					), $this->value['background-position'], $this->field_name(), 'field/background'
				);

				echo '</div>';

			}

			//
			// Background Repeat.
			if ( ! empty( $args['background_repeat'] ) ) {
				echo '<div class="spf--block spf--select">';

				spf::field(
					array(
						'id'      => 'background-repeat',
						'type'    => 'select',
						'options' => array(
							''          => esc_html__( 'Background Repeat', 'spf' ),
							'repeat'    => esc_html__( 'Repeat', 'spf' ),
							'no-repeat' => esc_html__( 'No Repeat', 'spf' ),
							'repeat-x'  => esc_html__( 'Repeat Horizontally', 'spf' ),
							'repeat-y'  => esc_html__( 'Repeat Vertically', 'spf' ),
						),
					), $this->value['background-repeat'], $this->field_name(), 'field/background'
				);

				echo '</div>';

			}

			//
			// Background Attachment.
			if ( ! empty( $args['background_attachment'] ) ) {
				echo '<div class="spf--block spf--select">';

				spf::field(
					array(
						'id'      => 'background-attachment',
						'type'    => 'select',
						'options' => array(
							''       => esc_html__( 'Background Attachment', 'spf' ),
							'scroll' => esc_html__( 'Scroll', 'spf' ),
							'fixed'  => esc_html__( 'Fixed', 'spf' ),
						),
					), $this->value['background-attachment'], $this->field_name(), 'field/background'
				);

				echo '</div>';

			}

			//
			// Background Size.
			if ( ! empty( $args['background_size'] ) ) {
				echo '<div class="spf--block spf--select">';

				spf::field(
					array(
						'id'      => 'background-size',
						'type'    => 'select',
						'options' => array(
							''        => esc_html__( 'Background Size', 'spf' ),
							'cover'   => esc_html__( 'Cover', 'spf' ),
							'contain' => esc_html__( 'Contain', 'spf' ),
						),
					), $this->value['background-size'], $this->field_name(), 'field/background'
				);

				echo '</div>';

			}

			//
			// Background Origin.
			if ( ! empty( $args['background_origin'] ) ) {
				echo '<div class="spf--block spf--select">';

				spf::field(
					array(
						'id'      => 'background-origin',
						'type'    => 'select',
						'options' => array(
							''            => esc_html__( 'Background Origin', 'spf' ),
							'padding-box' => esc_html__( 'Padding Box', 'spf' ),
							'border-box'  => esc_html__( 'Border Box', 'spf' ),
							'content-box' => esc_html__( 'Content Box', 'spf' ),
						),
					), $this->value['background-origin'], $this->field_name(), 'field/background'
				);

				echo '</div>';

			}

			//
			// Background Clip.
			if ( ! empty( $args['background_clip'] ) ) {
				echo '<div class="spf--block spf--select">';

				spf::field(
					array(
						'id'      => 'background-clip',
						'type'    => 'select',
						'options' => array(
							''            => esc_html__( 'Background Clip', 'spf' ),
							'border-box'  => esc_html__( 'Border Box', 'spf' ),
							'padding-box' => esc_html__( 'Padding Box', 'spf' ),
							'content-box' => esc_html__( 'Content Box', 'spf' ),
						),
					), $this->value['background-clip'], $this->field_name(), 'field/background'
				);

				echo '</div>';

			}

			//
			// Background Blend Mode.
			if ( ! empty( $args['background_blend_mode'] ) ) {
				echo '<div class="spf--block spf--select">';

				spf::field(
					array(
						'id'      => 'background-blend-mode',
						'type'    => 'select',
						'options' => array(
							''            => esc_html__( 'Background Blend Mode', 'spf' ),
							'normal'      => esc_html__( 'Normal', 'spf' ),
							'multiply'    => esc_html__( 'Multiply', 'spf' ),
							'screen'      => esc_html__( 'Screen', 'spf' ),
							'overlay'     => esc_html__( 'Overlay', 'spf' ),
							'darken'      => esc_html__( 'Darken', 'spf' ),
							'lighten'     => esc_html__( 'Lighten', 'spf' ),
							'color-dodge' => esc_html__( 'Color Dodge', 'spf' ),
							'saturation'  => esc_html__( 'Saturation', 'spf' ),
							'color'       => esc_html__( 'Color', 'spf' ),
							'luminosity'  => esc_html__( 'Luminosity', 'spf' ),
						),
					), $this->value['background-blend-mode'], $this->field_name(), 'field/background'
				);

				echo '</div>';

			}

			echo '<div class="clear"></div>';

			echo $this->field_after();

		}

		public function output() {

			$output    = '';
			$bg_image  = array();
			$important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
			$element   = ( is_array( $this->field['output'] ) ) ? join( ',', $this->field['output'] ) : $this->field['output'];

			// Background image and gradient.
			$background_color        = ( ! empty( $this->value['background-color'] ) ) ? $this->value['background-color'] : '';
			$background_gd_color     = ( ! empty( $this->value['background-gradient-color'] ) ) ? $this->value['background-gradient-color'] : '';
			$background_gd_direction = ( ! empty( $this->value['background-gradient-direction'] ) ) ? $this->value['background-gradient-direction'] : '';
			$background_image        = ( ! empty( $this->value['background-image']['url'] ) ) ? $this->value['background-image']['url'] : '';

			if ( $background_color && $background_gd_color ) {
				$gd_direction = ( $background_gd_direction ) ? $background_gd_direction . ',' : '';
				$bg_image[]   = 'linear-gradient(' . $gd_direction . $background_color . ',' . $background_gd_color . ')';
			}

			if ( $background_image ) {
				$bg_image[] = 'url(' . $background_image . ')';
			}

			if ( ! empty( $bg_image ) ) {
				$output .= 'background-image:' . implode( ',', $bg_image ) . $important . ';';
			}

			// Common background properties.
			$properties = array( 'color', 'position', 'repeat', 'attachment', 'size', 'origin', 'clip', 'blend-mode' );

			foreach ( $properties as $property ) {
				$property = 'background-' . $property;
				if ( ! empty( $this->value[ $property ] ) ) {
					$output .= $property . ':' . $this->value[ $property ] . $important . ';';
				}
			}

			if ( $output ) {
				$output = $element . '{' . $output . '}';
			}

			$this->parent->output_css .= $output;

			return $output;

		}

	}
}
