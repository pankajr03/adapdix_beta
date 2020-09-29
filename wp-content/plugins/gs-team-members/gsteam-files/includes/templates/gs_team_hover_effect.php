<?php
/*
 * GS Team - Theme hover effect
 * @author GS Plugins <samdani1997@gmail.com>
 * 
 */
$gs_member_connect = gs_team_getoption('gs_member_connect', 'gs_team_settings', 'on');
$gs_tm_link_tar = gs_team_getoption('gs_tm_link_tar', 'gs_team_settings', '_blank');
$gs_member_name = gs_team_getoption('gs_member_name', 'gs_team_settings', 'on');
$gs_member_role = gs_team_getoption('gs_member_role', 'gs_team_settings', 'on');
$gs_member_pagination = gs_team_getoption('gs_member_pagination', 'gs_team_settings', 'on');
$gs_member_srch_by_name = gs_team_getoption('gs_member_srch_by_name', 'gs_team_settings', 'on');
$gs_teamfliter_name = gs_team_getoption('gs_teamfliter_name', 'gs_team_adv_settings', 'Search By Name');

$gs_member_details = gs_team_getoption('gs_member_details', 'gs_team_settings', 'on');
$gs_tm_details_contl = gs_team_getoption('gs_tm_details_contl', 'gs_team_settings', 100);

$output .= '<div class="container cbp-so-scroller" id="cbp-so-scroller">';
	$output .= '<div class="search-filter">';
		$output .= '<div class="row justify-content-md-center">';
			if ( 'on' ==  $gs_member_srch_by_name ) :
				$output .='<div class="col-lg-4 col-md-6 search-fil-nbox"><input type="text" id="quicksearch" placeholder="'.$gs_teamfliter_name.'" /></div>';
			endif;
		$output .= '</div>';
	$output .= '</div>';
$output .= '<div class="row clearfix gs_team gstm-gridder gs-all-items-filter-wrapper ">';

	$output .= '<ul class="gridder cbp-so-section ">';

		if ( $GLOBALS['gs_team_loop']->have_posts() ) {
				
			while ( $GLOBALS['gs_team_loop']->have_posts() ) {
				$GLOBALS['gs_team_loop']->the_post();
				$gs_team_id = get_post_thumbnail_id();
				$gs_team_url = wp_get_attachment_image_src($gs_team_id, 'full', true);
				$team_thumb = $gs_team_url[0];
				$gs_tm_meta = get_post_meta( get_the_id() );
				$designation = !empty($gs_tm_meta['_gs_des'][0]) ? $gs_tm_meta['_gs_des'][0] : '';
				$gs_social  = get_post_meta( get_the_id(), 'gs_social', true);
				$gs_ribon = get_post_meta( get_the_id(), '_gs_ribon', true );
				
				$output .='<li class="gridder-list cbp-so-side cbp-so-side-left gs-filter-single-item" data-griddercontent="#'.get_the_id().'">';
					$output .='<div class="overlay-area">';
						if(!empty($gs_ribon)):
							$output .='<div class="gs_team_ribbon">'.esc_html($gs_ribon).'</div>';
					    endif;
					  $output .='<img src="'.$team_thumb.'" alt="" class="img">
					  <div class="overlay">
    					<h2 class="title gs-member-name">'.get_the_title().'</h2>
						<p class="desig">'.$designation.'</p>
					  </div>
					</div>';
				$output .='</li>';		
			} // end while loop
			do_action('gs_team_custom_css');
		} else {
			$output .= "No Team Member Added!";
		}

		wp_reset_postdata();
	$output .='</ul>';

	if ( $GLOBALS['gs_team_loop']->have_posts() ) {
			
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
					
			$output .='<div id="'.get_the_id().'" class="gridder-content">';
				$output .='<div class="row">';
					$output .='<div class="col-md-6 team-description">
						<h2 class="title">'.get_the_title().'</h2>
						<p>'.$designation.'</p>
						<p>'.$gs_member_desc.'</p>
					</div>';

					$output .='<div class="col-md-5 col-md-offset-1 gs-tm-sicons">';
									
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
	    	    	$output .='  </div>'; // col-md-offset-1
				$output .='</div>'; // row
			$output .='</div>'; // gridder-content
		} // end while loop
		do_action('gs_team_custom_css');
	} else {
		$output .= "No Team Member Added!";
	}

$output .= '</div>'; // end row

	if ( 'on' ==  $gs_member_pagination ) :
		$output .= gs_pagination();
	endif;

$output .= '</div>'; // end container
return $output;