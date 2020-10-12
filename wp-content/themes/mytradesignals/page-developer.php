<?php
// mts_home.php
/**
 * Template Name: Adapdix Developer
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
		pageBanner($bannerArgu) ; 
	}
	get_template_part('content', 'homepage'); 
	?>

<?php get_footer('developer'); ?>