<!-- 
<ul class='featured_posts_widget 
	featured_posts_widget--<?php echo $widget_type ?> 
	featured_posts_widget--<?php echo $widget_size ?>
	
	<?=($show_thumbnail)? 'featured_posts_widget--thumb' :''?>
	'>
	<?php while ( $r->have_posts() ) : $r->the_post(); ?>
	<li>
		<?php if ( $show_thumbnail) : if(has_post_thumbnail()): ?>
		<span class="featured_posts__thumb">
			<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumbnail', array('style'=>'width:30px')) ?></a>
		</span>
		<?php endif; endif;?>
		<div class='featured_posts__detail'>
    		<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
    		
    		<?php if ( $show_author) : ?>
    		<span class="post-author">
    			<?php /*?><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>" class="author"><?php echo get_avatar($authorId, 36)?></a>*/ ?>
    			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>" class="author"> - <?php echo get_the_author();  ?></a>
    		</span>
    		<?php endif; ?>
    		
    		<?php if ( $show_date ) : ?>
    		<span class="post-date"><?php echo get_the_date(); ?></span>
    		<?php endif; ?>
		</div>
	</li>
	<?php endwhile; ?>
</ul>
-->