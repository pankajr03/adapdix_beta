<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: sorter
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! class_exists( 'SPF_Field_sorter' ) ) {
	class SPF_Field_sorter extends SPF_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$args = wp_parse_args(
				$this->field, array(
					'disabled'       => true,
					'enabled_title'  => esc_html__( 'Enabled', 'spf' ),
					'disabled_title' => esc_html__( 'Disabled', 'spf' ),
				)
			);

			echo $this->field_before();

			$this->value      = ( ! empty( $this->value ) ) ? $this->value : $this->field['default'];
			$enabled_options  = ( ! empty( $this->value['enabled'] ) ) ? $this->value['enabled'] : array();
			$disabled_options = ( ! empty( $this->value['disabled'] ) ) ? $this->value['disabled'] : array();

			echo ( $args['disabled'] ) ? '<div class="spf-modules">' : '';

			echo ( ! empty( $args['enabled_title'] ) ) ? '<div class="spf-sorter-title">' . $args['enabled_title'] . '</div>' : '';
			echo '<ul class="spf-enabled">';
			if ( ! empty( $enabled_options ) ) {
				foreach ( $enabled_options as $key => $value ) {
					echo '<li><input type="hidden" name="' . $this->field_name( '[enabled][' . $key . ']' ) . '" value="' . $value . '"/><label>' . $value . '</label></li>';
				}
			}
			echo '</ul>';

			// Check for hide/show disabled section
			if ( $args['disabled'] ) {

				echo '</div>';

				echo '<div class="spf-modules">';
				echo ( ! empty( $args['disabled_title'] ) ) ? '<div class="spf-sorter-title">' . $args['disabled_title'] . '</div>' : '';
				echo '<ul class="spf-disabled">';
				if ( ! empty( $disabled_options ) ) {
					foreach ( $disabled_options as $key => $value ) {
						echo '<li><input type="hidden" name="' . $this->field_name( '[disabled][' . $key . ']' ) . '" value="' . $value . '"/><label>' . $value . '</label></li>';
					}
				}
				echo '</ul>';
				echo '</div>';

			}

			echo '<div class="clear"></div>';

			echo $this->field_after();

		}

		public function enqueue() {

			if ( ! wp_script_is( 'jquery-ui-sortable' ) ) {
				wp_enqueue_script( 'jquery-ui-sortable' );
			}

		}

	}
}