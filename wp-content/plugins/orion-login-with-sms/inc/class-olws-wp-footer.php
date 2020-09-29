<?php
/**
 * Add Footer Div Element.
 *
 * @package Orion Login with SMS
 */

/**
 * Class OLWS_Wp_Footer class.
 */
class OLWS_Wp_Footer {
	/**
	 * OLWS_Wp_Footer constructor
	 */
	public function __construct() {
		add_action( 'wp_footer', array( $this, 'olws_add_footer_content' ), 10 );
	}

	/**
	 * Add Div for Login Popup
	 */
	public function olws_add_footer_content() {

		$is_user_logged_in = is_user_logged_in();
		if ( $is_user_logged_in ) {
			return;
		}
		echo "<div id='olws-root'></div>";
	}

}

new OLWS_Wp_Footer();
