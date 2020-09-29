<?php
// mts_home.php
/**
 * Template Name: Public OPT-IN
 */

get_header('public-opt-in');
?>


<?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('content', 'page'); ?>
<?php endwhile; // end of the loop. ?>


<?php get_footer('public-opt-in'); ?>