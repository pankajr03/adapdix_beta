<?php
/*
 * GS Team - Theme Grid2
 * @author GS Plugins <samdani1997@gmail.com>
 * 
 */

$gs_member_name = gs_team_getoption('gs_member_name', 'gs_team_settings', 'on');
$gs_member_role = gs_team_getoption('gs_member_role', 'gs_team_settings', 'on');
$gs_member_pagination = gs_team_getoption('gs_member_pagination', 'gs_team_settings', 'on');

$output .= '<div class="container cbp-so-scroller" id="cbp-so-scroller">';
$output .= '<div class="row clearfix gs_team ">';

	if ( $GLOBALS['gs_team_loop']->have_posts() ) {
			
		while ( $GLOBALS['gs_team_loop']->have_posts() ) {
			$GLOBALS['gs_team_loop']->the_post();
			$gs_team_id = get_post_thumbnail_id();
			$gs_team_url = wp_get_attachment_image_src($gs_team_id, 'full', true);
			$team_thumb = $gs_team_url[0];
			$gs_team_alt = get_post_meta($gs_team_id,'_wp_attachment_image_alt',true);
			$gs_member_desc_link = get_the_permalink();

			$gs_tm_meta = get_post_meta( get_the_id() );
			$designation = !empty($gs_tm_meta['_gs_des'][0]) ? $gs_tm_meta['_gs_des'][0] : '';
			
		  
		$output .= '<div class="col-md-'.$cols.' col-sm-6 col-xs-6 cbp-so-section single-member-div">';
			$output .= '<div itemscope itemtype="http://schema.org/Organization">'; //Start sehema
			
				$output .= '<div class="staff-member clearfix">';
				    $output .= '<div class="staff-img">';
				      
						if ( has_post_thumbnail() )
							$output .= '<a href="'. $gs_member_desc_link .'"><img src="'. $team_thumb .'" alt="'. get_the_title() .'" itemprop="image"/></a>';
						else {
							$output .= '<img src="' . GSTEAM_FILES_URI . '/assets/img/no_img.png" class=""/>';
						}
				    $output .= '</div>';

				    $output .= '<div class="staff-meta">'; // staff-meta
						if ( 'on' ==  $gs_member_name ) :
							$output.= '<div class="gs-member-name" itemprop="name">'. get_the_title() .'</div>';
						endif;
						if(!empty( $designation ) && 'on' == $gs_member_role ):
							$output.= '<div class="gs-member-desig" itemprop="jobtitle">'. $designation .'</div>';
						endif;
				    $output .= '</div>'; // end staff-meta
				$output .= '</div>';

			$output .= '</div>'; // end col
			$output .= '</div>'; //end sehema
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