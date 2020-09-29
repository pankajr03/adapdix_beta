<?php
// mts_home.php
/**
 * Template Name: Members - wide - nocomments
 * Unit Template Name: Members - wide - nocomments
 */
get_header('members'); ?>
    <div class="container">

        <div class="hero-unit">
            <div class="row-fluid">

                <div class="span12 ">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('content', 'page'); ?>

                    <?php endwhile; // end of the loop. ?>
                </div>

            </div>

        </div>

    </div>
    <!-- /container -->
<?php get_footer('home'); ?>