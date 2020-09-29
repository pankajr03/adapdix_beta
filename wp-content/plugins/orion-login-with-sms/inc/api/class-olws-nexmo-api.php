<?php
/**
 * OLWS_Nexmo_Api class.
 *
 * The class names need to defined in format: OLWS_%s_Api, where %s means Api name, e.g. OLWS_Nexmo_Api
 * The class methods need to end with api key name
 *
 * @package Orion Login with SMS
 */

/**
 * Class OLWS_Nexmo_Api
 */
class OLWS_Nexmo_Api {
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
	 * Api Secret
	 *
	 * @var string
	 */
	public $api_secret;

	/**
	 * OLWS_Handle_Messaging constructor.
	 */
	public function __construct() {
		$plugin_settings  = get_option( 'olws_plugin_settings' );
		$this->api_key    = trim( $plugin_settings['api_key'] );
		$this->api_secret = trim( $plugin_settings['api_secret'] );
		$this->sender     = trim( $plugin_settings['sender_id'] );
	}

	/**
	 * Send the OTP via Clicksend api.
	 *
	 * @param {int} $phone Phone number is without country code.
	 * @param {int} $country_code Country Code is without plus sign.
	 *
	 * @return {array} Returns result
	 */
	public function olws_send_otp( $phone, $country_code ) {

		$international_phone = $country_code . $phone;

		$api_url = 'https://api.nexmo.com/verify/json';

		$url = sprintf( '%s?api_key=%s&api_secret=%s&number=%s&brand=%s&code_length=4', $api_url, $this->api_key, $this->api_secret, $international_phone, $this->sender );

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

		$user_message = '';
		$dev_message  = array();
		$res_param    = array();

		if ( is_wp_error( $response ) ) {
			$dev_message = $response->get_error_message();
			$success     = false;
		} else {
			$decoded_response = (array) json_decode( $response['body'] );
			$status           = isset( $decoded_response['status'] ) ? $decoded_response['status'] : '';

			if ( '0' === $status ) {
				$success                 = true;
				$res_param['request_id'] = $decoded_response['request_id'];
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
	 * Verifies otp.
	 *
	 * @param {Int}    $phone Phone.
	 * @param {Int}    $country_code Country Code.
	 * @param {String} $otp OTP.
	 * @param {Array}  $res_param Response Parameter.
	 *
	 * @return array
	 */
	public function olws_verify_otp( $phone, $country_code, $otp, $res_param ) {

		$request_id = isset( $res_param['request_id'] ) ? $res_param['request_id'] : '';

		$api_url = 'https://api.nexmo.com/verify/check/json';
		$url     = sprintf( '%s?api_key=%s&api_secret=%s&request_id=%s&code=%s', $api_url, $this->api_key, $this->api_secret, $request_id, $otp );

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

			$status = isset( $decoded_response['status'] ) ? $decoded_response['status'] : '';

			if ( '0' === $status ) {
				$success = true;
			} elseif ( '16' === $status ) {

				// Invalid Otp.
				$success     = false;
				$invalid_otp = true;
			} else {
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
