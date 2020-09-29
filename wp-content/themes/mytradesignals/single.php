<?php

/**
 *
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header('home'); ?>
<div class="spacer-mobi"></div>

<div class="section-contact resources-mob">
		
	<aside id="sticky-posts-2" class="widget widget_ultimate_posts">
	<div class="custom-container">
		<div class="row">
    
                    <?php if (have_posts()) while (have_posts()) : the_post(); ?>

						
						<div class="col-md-12">
							<h1 class=" mb-5"><?php the_title(); ?></h1>
						</div>
						
						<div class="col-md-12">
                        <?php //twentyten_posted_on(); ?>

                        <?php the_content(); ?>
                        <?php wp_link_pages(array('before' => '' . __('Pages:', 'twentyten'), 'after' => '')); ?>

                        <?php if (get_the_author_meta('description')) : // If a user has filled out their description, show a bio on their entries  ?>
                            <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('twentyten_author_bio_avatar_size', 60)); ?>
                            <h2><?php printf(esc_attr__('About %s', 'twentyten'), get_the_author()); ?></h2>
                            <?php the_author_meta('description'); ?>
                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                <?php printf(__('View all posts by %s &rarr;', 'twentyten'), get_the_author()); ?>
                            </a>
                        <?php endif; ?>

                        <?php edit_post_link(__('Edit', 'twentyten'), '', ''); ?>



                        <?php comments_template('', true); ?>
						</div>

                    <?php endwhile; // end of the loop. ?>


        </div>
        </div>
</aside>        
            
</div>

<?php get_footer('home');?>



