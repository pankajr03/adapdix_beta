<?php
// mts_home.php
/**
 * Template Name: Adapdix Company
 */

get_header('home'); ?>
			  
	<?php 
	while( have_posts() ) {
		the_post();
		$pageBannerImage = get_field('page_banner_background_image');
		$pageBannerMobileImage = get_field('page_banner_mobile_background_image');
		$photo_mobile = $pageBannerMobileImage['sizes']['pageBannerMobile'];	
		$photo = $pageBannerImage['sizes']['pageBanner'];
		$bannerArgu = array(
		'title' => get_field('page_banner_title'),
		'subtitle' => get_field('page_banner_subtitle'),
		'button_text' => get_field('page_banner_button_text'),
		'button_link' => get_field('page_banner_button_link'),
		'photo' => $photo,
		'photo_mobile' => $photo_mobile
		);
		pageBannerCompany($bannerArgu) ; 
	}
	get_template_part('content', 'homepage'); 
	?>
	
	<div class="section-hp sm-section-p">
		<div class="custom-container">
			<div class="row">
                           
				<div class="col-md-4 col-lg-4 offset-md-1">
					<h2 class="l-text-h mb-5 heding-style-two">Contact Us</h2>
                    <?php dynamic_sidebar('company-address-content');	?>
				</div>
				<div class="col-md-7 col-lg-7">
					<div class="contact-map">
						<?php dynamic_sidebar('company-gmap-content');	?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php get_footer('home'); ?>