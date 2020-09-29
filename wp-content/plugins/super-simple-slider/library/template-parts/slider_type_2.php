<?php 
if ( $slides ) :
		$has_min_width		= $slider_settings['super_simple_slider_has_min_width'];
		$min_width			= $slider_settings['super_simple_slider_min_width'];
	
		$container_classes = array();
				
		$arrow_style = null;

		$slider_id = uniqid();
		
		include($this->parent->assets_dir . '/includes/dynamic-css-slider.php');
?>
		
		<div class="row m-0">
			<div class="col-md-12 pl-0 pr-0">
				<div id="super-simple-slider-<?php echo $slider_id; ?>" class="slider tesitomnial-slider-two">
		
							<?php
							foreach ( $slides as $slide ) :
								$image_id 	 = $slide['super_simple_slider_slide_image'];
								$slide_image = wp_get_attachment_image_src( $image_id, 'full' );
								
								$bgimage_id 	 = $slide['super_simple_slider_slide_bgimage'];
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
							
							<div class="slider-item specil pt-5" <?php echo $slide_bgimage_img?> >
								<div class="custom-container">
								  <div class="slider-content mb-5 pb-3 offset-md-1 silent">
									<div class="slider-text">
									 <h2 class="l-text-h mb-4 heding-style-two"><?php echo $title;?></h2>
									  <p class="lead text-white"><?php esc_html_e( $text ); ?></p>

									</div>
									<div class="slider-img align-self-end">
									  <img src="<?php echo esc_url( $slide_image[0] ); ?>" class="img-fluid">

									</div>

								  </div>
								</div>
							</div>
								
							
							<?php endforeach; ?>
								
						
			</div>
		</div>
	</div>	
		
		<script type="text/javascript">
		jQuery(document).ready(function() {
		  var slickOpts = {
			slidesToShow: 1,
			slidesToScroll: 1,
			//centerMode: true,
			easing: 'swing', // see http://api.jquery.com/animate/
			speed: 700,
			dots: true,
			arrows: false,
			customPaging: function(slick,index) {
				return '<a>' + (index + 1) + '</a>';
			}
		  };
		  // Init slick carousel
		  jQuery('#super-simple-slider-<?php echo $slider_id; ?>').slick(slickOpts);
		});

		</script>
		<script>
			$(document).ready(function() {
			  var slickOpts = {
				slidesToShow: 1,
				slidesToScroll: 1,
				//centerMode: true,
				easing: 'swing', // see http://api.jquery.com/animate/
				speed: 700,
				dots: true,
				arrows: false,
				customPaging: function(slick,index) {
					return '<a>' + (index + 1) + '</a>';
				}
			  };
			  // Init slick carousel
			  $('#super-simple-slider-<?php echo $slider_id; ?>').slick(slickOpts);
			});

		</script>
		
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

    