<?php
// mts_home.php
/**
 * Template Name: Members - contact
 */
get_header('members'); ?>

    <div class="container">
        <?php the_post(); ?>
        <div class="hero-unit">
            <div class="row-fluid">
                <div class="span12">
                    <div class="contact entry-content clearfix">
                        <?php the_content(); ?>
                    </div>
                    <!-- .entry-content -->
                </div>
            </div>

        </div>

    </div>
    <!-- /container -->
<?php get_footer('home'); ?>