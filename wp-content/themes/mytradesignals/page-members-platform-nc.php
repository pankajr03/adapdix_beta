<?php
// mts_home.php
/**
 * Template Name: Members: platform without comments
 * Unit Template Name: Members: platform without comments
 */
get_header('members');
?>
    <div class="container">
        <div class="hero-unit">
            <div class="row-fluid">
                <div class="col-md-4">
                    <div id="secondary" class="widget-area" role="complementary">
                        <?php if (is_active_sidebar('members-platform')) : ?>
                            <?php dynamic_sidebar('members-platform'); ?>
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