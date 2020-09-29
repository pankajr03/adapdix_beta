<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: notice
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! class_exists( 'SPF_Field_notice' ) ) {
	class SPF_Field_notice extends SPF_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$style = ( ! empty( $this->field['style'] ) ) ? $this->field['style'] : 'normal';

			echo ( ! empty( $this->field['content'] ) ) ? '<div class="spf-notice spf-notice-' . $style . '">' . $this->field['content'] . '</div>' : '';

		}

	}
}
