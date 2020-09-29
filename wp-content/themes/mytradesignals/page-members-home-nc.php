<?php
// mts_home.php
/**
 * Template Name: Adapdix: Member Home
 */
get_header('members');
?>



		<div  class="custom-container lines-bg">
			<div class="section-contact">
			<div class="row">
				<div class="col-md-12 text-right">
				<h2>Memeber Area</h2>
				</div>
				<div class="col-md-4 pr-md-0">
					<?php if (is_active_sidebar('members-materials')) : ?>
						<?php dynamic_sidebar('members-materials'); ?>
                    <?php endif; ?>
					<?php get_template_part('multi', 'menu'); ?>
                   
				</div>
				
				<div class="col-md-8 pr-md-0">
					<?php get_template_part('content', 'homepage'); ?>
					
				</div>
				
			</div>
			</div>
			
			
		</div>
	  

   
<?php get_footer('home'); ?>