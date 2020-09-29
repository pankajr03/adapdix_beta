<?php
/**
 * Template Name: Members: Gordon Scott No Comments
 * Unit Template Name: Members: Gordon Scott No Comments
 */

get_header('members'); ?>
    <div class="container">
        <div class="hero-unit">
            <div class="row-fluid">
                <div class="col-md-4">
                    <div id="secondary" class="widget-area"
                         role="complementary">                    <?php if (is_active_sidebar('members-materials-course-1')) : ?>                        <?php dynamic_sidebar('members-materials-course-1'); ?>                        <?php get_template_part('multi', 'menu'); ?>                    <?php endif; ?>                </div>
                </div>
                <div
                    class="span9">                <?php while (have_posts()) : the_post(); ?>                    <?php get_template_part('content', 'page'); ?>                <?php endwhile; // end of the loop.   ?>            </div>
            </div>
        </div>
    </div>    <!-- /container --><?php get_footer('home'); ?>