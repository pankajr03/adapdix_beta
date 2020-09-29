<?php
/*
 * GS Team - Theme One
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

$output .= '<div class="container cbp-so-scroller" id="cbp-so-scroller"">';
$output .= '<div class="row clearfix gs_team" id="gs_team'.get_the_id().'">';

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
				$gs_ribon = get_post_meta( get_the_id(), '_gs_ribon', true );

			    

			$output .= '<div class="col-md-'.$cols.' col-sm-6 col-xs-6 cbp-so-section">';
			$output .= '<div itemscope="" itemtype="http://schema.org/Person">'; //Start sehema
				$output .= '<div class="single-member cbp-so-side cbp-so-side-left">'; // start single member

				$output .= '<div class="gs-grey">'; // start gs-grey
				$output .= '<a href="'. $gs_member_desc_link .'">';
					if(!empty($gs_ribon)):
						$output .='<div class="gs_team_ribbon">'.esc_html($gs_ribon).'</div>';
				    endif;
					if ( has_post_thumbnail() )
			            $output .= '<img src="'. $team_thumb .'" alt="'. $gs_team_alt .'" itemprop="image"/>';
			        else {
			            $output .= '<img src="' . GSTEAM_FILES_URI . '/assets/img/no_img.png" class=""/>';
			        }
		        $output .= '</a>';
		        $output .= '</div>'; // end gs-grey

		        if ( 'on' ==  $gs_member_name ) :
		            $output.= '<div class="gs-member-name" itemprop="name">'. get_the_title() .'</div>';
		        endif;

				if(!empty( $designation ) && 'on' == $gs_member_role ):
		          $output.= '<div class="gs-member-desig" itemprop="jobtitle">'. $designation .'</div>';
		        endif;

		        $output .= '<div class="single-mem-desc-social">'; // start desc & social
				
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
				$output .= '</div>'; // end desc & social

		        if ( 'on' ==  $gs_member_details ) :
		        $output.= '<p class="gs-member-desc grey-desc" itemprop="description">'. $gs_member_desc .'</p>';
		        endif;
		        
		        $output .= '</div>'; // end single member
		        
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