<?php 
if ( $slides ) :
	$has_min_width		= $slider_settings['super_simple_slider_has_min_width'];
	$min_width			= $slider_settings['super_simple_slider_min_width'];

	$container_classes = array();
			
	$arrow_style = null;

	$slider_id = uniqid();
	
	include($this->parent->assets_dir . '/includes/dynamic-css-slider.php');
	$first_li_title = $slides[0]['super_simple_slider_slide_title'];
?>

	<div class="custom-container image_div_margin_40">
		<div class="row">
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
				$ico_company 	 = $slide['super_simple_slider_slide_company'];
			?>



				<div class="col-lg-4 col-md-4 mb-4 ">
					<div class="usecase-main usecasesolutions">
						<img src="<?php echo esc_url( $slide_image[0] ); ?>" class="img-fluid w-100">
						<div class="usecase-text">
							<div class="case-text">
								<h2 class="l-text-h mb-3"><?php echo $text?></h2>
								<p><?php echo $title?></p>
							</div>
							<div class="card_bottom-left-arrow"></div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>



	<?php else : ?>
		<div class="placeholder">
			<?php esc_html_e( 'Invalid Shortcode ID,', 'super-simple-slider' ); ?> <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=super-simple-slider' ) ); ?>" target="_blank"><?php esc_html_e( 'Create a new Slider', 'super-simple-slider' ); ?></a>
		</div>
	<?php endif; ?>