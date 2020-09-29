<?php
/**
 * Enqueue Scripts
 *
 * @package Orion Login with SMS
 */

/**
 * Class OLWS_Enqueue_Scripts class.
 */
class OLWS_Enqueue_Scripts {
	/**
	 * OLWS_Enqueue_Scripts constructor
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'olws_enqueue_scripts_dashboard' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'olws_enqueue_style_front_end' ) );
	}

	/**
	 * Enqueue Admin Styles
	 *
	 * @param {string} $hook Hook.
	 */
	public function olws_enqueue_scripts_dashboard( $hook ) {

		if ( 'toplevel_page_orion-login-settings' === $hook ) {
			wp_enqueue_style( 'ihs_otp_admin_font_awesome', '//use.fontawesome.com/releases/v5.8.1/css/all.css', '', '1.0' );
			wp_enqueue_style( 'ihs_otp_admin_bootstrap_styles', OLWS_CSS_URI . 'bootstrap.min.css', '', '1.0' );
			wp_register_style( 'olws_admin_styles', OLWS_CSS_URI . 'admin.css', '', '1.0.0', 'all' );
			wp_enqueue_style( 'olws_admin_styles' );

			wp_register_script( 'olws_admin_main_js', OLWS_JS_URI . 'admin.js', array(), '1.0.0', true );
			wp_enqueue_script( 'olws_admin_main_js' );
		}

	}

	/**
	 * Enqueue Front End Styles.
	 */
	public function olws_enqueue_style_front_end() {

		// Don't include styles & script if user is logged in.
		$is_user_logged_in = is_user_logged_in();
		if ( $is_user_logged_in ) {
			return;
		}

		// Check if the plugin status is active.
		$plugin_settings = get_option( 'olws_plugin_settings' );

		wp_register_style( 'olws_front_end_styles', OLWS_CSS_URI . 'style.css', '', '1.0.0', 'all' );
		wp_register_script( 'olws_react_main_js', OLWS_JS_DIST_URI . 'main.js', array(), '1.0.0', true );

		wp_enqueue_style( 'olws_front_end_styles' );
		wp_enqueue_script( 'olws_react_main_js' );

		$adaptive_style = ( '1' !== $plugin_settings['adaptive_style'] );

		if ( '' === $plugin_settings['login_btn_selector'] ) {
			wp_register_script( 'olws_main_js', OLWS_JS_URI . 'main.js', array(), '1.0.0', true );
			wp_enqueue_script( 'olws_main_js' );
			wp_localize_script(
				'olws_main_js',
				'olLoginForm',
				array(
					'selector'      => $plugin_settings['login_form_selector'],
					'btnText'       => __( 'Login With SMS', 'orion-login' ),
					'adaptiveStyle' => $adaptive_style,
				)
			);
		}

		$plugin_settings_js = array(
			'countryCode'      => $plugin_settings['country_code'],
			'loginBtnSelector' => $plugin_settings['login_btn_selector'],
			'mobileLength'     => $plugin_settings['mobile_length'],
			'imageBase'        => OLWS_IMAGE_URI,
			'adaptiveStyle'    => $adaptive_style,
		);

		wp_localize_script(
			'olws_react_main_js',
			'olwsLoginData',
			array(
				'ajaxUrl'        => admin_url( 'admin-ajax.php' ), // admin_url( 'admin-ajax.php' ) returns the url till admin-ajax.php file of wordpress.
				'ajaxNonce'      => wp_create_nonce( 'olws_nonce_action_name' ),  // Create nonce and send it to js file in olwsLoginData.ajax_nonce.
				'pluginSettings' => $plugin_settings_js,
				'wpmlMessages'   => $this->olws_generate_translated_msgs(),
			)
		);

	}

	/**
	 * Generate translated Messages
	 *
	 * @return {array} $messages
	 */
	public function olws_generate_translated_msgs() {

		$messages = array(
			'pleaseEnterPhoneNumber'      => __( 'Please enter phone number', 'orion-login' ),
			'pleaseEnter'                 => __( 'Please enter', 'orion-login' ),
			'digitPhoneNumber'            => __( 'digit phone number', 'orion-login' ),
			'userNotFound'                => __( 'User not found', 'orion-login' ),
			'sending'                     => __( 'Sending...', 'orion-login' ),
			'loginWithSms'                => __( 'Login With SMS', 'orion-login' ),
			'verificationCodeSent'        => __( 'A verification code has been sent to', 'orion-login' ),
			'phoneNumber'                 => __( 'Phone Number', 'orion-login' ),
			'enterPhoneNumber'            => __( 'Enter phone number', 'orion-login' ),
			'verificationCode'            => __( 'Verification Code', 'orion-login' ),
			'enterVerificationCode'       => __( 'Enter verification code', 'orion-login' ),
			'sendVerificationCode'        => __( 'Send Verification Code', 'orion-login' ),
			'close'                       => __( 'Close', 'orion-login' ),
			'verifying'                   => __( 'Verifying...', 'orion-login' ),
			'youWillBeLoggedin'           => __( 'You will now be logged in...', 'orion-login' ),
			'pleaseEnterVerificationCode' => __( 'Please enter verification code', 'orion-login' ),
			'verifyAndLogin'              => __( 'Verify & Login', 'orion-login' ),
			'resendVerificationCode'      => __( 'Resend Verification Code', 'orion-login' ),
		);

		return $messages;
	}
}

new OLWS_Enqueue_Scripts();
