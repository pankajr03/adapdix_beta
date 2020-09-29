<?php

if ( ! function_exists('enqueue_gs_team_admin_style')) {
	function enqueue_gs_team_admin_style($screen){
		$s_action = $screen->action;
		$s_post_type = $screen->post_type;
		$s_parent_base = $screen->parent_base;
		$s_base = $screen->base;

		if(($s_action == 'add' || $s_action == null) && $s_base == 'post' && $s_post_type == 'gs_team'){
			add_action('admin_enqueue_scripts', function(){

			$media = 'all';
			wp_register_style( 'gs-team-admin', GSTEAM_FILES_URI . '/assets/css/gs-team-admin.css', '', GSTEAM_VERSION, $media );
	        wp_enqueue_style( 'gs-team-admin' );
			} );
		}
	}
	add_action('current_screen', 'enqueue_gs_team_admin_style');
}
function gs_team_enqueue_admin_script( ) {
	$media='all';
	wp_register_style( 'team_vendor_admin_css', GSTEAM_FILES_URI . '/admin/css/team_vendor_admin.css', '', GSTEAM_VERSION, $media );
    wp_enqueue_style( 'team_vendor_admin_css' );
        
    wp_enqueue_script( 'gs_team_select_2', GSTEAM_FILES_URI . '/admin/js/select2.min.js', array('jquery'), GSTEAM_VERSION,true );
    wp_enqueue_script( 'my_custom_script', GSTEAM_FILES_URI . '/admin/js/team-admin.js', array('jquery'), GSTEAM_VERSION,true );
}
add_action( 'admin_enqueue_scripts', 'gs_team_enqueue_admin_script' );

// -- Include js files
if ( ! function_exists('gs_enqueue_team_scripts') ) {
	function gs_enqueue_team_scripts() {
		if (!is_admin()) {
			wp_register_script('gsteam-vendor-js', GSTEAM_FILES_URI . '/assets/js/gs_team_vendor.js', array('jquery'), GSTEAM_VERSION, true);
			wp_enqueue_script('gsteam-vendor-js');

			wp_register_script('gsteam-custom-js', GSTEAM_FILES_URI . '/assets/js/gs-team.custom.js', array('jquery'), GSTEAM_VERSION, true);
			wp_enqueue_script('gsteam-custom-js');
		}	
	}
	add_action( 'wp_enqueue_scripts', 'gs_enqueue_team_scripts' ); 
}

// -- Include css files
if ( ! function_exists('gs_enqueue_team_styles') ) {
	function gs_enqueue_team_styles() {
		if (!is_admin()) {
			$media = 'all';
			wp_register_style('gsteam-vendor', GSTEAM_FILES_URI . '/assets/css/team-vendor.css','', GSTEAM_VERSION, $media);
			wp_enqueue_style('gsteam-vendor');
			// Plugin main stylesheet
			wp_register_style('gs_team_csutom_css', GSTEAM_FILES_URI . '/assets/css/gs-team-custom.css','', GSTEAM_VERSION, $media);
			wp_enqueue_style('gs_team_csutom_css');			
		}
	}
	add_action( 'init', 'gs_enqueue_team_styles' );
}

// -- Team Custom CSS
if ( !function_exists('gs_team_custom_style')) {
	function gs_team_custom_style() {

		$gs_tm_custom_css = gs_team_getoption('gs_tm_custom_css', 'gs_team_style_settings', '');

		if( isset($gs_tm_custom_css) && !empty($gs_tm_custom_css) ){
			?>
				<style type="text/css">
					<?php echo $gs_tm_custom_css;?>
				</style>
			<?php
		}
	}
	add_action( 'gs_team_custom_css','gs_team_custom_style' );
}