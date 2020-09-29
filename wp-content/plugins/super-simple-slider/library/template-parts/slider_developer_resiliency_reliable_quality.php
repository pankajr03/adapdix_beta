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

	<div class="section-hp sm-section-p feature-boxsparts-mobi">
		<div class="custom-container parner-categories ">
			<div class="row hide-m">

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
				
					<div class="col-md-4 col-lg-4 col-lx-4 mb-3 ">
						<div class="feature-boxs feature-boxsparts">
							<span class="box-head-title"><img src="<?php echo esc_url( $slide_image[0] ); ?>"></span><p></p>
							<h5 class="mb-3 mt-2"><?php echo $title?></h5>
							<p class=""><?php echo $text?></p>
							
							<div class="threeColumpart threeColumpartsecond">
								<p class=" mb-4 font-weight-bold mb-4 primary-color">
									<?php echo $ico_company?>
								</p>
								<ul>
									<?php echo $text_2?>
								</ul>
							</div>
						</div>
					</div>

		
				<?php $count_slider++; endforeach; ?>
			</div>
			
			<div class="hide-dt">
				<div class="owl-carousel-<?php echo $slider_id; ?> owl-theme">


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
				
					
					<div class="item">
						<div class="feature-boxs feature-boxsparts">
							<span class="box-head-title"><img src="<?php echo esc_url( $slide_image[0] ); ?>"></span><p></p>
							
							<h5 class="mb-3 mt-2"><?php echo $title?></h5>
							<p class=""><?php echo $text?></p>
							<div class="threeColumpart threeColumpartsecond">
								<p class=" mb-4 font-weight-bold mb-4 primary-color">
									<?php echo $ico_company?>
								</p>
								<ul>
									<?php echo $text_2?>
								</ul>
							</div>
						</div>
					</div>

				<?php $count_slider++; endforeach; ?>
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
.owl-carousel-<?php echo $slider_id; ?>,.owl-carousel-<?php echo $slider_id; ?> .owl-item{-webkit-tap-highlight-color:transparent;position:relative}
.owl-carousel-<?php echo $slider_id; ?>{display:none;width:100%;z-index:1}
.owl-carousel-<?php echo $slider_id; ?> .owl-stage{position:relative;-ms-touch-action:pan-Y;touch-action:manipulation;-moz-backface-visibility:hidden}
.owl-carousel-<?php echo $slider_id; ?> .owl-stage:after{content:".";display:block;clear:both;visibility:hidden;line-height:0;height:0}
.owl-carousel-<?php echo $slider_id; ?> .owl-stage-outer{position:relative;overflow:hidden;-webkit-transform:translate3d(0,0,0)}
.owl-carousel-<?php echo $slider_id; ?> .owl-item,.owl-carousel-<?php echo $slider_id; ?> .owl-wrapper{-webkit-backface-visibility:hidden;-moz-backface-visibility:hidden;-ms-backface-visibility:hidden;-webkit-transform:translate3d(0,0,0);-moz-transform:translate3d(0,0,0);-ms-transform:translate3d(0,0,0)}
.owl-carousel-<?php echo $slider_id; ?> .owl-item{min-height:1px;float:left;-webkit-backface-visibility:hidden;-webkit-touch-callout:none}
.owl-carousel-<?php echo $slider_id; ?> .owl-item img{display:block;width:100%}
.owl-carousel-<?php echo $slider_id; ?> .owl-dots.disabled,.owl-carousel-<?php echo $slider_id; ?> .owl-nav.disabled{display:none}
.no-js .owl-carousel-<?php echo $slider_id; ?>,.owl-carousel-<?php echo $slider_id; ?>.owl-loaded{display:block}
.owl-carousel-<?php echo $slider_id; ?> .owl-dot,.owl-carousel-<?php echo $slider_id; ?> .owl-nav .owl-next,.owl-carousel-<?php echo $slider_id; ?> .owl-nav .owl-prev{cursor:pointer;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}
.owl-carousel-<?php echo $slider_id; ?> .owl-nav button.owl-next,.owl-carousel-<?php echo $slider_id; ?> .owl-nav button.owl-prev,.owl-carousel-<?php echo $slider_id; ?> button.owl-dot{background:0 0;color:inherit;border:none;padding:0!important;font:inherit}
.owl-carousel-<?php echo $slider_id; ?>.owl-loading{opacity:0;display:block}
.owl-carousel-<?php echo $slider_id; ?>.owl-hidden{opacity:0}
.owl-carousel-<?php echo $slider_id; ?>.owl-refresh .owl-item{visibility:hidden}
.owl-carousel-<?php echo $slider_id; ?>.owl-drag .owl-item{-ms-touch-action:pan-y;touch-action:pan-y;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}
.owl-carousel-<?php echo $slider_id; ?>.owl-grab{cursor:move;cursor:grab}
.owl-carousel-<?php echo $slider_id; ?>.owl-rtl{direction:rtl}
.owl-carousel-<?php echo $slider_id; ?>.owl-rtl .owl-item{float:right}
.owl-carousel-<?php echo $slider_id; ?> .animated{animation-duration:1s;animation-fill-mode:both}
.owl-carousel-<?php echo $slider_id; ?> .owl-animated-in{z-index:0}
.owl-carousel-<?php echo $slider_id; ?> .owl-animated-out{z-index:1}
.owl-carousel-<?php echo $slider_id; ?> .fadeOut{animation-name:fadeOut}@keyframes fadeOut{0%{opacity:1}100%{opacity:0}}
.owl-height{transition:height .5s ease-in-out}
.owl-carousel-<?php echo $slider_id; ?> .owl-item .owl-lazy{opacity:0;transition:opacity .4s ease}
.owl-carousel-<?php echo $slider_id; ?> .owl-item .owl-lazy:not([src]),.owl-carousel-<?php echo $slider_id; ?> .owl-item .owl-lazy[src^=""]{max-height:0}
.owl-carousel-<?php echo $slider_id; ?> .owl-item img.owl-lazy{transform-style:preserve-3d}
.owl-carousel-<?php echo $slider_id; ?> .owl-video-wrapper{position:relative;height:100%;background:#000}
.owl-carousel-<?php echo $slider_id; ?> .owl-video-play-icon{position:absolute;height:80px;width:80px;left:50%;top:50%;margin-left:-40px;margin-top:-40px;background:url(owl.video.play.png) no-repeat;cursor:pointer;z-index:1;-webkit-backface-visibility:hidden;transition:transform .1s ease}
.owl-carousel-<?php echo $slider_id; ?> .owl-video-play-icon:hover{-ms-transform:scale(1.3,1.3);transform:scale(1.3,1.3)}
.owl-carousel-<?php echo $slider_id; ?> .owl-video-playing .owl-video-play-icon,.owl-carousel-<?php echo $slider_id; ?> .owl-video-playing .owl-video-tn{display:none}
.owl-carousel-<?php echo $slider_id; ?> .owl-video-tn{opacity:0;height:100%;background-position:center center;background-repeat:no-repeat;background-size:contain;transition:opacity .4s ease}
.owl-carousel-<?php echo $slider_id; ?> .owl-video-frame{position:relative;z-index:1;height:100%;width:100%}
</style>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script	src="  https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/owl.carousel.min.js"></script>

<script>
$(document).ready(function() {
	$('.owl-carousel-<?php echo $slider_id; ?>').owlCarousel({
	stagePadding: 40,
	loop:true,
	margin:10,
	nav:false,
	dots:false,
	responsive:{
		0:{
		items:1
		},
		992:{
			items:1
		}

	}
	});
});

</script>