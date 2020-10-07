<?php
// mts_home.php
/**
 * Template Name: Adapdix Home
 */

get_header('home'); ?>

				  
	<?php 
	while( have_posts() ) {
		the_post();
		$pageBannerImage = get_field('page_banner_background_image');
		$photo = $pageBannerImage['sizes']['pageBanner'];
		$bannerArgu = array(
		'title' => get_field('page_banner_title'),
		'subtitle' => get_field('page_banner_subtitle'),
		'button_text' => get_field('page_banner_button_text'),
		'button_link' => get_field('page_banner_button_link'),
		'photo' => $photo
		);
		pageBannerHome($bannerArgu) ; 
	}
	?>
	<div class="adapdix-fundraising">
		<!-- div id="buttonOpenClose">Fundraising</div -->
		<div class="adapdix-learn-more-open">
		<h1 class="lead text-white mb-4 pr-lg-5 f-w500">Adapdix Raises $x Million in SeriesA Funding</h1>
		<div><a href="#" class="tearn-btn">LEARN MORE</a></div>
		</div>
		<div class="adapdix-lear-more-close" >
			<div id="adapdix-close-go-to">X</div>
			<ul>
				<li><img src="<?php echo get_template_directory_uri(); ?>/img/fund-partners/Micon.png" /></li>
				<li><img src="<?php echo get_template_directory_uri(); ?>/img/fund-partners/Morgan_Stanley.png" /></li>
				<li><img src="<?php echo get_template_directory_uri(); ?>/img/fund-partners/WRVI.svg" /></li>
				<li><img src="<?php echo get_template_directory_uri(); ?>/img/fund-partners/X2_Equity.png" /></li>
				
			</ul>
			<a class="tearn-btn" href="<?php echo get_site_url()?>/?page_id=43">DOWNLOAD PR</a>
			
		</div>
	</div>

<style>
.adapdix-fundraising {
position: fixed;
background: #3ec4ff!important;
color: #fff;
padding: 20px;
width: 30%;
bottom:0%;
left:0%;
height: auto;
z-index: 9999999999999;
}

.adapdix-fundraising h1 {
font-size: 125%;
line-height: 100%;
}
.adapdix-lear-more-close { 
display: none; 
}

.adapdix-lear-more-close ul li { 
text-align:center; 
display:inline-block; 
padding:0.1em 1em; 
}
.adapdix-lear-more-close ul li img { 
width:100px; 
display:block; 
margin:0 auto;
}
/*
#buttonOpenClose {
	float: right;
    width: 20px;
    text-orientation: upright;
	writing-mode: vertical-rl;
}
*/
#adapdix-close-go-to {
	float:right;
	color:#fff;
	font-size:20px;
	cursor: pointer;
}

</style>

<script>
jQuery(document).ready(function(){
jQuery(".adapdix-learn-more-open a").click(function(e){
	jQuery(".adapdix-learn-more-open").hide();
	jQuery(".adapdix-lear-more-close").show();
}) ;

jQuery("#adapdix-close-go-to").click(function(e){
	jQuery(".adapdix-learn-more-open").show();
	jQuery(".adapdix-lear-more-close").hide();
}) ;


});
</script>
	
	<?php
	get_template_part('content', 'homepage'); 
	?>

	<?php dynamic_sidebar('featured-info-content');	?>
	
<?php get_footer('home'); ?>
