<?php
/**
 * Authenticate User
 *
 * @package Orion Login with SMS
 */

/**
 * Class OLWS_Authenticate_User class.
 */
class OLWS_Authenticate_User {

	/**
	 * OLWS_Authenticate_User constructor.
	 */
	public function __construct() {
		$this->plugin_settings = get_option( 'olws_plugin_settings' );
	}

	/**
	 * Check if the user with given meta key and meta value exists.
	 *
	 * @param {String} $meta_value Meta Value.
	 *
	 * @return {array} Returns User data on success and empty array on failure.
	 */
	public function olws_user_exists_via_phone( $meta_value ) {

		$meta_key     = $this->plugin_settings['olws_phone_meta_key'];
		$saved_with   = $this->plugin_settings['saved_with_country_code'];
		$country_code = $this->plugin_settings['country_code'];

		if ( 'no' === $saved_with ) {
			$match      = '/^' . $country_code . '/';
			$meta_value = preg_replace( $match, '', $meta_value );
		} elseif ( 'with-plus-sign' === $saved_with ) {
			$meta_value = '+' . $meta_value;
		}

		$meta_value = sanitize_text_field( wp_unslash( $meta_value ) );

		$args = array(
			'meta_key'   => $meta_key, // phpcs:ignore WordPress.DB.SlowDBQuery
			'meta_value' => $meta_value, // phpcs:ignore WordPress.DB.SlowDBQuery
		);

		return get_users( $args );
	}
}

new OLWS_Authenticate_User();
