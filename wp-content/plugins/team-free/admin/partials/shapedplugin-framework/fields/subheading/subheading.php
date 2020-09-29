<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: subheading
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! class_exists( 'SPF_Field_subheading' ) ) {
	class SPF_Field_subheading extends SPF_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			echo ( ! empty( $this->field['content'] ) ) ? $this->field['content'] : '';
			echo ( ! empty( $this->field['image'] ) ) ? '<img src="' . $this->field['image'] . '"/>' : '';
			echo ( ! empty( $this->field['after'] ) && ! empty( $this->field['link'] ) ) ? '<span class="spacer"></span><span class="support"><a href="' . $this->field['link'] . '">' . $this->field['after'] . '</a></span>' : '';
		}

	}
}
