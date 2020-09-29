<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: submessage
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! class_exists( 'SPF_Field_submessage' ) ) {
	class SPF_Field_submessage extends SPF_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$style = ( ! empty( $this->field['style'] ) ) ? $this->field['style'] : 'normal';

			echo '<div class="spf-submessage spf-submessage-' . $style . '">' . $this->field['content'] . '</div>';

		}

	}
}
