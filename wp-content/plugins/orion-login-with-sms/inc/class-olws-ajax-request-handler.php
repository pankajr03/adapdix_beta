<?php
/**
 * Ajax Request Handler
 *
 * @package Orion Login with SMS
 */

/**
 * Class OLWS_Ajax_Request_Handler class.
 */
class OLWS_Ajax_Request_Handler {

	/**
	 * OLWS_Authenticate_User Class Object.
	 *
	 * @since 1.0.0
	 * @var {obj}
	 */
	public $authenticate_user;

	/**
	 * OLWS_Handle_Messaging Class object.
	 *
	 * @since 1.0.0
	 * @var {obj}
	 */
	public $handle_messaging;

	/**
	 * Plugin Settings
	 *
	 * @since 1.0.0
	 * @var {array}
	 */
	public $plugin_settings;

	/**
	 * OLWS_Ajax_Request_Handler constructor.
	 */
	public function __construct() {

		$this->authenticate_user = new OLWS_Authenticate_User();
		$this->handle_messaging  = new OLWS_Handle_Messaging();
		$this->plugin_settings   = get_option( 'olws_plugin_settings' );

		/**
		 * Verify Phone Number.
		 * Action name: olws_verify_phone .
		 */
		add_action( 'wp_ajax_nopriv_olws_verify_phone', array( $this, 'olws_handle_verify_phone' ) );
		/**
		 * Verify OTP
		 * Action name: olws_verify_otp
		 */
		add_action( 'wp_ajax_nopriv_olws_verify_otp', array( $this, 'olws_handle_otp_verification' ) );
	}

	/**
	 * Handle User verification with phone and sending OTP
	 * Checks if user with the
	 */
	public function olws_handle_verify_phone() {
		// If nonce verification fails die.
		if ( isset( $_POST['security'] ) ) {
			$nonce_val = esc_html( wp_unslash( $_POST['security'] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		}

		if ( ! wp_verify_nonce( $nonce_val, 'olws_nonce_action_name' ) ) {
			wp_die();
		}

		$verification_code_sent = false;
		$phone                  = isset( $_POST['phone'] ) ? $_POST['phone'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
		$phone                  = preg_replace( '/[^0-9]/', '', $phone );
		$phone                  = sanitize_text_field( wp_unslash( $phone ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

		$user = $this->authenticate_user->olws_user_exists_via_phone( $phone );

		$user_exits = ! ! count( $user );

		if ( $user_exits ) {

			$phone        = $this->olws_remove_country_code( $phone );
			$country_code = $this->plugin_settings['country_code'];

			$verification_code_sent = $this->handle_messaging->olws_send_otp(
				$phone,
				$country_code
			);
		}

		wp_send_json_success(
			array(
				'userExits' => $user_exits,
				'smsSent'   => $verification_code_sent,

			)
		);
	}

	/**
	 * Handle OTP verification
	 */
	public function olws_handle_otp_verification() {

		// If nonce verification fails die.
		if ( isset( $_POST['security'] ) ) {
			$nonce_val = esc_html( wp_unslash( $_POST['security'] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		}

		if ( ! wp_verify_nonce( $nonce_val, 'olws_nonce_action_name' ) ) {
			wp_die();
		}

		$verified       = false;
		$user_logged_in = false;
		$error_message  = '';
		$redirect_url   = get_site_url();
		$dev_message    = '';

		if ( ! empty( $_POST['phone'] ) && ! empty( $_POST['otp'] ) ) {

			$phone = isset( $_POST['phone'] ) ? $_POST['phone'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
			$phone = preg_replace( '/[^0-9]/', '', $phone );
			$phone = sanitize_text_field( wp_unslash( $phone ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

			$user_otp = isset( $_POST['otp'] ) ? $_POST['otp'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
			$user_otp = preg_replace( '/[^0-9]/', '', $user_otp );
			$user_otp = sanitize_text_field( wp_unslash( $user_otp ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

			$res_param = isset( $_POST['resParam'] ) ? $_POST['resParam'] : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
			$res_param = $this->olws_sanitize_array( $res_param ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput

			$phone_without_country = $this->olws_remove_country_code( $phone );

			$result = $this->handle_messaging->olws_verify_otp(
				(int) $phone_without_country,
				(int) $this->plugin_settings['country_code'],
				(string) $user_otp,
				(array) $res_param
			);

			$dev_message = $result['devMessage'];

			// If verification successful.
			if ( true === $result['success'] ) {

				// Verification code is correct.
				$verified = true;

				$user       = $this->authenticate_user->olws_user_exists_via_phone( $phone );
				$user_exits = ! ! count( $user );

				if ( $user_exits ) {
					$this->olws_login_user( $user[0]->ID );
					$user_logged_in = true;
				} else {
					$error_message = __( 'User not found', 'orion-login' );
				}
			} elseif ( true === $result['invalidOtp'] ) {
				$error_message = __( 'Verification code is invalid', 'orion-login' );
			} else {
				$error_message = $result['errorMessage'];
			}
		}

		wp_send_json_success(
			array(
				'verified'     => $verified,
				'loginStatus'  => $user_logged_in,
				'errorMessage' => $error_message,
				'redirectUrl'  => $redirect_url,
				'devMessage'   => $dev_message,
			)
		);

	}

	/**
	 * Login User.
	 *
	 * @param {INT} $user_id User Id.
	 */
	private function olws_login_user( $user_id ) {

		// If nonce verification fails die.
		if ( isset( $_POST['security'] ) ) {
			$nonce_val = esc_html( wp_unslash( $_POST['security'] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		}

		if ( ! wp_verify_nonce( $nonce_val, 'olws_nonce_action_name' ) ) {
			wp_die();
		}

		// Login user.
		if ( $user_id < 1 ) {
			return;
		}

		wp_clear_auth_cookie();
		wp_set_current_user( $user_id );
		wp_set_auth_cookie( $user_id );
	}

	/**
	 * Remove country code from phone number.
	 *
	 * @param {Int} $phone Phone number.
	 *
	 * @return string|string[]|null $phone_without_country_code Phone number without country code.
	 */
	private function olws_remove_country_code( $phone ) {

		$country_code               = $this->plugin_settings['country_code'];
		$match                      = '/^' . $country_code . '/';
		$phone_without_country_code = preg_replace( $match, '', $phone );
		return $phone_without_country_code;
	}

	/**
	 * Sanitize array ( using for some API ).
	 *
	 * @param {array} $input Input.
	 *
	 * @return {array} $new_input Sanitized input.
	 */
	private function olws_sanitize_array( $input ) {

		// Initialize the new array that will hold the sanitize values.
		$new_input = array();

		// Loop through the input and sanitize each of the values.
		foreach ( $input as $key => $val ) {
			$new_input[ $key ] = sanitize_text_field( $val );
		}
		return $new_input;
	}

}

new OLWS_Ajax_Request_Handler();
