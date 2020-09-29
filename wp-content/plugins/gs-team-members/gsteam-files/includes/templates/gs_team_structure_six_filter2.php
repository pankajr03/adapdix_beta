<?php
/*
 * GS Team - Theme One
 * @author GS Plugins <samdani1997@gmail.com>
 * 
 */

// -- Function for GS Team Category
if ( !function_exists('gs_team_category')) {	
	function gs_team_category(){
	    global $post;
	    if(!empty(get_the_terms( $post->ID, 'team_group' ))){
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

$output .= '<div class="container ccbp-so-scroller" id="ccbp-so-scroller">';


	// Team cats for filtering
	// $filter_cat_lists = explode(",",$filter_cat);
	$filter_cat_lists = explode(",",$group);

	
	$output .= '<ul class="gs-team-filter-cats" style="display:'. $cats_name .';">';
        $output .= '<li class="filter" data-filter="all">All</li>';
		foreach ( $filter_cat_lists as $filter_cat_list ) {

			$gsteam_taxonomies = get_taxonomies();
			foreach ( $gsteam_taxonomies as $gstm_tax_type_key => $gsteam_taxonomy ) {
			    if ( $gsteam_term_object = get_term_by( 'slug', $filter_cat_list , $gsteam_taxonomy ) ) {
			        break;
			    }
			}

			if ( !empty($gsteam_term_object->name)) {
				$gstm_term_id = $gsteam_term_object->name;
				
				$output .= '<li class="filter" data-filter="' . '.' . $filter_cat_list . '">' . $gstm_term_id . '</li>';
			}
			

			// $output .= '<li class="filter" data-filter="' . '.' . $filter_cat_list . '">' . $filter_cat_list . '</li>';
			
		}
	$output .= '</ul>';
	// End Team cats for filtering

	if ( $GLOBALS['gs_team_loop']->have_posts() ) {

			$output .= '<div class="gs-all-items-filter-wrapper">';
			$output .= '<div class="row clearfix gs_team" id="gs_team'.get_the_id().'">';
			
			while ( $GLOBALS['gs_team_loop']->have_posts() ) {
				$GLOBALS['gs_team_loop']->the_post();
				$gs_team_id = get_post_thumbnail_id();
				$gs_team_url = wp_get_attachment_image_src($gs_team_id, 'full', true);
				$team_thumb = $gs_team_url[0];
				$gs_team_alt = get_post_meta($gs_team_id,'_wp_attachment_image_alt',true);
				$gs_member_desc = get_the_content();
				$gs_member_desc_link = get_the_permalink();
				$gs_member_desc = (strlen($gs_member_desc) > 50) ? substr($gs_member_desc,0, $gs_tm_details_contl ).'...<a href="'.$gs_member_desc_link.'">more</a>' : $gs_member_desc;

				$gs_tm_meta = get_post_meta( get_the_id() );
				$designation = !empty($gs_tm_meta['_gs_des'][0]) ? $gs_tm_meta['_gs_des'][0] : '';
				$gs_social  = get_post_meta( get_the_id(), 'gs_social', true);
				$gs_skill = get_post_meta(get_the_id(), 'gs_skill', true);
				$gs_ribon = get_post_meta( get_the_id(), '_gs_ribon', true );
				$gs_address = get_post_meta( get_the_id(), '_gs_address', true );
				$gs_email = get_post_meta( get_the_id(), '_gs_email', true );
				$gs_land = get_post_meta( get_the_id(), '_gs_land', true );
				$gs_cell = get_post_meta( get_the_id(), '_gs_cell', true );
				$gs_company = get_post_meta( get_the_id(), '_gs_com', true );
				$terms_gender = get_the_terms( get_the_id(), 'team_gender' );				
								
				$output .= '<div class="ccbp-so-section gs-filter-single-item col-md-'.$cols.' col-sm-6 col-xs-6 '.gs_team_category().'" itemscope="" itemtype="http://schema.org/Person">';
					$output .= '<div class="single-member single-member-pop ccbp-so-side ccbp-so-side-right">'; // start single meember

				$output .= '<a class="gs_team_pop open-popup-link" data-mfp-src="#gs_team_popup_'.get_the_id().'" href="javascript:void(0);" data-effect="">'; // Start Link

				if(!empty($gs_ribon)):
					$output .='<div class="gs_team_ribbon">'.esc_html($gs_ribon).'</div>';
			    endif;

				if ( has_post_thumbnail() )
		            $output .= '<img src="'. $team_thumb .'" alt="'. $gs_team_alt .'" itemprop="image"/>';
		        else {
		            $output .= '<img src="' . GSTEAM_FILES_URI . '/assets/img/no_img.png" class=""/>';
		        }
		        $output .= '<div class="gs_team_overlay"><i class="fa fa-external-link"></i></div>';
		        $output .= '<div class="single-member-name-desig">'; // start Name Desig
		        	if ( 'on' ==  $gs_member_name ) :
			            $output.= '<div class="gs-member-name" itemprop="name">'. get_the_title() .'</div>';
			        endif;

					if(!empty( $designation ) && 'on' == $gs_member_role ):
			          $output.= '<div class="gs-member-desig" itemprop="jobtitle">'. $designation .'</div>';
			        endif;
		        $output .= '</div>'; // End Name Desig
		        $output .= '</a>'; // End Link

		        // Popup
				$output .= '<div id="gs_team_popup_'.get_the_id().'" class="white-popup mfp-hide mfp-with-anim gs_team_popup">';
				if($popup_column == 'one'){

					$output .= '<div class="gs_team_popup_details gs-tm-sicons popup-one-column">'; // start Member details
						
							if ( has_post_thumbnail() )
								$output .= '<img src="'. $team_thumb .'" alt="'. $gs_team_alt .'" itemprop="image"/>';
							else {
								$output .= '<img src="' . GSTEAM_FILES_URI . '/assets/img/no_img.png" class=""/>';
					
			        		}
					
					$output.= '<div class="gs-member-name" itemprop="name">'. get_the_title() .'</div>';

					if(!empty( $designation ) && 'on' == $gs_member_role ):
			          $output.= '<div class="gs-member-desig" itemprop="jobtitle">'. $designation .'</div>';
			        endif;

					if ( 'on' == $gs_member_connect ) :
				        $output .= '<div itemscope itemtype="http://schema.org/Organization">'; // social links
				          
				            $output .= '<ul class="gs-team-social">';
				            	if(!empty($gs_social)){
				            		foreach ($gs_social as $key => $value) {

					            		if($value['icon']=='envelope'){
					            			$link=!empty($value['link']) ? 'mailto:'.$value['link'] :'#';
					            		} else{
					            			$link=!empty($value['link']) ? $value['link'] :'#';
					            		}
										$output .= '<li><a class ="'.$value['icon'].'"href="'.$link  .'" target="'. $gs_tm_link_tar .'" itemprop="sameAs"><i class="fa fa-'.$value['icon'].'"></i></a></li>';
									}
				            	}
				            $output .= '</ul>';
				       
 				        $output .= '</div>'; // end social links
				    endif;

					if ( 'on' ==  $gs_member_details ) :
			        	// $output.= '<p class="gs-member-desc" itemprop="description">'. get_the_content() .'</p>';
			        	$output.= '<div class="gs-member-desc" itemprop="description">'. wpautop( get_the_content() ).'</div>';
			        endif;

			        $output .= '<div class="gstm-details">';
				        if(!empty($gs_company)){
				        	$output.= '<div class="gs-member-company"><span class="levels">'.$gs_teamcom_meta.'</span> <span class="level-info-company"> : '. $gs_company .'</span></div>';
				        }
				        if(!empty($gs_address)){
				        	$output.= '<div class="gs-member-address"><span class="levels">'.$gs_teamadd_meta.' </span> <span class="level-info-address"> : '. $gs_address .'</span></div>';
				        }
				        if(!empty($gs_land)){
				        	$output.= '<div class="gs-member-lphon"><span class="levels">'.$gs_teamlandphone_meta.' </span> <span class="level-info-lphon"> : '. $gs_land .'</span></div>';
				        }
				        if(!empty($gs_cell)){
				        	$output.= '<div class="gs-member-cphon"><span class="levels">'.$gs_teamcellPhone_meta.' </span> <span class="level-info-cphon"> : '. $gs_cell .'</span></div>';
				        }
				        if(!empty($gs_email)){
				        	$output.= '<div class="gs-member-email"><span class="levels">'.$gs_teamemail_meta.'</span> <span class="level-info-email"> : '. $gs_email .'</span></div>';
				        }

				        if(!empty( gsteam_location() )) {
							$output.= '<div class="gs-member-loc"><span class="levels">'.$gs_teamlocation_meta.'</span> <span class="level-info-loc"> : '. gsteam_location() .'</span></div>';
				        }
				        if(!empty( gsteam_language() ) ) { 
				        	$output.= '<div class="gs-member-lang"><span class="levels">'.$gs_teamlanguage_meta.'</span> <span class="level-info-lang"> : '. gsteam_language() .'</span></div>';
				        }
				        if(!empty( gsteam_specialty() ) ) { 
				        	$output.= '<div class="gs-member-specialty"><span class="levels">'.$gs_teamspecialty_meta.' </span> <span class="level-info-specialty"> : '. gsteam_specialty() .'</span></div>';
				        }
				        if(!empty( $terms_gender[0]->name ) ) {
				        	$output.= '<div class="gs-member-gender"><span class="levels">'.$gs_teamgender_meta.'</span> <span class="level-info-gender"> : '. $terms_gender[0]->name .'</span></div>';
				        }
					$output .= '</div>';

			        $output .='<div class="member-skill">';
				        if(!empty($gs_skill)){
				        	foreach ($gs_skill as  $value) {	
				        		
						        if (!empty( $value['percent'] )) {
				        			$gstm_percent = $value['percent'];
				        			$output .='<span class="progressText"><b>'.$value['skill'].'</b></span><div class="progress">';
						            	$output .='<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '.$gstm_percent.'%;"></div>';
						            	$output .='<span class="progress-completed">'.$gstm_percent.' % </span>';
					        		$output .='</div>';
					        	}
					    	} 
					    }
			        $output .='</div>'; // member-skill
			        
					$output .= '</div>'; // end Member details
				} else {
					$output .= '<div class="gs_team_popup_img">';
						if ( has_post_thumbnail() )
				            $output .= '<img src="'. $team_thumb .'" alt="'. $gs_team_alt .'" itemprop="image"/>';
				        else {
				            $output .= '<img src="' . GSTEAM_FILES_URI . '/assets/img/no_img.png" class=""/>';
				        }

				        $output .= '<div class="gstm-details">';
					        if(!empty($gs_company)){
					        	$output.= '<div class="gs-member-company"><span class="levels">'.$gs_teamcom_meta.'</span> <span class="level-info-company"> : '. $gs_company .'</span></div>';
					        }
					        if(!empty($gs_address)){
					        	$output.= '<div class="gs-member-address"><span class="levels">'.$gs_teamadd_meta.' </span> <span class="level-info-address"> : '. $gs_address .'</span></div>';
					        }
					        if(!empty($gs_land)){
					        	$output.= '<div class="gs-member-lphon"><span class="levels">'.$gs_teamlandphone_meta.' </span> <span class="level-info-lphon"> : '. $gs_land .'</span></div>';
					        }
					        if(!empty($gs_cell)){
					        	$output.= '<div class="gs-member-cphon"><span class="levels">'.$gs_teamcellPhone_meta.' </span> <span class="level-info-cphon"> : '. $gs_cell .'</span></div>';
					        }
					        if(!empty($gs_email)){
					        	$output.= '<div class="gs-member-email"><span class="levels">'.$gs_teamemail_meta.'</span> <span class="level-info-email"> : '. $gs_email .'</span></div>';
					        }

					        if(!empty( gsteam_location() )) {
								$output.= '<div class="gs-member-loc"><span class="levels">'.$gs_teamlocation_meta.'</span> <span class="level-info-loc"> : '. gsteam_location() .'</span></div>';
					        }
					        if(!empty( gsteam_language() ) ) { 
					        	$output.= '<div class="gs-member-lang"><span class="levels">'.$gs_teamlanguage_meta.'</span> <span class="level-info-lang"> : '. gsteam_language() .'</span></div>';
					        }
					        if(!empty( gsteam_specialty() ) ) { 
					        	$output.= '<div class="gs-member-specialty"><span class="levels">'.$gs_teamspecialty_meta.' </span> <span class="level-info-specialty"> : '. gsteam_specialty() .'</span></div>';
					        }
					        if(!empty( $terms_gender[0]->name ) ) {
					        	$output.= '<div class="gs-member-gender"><span class="levels">'.$gs_teamgender_meta.'</span> <span class="level-info-gender"> : '. $terms_gender[0]->name .'</span></div>';
					        }
						$output .= '</div>';
					$output .= '</div>'; // end Member Img
					
					$output .= '<div class="gs_team_popup_details gs-tm-sicons">'; // start Member details
						
						$output.= '<div class="gs-member-name" itemprop="name">'. get_the_title() .'</div>';

						if(!empty( $designation ) && 'on' == $gs_member_role ):
				          $output.= '<div class="gs-member-desig" itemprop="jobtitle">'. $designation .'</div>';
				        endif;

						if ( 'on' == $gs_member_connect ) :
					        $output .= '<div itemscope itemtype="http://schema.org/Organization">'; // social links
					         
					            $output .= '<ul class="gs-team-social">';
					            	if(!empty($gs_social)){
					            		foreach ($gs_social as $key => $value) {

						            		if($value['icon']=='envelope'){
						            			$link=!empty($value['link']) ? 'mailto:'.$value['link'] :'#';
						            		} else{
						            			$link=!empty($value['link']) ? $value['link'] :'#';
						            		}
											$output .= '<li><a class ="'.$value['icon'].'"href="'.$link  .'" target="'. $gs_tm_link_tar .'" itemprop="sameAs"><i class="fa fa-'.$value['icon'].'"></i></a></li>';
										}
					            	}
					            $output .= '</ul>';
					         
					        $output .= '</div>'; // end social links
					    endif;

						if ( 'on' ==  $gs_member_details ) :
				        $output.= '<p class="gs-member-desc" itemprop="description">'. get_the_content() .'</p>';
				        // $output.= '<p class="gs-member-desc" itemprop="description">'. wpautop( get_the_content() ).'</p>';
				        endif;

				        $output .='<div class="member-skill">';
					        if(!empty($gs_skill)){
					        	foreach ($gs_skill as  $value) {

					        		if (!empty( $value['percent'] )) {
					        			$gstm_percent = $value['percent'];
					        			$output .='<span class="progressText"><b>'.$value['skill'].'</b></span><div class="progress">';
							            	$output .='<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '.$gstm_percent.'%;"></div>';
							            	$output .='<span class="progress-completed">'.$gstm_percent.' % </span>';
						        		$output .='</div>';
						        	}
						    	} 
						    }
				        $output .='</div>';
					$output .= '</div>'; // end Member details
				}
				$output .= '</div>'; 
				// Popup end

			        $output .= '</div>'; // end single meember
				$output .= '</div>'; // end col
			} // end while loop
			do_action('gs_team_custom_css');
			$output .= '</div>'; // end row
			
		} else {
			$output .= "No Team Member Added!";
		}

		wp_reset_postdata();

	

	if ( 'on' ==  $gs_member_pagination ) :
		$output .= gs_pagination();
	endif;
$output .= '</div>'; // end container
return $output;