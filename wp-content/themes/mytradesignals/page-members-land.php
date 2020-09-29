<?php
// mts_home.php
/**
 * Template Name: Members: landing page
 */
get_header('members-land');
?>
    <div class="container">

        <div class="hero-unit">
            <div class="row-fluid">
                <div class="col-md-4">
                    <div id="secondary" class="widget-area" role="complementary">
                        <?php if (is_active_sidebar('members-home')) : ?>
                            <?php dynamic_sidebar('members-home'); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('content', 'page'); ?>
                    <?php endwhile; // end of the loop.   ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /container -->
<?php get_footer('home'); ?>