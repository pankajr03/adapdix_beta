<?php
// mts_home.php
/**
 * Template Name: Adapdix Products
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
		pageBanner($bannerArgu) ; 
	}
	get_template_part('content', 'homepage'); ?>

	<div class="adapdix-style-2">
		<div id="buttonOpenClose">Fundraising</div>
		<div class="adapdix-style-2-12">
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
		</div>
		
	</div>
	
	

<style>
.adapdix-style-2 {
	position: fixed;
	padding-left: 20px;
	width: auto;
	bottom:0%;
	right:0%;
	height: auto;
	z-index: 9999999999999;
}

#buttonOpenClose {
position: relative;
background: #3ec4ff!important;
padding:10px;
color: #fff;
bottom:40%;
right:0%;
height: auto;
float:left;
clear:both;
writing-mode: vertical-rl;

}
.adapdix-style-2-12 {
	width: 90%;
    margin-left: 10%;
	background: #3ec4ff!important;
	max-width:380px;
	padding-top:10px;
	padding-bottom:10px;
}
.adapdix-style-2-div-1 {
	margin-left:5%;
}
.adapdix-style-2 h1 {
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
		jQuery(".adapdix-learn-more-open").hide();
		jQuery(".adapdix-lear-more-close").hide();

		jQuery("#buttonOpenClose").click(function(){
			if (jQuery('.adapdix-learn-more-open').is(':hidden')) {
				if (jQuery('.adapdix-lear-more-close').is(':hidden')) {
					jQuery(".adapdix-learn-more-open").show();
				} else {
					jQuery(".adapdix-learn-more-open").hide();	
				}
				
				jQuery(".adapdix-lear-more-close").hide();	
			} else {
				jQuery(".adapdix-learn-more-open").hide();
				jQuery(".adapdix-lear-more-close").hide();
			}



			
		});

		jQuery(".adapdix-learn-more-open a").click(function(e){
			jQuery(".adapdix-learn-more-open").hide();
			jQuery(".adapdix-lear-more-close").show();
		}) ;

		jQuery("#adapdix-close-go-to").click(function(e){
			jQuery(".adapdix-learn-more-open").show();
			jQuery(".adapdix-lear-more-close").hide();
		}) ;

	}) ; 


</script>

<?php get_footer('home'); ?>