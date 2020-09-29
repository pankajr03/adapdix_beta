<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! class_exists( 'SPF_Field_backup' ) ) {
	class SPF_Field_backup extends SPF_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			$unique = $this->unique;
			$nonce  = wp_create_nonce( 'spf_backup_nonce' );
			$export = add_query_arg(
				array(
					'action' => 'spf-export',
					'export' => $unique,
					'nonce'  => $nonce,
				), admin_url( 'admin-ajax.php' )
			);

			echo $this->field_before();

			echo '<textarea name="spf_transient[spf_import_data]" class="spf-import-data"></textarea>';
			echo '<button type="submit" class="button button-primary spf-confirm spf-import" data-unique="' . $unique . '" data-nonce="' . $nonce . '">' . esc_html__( 'Import', 'spf' ) . '</button>';
			echo '<small>( ' . esc_html__( 'copy-paste your backup string here', 'spf' ) . ' )</small>';

			echo '<hr />';
			echo '<textarea readonly="readonly" class="spf-export-data">' . json_encode( get_option( $unique ) ) . '</textarea>';
			echo '<a href="' . esc_url( $export ) . '" class="button button-primary sp-export" target="_blank">' . esc_html__( 'Export and Download Backup', 'spf' ) . '</a>';

			echo '<hr />';
			echo '<button type="submit" name="spf_transient[spf_reset_all]" value="spf_reset_all" class="button button-primary spf-warning-primary spf-confirm spf-reset" data-unique="' . $unique . '" data-nonce="' . $nonce . '">' . esc_html__( 'Reset All', 'spf' ) . '</button>';
			echo '<small class="spf-text-error">' . esc_html__( 'Please be sure for reset all of options.', 'spf' ) . '</small>';

			echo $this->field_after();

		}

	}
}
