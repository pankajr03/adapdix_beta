<?php 
if ( $slides ) :
		$has_min_width		= $slider_settings['super_simple_slider_has_min_width'];
		$min_width			= $slider_settings['super_simple_slider_min_width'];
	
		$container_classes = array();
				
		$arrow_style = null;

		$slider_id = uniqid();
		
		include($this->parent->assets_dir . '/includes/dynamic-css-slider.php');
?>
	<div class="section-hp pb-0 sm-section-p">
		<div class="custom-container">
			<div class="row">
				<div class="col-md-12"> </div>
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
					$text_2  = trim( $slide['super_simple_slider_slide_text_2'] );
					$ico_company  = trim( $slide['super_simple_slider_slide_company'] );
					
					
				?>	
					<div class="col-lg-5 col-md-5 mb-4 ">
						<div class="case-text">
							<h2 class="l-text-h mb-3"><?php echo $title?></h2>
							<p class="l-text-j m-40"><?php echo $text?></p>
							<p class="l-text-j m-40 pt-4"><?php echo $text_2?></p>
						</div>
					</div>
					<div class="col-md-6 text-center banner-img img offset-md-1 specil">
						<img class="img-fluid" src="<?php echo esc_url( $slide_image[0] ); ?>" />
						<p> </p>
						<div class="edge_group">
							<button type="button" class="btn btn-secondary btn_clr01">EdgeFlexx</button><br>
							<button type="button" class="btn btn-secondary btn_clr02">EdgeMesh</button><br>
							<button type="button" class="btn btn-secondary btn_clr03">EdgeSite</button><br>
							<button type="button" class="btn btn-secondary btn_clr04">EdgeNode</button>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php else : ?>

		<div class="placeholder">
			<?php esc_html_e( 'Invalid Shortcode ID,', 'super-simple-slider' ); ?> <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=super-simple-slider' ) ); ?>" target="_blank"><?php esc_html_e( 'Create a new Slider', 'super-simple-slider' ); ?></a>
		</div>
	
	<?php endif; ?>