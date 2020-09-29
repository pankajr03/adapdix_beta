<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://lakshman.com.np
 * @since      1.0.0
 *
 * @package    Featured_Posts_Pro
 * @subpackage Featured_Posts_Pro/admin/partials
 */
?>
<div class='wrap'>
<h1>Featured Posts</h1>
<?php
if($featuredPosts->have_posts()):?>
<p>Drag the posts up and down to reposition the featured posts</p>
<form method='get' id='admin-featured-posts-pro-form'>
    <table class='wp-list-table widefat fixed striped  admin-fppro-tbl-medium  '>
    	<thead>
        	<tr>
    			<td class='check-column'></td>
    			<td>Title</td>
    			<td class='manage-column column-date'>Date</td>
    			<td class='manage-column column-categories'>Category</td>
    			<td class='manage-column column-categories'>Post Type</td>
    			<td class='manage-column column-is_featured'>isFeatured</td>
        	</tr>
    	</thead>
    	<tbody id='admin-featured-posts-pro-list'>
    		<?php
    		global $post;
    		while($featuredPosts->have_posts()): $featuredPosts->the_post(); 
    		?>
    		<tr data-id='<?php echo $post->ID ?>' >
    			<td>
    			<i class="fa fa-bars" aria-hidden="true"></i><?php //echo get_post_meta($post->ID, 'post_featured_position', true) ?>
    			</td>
    			<td><?php the_title(); ?>
    				<div class='row-actions'>
    					<span class="edit"><?php edit_post_link(); ?> | </span>
    					<span class="view"><a href="<?php the_permalink() ?>">View</a></span>
    				</div>
    			</td>
    			<td>Published<br /><?php the_time('Y/m/d'); ?></td>
    			<td><?php the_category(', '); ?></td>
    			<td><?php echo $post->post_type; ?></td>
    			<td class='column-is_featured'>
    			<?php $this->custom_columns_hander('is_featured', $post->ID); ?>
    			</td>
    			
    		</tr>
    		<?php endwhile;
    		wp_reset_postdata();
    		?>
    	</tbody>
    </table>
</form>
<?php else: ?>
<strong>Zero posts are set as featured!</strong>	
<?php endif; ?>
</div>
