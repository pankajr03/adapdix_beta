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
	            $gs_team_cats_link=preg_replace('/[^A-Za-z0-9\-]/', '', $gs_team_cats_link);
	            $gs_team_cats = join( " ", $gs_team_cats_link );
	            $gs_team_cats = strtolower($gs_team_cats);      
		    endif;
		    return $gs_team_cats;  
	    }    
	} 
}


if ( !function_exists('gs_team_location_loc')) {	
	function gs_team_location_loc(){
	    global $post;
	    if(!empty(get_the_terms( $post->ID, 'team_location' ))){
		    $terms = get_the_terms( $post->ID, 'team_location' );
		                                                   
		    if ( $terms && ! is_wp_error( $terms ) ) :
	            $gs_team_cats_link = array();
	     
	            foreach ( $terms as $term ) {
	                $gs_team_cats_link[] = $term->name;
	            }
	             
	            $gs_team_cats_link = str_replace(' ', '-', $gs_team_cats_link);
	            $gs_team_cats_link=preg_replace('/[^A-Za-z0-9\-]/', '', $gs_team_cats_link);
	            $gs_team_cats = join( " ", $gs_team_cats_link );
	            $gs_team_cats = strtolower($gs_team_cats);      
		    endif;
		    return $gs_team_cats;  
	    }    
	} 
}

if ( !function_exists('gs_team_language_filter')) {	
	function gs_team_language_filter(){
	    global $post;
	    if(!empty(get_the_terms( $post->ID, 'team_language' ))){
		    $terms = get_the_terms( $post->ID, 'team_language' );
		                                                   
		    if ( $terms && ! is_wp_error( $terms ) ) :
	            $gs_team_cats_link = array();
	     
	            foreach ( $terms as $term ) {
	                $gs_team_cats_link[] = $term->name;
	            }
	             
	            $gs_team_cats_link = str_replace(' ', '-', $gs_team_cats_link);
	            $gs_team_cats_link=preg_replace('/[^A-Za-z0-9\-]/', '', $gs_team_cats_link);
	            $gs_team_cats = join( " ", $gs_team_cats_link );
	            $gs_team_cats = strtolower($gs_team_cats);      
		    endif;
		    return $gs_team_cats;  
	    }    
	} 
}

if ( !function_exists('gs_team_gender_filter')) {	
	function gs_team_gender_filter(){
	    global $post;
	    if(!empty(get_the_terms( $post->ID, 'team_gender' ))){
		    $terms = get_the_terms( $post->ID, 'team_gender' );
		                                                   
		    if ( $terms && ! is_wp_error( $terms ) ) :
	            $gs_team_cats_link = array();
	     
	            foreach ( $terms as $term ) {
	                $gs_team_cats_link[] = $term->name;
	            }
	             
	            $gs_team_cats_link = str_replace(' ', '-', $gs_team_cats_link);
	            $gs_team_cats_link=preg_replace('/[^A-Za-z0-9\-]/', '', $gs_team_cats_link);
	            $gs_team_cats = join( " ", $gs_team_cats_link );
	            $gs_team_cats = strtolower($gs_team_cats);      
		    endif;
		    return $gs_team_cats;  
	    }    
	} 
}

if ( !function_exists('gs_team_specialty_filter')) {	
	function gs_team_specialty_filter(){
	    global $post;
	    if(!empty(get_the_terms( $post->ID, 'team_specialty' ))){
		    $terms = get_the_terms( $post->ID, 'team_specialty' );
		                                                   
		    if ( $terms && ! is_wp_error( $terms ) ) :
	            $gs_team_cats_link = array();
	     
	            foreach ( $terms as $term ) {
	                $gs_team_cats_link[] = $term->name;
	            }
	             
	            $gs_team_cats_link = str_replace(' ', '-', $gs_team_cats_link);
	            $gs_team_cats_link=preg_replace('/[^A-Za-z0-9\-]/', '', $gs_team_cats_link);
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
$gs_member_filter_by_Location = gs_team_getoption('gs_member_filter_by_Location', 'gs_team_settings', 'on');
$gs_member_filter_by_language = gs_team_getoption('gs_member_filter_by_language', 'gs_team_settings', 'on');
$gs_member_filter_by_gender = gs_team_getoption('gs_member_filter_by_gender', 'gs_team_settings', 'on');
$gs_member_filter_by_speciality = gs_team_getoption('gs_member_filter_by_speciality', 'gs_team_settings', 'on');
$gs_teamfliter_designation = gs_team_getoption('gs_teamfliter_designation', 'gs_team_adv_settings', 'Show All Designation');
$gs_teamfliter_name = gs_team_getoption('gs_teamfliter_name', 'gs_team_adv_settings', 'Search By Name');

$output .= '<div class="container ccbp-so-scroller" id="ccbp-so-scroller"">';


	// Team cats for filtering
	$gs_team_terms = get_terms('team_group');
	
		
	// $output .= '<ul class="gs-team-filter-cats" style="display:'. $cats_name .';">';
 //        $output .= '<li class="filter" data-filter="all">All</li>';
	// 	foreach ( $gs_team_terms as $term ) {
	// 		$gs_team_termname = strtolower($term->name);  
	// 		$gs_team_termname = str_replace(' ', '-', $gs_team_termname); 
			
	// 		$output .= '<li class="filter" data-filter="' . '.' . $gs_team_termname . '">' . $term->name . '</li>';
	// 		}
	// $output .= '</ul>';
	$output .= '<div class="search-filter">';
		$output .= '<div class="row">';

			if ( 'on' ==  $gs_member_srch_by_name ) :
				$output .='<div class="col-md-6 search-fil-nbox"><input type="text" id="quicksearch" placeholder="'.$gs_teamfliter_name.'" /></div>';
			endif;

			if ( 'on' == $gs_member_filter_by_desig) :
				$output .='<div class="col-md-6 search-fil-nbox">';
					$output .='<select class="filters-select"><option value="*">'.$gs_teamfliter_designation.'</option>';
					$args = array( 'post_type' => 'gs_team', 'meta_key' => '_gs_des', 'numberposts' => -1, 'orderby' => 'meta_value', 'order' => 'ASC', 'team_group' => $group  );

					// print_r($args);
						$lastposts = get_posts( $args );

						foreach($lastposts as $post) : setup_postdata($post);
						    $tm_desig_list[] = get_post_meta($post->ID,'_gs_des',true); 
						    $tm_desig_list = array_unique($tm_desig_list);
						    ?>
						<?php endforeach;
						foreach($tm_desig_list as $des):
							if(!empty($des)):
								$tm_design_string = str_replace(' ', '-', $des);
								$output .='<option value=".'.$tm_design_string.'">'.$des.'</option>';
				           endif;
				        endforeach;   			
					$output .='</select>';
				$output .='</div>';
			endif;

			if ( 'on' == $gs_member_filter_by_Location) :

				$output .='<div class="col-md-6 search-fil-nbox">';
					
					$output .='<select class="filters-select-location"><option value="*">'.$gs_teamlocation_meta.'</option>';
					
						if ( $GLOBALS['gs_team_loop']->have_posts() ) {
							while ( $GLOBALS['gs_team_loop']->have_posts() ) {
								$GLOBALS['gs_team_loop']->the_post();

								$team_location = wp_get_post_terms( get_the_ID(), 'team_location',array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );

								if(!empty($team_location )):

									foreach( $team_location as $term_location ):
										$ind_location[]=$term_location->name;
							
										foreach (array_unique($ind_location) as $term2_location) :
											$indx2_location[]=$term2_location;
										endforeach;
									endforeach;
								endif;
			                }
	            		}
	            
	            		wp_reset_postdata();

	            		if( !empty($indx2_location) ):
				            foreach (array_unique( $indx2_location) as  $term3_location) {
				            	$gs_team_location_link = str_replace(' ', '-', $term3_location);
				            	$gs_team_location_link=preg_replace('/[^A-Za-z0-9\-]/', '', $gs_team_location_link);
						        $gs_team_location = strtolower($gs_team_location_link); 

				            	$output .='<option value=".'.$gs_team_location.'">'.$term3_location.'</option>';	
				            }
			            endif;	

					$output .='</select>';	
				$output .='</div>';

			endif;

			if ( 'on' == $gs_member_filter_by_language) :
				$output .='<div class="col-md-6 search-fil-nbox">';
					
					$output .='<select class="filters-select-language"><option value="*">'.$gs_teamlanguage_meta .'</option>';
					
						if ( $GLOBALS['gs_team_loop']->have_posts() ) {
							while ( $GLOBALS['gs_team_loop']->have_posts() ) {
								$GLOBALS['gs_team_loop']->the_post();

								$team_language = wp_get_post_terms( get_the_ID(), 'team_language',array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );
								if(!empty($team_language )):
									foreach( $team_language as $term_language ):
										$ind_language[]=$term_language->name;
							
										foreach (array_unique($ind_language) as $term2_language) :
											$indx2_language[]=$term2_language;
										endforeach;
									endforeach;
								endif;
			                }
	            		}
	            
	            		wp_reset_postdata();
	            		if(!empty($indx2_language )):
				            foreach (array_unique( $indx2_language) as  $term3_language) {
				            	$gs_team_language_link = str_replace(' ', '-', $term3_language);
				            	$gs_team_language_link=preg_replace('/[^A-Za-z0-9\-]/', '', $gs_team_language_link);
						        $gs_team_language = strtolower($gs_team_language_link); 

				            	$output .='<option value=".'.$gs_team_language.'">'.$term3_language.'</option>';	
				            }
			            endif;			
					$output .='</select>';	
				$output .='</div>';
			endif;

			if ( 'on' == $gs_member_filter_by_gender) :
				$output .='<div class="col-md-6 search-fil-nbox">';
					
					$output .='<select class="filters-select-gender"><option value="*">'.$gs_teamgender_meta.'</option>';
					
						if ( $GLOBALS['gs_team_loop']->have_posts() ) {
							while ( $GLOBALS['gs_team_loop']->have_posts() ) {
								$GLOBALS['gs_team_loop']->the_post();

								$team_gender = wp_get_post_terms( get_the_ID(), 'team_gender',array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );

								if(!empty($team_gender)):

									foreach( $team_gender as $term_gender ):
										$ind_gender[]=$term_gender->name;
							
										foreach (array_unique($ind_gender) as $term2_gender) :
											$indx2_gender[]=$term2_gender;
										endforeach;
									endforeach;
								endif;
			                }
	            		}
	            
	            		wp_reset_postdata();

	            		if(!empty($indx2_gender)):
				            foreach (array_unique( $indx2_gender) as  $term3_gender) {

				            	$gs_team_gender_link = str_replace(' ', '-', $term3_gender);
				            	$gs_team_gender_link=preg_replace('/[^A-Za-z0-9\-]/', '', $gs_team_gender_link);

						        $gs_team_gender = strtolower($gs_team_gender_link); 

				            	$output .='<option value=".'.$gs_team_gender.'">'.$term3_gender.'</option>';
				            }
			        	endif;
					  			
					$output .='</select>';	
				$output .='</div>';
			endif;

			if ( 'on' == $gs_member_filter_by_speciality) :

				$output .='<div class="col-md-6 search-fil-nbox">';
					
					$output .='<select class="filters-select-speciality"><option value="*">'.$gs_teamspecialty_meta.'</option>';
					
						if ( $GLOBALS['gs_team_loop']->have_posts() ) {
							while ( $GLOBALS['gs_team_loop']->have_posts() ) {
								$GLOBALS['gs_team_loop']->the_post();

								$team_speciality = wp_get_post_terms( get_the_ID(), 'team_specialty',array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );

								if(!empty($team_speciality)):
									foreach( $team_speciality as $speciality_term ):
										$ind_speciality_term[]=$speciality_term->name;

										foreach (array_unique($ind_speciality_term) as $speciality_term2) :
											$speciality_indx2[]=$speciality_term2;
										endforeach;
									endforeach;
								endif;
			                }
	            		}
	            
	            		wp_reset_postdata();
	            		
	            		if(!empty($speciality_indx2)):
				            foreach (array_unique($speciality_indx2) as  $speciality_term3) {

				            	$gs_team_speciality_link = str_replace(' ', '-', $speciality_term3);
				            	$gs_team_speciality_link=preg_replace('/[^A-Za-z0-9\-]/', '', $gs_team_speciality_link);

						        $gs_team_speciality = strtolower($gs_team_speciality_link); 

				            	$output .='<option value=".'.$gs_team_speciality.'">'.$speciality_term3.'</option>';
				            }
			            endif;		
					$output .='</select>';	
				$output .='</div>';
			endif;

		$output .= '</div>';
	$output .= '</div>';

	if ( $GLOBALS['gs_team_loop']->have_posts() ) {

		$output .= '<div class="gs-all-items-filter-wrapper">';

		$output .= '<div class="row clearfix gs_team" id="gs_team'.get_the_id().'">';

			while ( $GLOBALS['gs_team_loop']->have_posts() ) {
				$GLOBALS['gs_team_loop']->the_post();
				$gs_team_id = get_post_thumbnail_id();
				$gs_team_url = wp_get_attachment_image_src($gs_team_id, 'full', true);
				$team_thumb = $gs_team_url[0];
				$gs_team_alt = get_post_meta($gs_team_id,'_wp_attachment_image_alt',true);
				$gs_member_desc_link = get_the_permalink();
				
				$gs_tm_meta = get_post_meta( get_the_id() );
				$designation = !empty($gs_tm_meta['_gs_des'][0]) ? $gs_tm_meta['_gs_des'][0] : '';
				$tm_design_string = str_replace(' ', '-', $designation);
				$gs_social  = get_post_meta( get_the_id(), 'gs_social', true);
				$gs_skill = get_post_meta(get_the_id(), 'gs_skill', true);
				$gs_ribon = get_post_meta( get_the_id(), '_gs_ribon', true );
				$gs_address = get_post_meta( get_the_id(), '_gs_address', true );
				$gs_email = get_post_meta( get_the_id(), '_gs_email', true );
				$gs_land = get_post_meta( get_the_id(), '_gs_land', true );
				$gs_cell = get_post_meta( get_the_id(), '_gs_cell', true );
				$gs_company = get_post_meta( get_the_id(), '_gs_com', true );
				$terms_gender = get_the_terms( get_the_id(), 'team_gender' );
								
				$output .= '<div class="ccbp-so-section gs-filter-single-item col-md-'.$cols.' col-sm-6 col-xs-6 '.gs_team_category().' '.$tm_design_string.' '.gs_team_location_loc().' '.gs_team_language_filter().' '.gs_team_gender_filter().' '.gs_team_specialty_filter().'" data-category="'.gs_team_category().'" itemscope="" itemtype="http://schema.org/Person">';
					$output .= '<div class="single-member">'; // start single 
						$output .='<div class="card">';
							$output .='<div class="banner">';
								if ( has_post_thumbnail() )
							            $output .= '<img src="'. $team_thumb .'" class="card-img-top" alt="'. $gs_team_alt .'" itemprop="image"/>';
						        else {
						            $output .= '<img src="' . GSTEAM_FILES_URI . '/assets/img/no_img.png" class="card-img-top"/>';
						        }
						        $output .='<div class="tittle_container">';
									if ( 'on' ==  $gs_member_name ) :
							            $output.= '<h5 class="card-title gs-member-name" itemprop="name">'. get_the_title() .'</h5>';
							        endif;
							        if(!empty( $designation ) && 'on' == $gs_member_role ):
							          $output.= '<p class="card-text gs-member-desig" itemprop="jobtitle">'. $designation .'</p>';
							        endif;
							 
								$output .='</div>';
							$output .='</div>'; 
							
							  
							  	$output .='<div class=" card-body social_cont">';
								 	 if(!empty($gs_email)){
							          	$output .='<a class="social_contact" href="mailto:'.$gs_email.'"><i class="fa fa-envelope"></i> '.$gs_email.'</a>';
						          	}
						          	if(!empty($gs_cell)){
							          	$output .='<a class="social_contact" href="tel:'.$gs_cell.'"><i class="fa fa-phone-square"></i>
							              '.$gs_cell.'</a>';
							        }
							        $output .='  	<a class="social_contact social_contact_mt" href="'. $gs_member_desc_link .'">
							               <i class="fa fa-arrow-right"></i>READ ON
							           </a>';
					         	 $output .='</div>';
						$output .='	</div>';
					$output .='	</div>';
				$output .= '</div>'; // end col
			} // end while loop
			do_action('gs_team_custom_css');

		
		$output .= '</div>';// end row
	} else {
		$output .= "No Team Member Added!";
	}

	wp_reset_postdata();

$output .= '</div>'; 

	if ( 'on' ==  $gs_member_pagination ) :
		$output .= gs_pagination();
	endif;

$output .= '</div>'; // end container
return $output;