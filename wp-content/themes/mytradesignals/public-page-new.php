<?php

/**
 * Template Name: Public page right sidebar
 */
?>

<?php get_header('public-blog'); ?>


<div class="container container-blog">
    <article class="page type-page status-publish hentry">

        <!-- Main hero unit for a primary marketing message or call to action -->
        <div class="hero-unit blog-container">
            <div class="row-fluid">
                <div class="col-md-12">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('content', 'page'); ?>
                        <?php //comments_template('', true); ?>
                    <?php endwhile; // end of the loop.   ?>
                </div>
<!--                <div class="col-md-4">
                    <div class="widget-area">
                    <?php //if (is_active_sidebar('primary-widget-area')) : ?>
                        <?php //dynamic_sidebar('primary-widget-area'); ?>
                        <?php //get_template_part('multi', 'menu'); ?>
                    <?php //endif; ?>
                    </div>
                </div>-->
            </div>
        </div>
    </article>
</div>

<div id="footer">
    <?php get_footer('public-blog'); ?>
</div>