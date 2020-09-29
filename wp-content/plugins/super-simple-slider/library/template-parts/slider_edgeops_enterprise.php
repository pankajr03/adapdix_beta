<?php 
if ( $slides ) :
	$has_min_width		= $slider_settings['super_simple_slider_has_min_width'];
	$min_width			= $slider_settings['super_simple_slider_min_width'];

	$container_classes = array();
			
	$arrow_style = null;

	$slider_id = uniqid();
	
	include($this->parent->assets_dir . '/includes/dynamic-css-slider.php');
?>
	<div class="section-hp pb-0 sm-section-p tesitomnial-responive">
		<div class="custom-container">
			<div class="row">
				<div class="col-md-4 offset-md-1 specil">
					<h3 class="mb-5 heding-style-two headingTopLine"><?php echo $post_title;?></h3>
				</div>
				<div class="col-md-7">
					<div class="row">
					<?php
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
						?>
						
							<div class="col-md-4  mb-3 ">
								<div class="feature-boxs edgeops">
									<span class="box-head-title"><img src="<?php echo esc_url( $slide_image[0] ); ?>"></span>
									<p class="margin_top_20"><?php echo $title?> &nbsp;</p>
								</div>
							</div>
						<?php endforeach; ?>
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