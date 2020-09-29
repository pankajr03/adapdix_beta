<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: content
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! class_exists( 'SPF_Field_content' ) ) {
	class SPF_Field_content extends SPF_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {
			echo $this->field['content'];
		}

	}
}
