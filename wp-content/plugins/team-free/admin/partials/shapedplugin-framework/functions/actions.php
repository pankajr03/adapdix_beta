<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Get icons from admin ajax
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_get_icons' ) ) {
	function spf_get_icons() {

		if ( ! empty( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'spf_icon_nonce' ) ) {

			ob_start();

			SPF::include_plugin_file( 'fields/icon/default-icons.php' );

			$icon_lists = apply_filters( 'spf_field_icon_add_icons', spf_get_default_icons() );

			if ( ! empty( $icon_lists ) ) {

				foreach ( $icon_lists as $list ) {

					echo ( count( $icon_lists ) >= 2 ) ? '<div class="spf-icon-title">' . $list['title'] . '</div>' : '';

					foreach ( $list['icons'] as $icon ) {
						echo '<a class="spf-icon-tooltip" data-spf-icon="' . $icon . '" title="' . $icon . '"><span class="spf-icon spf-selector"><i class="' . $icon . '"></i></span></a>';
					}
				}
			} else {

				  echo '<div class="spf-text-error">' . esc_html__( 'No data provided by developer', 'spf' ) . '</div>';

			}

			wp_send_json_success(
				array(
					'success' => true,
					'content' => ob_get_clean(),
				)
			);

		} else {

			wp_send_json_error(
				array(
					'success' => false,
					'error'   => esc_html__( 'Error while saving.', 'spf' ),
					'debug'   => $_REQUEST,
				)
			);

		}

	}
	add_action( 'wp_ajax_spf-get-icons', 'spf_get_icons' );
}

/**
 *
 * Export
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_export' ) ) {
	function spf_export() {

		if ( ! empty( $_GET['export'] ) && ! empty( $_GET['nonce'] ) && wp_verify_nonce( $_GET['nonce'], 'spf_backup_nonce' ) ) {

			header( 'Content-Type: application/json' );
			header( 'Content-disposition: attachment; filename=backup-' . gmdate( 'd-m-Y' ) . '.json' );
			header( 'Content-Transfer-Encoding: binary' );
			header( 'Pragma: no-cache' );
			header( 'Expires: 0' );

			echo json_encode( get_option( wp_unslash( $_GET['export'] ) ) );

		}

		die();
	}
	add_action( 'wp_ajax_spf-export', 'spf_export' );
}


/**
 *
 * Import Ajax
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_import_ajax' ) ) {
	function spf_import_ajax() {

		if ( ! empty( $_POST['import_data'] ) && ! empty( $_POST['unique'] ) && ! empty( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'spf_backup_nonce' ) ) {

			$import_data = unserialize( stripslashes( trim( $_POST['import_data'] ) ) );

			if ( is_array( $import_data ) ) {

				update_option( wp_unslash( $_POST['unique'] ), wp_unslash( $import_data ) );
				wp_send_json_success( array( 'success' => true ) );

			}
		}

		wp_send_json_error(
			array(
				'success' => false,
				'error'   => esc_html__( 'Error while saving.', 'spf' ),
				'debug'   => $_REQUEST,
			)
		);

	}
	add_action( 'wp_ajax_spf-import', 'spf_import_ajax' );
}

/**
 *
 * Reset Ajax
 *
 * @since 2.0
 * @version 2.0
 */
if ( ! function_exists( 'spf_reset_ajax' ) ) {
	function spf_reset_ajax() {

		if ( ! empty( $_POST['unique'] ) && ! empty( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'spf_backup_nonce' ) ) {
			delete_option( wp_unslash( $_POST['unique'] ) );
			wp_send_json_success( array( 'success' => true ) );
		}

		wp_send_json_error(
			array(
				'success' => false,
				'error'   => esc_html__( 'Error while saving.', 'spf' ),
				'debug'   => $_REQUEST,
			)
		);
	}
	add_action( 'wp_ajax_spf-reset', 'spf_reset_ajax' );
}
