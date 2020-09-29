<?php
/*
 * GS Team - Theme table
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

$output .= '<div class="container cbp-so-scroller" id="cbp-so-scroller">';
$output .= '<div class="row clearfix gs_team">';
	
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
			// $gs_member_desc = get_the_content();

			$gs_tm_meta = get_post_meta( get_the_id() );
			$designation = !empty($gs_tm_meta['_gs_des'][0]) ? $gs_tm_meta['_gs_des'][0] : '';
			$gs_social  = get_post_meta( get_the_id(), 'gs_social', true);
		
			$output .='<div class="col-md-12 cbp-so-section">';
				$output .= '<div class="single-member fullcolumn">'; // start single meember
					$output .='<div class="row">';
						$output .='<div class="col-md-4 col-sm-4 col-xs-12 cbp-so-side cbp-so-side-left gstm-img-div">
							<div class="zoomin image">
								<a href="'.$gs_member_desc_link.'" target="'.$gs_tm_link_tar.'">
								<img src="'.$team_thumb.'" alt="">
								</a>
							</div>
						</div>';
						$output .='<div class=" col-md-8  col-sm-8 col-xs-12 cbp-so-side cbp-so-side-right gstm-img-div">
							<div class="single-team-rightinfo">
								<div class="gs-team-info gs-tm-sicons">
									<span class="gs-team-name">
									<a href="'.$gs_member_desc_link.'" target="'.$gs_tm_link_tar.'">'.get_the_title().'</a></span><span class="gs-team-profession">'.$designation.'</span><div class="gs-team-details justify">'.get_the_content().'</div>';
									$output .='<div class="socialicon">';
										
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

									$output .='</div>';
								$output .='</div>
							</div>
						</div>';
					$output .='</div>'; // end row	
				$output .='</div>'; // end single meember	
			$output .='</div>';

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