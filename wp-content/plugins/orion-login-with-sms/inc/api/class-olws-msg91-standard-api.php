<?php
/**
 * OLWS_Msg91_Standard_Api class.
 *
 * The class names need to defined in format: OLWS_%s_Api, where %s means Api name, e.g. OLWS_Msg91_Standard_Api
 * The class methods need to end with api key name
 *
 * @package Orion Login with SMS
 */

/**
 * Class OLWS_Msg91_Standard_Api
 */
class OLWS_Msg91_Standard_Api {

	/**
	 * Api Key
	 *
	 * @var string
	 */
	public $api_key;

	/**
	 * Sender Id
	 *
	 * @var string
	 */
	public $sender;

	/**
	 * OLWS_Handle_Messaging constructor.
	 */
	public function __construct() {
		$plugin_settings = get_option( 'olws_plugin_settings' );
		$this->api_key   = trim( $plugin_settings['api_key'] );
		$this->sender    = trim( $plugin_settings['sender_id'] );
	}

	/**
	 * Send the OTP via MSG91 Standard api
	 *
	 * @param {int} $phone Phone number is without country code.
	 * @param {int} $country_code Country Code is without plus sign.
	 *
	 * @return {array} Returns result
	 */
	public function olws_send_otp( $phone, $country_code ) {

		$message             = rawurlencode( 'Your verification code is ##OTP##.' );
		$international_phone = $country_code . $phone;

		$api_url = 'https://control.msg91.com/api/sendotp.php';
		$url     = sprintf( '%s?authkey=%s&message=%s&sender=%s&mobile=%s&otp_expiry=300', $api_url, $this->api_key, $message, $this->sender, $international_phone );

		$response = wp_remote_post(
			$url,
			array(
				'method'      => 'POST',
				'timeout'     => 30,
				'redirection' => 10,
				'httpversion' => '1.1',
				'blocking'    => true,
				'headers'     => array(),
				'body'        => array(),
				'cookies'     => array(),
			)
		);

		$user_message = '';
		$dev_message  = array();
		$res_param    = array();

		if ( is_wp_error( $response ) ) {
			$dev_message = $response->get_error_message();
			$success     = false;
		} else {
			$decoded_response = (array) json_decode( $response['body'] );
			$type             = isset( $decoded_response['type'] ) ? $decoded_response['type'] : '';

			if ( 'success' === $type ) {
				$success = true;
			} else {
				$success      = false;
				$user_message = __( 'Api error', 'orion-login' );
			}
		}

		return array(
			'success'     => $success,
			'userMessage' => $user_message,
			'devMessage'  => $dev_message,
			'resParam'    => $res_param,
		);
	}

	/**
	 * Verifies otp
	 *
	 * @param {Int}    $phone Phone.
	 * @param {Int}    $country_code Country Code.
	 * @param {String} $otp OTP.
	 * @param {Array}  $res_param Response Parameter.
	 *
	 * @return array
	 */
	public function olws_verify_otp( $phone, $country_code, $otp, $res_param ) {

		$international_phone = $country_code . $phone;

		$api_url = 'https://control.msg91.com/api/verifyRequestOTP.php';
		$url     = sprintf( '%s?authkey=%s&mobile=%s&otp=%s', $api_url, $this->api_key, $international_phone, $otp );

		$response = wp_remote_post(
			$url,
			array(
				'method'      => 'GET',
				'timeout'     => 30,
				'redirection' => 10,
				'httpversion' => '1.1',
				'blocking'    => true,
				'headers'     => array(
					'content-type: application/x-www-form-urlencoded',
				),
				'body'        => array(),
				'cookies'     => array(),
			)
		);

		$invalid_otp   = false;
		$error_message = '';
		$dev_message   = '';

		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			$success       = false;
		} else {
			$decoded_response = (array) json_decode( $response['body'] );
			$type             = isset( $decoded_response['type'] ) ? $decoded_response['type'] : '';

			if ( 'success' === $type ) {
				$success = true;
			} else {

				if ( 'otp_not_verified' === $decoded_response['message'] ) {
					$invalid_otp = true;
				}

				$success       = false;
				$error_message = __( 'Api error', 'orion-login' );
			}
		}

		return array(
			'success'      => $success,
			'invalidOtp'   => $invalid_otp,
			'errorMessage' => $error_message,
			'devMessage'   => $dev_message,
		);

	}

}
