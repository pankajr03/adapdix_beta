<?php
/*
 * GS Team - Theme panel slide
 * @author GS Plugins <samdani1997@gmail.com>
 * 
 */
$gs_member_connect = gs_team_getoption('gs_member_connect', 'gs_team_settings', 'on');
$gs_tm_link_tar = gs_team_getoption('gs_tm_link_tar', 'gs_team_settings', '_blank');
$gs_member_name = gs_team_getoption('gs_member_name', 'gs_team_settings', 'on');
$gs_member_role = gs_team_getoption('gs_member_role', 'gs_team_settings', 'on');
$gs_member_pagination = gs_team_getoption('gs_member_pagination', 'gs_team_settings', 'on');
$gs_member_details = gs_team_getoption('gs_member_details', 'gs_team_settings', 'on');
$gs_tm_details_contl = gs_team_getoption('gs_tm_details_contl', 'gs_team_settings', 100);
$gs_member_srch_by_name = gs_team_getoption('gs_member_srch_by_name', 'gs_team_settings', 'on');
$gs_teamfliter_name = gs_team_getoption('gs_teamfliter_name', 'gs_team_adv_settings', 'Search By Name');

$output .= '<div class="container cbp-so-scroller" id="cbp-so-scroller">';

	$output .= '<div class="search-filter">';
		$output .= '<div class="row justify-content-md-center">';
			if ( 'on' ==  $gs_member_srch_by_name ) :
				$output .='<div class="col-lg-4 col-md-6 search-fil-nbox"><input type="text" id="quicksearch" placeholder="'.$gs_teamfliter_name.'" /></div>';
			endif;
		$output .= '</div>';
	$output .= '</div>';

	$output .= '<div class="row clearfix gs_team gs-all-items-filter-wrapper " id="gs_team'.get_the_id().'">';

		if ( $GLOBALS['gs_team_loop']->have_posts() ) {
			
			while ( $GLOBALS['gs_team_loop']->have_posts() ) {
				$GLOBALS['gs_team_loop']->the_post();
				$gs_team_id = get_post_thumbnail_id();
				$gs_team_url = wp_get_attachment_image_src($gs_team_id, 'full', true);
				$team_thumb = $gs_team_url[0];
				$gs_team_alt = get_post_meta($gs_team_id,'_wp_attachment_image_alt',true);
				
				$gs_tm_meta = get_post_meta( get_the_id() );
				$designation = !empty($gs_tm_meta['_gs_des'][0]) ? $gs_tm_meta['_gs_des'][0] : '';
				
			    
			$output .= '<div class="col-md-'.$cols.' col-sm-6 col-xs-6 cbp-so-section gs-filter-single-item">';
				$output .= '<div itemscope="" itemtype="http://schema.org/Person">'; //Start sehema

					$output .= '<div class="single-member single-member-pop cbp-so-side cbp-so-side-left">'; // start single meember

						$output .= '<a class="gs_team_pop" id="gsteamlink'.get_the_id().'" href=#gsteam'.get_the_id().' >'; // Start Link

						if ( has_post_thumbnail() )
				            $output .= '<img src="'. $team_thumb .'" alt="'. $gs_team_alt .'" itemprop="image"/>';
				        else {
				            $output .= '<img src="' . GSTEAM_FILES_URI . '/assets/img/no_img.png" class=""/>';
				        }
				        $output .= '<div class="gs_team_overlay"><i class="fa fa-bolt"></i></div>';
				        $output .= '<div class="single-member-name-desig">'; // start Name Desig
				        	if ( 'on' ==  $gs_member_name ) :
					            $output.= '<div class="gs-member-name" itemprop="name">'. get_the_title() .'</div>';
					        endif;

							if(!empty( $designation ) && 'on' == $gs_member_role ):
					          $output.= '<div class="gs-member-desig" itemprop="jobtitle">'. $designation .'</div>';
					        endif;
				        $output .= '</div>'; // End Name Desig
				        $output .= '</a>'; // End Link

			        $output .= '</div>'; // end single meember
				$output .= '</div>'; //end sehema
			$output .= '</div>';  // end col

			} // end while loop
			do_action('gs_team_custom_css');
		} else {
			$output .= "No Team Member Added!";
		}

		wp_reset_postdata();

	$output .= '</div>'; // end row
	if ( $GLOBALS['gs_team_loop']->have_posts() ) {
			
		while ( $GLOBALS['gs_team_loop']->have_posts() ) {

			$GLOBALS['gs_team_loop']->the_post();
			$gs_team_id = get_post_thumbnail_id();
			$gs_team_url = wp_get_attachment_image_src($gs_team_id, 'full', true);
			$team_thumb = $gs_team_url[0];
			$gs_team_alt = get_post_meta($gs_team_id,'_wp_attachment_image_alt',true);
			
			$gs_tm_meta = get_post_meta( get_the_id() );
			$designation = !empty($gs_tm_meta['_gs_des'][0]) ? $gs_tm_meta['_gs_des'][0] : '';
			$gs_social  = get_post_meta( get_the_id(), 'gs_social', true);
			$gs_skill = get_post_meta(get_the_id(), 'gs_skill', true);
			$gs_company = get_post_meta( get_the_id(), '_gs_com', true );
			$terms_gender = get_the_terms( get_the_id(), 'team_gender' );
			$gs_address = get_post_meta( get_the_id(), '_gs_address', true );
			$gs_land = get_post_meta( get_the_id(), '_gs_land', true );
			$gs_cell = get_post_meta( get_the_id(), '_gs_cell', true );
			$gs_email = get_post_meta( get_the_id(), '_gs_email', true );
				
			$output .='<div id="gsteam'.get_the_id().'" class="gstm-panel">';
				$output .='<div class="panel-container">';
					
					$output .='<div class="gstm-panel-left gs-tm-sicons">';
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
					$output .='</div>'; // end gstm-panel-left

					$output .='<div class="gstm-panel-right">';
						$output .='<div class="gstm-panel-title">'.get_the_title().'<div class="close-gstm-panel-bt"><i class="fa fa-times" aria-hidden="true"></i></div></div>';
						$output .='<div class="gstm-panel-info">'.$designation.'</div>';

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

				        	$output .='<div class="member-skill">';
					        if(!empty($gs_skill)){
					        	$output .='<h3>Skills</h3>';
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
		        			$output .='</div>'; // end member-skill
				        // $output .='</div>'; // end gstm-panel-inner
				    $output .='</div>'; // gstm-panel-right

			    $output .='</div>'; // panel container
			$output .='</div>';
				// echo $panel;
			?>
			<script type="text/javascript">
			    jQuery(document).ready(function () {
			        jQuery('#gsteamlink<?php the_ID(); ?>').panelslider({
			            side: '<?php echo $panel; ?>',
			            clickClose: true,
			            duration: 200,
			            onOpen: function() { jQuery('body').addClass('gs-active-panel'); }
			        });
			        jQuery('.close-gstm-panel-bt').click(function () {
			            jQuery.panelslider.close();
			        });
			    });
			</script>	
			<?php 

		} // end while
		
	} else {
		$output .= "No Team Member Added!";
	}

	wp_reset_postdata();



	if ( 'on' ==  $gs_member_pagination ) :
		$output .= gs_pagination();
	endif;
$output .= '</div>'; // end container
$output .='<div id="gstm-overlay"></div>';

return $output;