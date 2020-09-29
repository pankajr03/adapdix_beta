<?php
/**
 * OLWS_Clicksend_Api class.
 *
 * The class names need to defined in format: OLWS_%s_Api, where %s means Api name, e.g. OLWS_Clicksend_Api
 * The class methods need to end with api key name
 *
 * @package Orion Login with SMS
 */

/**
 * Class OLWS_Clicksend_Api class.
 */
class OLWS_Clicksend_Api {

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
	 * Api Username
	 *
	 * @var string
	 */
	public $username;

	/**
	 * OLWS_Handle_Messaging constructor.
	 */
	public function __construct() {
		$plugin_settings = get_option( 'olws_plugin_settings' );
		$this->api_key   = trim( $plugin_settings['api_key'] );
		$this->sender    = trim( $plugin_settings['sender_id'] );
		$this->username  = trim( $plugin_settings['api_username'] );
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

		$otp_sent = wp_rand( 1000, 9999 );

		$message = rawurlencode( "Your verification code is $otp_sent." );

		$international_phone = $country_code . $phone;

		$api_url = 'https://api-mapper.clicksend.com/http/v2/send.php';
		$url     = sprintf( '%s?username=%s&key=%s&to=+%s&message=%s&senderid=%s', $api_url, $this->username, $this->api_key, $international_phone, $message, $this->sender );

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

			$response          = $this->olws_xml_string_to_array( $response['body'] );
			$response_messages = isset( $response['messages'] ) ? $response['messages'] : false;

			if ( $response_messages && isset( $response_messages['message'] ) ) {

				$response_code = isset( $response_messages['message']['result'] ) ? $response_messages['message']['result'] : '';

				// Sms Sent.
				if ( '0000' === $response_code ) {
					$success             = true;
					$res_param['ref_id'] = $this->olws_generate_otp_hash( $country_code, $phone, $otp_sent );
				} else {
					$success     = false;
					$dev_message = $response_messages;

					switch ( $response_code ) {
						case '2015':
							$user_message = __( 'Invalid phone number', 'orion-login' );
							break;
						case '2016':
							$user_message = __( 'Message already sent!', 'orion-login' );
							break;
						default:
							$user_message = __( 'Api error', 'orion-login' );
							break;
					}
				}
			} else {
				$success      = false;
				$dev_message  = $response;
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
			$success     = false;
		}

		return array(
			'success'      => $success,
			'invalidOtp'   => $invalid_otp,
			'errorMessage' => $error_message,
			'devMessage'   => $dev_message,
		);

	}

	/**
	 * Convert XML Stinrg to Array
	 *
	 * @param {String} $xml_string XML String.
	 *
	 * @return array
	 */
	private function olws_xml_string_to_array( $xml_string ) {

		$xml   = simplexml_load_string( $xml_string, 'SimpleXMLElement', LIBXML_NOCDATA );
		$array = json_decode( wp_json_encode( $xml ), true );
		return $array;

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
