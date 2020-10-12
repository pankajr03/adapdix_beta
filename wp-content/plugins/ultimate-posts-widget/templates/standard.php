<?php
/**
 * Standard ultimate posts widget template
 *
 * @version     2.1.1
 */
?>

<?php if ($instance['before_posts']) : ?>
  <div class="upw-before">
    <?php echo wpautop($instance['before_posts']); ?>
  </div>
<?php endif; ?>


	<div class="custom-container">
		<div class="row">
			<div class="col-md-12">
				<h1 class=" mb-5">Resources.</h1>
            </div>
             
			<div class="col-md-12 filters">
				<div class="filter-display mb-4"><span>Filter By: <span class="all-type pl-2" id="alltypes"> All Types </span></span> <button class=" btn primary-color filterreset" id="all">Reset</button></div>
				<div class="filter-types mb-5" id="filtertypes" style="display: none;">
					<button class="active btn filterreset" id="all"><img src="<?php echo get_template_directory_uri(); ?>/img/cross-img.png"></button>
					<?php 
					$postcategory = array() ;
					$dist_category = array() ;
					while ($upw_query->have_posts()) : $upw_query->the_post(); 
						$postcats 	            = get_the_terms($post->ID, 'category');
						$postcategory[$post->ID] = $postcats[0]->name;
						$dist_category[] = $postcats[0]->name;
					endwhile;
					$distinct_cat = array_unique($dist_category);
					foreach ( $distinct_cat as $kp=>$vp ) {
					?>
					<button class="btn filterbtns" id="<?php echo $vp?>"><?php echo $vp?></button>
					<?php } ?>
				</div>
            </div>
        </div>
			   
		<div >
			<div class="row" id="parent">
            <?php if ($upw_query->have_posts()) : ?>
			<?php 
				$child_id = 1;
				$read_more_watch = array("PRODUCT"=>"More", "NEWS"=>"Read", "VIDEOS"=> "Watch", "FEATURED"=> "More", "PRESS"=> "Read", "DOCS"=>"More") ; 
					
				while ($upw_query->have_posts()) : $upw_query->the_post(); 
					
					$cat_name = $postcategory[$post->ID];
					$link_name ='Read More';
					if ( isset($read_more_watch[$cat_name]) ) {
						$link_name = $read_more_watch[$cat_name];
					}		
					?>
					<div class="col-md-4  mb-5 <?php echo $postcategory[$post->ID]?>" id="child-<?php echo $child_id?>">
						<div class="feature-boxs ">
                           <span class="box-head-title"><?php echo $postcategory[$post->ID]?></span>
                           <h5 class="mb-3"><?php the_title(); ?></h5>
                           <div class="featured_content_p_height">
						   <?php //the_excerpt()?>
						   <?php echo wp_trim_words(get_the_content(), $excerpt_length)?>
						   </div>
						   <?php 
						   $aq_block_1_arr = get_post_meta($post->ID, 'aq_block_1');
						   $aq_block_1_url = $aq_block_1_arr[0];
						   //echo $aq_block_1_url;
						   ?>
                           <a target="_blank" class="tearn-btn" href="<?php echo $aq_block_1_url?>" ><?php echo $link_name?></a> <!-- href="<?php the_permalink(); ?>" -->
                        </div>
                     </div>
				<?php $child_id++; endwhile; ?>
			<?php endif;?>
			</div>
		</div>
	</div>
