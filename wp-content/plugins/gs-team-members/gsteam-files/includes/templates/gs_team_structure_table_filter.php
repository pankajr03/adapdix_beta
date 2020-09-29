<?php
/*
 * GS Team - Theme table filter
 * @author GS Plugins <samdani1997@gmail.com>
 * 
 */

function formatPhone($num) {
    $num = preg_replace('/[^0-9]/', '', $num);
    $len = strlen($num);

    if($len == 7) $num = preg_replace('/([0-9]{3})([0-9]{2})([0-9]{1})/', '($1) $2$3-', $num);
    elseif($len == 8) $num = preg_replace('/([0-9]{3})([0-9]{2})([0-9]{1})/', '($1) $2$3-', $num);
    elseif($len == 9) $num = preg_replace('/([0-9]{3})([0-9]{2})([0-9]{1})([0-9]{2})/', '($1) $2$3-$4', $num);
    elseif($len == 10) $num = preg_replace('/([0-9]{3})([0-9]{2})([0-9]{1})([0-9]{3})/', '($1) $2$3-$4', $num);

    return $num;
}
$gs_member_connect = gs_team_getoption('gs_member_connect', 'gs_team_settings', 'on');
$gs_tm_link_tar = gs_team_getoption('gs_tm_link_tar', 'gs_team_settings', '_blank');
$gs_member_name = gs_team_getoption('gs_member_name', 'gs_team_settings', 'on');
$gs_member_role = gs_team_getoption('gs_member_role', 'gs_team_settings', 'on');
$gs_member_pagination = gs_team_getoption('gs_member_pagination', 'gs_team_settings', 'on');

$gs_member_details = gs_team_getoption('gs_member_details', 'gs_team_settings', 'on');
$gs_tm_details_contl = gs_team_getoption('gs_tm_details_contl', 'gs_team_settings', 100);
	
	$output .='<div class="table-responsive">';

	$output .='<table id="tm_theme21" data-toggle="table" data-search="true" class=" mt-5 table table-striped table-hover table-borderless">';

	//$output .= 	'<table id="tm_theme21" class=" mt-5 table table-striped table-hover table-borderless" style="width:100%">';
    	$output .= '<thead class="thead-dark">
					<tr>
						<th data-sortable="true">name</th>
						<th data-sortable="true">Department</th>
						<th data-sortable="true">Contact</th>
					</tr>
				</thead>';
			$output .= '<tbody>';

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
						$gs_email = get_post_meta( get_the_id(), '_gs_email', true );
						$gs_land = get_post_meta( get_the_id(), '_gs_land', true );
						$gs_cell = get_post_meta( get_the_id(), '_gs_cell', true );
						$phoneNumber = addslashes($gs_cell);
 						
						$output .='<tr>
									<td>'.get_the_title().'</td>
									<td >'.$designation.'</td>
									<td ><a href="tel:'.$gs_cell.'">'. formatPhone($gs_cell).'</a>
										 | <a href="mailto:'.$gs_email.'">SEND EMAIL</a></td>
								</tr>';

					} // end while loop
					do_action('gs_team_custom_css');
				} else {
					$output .= "No Team Member Added!";
				}

				wp_reset_postdata();

	$output .= '</tbody>'; // end row
	$output .= '</table>'; // end row
	$output .= '</div>'; // end row

return $output;