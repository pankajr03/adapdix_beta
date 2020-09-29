<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

/**
 * Scripts and styles
 */
class SP_Team_Free_Scripts {

	/**
	 * Script version number
	 */
	protected $version;

	/**
	 * Initialize the class
	 */
	public function __construct() {
		$this->version = '20170420';

		add_action( 'wp_enqueue_scripts', array( $this, 'sp_team_free_front_scripts' ) );
	}

	/**
	 * Front Scripts
	 */
	public function sp_team_free_front_scripts() {
		// CSS Files.
		wp_enqueue_style( 'slick', SP_TEAM_FREE_URL . 'assets/css/slick.css', false, $this->version );
		wp_enqueue_style( 'font-awesome-min', SP_TEAM_FREE_URL . 'assets/css/font-awesome.min.css', false, $this->version );
		wp_enqueue_style( 'team-free-style', SP_TEAM_FREE_URL . 'assets/css/style.css', false, $this->version );

		// JS Files.
		wp_enqueue_script( 'slick-min-js', SP_TEAM_FREE_URL . 'assets/js/slick.min.js', array( 'jquery' ), $this->version, true );
	}

}
new SP_Team_Free_Scripts();
