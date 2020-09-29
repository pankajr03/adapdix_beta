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

	<div class="section-hp pb-0 sm-section-p">
		<div class="custom-container">
			<div class="row">
				<div class="col-md-12">
					<div class="slider-nav-sloution-<?php echo $slider_id; ?>">
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
							<div class="text-center"><img src="<?php echo esc_url( $slide_image[0] ); ?>" class="img-fluid m-auto"><p class="primary-color"><?php echo $text?></p></div>	
						<?php endforeach; ?>
					</div>
					<!-- Second Tage -->
					<div class="slider-for-sloution-<?php echo $slider_id; ?>">
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
							<div>
								<div class="row">
									<div class="col-md-5 col-lg-5 career-text ">
										<h2 class="font-weight-normal mb-3 l-text-p"><?php echo $title?></h2>
										<p class=" mb-3 l-text-k"><?php echo $ico_company?></p>
									</div>
									
									<div class="col-md-7">
										<div class="threeColumpart">
											<ul class="l-text-k">
											<?php echo $text_2?>
											</ul>
										</div>
									</div>
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
<style>
.slider-nav-sloution-<?php echo $slider_id; ?> .slick-slide img {
    border: 1px solid #52bcf2;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px !important;
    position: relative;
    width: 60px;
    height: 60px;
}
.slider-nav-sloution-<?php echo $slider_id; ?> .slick-current p {
    color: #fff !important;
}
.slider-nav-sloution-<?php echo $slider_id; ?> .slick-slide {
    position: relative;
}
.slider-nav-sloution-<?php echo $slider_id; ?> .slick-slide:before {
    content: "";
    position: absolute;
    width: 100px;
    height: 3px;
    right: -50px;
    background: rgba(0, 0, 0, .4);
    top: 23px;
}
.slider-nav-sloution-<?php echo $slider_id; ?> .slick-slide.slick-current:before {
    background: #03A9F4;
}
.slider-nav-sloution-<?php echo $slider_id; ?> .slick-next:before {
    content: "\f105";
    font-family: FontAwesome !important;
    transform: rotate(45deg);
    font-size: 30px;
    color: #3ec4ff;
}

.slider-nav-sloution-<?php echo $slider_id; ?> .slick-prev:before{
    content: "\f104";
    font-family: FontAwesome !important;
    transform: rotate(45deg);
    font-size: 30px;
    color: #3ec4ff;
}
.slider-for-sloution-<?php echo $slider_id; ?> .slick-prev, .slider-for-sloution-<?php echo $slider_id; ?> .slick-next{
    display: none !important;
}

@media (max-width: 767px)  {

	.slider-for-sloution-<?php echo $slider_id; ?> p {
		font-size: 12px;
		line-height: 18px;
	}
	.slider-for-sloution-<?php echo $slider_id; ?> .threeColumpart ul li {
		margin-bottom: 0;
		font-size: 12px;
		line-height: 18px;
	}
	.slider-for-sloution-<?php echo $slider_id; ?> {
		margin-bottom: 70px;
	}
	.slider-nav-sloution-<?php echo $slider_id; ?> .slick-slide:before {
		display:none;
	}
}
</style>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script	src="  https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.js"></script>
<script>
$(document).ready(function () {
	$('.slider-for-sloution-<?php echo $slider_id; ?>').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  fade: true,

	  
	  asNavFor: '.slider-nav-sloution-<?php echo $slider_id; ?>'
	});
	$('.slider-nav-sloution-<?php echo $slider_id; ?>').slick({
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  asNavFor: '.slider-for-sloution-<?php echo $slider_id; ?>',
	  arrows: true,
	  centerMode: false,
	  focusOnSelect: true,
	  responsive: [
			{
				breakpoint: 980, // tablet breakpoint
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 480, // mobile breakpoint
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
		]
	});
	
	
	
});
</script>