<?php 
if ( $slides ) :
		$has_min_width		= $slider_settings['super_simple_slider_has_min_width'];
		$min_width			= $slider_settings['super_simple_slider_min_width'];
	
		$container_classes = array();
				
		$arrow_style = null;

		$slider_id = uniqid();
		
		include($this->parent->assets_dir . '/includes/dynamic-css-slider.php');
?>
		<div class="">
		<div class="custom-container">
			<div class="row ">
			<div class="col-md-12">
            <div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
				
				<ol class="carousel-indicators list-inline">
				<?php
				$count = 0;
				foreach ( $slides as $slide ) :
					$image_id 	 = $slide['super_simple_slider_slide_image'];
					$slide_image = wp_get_attachment_image_src( $image_id, 'full' );
					$active_class='';
					$selected_class ='';
					if ( $count == 0) {
						$active_class='active';
						$selected_class ='selected';
						
					}
					echo '<li class="list-inline-item '.$active_class.'"> <a id="carousel-selector-'.$count.'" class="'.$selected_class.'" data-slide-to="'.$count.'" data-target="#custCarousel"> <img src="'.esc_url( $slide_image[0]).'" class="img-fluid"> </a> </li>';
					$count++;
				endforeach;
				?>
                    <!-- li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel"> <img src="img/partners1.png" class="img-fluid"> </a> </li>
                    <li class="list-inline-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel"> <img src="img/partners2.png" class="img-fluid"> </a> </li>
                    <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="2" data-target="#custCarousel"> <img src="img/partners3.png" class="img-fluid"> </a> </li>
                    <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="3" data-target="#custCarousel"> <img src="img/partners4.png" class="img-fluid"> </a> </li>
					<li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="4" data-target="#custCarousel"> <img src="img/partners5.png" class="img-fluid"> </a> </li>
					<li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="5" data-target="#custCarousel"> <img src="img/partners6.png" class="img-fluid"> </a> </li -->
                </ol>
				
				<div class="carousel-inner">
                    <?php
					$count = 0;
					foreach ( $slides as $slide ) :
						$active_class='';
						if ( $count == 0) {
							$active_class='active';
							
						}
						$image_id 	 = $slide['super_simple_slider_slide_image'];
						$slide_image = wp_get_attachment_image_src( $image_id, 'full' );
						
						$bgimage_id 	 = $slide['super_simple_slider_slide_bgimage'];
						$company 	 = $slide['super_simple_slider_slide_company'];
						$slide_bgimage = wp_get_attachment_image_src( $bgimage_id, 'full' );
						$slide_bgimage_img='';
						if ( count($slide_bgimage) > 0 ) {
							$slide_bgimage_img = "style='background-image: url($slide_bgimage[0])'";
						
						}
						
						
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
						
						$has_buttons   = false;
						$button_1_text = trim( $this->getIfSet( $slide['super_simple_slider_slide_button_1_text'], '' ) );

						if ( $button_1_text ) {
							$has_buttons 			  = true;
							$button_1_link_content 	  = intval( $slide['super_simple_slider_slide_button_1_link_content'] );
							$button_1_link_custom_url = $slide['super_simple_slider_slide_button_1_link_custom_url'];
							$button_1_link_url		  = '';
							
							if ( $button_1_link_content != 'custom' && $button_1_link_content > 0 ) {
								$button_1_link_url = get_permalink( $button_1_link_content );
							} else if ( $button_1_link_content == 'custom' ) {
								$button_1_link_url = esc_url( $button_1_link_custom_url );
							}
							
							if ( $slide['super_simple_slider_slide_button_1_link_target'] == 'new-window' ) {
								$button_1_link_target  = '_blank';
							} else {
								$button_1_link_target  = '';
							}
						}
				
					?>
							
					<div class="carousel-item <?php echo $active_class;?>"> 
						<div class="col-md-8 text-left">
							<p class="l-text-p bio-quote partners-quots">
							<?php esc_html_e( $text ); ?>
							</p>
							<div class="partner-signs">
							     <h4 class=""><?php echo $title;?></h4>
                                 <h5><?php echo $company;?></h5>
							</div>
						</div>
					</div>
					
					
                <?php $count++; endforeach;?>    
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


<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script
  src="  https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.js"></script>

    