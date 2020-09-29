<?php
// page-placeholder.php
/**
 * Template Name: HTML placeholder
 * Created by PHP Developer.
 * User: Developer
 * DateTime: 29/07/13 11:21
 */

?>
<?php while (have_posts()) : the_post(); ?>
    <?php echo get_the_content(); ?>
<?php endwhile; // end of the loop. ?>