<?php 
 $post = get_page(get_the_ID());
 $content = apply_filters('the_content', $post->post_content);
 echo $content;
?>
<footer class="entry-meta">
        <?php edit_post_link(__('Edit', 'twentytwelve'), '<span class="edit-link">', '</span>'); ?>
</footer>