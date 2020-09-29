<?php 

// -- Getting values from setting panel

function gs_team_getoption( $option, $section, $default = '' ) {
    $options = get_option( $section );
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
    return $default;
}

// -- Shortcode [gs_team]

add_shortcode('gs_team','gs_team_shortcode');

function gs_team_shortcode( $atts ) {

	$gs_team_theme = gs_team_getoption('gs_team_theme', 'gs_team_settings', 'gs_tm_theme1');
	$gs_team_cols = gs_team_getoption('gs_team_cols', 'gs_team_settings', 3);
	$gs_teammembers_pop_clm = gs_team_getoption('gs_teammembers_pop_clm', 'gs_team_adv_settings', 'two');
	$gs_teamcom_meta = gs_team_getoption('gs_teamcom_meta', 'gs_team_level_settings', 'Company');
	$gs_teamadd_meta = gs_team_getoption('gs_teamadd_meta', 'gs_team_level_settings', 'Address');
	$gs_teamlandphone_meta = gs_team_getoption('gs_teamlandphone_meta', 'gs_team_level_settings', 'Land Phone');
	$gs_teamcellPhone_meta = gs_team_getoption('gs_teamcellPhone_meta', 'gs_team_level_settings', 'Cell Phone');
	$gs_teamemail_meta = gs_team_getoption('gs_teamemail_meta', 'gs_team_level_settings', 'Email');
	$gs_teamlocation_meta = gs_team_getoption('gs_teamlocation_meta', 'gs_team_level_settings', 'Location');
	$gs_teamlanguage_meta = gs_team_getoption('gs_teamlanguage_meta', 'gs_team_level_settings', 'Language');
	$gs_teamspecialty_meta = gs_team_getoption('gs_teamspecialty_meta', 'gs_team_level_settings', 'Specialty');
	$gs_teamgender_meta = gs_team_getoption('gs_teamgender_meta', 'gs_team_level_settings', 'Gender');

	if ( get_query_var('paged') ) {
    	$gs_tm_paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
	    $gs_tm_paged = get_query_var('page');
	} else {
	    $gs_tm_paged = 1;
	}

	extract(shortcode_atts(
		array(
		'num' 		=> -1,
		'order'		=> 'DESC',
		'orderby'	=> 'date',
		'theme'		=> $gs_team_theme,
		'cols'		=> $gs_team_cols,
		'group'		=> '',
		'cats_name'	=> '',
		'panel'		=> 'right',
		'popup_column'		=> $gs_teammembers_pop_clm
		), $atts
	));

	
	$GLOBALS['gs_team_loop'] = new WP_Query(
		array(
		'post_type'			=> 'gs_team',
		'order'				=> $order,
		'orderby'			=> $orderby,
		'posts_per_page'	=> $num,
		'team_group'		=> $group,
		'paged'             => $gs_tm_paged
	));
       
        $output = '';
		$output = '<div  class="wrap gs_team_area '.$theme.'">';
			if ( $theme == 'gs_tm_theme1' || $theme == 'gs_tm_theme2') {
				include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_one.php';
			}
			if ( $theme == 'gs_tm_theme3' || $theme == 'gs_tm_theme5') {
				include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_two.php';
			}
			if ( $theme == 'gs_tm_theme4' || $theme == 'gs_tm_theme6') {
				include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_three.php';
			}
			if ( gtm_fs()->is__premium_only() or gtm_fs()->can_use_premium_code() ) {
				if ( $theme == 'gs_tm_grid2') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_grid2.php';
				} 
				
				if ( $theme == 'gs_tm_theme7') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_four_slider.php';
				}
				if ( $theme == 'gs_tm_theme8') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_five_popup.php';
				}
				if ( $theme == 'gs_tm_theme9') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_six_filter.php';
				}
				if ( $theme == 'gs_tm_theme10') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_7_greyscale.php';
				}
				if ( $theme == 'gs_tm_theme11') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_8_not_pop_to_single_team.php';
				}
				if ( $theme == 'gs_tm_theme12') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_six_filter2.php';
				}
				//new
				if ( $theme == 'gs_tm_theme13' || $theme == 'gs_tm_drawer2') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_hover_effect.php';
				}
				if ( $theme == 'gs_tm_theme14') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_table.php';
				}
				if ( $theme == 'gs_tm_theme15') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_table_box.php';
				}
				if ( $theme == 'gs_tm_theme16') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_table_odd_even.php';
				}
				if ( $theme == 'gs_tm_theme17') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_list.php';
				}
				if ( $theme == 'gs_tm_theme18') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_list2.php';
				}
				if ( $theme == 'gs_tm_theme19') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_panelslide.php';
				}
				if ( $theme == 'gs_tm_theme20') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_grid.php';
				}
				if ( $theme == 'gs_tm_theme21') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_table_filter.php';
				}
				if ( $theme == 'gs_tm_theme22') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_six_filter_grid.php';
				}
				if ( $theme == 'gs_tm_theme23') {
					include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_flip.php';
				}
			}
			//test
			// if ( $theme == 'gs_tm_theme21') {
			// 	include GSTEAM_FILES_DIR . '/includes/templates/gs_team_structure_five_popup_5cols.php';
			// }
		$output .= '</div>'; // end wrap
	return $output;
}

// -- CSS values
if ( !function_exists( 'gs_team_setting_styles' )) {
	function gs_team_setting_styles() {
		$gs_tm_m_fz = gs_team_getoption('gs_tm_m_fz', 'gs_team_style_settings', 18);
		$gs_tm_m_fntw = gs_team_getoption('gs_tm_m_fntw', 'gs_team_style_settings', 'normal');
		$gs_tm_m_fnstyl = gs_team_getoption('gs_tm_m_fnstyl', 'gs_team_style_settings', 'normal');
		$gs_tm_mname_color = gs_team_getoption('gs_tm_mname_color', 'gs_team_style_settings', '#141412');
		$gs_tm_mname_backcolor = gs_team_getoption('gs_tm_mname_background', 'gs_team_style_settings', 'rgba(0,185,235,0.8)');
		$gs_tm_hovericon_backcolor = gs_team_getoption('gs_tm_hover_icon_background', 'gs_team_style_settings', '#00B9EB');
		$gs_tm_ribon_color = gs_team_getoption('gs_tm_ribon_color', 'gs_team_style_settings', '#1DA642');
		$gs_tm_arrow_color = gs_team_getoption('gs_tm_arrow_color', 'gs_team_style_settings', '#1d9ff3');
		$gs_tm_role_fz = gs_team_getoption('gs_tm_role_fz', 'gs_team_style_settings', 15);
		$gs_tm_role_fntw = gs_team_getoption('gs_tm_role_fntw', 'gs_team_style_settings', 'normal');
		$gs_tm_role_fnstyl = gs_team_getoption('gs_tm_role_fnstyl', 'gs_team_style_settings', 'italic');
		$gs_tm_role_color = gs_team_getoption('gs_tm_role_color', 'gs_team_style_settings', '#141412');
		$gs_tm_filter_cat_pos = gs_team_getoption('gs_tm_filter_cat_pos', 'gs_team_style_settings', 'center');
	?>
	<style>
		.gs_tm_theme1 .gs-member-name,
		.gs_tm_theme2 .gs-member-name,
		.gs_tm_theme3 .gs-member-name,
		.gs_tm_theme4 .gs-member-name,
		.gs_tm_theme5 .gs-member-name,
		.gs_tm_theme6 .gs-member-name,
		.gs_tm_theme7 .gs-member-name,
		.gs_tm_theme10 .gs-member-name,
		.gs_tm_theme20 .gs-member-name,
		.gs_tm_theme23 .gs-member-name,
		.gs_team_popup_details .gs-member-name,
		.single-gs_team .gs-sin-mem-name,
		.gs-archive-container .gs-arc-mem-name,
		.gs_tm_theme14 .gs-member-name a,
		.gs_tm_theme15 .gs-member-name a,
		.gs_tm_theme16 .gs-member-name a {
		    font-size: <?php echo $gs_tm_m_fz;?>px;
		    font-weight: <?php echo $gs_tm_m_fntw; ?>;
		    font-style: <?php echo $gs_tm_m_fnstyl; ?>;
		    color: <?php echo $gs_tm_mname_color; ?>;
		    box-shadow: none;
		    text-decoration: none;   
		}
		.mfp-arrow:hover,.mfp-close:hover {
		    background-color: <?php echo $gs_tm_arrow_color; ?>;
		}
		.gs_team_ribbon{
			background: <?php echo $gs_tm_ribon_color; ?>;
		}
		.gs_tm_theme8 .gs-member-name,
		.gs_tm_theme9 .gs-member-name, 
		.gs_tm_theme11 .gs-member-name, 
		.gs_tm_theme12 .gs-member-name, 
		.gs_tm_theme19 .gs-member-name,
		.gstm-panel-title {
			background-color: <?php echo $gs_tm_mname_backcolor; ?>;
		}
		.gs_tm_theme8 .single-member .gs_team_overlay i,
		.gs_tm_theme9 .single-member .gs_team_overlay i,
		.gs_tm_theme11 .single-member .gs_team_overlay i,
		.gs_tm_theme12 .single-member .gs_team_overlay i,
		.gs_tm_theme19 .single-member .gs_team_overlay i {
			background-color: <?php echo $gs_tm_hovericon_backcolor; ?>;
		}
		.gs_tm_theme1 .gs-member-desig,
		.gs_tm_theme2 .gs-member-desig,
		.gs_tm_theme3 .gs-member-desig,
		.gs_tm_theme4 .gs-member-desig,
		.gs_tm_theme5 .gs-member-desig,
		.gs_tm_theme6 .gs-member-desig,
		.gs_tm_theme7 .gs-member-desig,
		.gs_tm_theme10 .gs-member-desig,
		.gs_tm_theme20 .gs-member-desig,
		.gs_tm_theme23 .gs-member-desig,
		.gs_team_popup_details .gs-member-desig,
		.single-gs_team .gs-sin-mem-desig,
		.gs-archive-container .gs-arc-mem-desig {
			font-size: <?php echo $gs_tm_role_fz; ?>px;
		    font-weight: <?php echo $gs_tm_role_fntw; ?>;
		    font-style: <?php echo $gs_tm_role_fnstyl; ?>;
		    color: <?php echo $gs_tm_role_color; ?>;   
		}
		.gs-team-filter-cats {
            text-align: <?php echo $gs_tm_filter_cat_pos; ?>;
        }
	</style>
	<?php 
	}
}
add_action('wp_head', 'gs_team_setting_styles' );

if ( gtm_fs()->is__premium_only() or gtm_fs()->can_use_premium_code() ) {
	// -- OWL Carousel 
	if (!function_exists('gs_team_slider_trigger')) {
		
		function gs_team_slider_trigger(){ ?>
			<script type="text/javascript">
				jQuery.noConflict();
				jQuery(document).ready(function(){

				jQuery('.slider').owlCarousel({
					autoplay: true,
					autoplayHoverPause: true,
					loop: true,
					margin: 10,
					autoplaySpeed: 1000,
					autoplayTimeout: 2500,
					navSpeed: 1000,
					dots: true,
				    // dotsEach: true, 
				    responsiveClass:true,
				    lazyLoad: true,
				    responsive:{
				        0:{
				            items:1,
				            nav:false
				        },
				        533:{
				            items:2,
				            nav:false
				        },
				        768:{
				            items:3,
				            nav:false
				        },
				        1000:{
				            items:4,
				            nav:true
				        }
				    }    
				}) // end of owlCarousel latest product
				});
			</script>
		<?php
		}
		add_action('wp_head', 'gs_team_slider_trigger' );
	}

	// -- Magnific Popup
	if ( !function_exists('gs_team_magnific_popup')) {
		
		function gs_team_magnific_popup(){ ?>
			<script type="text/javascript">
				jQuery.noConflict();
				jQuery(document).ready(function(){
					jQuery('.single-member-pop').magnificPopup({
						type:'inline',
						midClick: true,
						gallery:{
							enabled:true
						},
						delegate: 'a.gs_team_pop',
						removalDelay: 500, //delay removal by X to allow out-animation
						callbacks: {
						    beforeOpen: function() {
						       this.st.mainClass = this.st.el.attr('data-effect');
						    }
						},
					  	closeOnContentClick: true,
					});
				});
			</script>
		<?php
		}
		add_action( 'wp_footer','gs_team_magnific_popup' );
	}

	// -- Shortcode for widget [gs_team_sidebar]
	add_shortcode('gs_team_sidebar','gs_team_gs_team_sidebar_shortcode');

	function gs_team_gs_team_sidebar_shortcode( $atts ) {

		extract(shortcode_atts(
			array(
			'total_mem' 	=> -1,
			'group_mem'		=> ''
			), $atts
		));

		$gs_team_loop_side = new WP_Query(
			array(
			'post_type'			=> 'gs_team',
			'order'				=> 'DESC',
			'orderby'			=> 'date',
			'posts_per_page'	=> $total_mem,
			'team_group'		=> $group_mem
		));
	       
	        $output = '';
			// $output = '<div class="wrap gs_team_area">';

			$gs_member_name = gs_team_getoption('gs_member_name', 'gs_team_settings', 'on');
			$gs_member_role = gs_team_getoption('gs_member_role', 'gs_team_settings', 'on');
			$gs_tm_link_tar = gs_team_getoption('gs_tm_link_tar', 'gs_team_settings', '_blank');

			// $output .= '<div class="container">';
			// $output .= '<div class="row clearfix gs_team">';

				if ( $gs_team_loop_side->have_posts() ) {
						
						while ( $gs_team_loop_side->have_posts() ) {
							$gs_team_loop_side->the_post();
							$gs_team_id = get_post_thumbnail_id();
							$gs_team_url = wp_get_attachment_image_src($gs_team_id, 'full', true);
							$team_thumb = $gs_team_url[0];
							$gs_team_alt = get_post_meta($gs_team_id,'_wp_attachment_image_alt',true);
							$gs_member_desc_link = get_the_permalink();
							$gs_tm_meta = get_post_meta( get_the_id() );
							$designation = !empty($gs_tm_meta['_gs_des'][0]) ? $gs_tm_meta['_gs_des'][0] : '';
							$gs_social  = get_post_meta( get_the_id(), 'gs_social', true);
							
						    $output .= '<div itemscope="" itemtype="http://schema.org/Person">'; //Start sehema
							
							// $output .= '<div class="col-md-12">';
								$output .= '<div class="gs-team-widget">'; // start GS Team Widget
								$output .= '<a href="'. $gs_member_desc_link .'">';
								if ( has_post_thumbnail() )
						            $output .= '<img src="'. $team_thumb .'" alt="'. $gs_team_alt .'" itemprop="image"/>';
						        else {
						            $output .= '<img src="' . GSTEAM_FILES_URI . '/assets/img/no_img.png" class=""/>';
						        }
						        $output .= '</a>';

						        if ( 'on' ==  $gs_member_name ) :
						            $output.= '<div class="gs-member-name" itemprop="name">'. get_the_title() .'</div>';
						        endif;

								if(!empty( $designation ) && 'on' == $gs_member_role ):
						          $output.= '<div class="gs-member-desig" itemprop="jobtitle">'. $designation .'</div>';
						        endif;

						        $output .='<div class="gs-team-table-cell gs-tm-sicons">';
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

						        $output .= '</div>'; // end GS Team Widget

							// $output .= '</div>'; // end col
							$output .= '</div>'; //end sehema
						} // end while loop
						// do_action('gs_team_custom_css');
					} else {
						$output .= "No Team Member Added!";
					}
					wp_reset_postdata();

			// $output .= '</div>'; // end row
			// $output .= '</div>'; // end container
			return $output;
			
			// $output .= '</div>'; // end wrap

		return $output;
	}
}