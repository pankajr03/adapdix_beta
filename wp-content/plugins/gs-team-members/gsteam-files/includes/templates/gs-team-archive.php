<?php
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
get_header(); ?>

<div class="container gs-archive-container">
	<div class="row clearfix gs_team" id="gs_team_archive">
		<h1 class="arc-title">Team Members Archive</h1>
		<?php while ( have_posts() ) : the_post(); 

		$gs_team_id = get_post_thumbnail_id();
		$gs_team_url = wp_get_attachment_image_src($gs_team_id, 'full', true);
		$team_thumb = $gs_team_url[0];
		$gs_team_alt = get_post_meta($gs_team_id,'_wp_attachment_image_alt',true);
		$gs_member_desc = get_the_content();
		$gs_member_desc_link = get_the_permalink();
		
		$gs_tm_meta = get_post_meta( get_the_id() );
		$designation = !empty($gs_tm_meta['_gs_des'][0]) ? $gs_tm_meta['_gs_des'][0] : '';
		$gs_social = get_post_meta( get_the_id(), 'gs_social', true);
		$gs_tm_link_tar = gs_team_getoption('gs_tm_link_tar', 'gs_team_settings', '_blank');
	?>
		
		<div itemscope="" itemtype="http://schema.org/Person"> <!-- Start sehema -->
		<div class="col-md-4 col-sm-6 col-xs-6">
		
		<div class="gs-arc-mem-img">
			<a href="<?php echo $gs_member_desc_link; ?>">
				<?php if ( has_post_thumbnail() ) : ?>
		            <img src="<?php echo $team_thumb; ?>" alt="<?php echo $gs_team_alt; ?>" itemprop="image"/>
		       	<?php else : ?> 
		       		<img src="<?php echo GSTEAM_FILES_URI; ?>/assets/img/no_img.png" class=""/>
		       <?php endif; ?>
	       	</a>
	    </div>

		<div class="gs_member_details gs-tm-sicons">
			<a href="<?php echo $gs_member_desc_link; ?>">
				<h1 class="gs-arc-mem-name" itemprop="name"><?php the_title(); ?></h1>
			</a>
			
			<div class="gs-arc-mem-desig" itemprop="jobtitle"><?php echo $designation; ?></div>

			<div itemscope itemtype="http://schema.org/Organization"> <!-- social links -->
	        	<ul class="gs-team-social">
	            	<?php 
	            	if(!empty($gs_social)){
	            		foreach ($gs_social as $key => $value) {

		            		if($value['icon']=='envelope'){
		            			$link=!empty($value['link']) ? 'mailto:'.$value['link'] :'#';
		            		} else{
		            			$link=!empty($value['link']) ? $value['link'] :'#';
		            		}
		            ?>
							<li><a class ="<?php echo $value['icon'] ?>"href="<?php echo $link ?>" target="<?php echo $gs_tm_link_tar ?>" itemprop="sameAs"><i class="fa fa-<?php echo $value['icon']?>"></i></a></li>
					<?php	} // end foreach
	            	} ?>  <!-- end if -->
	            </ul>
			</div> <!-- end social links -->
			<!-- <p class="gs-arc-mem-desc" itemprop="description"><?php //echo get_the_content(); ?></p> -->
		</div>
		
		</div> <!-- end col -->
		</div> <!-- end sehema -->
	
		<?php endwhile; ?>

	</div> <!-- end row -->
</div> <!-- end container -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>