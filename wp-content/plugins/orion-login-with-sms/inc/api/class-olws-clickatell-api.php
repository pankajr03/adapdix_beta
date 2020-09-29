<?php
/**
 * OLWS_Clickatell_Api class.
 *
 * The class names need to defined in format: OLWS_%s_Api, where %s means Api name, e.g. OLWS_Clickatell_Api
 * The class methods need to end with api key name
 *
 * @package Orion Login with SMS
 */

/**
 * Class OLWS_Clickatell_Api
 */
class OLWS_Clickatell_Api {

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
	 * Send the OTP via Clickatell api
	 *
	 * @param {int} $phone Phone number is without country code.
	 * @param {int} $country_code Country Code is without plus sign.
	 *
	 * @return {array} Returns result
	 */
	public function olws_send_otp( $phone, $country_code ) {

		$international_phone = $country_code . $phone;

		$otp_sent = wp_rand( 1000, 9999 );

		$message = rawurlencode( "Your verification code is $otp_sent." );

		$api_url = 'https://platform.clickatell.com/messages/http/send';
		$url     = sprintf( '%s?apiKey=%s&to=%s&content=%s', $api_url, $this->api_key, $international_phone, $message );

		$response = wp_remote_post(
			$url,
			array(
				'method'      => 'GET',
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
			$decoded_response = json_decode( $response['body'] );

			if ( $decoded_response->messages && null === $decoded_response->errorCode ) { // phpcs:ignore WordPress.NamingConventions.ValidVariableName

				if ( $decoded_response->messages[0] && null !== $decoded_response->messages[0]->apiMessageId ) {
					$success             = true;
					$res_param['ref_id'] = $this->olws_generate_otp_hash( $country_code, $phone, $otp_sent );
				} else {
					$success      = false;
					$user_message = __( 'Api error', 'orion-login' );
					$dev_message  = $decoded_response;
				}
			} else {
				$success      = false;
				$user_message = __( 'Api error', 'orion-login' );
				$dev_message  = $decoded_response;
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

		$ref_id = isset( $res_param['ref_id'] ) ? $res_param['ref_id'] : '';

		$new_hash = $this->olws_generate_otp_hash( $country_code, $phone, $otp );

		$success       = false;
		$invalid_otp   = false;
		$error_message = '';
		$dev_message   = '';

		if ( '' !== $ref_id && $ref_id === $new_hash ) {
			$success = true;
		} else {
			$invalid_otp = true;
		}

		return array(
			'success'      => $success,
			'invalidOtp'   => $invalid_otp,
			'errorMessage' => $error_message,
			'devMessage'   => $dev_message,
		);

	}

	/**
	 * Generate OTP Hash
	 *
	 * @param {Int}    $country_code Country Code.
	 * @param {Int}    $phone Phone.
	 * @param {String} $otp OTP.
	 *
	 * @return string
	 */
	private function olws_generate_otp_hash( $country_code, $phone, $otp ) {

		$mobile_number = $country_code . $phone;

		$str_mobile = strval( trim( $mobile_number ) );
		$str_otp    = strval( trim( $otp ) );
		$hash       = md5( $str_mobile . $str_otp );
		return $hash;
	}

}
