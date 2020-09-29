<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: heading
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! class_exists( 'SPF_Field_heading' ) ) {
	class SPF_Field_heading extends SPF_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			echo ( ! empty( $this->field['content'] ) ) ? $this->field['content'] : '';

		}

	}
}
