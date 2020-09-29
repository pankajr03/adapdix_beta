<?php
/**
 * OLWS_Ringcaptcha_Api class.
 *
 * The class names need to defined in format: OLWS_%s_Api, where %s means Api name, e.g. OLWS_Ringcaptcha_Api
 * The class methods need to end with api key name
 *
 * @package Orion Login with SMS
 */

/**
 * Class OLWS_Ringcaptcha_Api class.
 */
class OLWS_Ringcaptcha_Api {

	/**
	 * Api Key
	 *
	 * @var string
	 */
	public $api_key;

	/**
	 * Api Secret
	 *
	 * @var string
	 */
	public $api_secret;

	/**
	 * Api Username
	 *
	 * @var string
	 */
	public $api_username;

	/**
	 * OLWS_Handle_Messaging constructor.
	 */
	public function __construct() {
		$plugin_settings    = get_option( 'olws_plugin_settings' );
		$this->api_key      = trim( $plugin_settings['api_key'] );
		$this->api_secret   = trim( $plugin_settings['api_secret'] );
		$this->api_username = trim( $plugin_settings['api_username'] );
	}

	/**
	 * Send the OTP via Ringcaptcha api.
	 *
	 * @param {int} $phone Phone number is without country code.
	 * @param {int} $country_code Country Code is without plus sign.
	 *
	 * @return {array} Returns result
	 */
	public function olws_send_otp( $phone, $country_code ) {

		$international_phone = $country_code . $phone;

		$api_url = 'https://api.ringcaptcha.com';
		$url     = sprintf( '%s/%s/code/sms', $api_url, $this->api_username );

		$response = wp_remote_post(
			$url,
			array(
				'method'      => 'POST',
				'timeout'     => 30,
				'redirection' => 10,
				'httpversion' => '1.1',
				'blocking'    => true,
				'headers'     => array(
					'Content-Type' => 'application/json; charset=utf-8',
				),
				'body'        => array(
					'api_key' => $this->api_key,
					'phone'   => sprintf( '+%s', $international_phone ),
				),
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
			$status           = isset( $decoded_response['status'] ) ? $decoded_response['status'] : '';
			$res_message      = isset( $decoded_response['message'] ) ? $decoded_response['message'] : '';

			if ( 'SUCCESS' === $status ) {
				$success            = true;
				$res_param['token'] = $decoded_response['token'];
			} else {
				$success = false;
				if ( 'ERROR_WAIT_TO_RETRY' === $res_message ) {
					$user_message = __( 'Wait for some time', 'orion-login' );
				} elseif ( 'ERROR_INVALID_NUMBER' === $res_message ) {
					$user_message = __( 'Invalid Phone Number', 'orion-login' );
				} else {
					$user_message = __( 'Api error', 'orion-login' );
					$dev_message  = $decoded_response;
				}
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

		$token = isset( $res_param['token'] ) ? $res_param['token'] : '';

		$api_url = 'https://api.ringcaptcha.com';
		$url     = sprintf( '%s/%s/verify', $api_url, $this->api_username );

		$response = wp_remote_post(
			$url,
			array(
				'method'      => 'POST',
				'timeout'     => 30,
				'redirection' => 10,
				'httpversion' => '1.1',
				'blocking'    => true,
				'headers'     => array(
					'Content-Type' => 'application/json; charset=utf-8',
				),
				'body'        => array(
					'api_key' => $this->api_key,
					'phone'   => sprintf( '+%s', $international_phone ),
					'code'    => $otp,
					'token'   => $token,
				),
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
			$status           = isset( $decoded_response['status'] ) ? $decoded_response['status'] : '';
			$res_message      = isset( $decoded_response['message'] ) ? $decoded_response['message'] : '';

			if ( 'SUCCESS' === $status ) {
				$success = true;
			} else {

				if ( 'ERROR_INVALID_PIN_CODE' === $res_message ) {
					$invalid_otp = true;
				} elseif ( 'ERROR_INVALID_NUMBER' === $res_message ) {
					$error_message = __( 'Invalid phone number', 'orion-login' );
				} else {
					$error_message = __( 'Api error', 'orion-login' );
					$dev_message   = $decoded_response;
				}
				$success = false;
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
