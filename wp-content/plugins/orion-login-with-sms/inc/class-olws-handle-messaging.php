<?php
/**
 * Handle Messaging.
 *
 * @package Orion Login with SMS
 */

/**
 * Class OLWS_Handle_Messaging class.
 */
class OLWS_Handle_Messaging {

	/**
	 * Api Type.
	 *
	 * @var {String}
	 */
	public $api_type;

	/**
	 * Api Classname.
	 *
	 * @var {string}
	 */
	public $api_classname;

	/**
	 * OLWS_Handle_Messaging constructor.
	 */
	public function __construct() {
		$plugin_settings     = get_option( 'olws_plugin_settings' );
		$this->api_type      = $plugin_settings['api_type'];
		$this->api_classname = sprintf( 'OLWS_%s_Api', ucfirst( $this->api_type ) );
	}


	/**
	 * Generates the class name and the function name, dynamically,
	 * based on the api type selected by the user from WordPress dashboard settings page.
	 *
	 * The class names need to defined in format: OLWS_%s_Api, where %s means Api name, e.g. OLWS_Twilio_Api.
	 * The class methods need to defined in format: olws_send_otp_via_%s, where %s means Api name, e.g. olws_send_otp_via_twilio.
	 *
	 * @param {string} $phone Phone Number.
	 * @param {string} $country_code Country Code.
	 *
	 * @return {array} $result array( 'success' => bool, 'user_message' => '', 'dev_message' => '' )
	 */
	public function olws_send_otp( $phone, $country_code ) {

		$callable_func_name = 'olws_send_otp';
		$callable_class     = new $this->api_classname();

		$result = call_user_func( array( $callable_class, $callable_func_name ), $phone, $country_code );

		return $result;
	}

	/**
	 * Verifies OTP.
	 *
	 * @param {Int}    $phone Phone.
	 * @param {Int}    $country_code Country code.
	 * @param {String} $otp OTP.
	 * @param {Array}  $res_param Response parameter.
	 *
	 * @return mixed
	 */
	public function olws_verify_otp( $phone, $country_code, $otp, $res_param ) {

		$phone        = filter_var( $phone, FILTER_VALIDATE_INT );
		$country_code = filter_var( $country_code, FILTER_VALIDATE_INT );
		$otp          = filter_var( $otp, FILTER_SANITIZE_STRING );

		$callable_func_name = 'olws_verify_otp';
		$callable_class     = new $this->api_classname();
		$result             = call_user_func( array( $callable_class, $callable_func_name ), $phone, $country_code, $otp, $res_param );
		return $result;
	}

}
