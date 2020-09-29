<?php
// mts_home.php
/**
 * Template Name: Adapdix Public Contact Us
 */
 
get_header('home'); ?>

<div class="spacer-mobi"></div>

	<div class="custom-container lines-bg">
		<div class="section-contact">

			<div class="row">
				<div class="col-md-6 pr-md-0">
				  
				  <?php dynamic_sidebar('contact-sidebar-content');	?>

				</div>
				
				<div class="col-md-6 text-center">
					<?php get_template_part('content', 'homepage'); ?>	
				</div>
			  </div>
		</div>
	</div>
</div>	  
	
	
	
<?php get_footer('home'); ?>