<div class="section-hp sm-section-p blog-responsive">
	<div class="custom-container">
		<div class="row">
			<div class="col-md-10 col-lg-10 specil offset-md-1">
			  <h2 class="l-text-h mb-5 heding-style-two">Featured Content</h2></div>
<div class="hide-dt">
<div class="owl-carousel owl-theme">
<?php 
$read_more_watch = array("PRODUCT"=>"More", "NEWS"=>"Read", "VIDEOS"=> "Watch", "FEATURED"=> "More", "PRESS"=> "Read", "DOCS"=>"More") ; 
while ( $r->have_posts() ) : $r->the_post(); ?>
<?php 
$getCatNameArr = get_the_category();
$cat_name = $getCatNameArr[0]->name;
$link_name ='Read More';
if ( isset($read_more_watch[$cat_name]) ) {
	$link_name = $read_more_watch[$cat_name];
} 
$aq_block_1_arr = get_post_meta(get_the_ID(), 'aq_block_1');
$aq_block_1_url = $aq_block_1_arr[0];
?>
<div class="item">
<div class="feature-boxs">
<span class="box-head-title"><?php the_category()?></span>
<h5 class="mb-3"><?php get_the_title() ? the_title() : the_ID(); ?></h5> 
<a target="_blank" class="tearn-btn" href="<?php echo $aq_block_1_url?>"><?php echo $link_name?></a>
</div>
</div>
<?php endwhile; ?>
</div>
</div>
			
			
			<?php 
			//print_r($read_more_watch) ;
			while ( $r->have_posts() ) : $r->the_post(); ?>
						
						<div class="col-md-4  mb-3 hide-m">
						<?php
							$getCatNameArr = get_the_category();
							$cat_name = $getCatNameArr[0]->name;
							$link_name ='Read More';
							if ( isset($read_more_watch["$cat_name"]) ) {
								$link_name = $read_more_watch["$cat_name"];
							} 
						?>
						<div class="feature-boxs">
								<span class="box-head-title"><?php echo $cat_name?></span>
								<h5 class="mb-3"><?php get_the_title() ? the_title() : the_ID(); ?></h5> 
									<?php 
								   $aq_block_1_arr = get_post_meta(get_the_ID(), 'aq_block_1');
								   $aq_block_1_url = $aq_block_1_arr[0];
								   ?>
									<div class="featured_content_p_height"><?php the_excerpt();?></div>
								   <a class="tearn-btn" target="_blank" href="<?php echo $aq_block_1_url?>"><?php echo $link_name?></a>
							</div>
						
						</div>
			
						
						<?php endwhile; ?>
			
		 
		  </div>
		</div>
  </div>
				  
<script>
$(document).ready(function () {
$('.owl-carousel').owlCarousel({
    stagePadding: 40,
    loop:true,
    margin:10,
    nav:false,
	dots:false,
	responsive:{
        0:{
            items:1
        },
        767:{
            items:2
        }
      
    }
	
});

//$('.owl-carousel').attr("width", "100%");
/*
$('.owl-item').css("width", "248px");
$('.owl-item .feature-boxs').css("height", "175px");
console.log ( $('.owl-item').css("width") ) ; 
*/
});
</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/owl.carousel.min.js"></script>

    