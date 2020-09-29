<?php
/**
 * Get User Data.
 *
 * @package Orion Login with SMS
 */

/**
 * Class OLWS_Get_User_Data class.
 */
class OLWS_Get_User_Data {
	/**
	 * WPCO_Get_User_Data constructor.
	 */
	public function __construct() {
		add_action( 'wp_ajax_olws_ajax_hook', array( $this, 'olws_get_users_data' ) );
		add_action( 'wp_ajax_nopriv_olws_ajax_hook', array( $this, 'olws_get_users_data' ) );
	}

	/**
	 * Get the data for matched users searched by the query string and pass it as success response to the request.done function in main.js
	 */
	public function olws_get_users_data() {

		// If nonce verification fails die.
		if ( isset( $_POST['security'] ) ) {
			$nonce_val = esc_html( wp_unslash( $_POST['security'] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		}

		if ( ! wp_verify_nonce( $nonce_val, 'olws_nonce_action_name' ) ) {
			wp_die();
		}

		$query = sanitize_text_field( wp_unslash( $_POST['query'] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput

		wp_send_json_success(
			array(
				'query' => $query,
			)
		);
	}
}

new OLWS_Get_User_Data();
