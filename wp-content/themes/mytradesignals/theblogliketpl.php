<?php
/**
 * Template Name: The New (blog like tpl)
 */

?>

<?php get_header('blog'); ?>
<div class="container container-blog">
    <article class="page type-page status-publish hentry">

        <!-- Main hero unit for a primary marketing message or call to action -->
        <div class="hero-unit blog-container c2">
            <div class="row-fluid">
                <div class="span4">
                    <div id="secondary" class="widget-area">
                        <?php if (is_active_sidebar('public-widget-area')) : ?>
                            <?php dynamic_sidebar('public-widget-area'); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="span1" style="width: 0.5%;">
                </div>
                <div class="span8">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('content', 'page'); ?>
                        <?php comments_template('', true); ?>
                    <?php endwhile; // end of the loop. ?>
                </div>

            </div>
        </div>
    </article>
</div>

<div id="footer">
    <?php get_footer('blog'); ?>
</div>