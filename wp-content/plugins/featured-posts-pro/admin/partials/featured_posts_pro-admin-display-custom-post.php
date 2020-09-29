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

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class='wrap'>
<h2>Post Types</h2>
<p>Select the post types that you want to the featured posts</p>  
<form method="post">
<table class='wp-list-table widefat fixed striped admin-fppro-tbl-small '>
	<thead>
    	<tr>
			<td class='check-column'></td>
			<td>Post Type</td>
			<td class='manage-column column-is_featured'>add featured</td>    		
    	</tr>
	</thead>
	<tbody>
		<?php
		foreach ($postTypes as $postType): 
		?>
		<tr>
			<td></td>
			<td><?php echo $postType; ?></td>
			<td class='column-is_featured'>
			<?php
			$isIncluded = (in_array($postType, $allowedPostTypes));
			?>
			<input value='<?php echo $postType; ?>' type="checkbox" name="is_post_featured[]" <?php checked($isIncluded, true) ?>>
			</td>
		</tr>
		<?php endforeach;
		?>
	</tbody>
</table>
<p>
<input type='submit' class='button button-primary button-large' name='save-featured-posts-posttypes' value='save changes' />
</p>
</form>
</div>