<?php 
if ( $slides ) :
	$has_min_width		= $slider_settings['super_simple_slider_has_min_width'];
	$min_width			= $slider_settings['super_simple_slider_min_width'];

	$container_classes = array();
			
	$arrow_style = null;

	$slider_id = uniqid();
	
	include($this->parent->assets_dir . '/includes/dynamic-css-slider.php');
	$first_li_title = $slides[0]['super_simple_slider_slide_title'];
	$first_li_text = $slides[0]['super_simple_slider_slide_text'];
?>

	<div class="section-hp pb-0 sm-section-p special-platform-sec">
		<div class="custom-container">
			<div class="row">
				<div class="col-lg-4 col-md-4 mb-4 offset-md-1">
					<h3 class="l-text-h mb-3 heding-style-three"><?php echo $first_li_text?></h3>
					<div class="case-text">
						<p class="lead text-white mb-4 pr-lg-5"><?php echo $first_li_title?></p>
						<p><a class="action-btn" href="http://adapdix.dev3/?page_id=552">SOLUTIONS</a></p>
					</div>
				</div>
				
				<div class="col-lg-7 col-md-7 mb-4 specil">
					<h2 class="l-text-h mb-3 text-center"><?php echo $post_title?>:</h2>
					<div class="row">
						<div class="col-lg-6 col-md-6 mb-4 ">
							<div class="drive_sol">
								<ul>
									<?php
									$count_slider = 1;
									foreach ( $slides as $slide ) :
										
										$image_id 	 = $slide['super_simple_slider_slide_image'];
										$slide_image = wp_get_attachment_image_src( $image_id, 'full' );
										
										$slide_image_alt 	= $slide['super_simple_slider_slide_image_alt'];
										$slide_image_title 	= $slide['super_simple_slider_slide_image_title'];

										$overlay_color_rgb 		= 'rgba(0, 0, 0, ' .$slide['super_simple_slider_slide_overlay_opacity']. ')';
										$text_overlay_color_rgb = 'rgba(0, 0, 0, ' .$slide['super_simple_slider_slide_text_overlay_opacity']. ')';
										
										$text_overlay_text_shadow = $this->getIfSet( $slide['super_simple_slider_slide_text_overlay_text_shadow'], false);
										
										$opacity_classes = array();
										
										if ( $text_overlay_text_shadow ) {
											$opacity_classes[] = 'text-shadow';
										}
										
										$title = trim( $slide['super_simple_slider_slide_title'] );
										$text  = trim( $slide['super_simple_slider_slide_text'] );
										$text_2  = trim( $slide['super_simple_slider_slide_text_2'] );
										$ico_company 	 = $slide['super_simple_slider_slide_company'];
									?>
										<li class="ico-img <?php echo $ico_company?>"><?php echo $text_2?></li>
										<?php if( $count_slider%3==0) { ?>
									</ul>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 mb-4 ">
								<div class="drive_sol">
									<ul>	
							<?php } ?>
							
						<?php $count_slider++; endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php else : ?>
	<div class="placeholder">
		<?php esc_html_e( 'Invalid Shortcode ID,', 'super-simple-slider' ); ?> <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=super-simple-slider' ) ); ?>" target="_blank"><?php esc_html_e( 'Create a new Slider', 'super-simple-slider' ); ?></a>
	</div>
<?php endif; ?>