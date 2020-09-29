<?php
/**
 * OLWS_Twilio_Api class.
 *
 * The class names need to defined in format: OLWS_%s_Api, where %s means Api name, e.g. OLWS_Twilio_Api
 * The class methods need to end with api key name
 *
 * @package Orion Login with SMS
 */

/**
 * Class OLWS_Twilio_Api class.
 */
class OLWS_Twilio_Api {

	/**
	 * Api Key
	 *
	 * @var string
	 */
	public $api_key;

	/**
	 * OLWS_Handle_Messaging constructor.
	 */
	public function __construct() {
		$plugin_settings = get_option( 'olws_plugin_settings' );
		$this->api_key   = trim( $plugin_settings['api_key'] );
	}

	/**
	 * Send the OTP via Twilio api
	 *
	 * @param {int} $phone Phone number is without country code.
	 * @param {int} $country_code Country Code is without plus sign.
	 *
	 * @return {array} Returns result
	 */
	public function olws_send_otp( $phone, $country_code ) {

		$url      = 'https://api.authy.com/protected/json/phones/verification/start';
		$response = wp_remote_post(
			$url,
			array(
				'method'      => 'POST',
				'timeout'     => 30,
				'redirection' => 10,
				'httpversion' => '1.1',
				'blocking'    => true,
				'headers'     => array(),
				'body'        => array(
					'api_key'      => $this->api_key,
					'via'          => 'sms',
					'phone_number' => $phone,
					'country_code' => $country_code,
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
			$res_success      = isset( $decoded_response['success'] ) ? $decoded_response['success'] : false;
			$error_code       = isset( $decoded_response['error_code'] ) ? $decoded_response['error_code'] : '';

			if ( $res_success ) {
				$success = true;
			} elseif ( '60033' === $error_code ) {
				$success      = false;
				$user_message = __( 'Phone number is invalid', 'orion-login' );
			} elseif ( '60001' === $error_code ) {
				$success      = false;
				$user_message = __( 'Invalid API key', 'orion-login' );
			} elseif ( '60082' === $error_code ) {
				$success      = false;
				$user_message = __( 'Cannot send SMS to landline phone numbers', 'orion-login' );
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

		$url      = 'https://api.authy.com/protected/json/phones/verification/check';
		$response = wp_remote_post(
			$url,
			array(
				'method'      => 'GET',
				'timeout'     => 30,
				'redirection' => 10,
				'httpversion' => '1.1',
				'blocking'    => true,
				'headers'     => array(
					'X-Authy-Api-Key' => $this->api_key,
				),
				'body'        => array(
					'phone_number'      => $phone,
					'country_code'      => $country_code,
					'verification_code' => $otp,
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

			$res_success = isset( $decoded_response['success'] ) ? $decoded_response['success'] : false;
			$error_code  = isset( $decoded_response['error_code'] ) ? $decoded_response['error_code'] : '';

			if ( $res_success ) {
				$success = true;
			} elseif ( '60022' === $error_code ) {
				$success     = false;
				$invalid_otp = true;
			} elseif ( '60023' === $error_code ) {
				$success       = false;
				$invalid_otp   = false;
				$error_message = __( 'Phone number already verified', 'orion-login' );
			} else {
				$success       = false;
				$error_message = __( 'Api error', 'orion-login' );
				$dev_message   = $decoded_response;
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
