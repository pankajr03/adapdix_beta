<?php
/* Define */
define( 'SP_TEAM_FREE_URL', plugins_url( '/' ) . plugin_basename( dirname( __FILE__ ) ) . '/' );
define( 'SP_TEAM_FREE_PATH', plugin_dir_path( __FILE__ ) );

/* Including files */
if ( file_exists( SP_TEAM_FREE_PATH . 'inc/scripts.php' ) ) {
	require_once SP_TEAM_FREE_PATH . 'inc/scripts.php';
}
if ( file_exists( SP_TEAM_FREE_PATH . 'inc/shortcodes.php' ) ) {
	require_once SP_TEAM_FREE_PATH . 'inc/shortcodes.php';
}
