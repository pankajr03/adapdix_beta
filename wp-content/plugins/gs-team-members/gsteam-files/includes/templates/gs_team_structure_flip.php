<?php
/*
 * GS Team - Theme filter
 * @author Golam Samdani <samdani1997@gmail.com>
 * 
 */

// -- Function for GS Team Category
if ( !function_exists('gs_team_category')) {	
	function gs_team_category(){
	    global $post;
	    $gst_term = get_the_terms( $post->ID, 'team_group' );
	    if(!empty( $gst_term )){
		    $terms = get_the_terms( $post->ID, 'team_group' );
		                                                   
		    if ( $terms && ! is_wp_error( $terms ) ) :
		            $gs_team_cats_link = array();
		     
		            foreach ( $terms as $term ) {
		                $gs_team_cats_link[] = $term->name;
		            }
		             
		            $gs_team_cats_link = str_replace(' ', '-', $gs_team_cats_link);
		            $gs_team_cats = join( " ", $gs_team_cats_link );
		            $gs_team_cats = strtolower($gs_team_cats);      
		    endif;
		    return $gs_team_cats;  
	    }    
	} 
}

$gs_member_connect = gs_team_getoption('gs_member_connect', 'gs_team_settings', 'on');
$gs_tm_link_tar = gs_team_getoption('gs_tm_link_tar', 'gs_team_settings', '_blank');
$gs_member_name = gs_team_getoption('gs_member_name', 'gs_team_settings', 'on');
$gs_member_role = gs_team_getoption('gs_member_role', 'gs_team_settings', 'on');
$gs_member_pagination = gs_team_getoption('gs_member_pagination', 'gs_team_settings', 'on');
$gs_member_details = gs_team_getoption('gs_member_details', 'gs_team_settings', 'on');
$gs_tm_details_contl = gs_team_getoption('gs_tm_details_contl', 'gs_team_settings', 100);
$gs_member_srch_by_name = gs_team_getoption('gs_member_srch_by_name', 'gs_team_settings', 'on');
$gs_member_filter_by_desig = gs_team_getoption('gs_member_filter_by_desig', 'gs_team_settings', 'on');

$output .= '<div class="container">';
$output .= '<div class="row clearfix gs_team">';

	// Team cats for filtering
	$gs_team_terms = get_terms('team_group');
	
		

	

	if ( $GLOBALS['gs_team_loop']->have_posts() ) {
		
		while ( $GLOBALS['gs_team_loop']->have_posts() ) {
			$GLOBALS['gs_team_loop']->the_post();
			$gs_team_id = get_post_thumbnail_id();
			$gs_team_url = wp_get_attachment_image_src($gs_team_id, 'full', true);
			$team_thumb = $gs_team_url[0];
			$gs_team_alt = get_post_meta($gs_team_id,'_wp_attachment_image_alt',true);
			
			$gs_tm_meta = get_post_meta( get_the_id() );
			$designation = !empty($gs_tm_meta['_gs_des'][0]) ? $gs_tm_meta['_gs_des'][0] : '';
			$tm_design_string = str_replace(' ', '-', $designation);
			$gs_social  = get_post_meta( get_the_id(), 'gs_social', true);
			$gs_skill = get_post_meta(get_the_id(), 'gs_skill', true);
			$gs_ribon = get_post_meta( get_the_id(), '_gs_ribon', true );
			$gs_land = get_post_meta( get_the_id(), '_gs_land', true );
			$gs_cell = get_post_meta( get_the_id(), '_gs_cell', true );
			$gs_email = get_post_meta( get_the_id(), '_gs_email', true );
			//$gs_second_featured_img = get_post_meta( get_the_id(), 'second_featured_img', true );
			$gs_second_featured_img = wp_get_attachment_image_src( get_post_meta( get_the_id(), 'second_featured_img', true ), 'full' ) ;
							
			$output .= '<div class="gs-filter-single-item col-md-'.$cols.' col-sm-6 col-xs-6 '.gs_team_category().' '.$tm_design_string.'" data-category="'.gs_team_category().'" itemscope="" itemtype="http://schema.org/Person">';
			$output .= '<div class="flip-vertical">'; // flip container
				$output .= '<div class="single-member front">'; // start single member

					if ( has_post_thumbnail() )
			            $output .= '<img src="'. $team_thumb .'" alt="'. $gs_team_alt .'" itemprop="image"/>';
			        else {
			            $output .= '<img src="' . GSTEAM_FILES_URI . '/assets/img/no_img.png" class="abc"/>';
			        }
		        $output .= '</div>'; // 

		        if( !empty($gs_second_featured_img[0])):
		        $output .= '<div class="back">';
					$output .= '<img src="'. $gs_second_featured_img[0] .'" alt="'. $gs_team_alt .'" itemprop="image"/>';
					$output .= '<div class="flip-info">';
						if( !empty($gs_email)):
							$output .= '<div class="flip-info-email">'.$gs_email.'</div>';
						endif;
						if( !empty($gs_land)):
							$output .= '<div>'.$gs_land.'</div>';
						endif;
						if( !empty($gs_cell)):
							$output .= '<div>'.$gs_cell.'</div>';
						endif;
					$output .= '</div>';
  				$output .= '</div>'; 
  				endif;

			$output .= '</div>'; // end flip container

			if ( 'on' ==  $gs_member_name ) :
	            $output.= '<div class="gs-member-name" itemprop="name">'. get_the_title() .'</div>';
	        endif;

			if(!empty( $designation ) && 'on' == $gs_member_role ):
	        	$output.= '<div class="gs-member-desig" itemprop="jobtitle">'. $designation .'</div>';
	        endif;

			$output .= '</div>'; // end col
		} // end while loop
		do_action('gs_team_custom_css');

	} else {
		$output .= "No Team Member Added!";
	}

	wp_reset_postdata();

$output .= '</div>'; // end row

	if ( 'on' ==  $gs_member_pagination ) :
		$output .= gs_pagination();
	endif;

$output .= '</div>'; // end container
return $output;