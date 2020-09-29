<?php
/*
 * GS Team - Theme table odd even
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

$output .= '<div class="container">';
$output .= '<div class="gs_team_table_oddeven">';
	$output .='<div class="gs-team-table">';
		$output .='<div class="gs-team-table-row gsc-table-head">';
			$output .='<div class="gs-team-table-cell">Image</div><div class="gs-team-table-cell">Name</div><div class="gs-team-table-cell">Position</div><div class="gs-team-table-cell">Description</div><div class="gs-team-table-cell">Social Links</div>';
		$output .='</div>';

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
		
			$output .='<div class="gs-team-table-row">
				<div class="gs-team-table-cell gsc-image">
					<a href="'.get_the_permalink().'" target="'.$gs_tm_link_tar.'">
						<img src="'.$team_thumb.'" alt="">
					</a>
				</div>
				<div class="gs-team-table-cell gsc-name">
					<div class="gs-team-table-cell-inner">
						<div class="gs-member-name">
							<a href="'.get_the_permalink().'" target="_self">'.get_the_title().'</a>
						</div>
					</div>
				</div>
				<div class="gs-team-table-cell gsc-desig">
					<div class="gs-team-table-cell-inner">
						<span class="gs-member-profession">'.$designation.'</span>
					</div>
				</div>
				<div class="gs-team-table-cell gsc-desc">
					<div class="gs-team-table-cell-inner">
						<div class="gs-member-details justify">'.$gs_member_desc.'</div>
					</div>
				</div>';
				$output .='<div class="gs-team-table-cell socialicon gs-tm-sicons">';
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
			$output .='</div>';
			   	
		} // end while loop
		do_action('gs_team_custom_css');
	} else {
		$output .= "No Team Member Added!";
	}

	wp_reset_postdata();
	$output .='</div>';	
$output .= '</div>'; // end row

	if ( 'on' ==  $gs_member_pagination ) :
		$output .= gs_pagination();
	endif;

$output .= '</div>'; // end container
return $output;