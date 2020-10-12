<?php
get_header('home'); ?>
	<div class="spacer-mobi"></div>
	<div class="section-contact resources-mob">
        <div class="custom-container">
            <?php if (have_posts()) : ?>
                <h1 ><?php printf(__('Search Results for: %s', 'twentytwelve'), '<span>' . get_search_query() . '</span>'); ?></h1>
            <?php endif; ?>

            <div class="row">
                <?php while( have_posts() ) { the_post(); ?>
                <div class="col-md-4 md-5">
                    <div class="feature-boxs">
                        
                        <span class="box-head-title">&nbsp;</span>
                        <h5 class="mb-3"><?php the_title()?></h5>
                        <div class="featured_content_p_height">
                        <p><?php echo wp_trim_words(get_the_content(), 18)?></p>
                        </div>
                        <a target="_blank" class="tearn-btn" href="<?php the_permalink()?>">Read More</a> 
                        

                    </div>
                </div>
                <?php } ?>
            </div>    
        </div>
    
	</div>
<?php get_footer('home'); ?>