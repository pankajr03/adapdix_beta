<?php
// mts_home.php
/**
 * Template Name: Login test tpl
 */

get_header('home');
?>
   <div  class="custom-container lines-bg">
			<div class="section-contact">
			<div class="row">
				<div class="col-md-12 text-center">
				<h1>Partner Login</h1>
				</div>
				<div class="col-md-12 pr-md-0" id="logindiv">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; // end of the loop. ?>
				</div>
            </div>
            </div>
        </div>
<?php get_footer('home'); ?>