<?php
$g_post_details = get_post( $id );
$post_title = $g_post_details->post_title;

if ( get_post_status( $id ) != 'publish' || get_post_type( $id ) != 'super-simple-slider' ) {
	return;
}

$slides = get_post_meta( $id, 'super-simple-slider-slide-settings-group', true );

$settings = $this->settings['fields'];


$slider_settings = array();

foreach ( $settings as $name => $config ) {
	$slider_settings[$name] = $this->sanitize_field( get_post_meta( $id, $name, true ), $config['type'] );
}

if ( $slider_settings['super_simple_slider_type'] == 'Slider 1' ) {
	require_once('slider_type_1.php') ; 	
} else if ( $slider_settings['super_simple_slider_type'] == 'Slider 2' ) {
	// slider 
	require_once('slider_type_2.php') ; 	
} else if ( $slider_settings['super_simple_slider_type'] == 'EdgeOps Enterprise' ) {
	// slider 
	require_once('slider_edgeops_enterprise.php') ; 	
} else if ( $slider_settings['super_simple_slider_type'] == 'EdgeOps Platform' ) {
	// slider 
	require_once('slider_edgeops_platform.php') ; 	
} else if ( $slider_settings['super_simple_slider_type'] == 'Solutions EdgeOps Bring' ) {
	// slider 
	require_once('slider_solutions_bring.php') ; 	
} else if ( $slider_settings['super_simple_slider_type'] == 'Solutions Industry' ) {
	// slider 
	require_once('slider_solutions_industry.php') ; 	
} else if ( $slider_settings['super_simple_slider_type'] == 'Solutions Industry Slider' ) {
	// slider 
	require_once('slider_solutions_industry_slider.php') ; 	
} else if ( $slider_settings['super_simple_slider_type'] == 'Product Slider 1' ) {
	// slider 
	require_once('slider_product_slider_1.php') ; 	
} else if ( $slider_settings['super_simple_slider_type'] == 'Product Slider 2' ) {
	// slider 
	require_once('slider_product_slider_2.php') ; 	
} else if ( $slider_settings['super_simple_slider_type'] == 'Product Product Featured' ) {
	// slider 
	require_once('slider_product_product_features.php') ; 	
} else if ( $slider_settings['super_simple_slider_type'] == 'Product Benefits Across the Organization' ) {
	// slider 
	require_once('slider_product_benefits_across_the_organization.php') ; 	
} else if ( $slider_settings['super_simple_slider_type'] == 'Product Data Driven' ) {
	// slider 
	require_once('slider_product_data_driven.php') ; 	
} else if ( $slider_settings['super_simple_slider_type'] == 'Developer Site Mesh Flexx' ) {
	// slider 
	require_once('slider_developer_site_mesh_flexx.php') ; 	
}  else if ( $slider_settings['super_simple_slider_type'] == 'Developer Resiliency Reliable Quality' ) {
	// slider 
	require_once('slider_developer_resiliency_reliable_quality.php') ; 	
}  else if ( $slider_settings['super_simple_slider_type'] == 'Developer EdgeOps Technology' ) {
	// slider 
	require_once('slider_developer_edgeops_technology.php') ; 	
}  else {
	require_once('slider_type_3.php') ;
}
//