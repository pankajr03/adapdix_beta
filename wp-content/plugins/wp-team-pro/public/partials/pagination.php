<?php
if ( $pagination ) : ?>
	<?php
	if ( 'pagination_number' == $pagination_type && $total_page > 1 ) :
		?>
		<div class="sptp-post-pagination">
		<ul>
			<li>
				<span class="prev ajax-page-numbers <?php echo ( 1 === $page_numb ) ? 'pagination-disable' : ''; ?>">
					<i class="fa fa-angle-left"></i>
				</span>
			</li>
			<?php
			foreach ( $filter_members_chunk as $key => $value ) :
				?>
				<li>
					<span class="ajax-page-numbers <?php echo ( $page_numb == ( $key + 1 ) ) ? 'current' : ''; ?>">
						<?php echo $key + 1; ?>
					</span>
				</li>
				<?php
			endforeach;
			?>
			<li>
				<span class="next ajax-page-numbers <?php echo ( count( $filter_members_chunk ) === $page_numb ) ? 'pagination-disable' : ''; ?>">
					<i class="fa fa-angle-right"></i>
				</span>
			</li>
		</ul>
	</div>
		<?php
	endif;
	if ( 'pagination_btn' === $pagination_type ) :
		?>
		<div class="sptp-post-pagination">
		<?php
		$paged_var = 'paged' . $generator_id;
		$args      = array(
			'format'    => '?paged' . $generator_id . '=%#%',
			'current'   => isset( $_GET[ "$paged_var" ] ) ? $_GET[ "$paged_var" ] : 1,
			'total'     => $filter_members_query->max_num_pages,
			'prev_next' => true,
			'next_text' => '<i class="fa fa-angle-right"></i>',
			'prev_text' => '<i class="fa fa-angle-left"></i>',
		);
		echo paginate_links( $args );
		?>
		</div>
		<div class="page-load-status">
			<p class="loader-ellips infinite-scroll-request">
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
			</p>
			<p class="infinite-scroll-last">End of content</p>
			<p class="infinite-scroll-error">No more pages to load</p>
		</div>
		<div class="sptp-post-load-more">
			<span><?php echo esc_html( $load_more_label ); ?></span>
		</div>
		<?php
	endif;
	if ( 'pagination_scrl' === $pagination_type ) :
		?>
		<div class="sptp-post-load-more">
			<span><?php echo esc_html( $scroll_load_more_label ); ?></span>
		</div>
		<div class="sptp-post-pagination hidden">
		<?php
		$paged_var = 'paged' . $generator_id;
		$args      = array(
			'format'    => '?paged' . $generator_id . '=%#%',
			'current'   => isset( $_GET[ "$paged_var" ] ) ? $_GET[ "$paged_var" ] : 1,
			'total'     => $filter_members_query->max_num_pages,
			'prev_next' => true,
			'next_text' => '<i class="fa fa-angle-right"></i>',
			'prev_text' => '<i class="fa fa-angle-left"></i>',
		);
		echo paginate_links( $args );
		?>
		</div>
		<div class="page-load-status">
			<p class="loader-ellips infinite-scroll-request">
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
			</p>
			<p class="infinite-scroll-last">End of content</p>
			<p class="infinite-scroll-error">No more pages to load</p>
		</div>
		<?php
	endif;
	if ( 'pagination_normal' == $pagination_type ) :
		?>
		<div class="sptp-post-pagination">
		<?php
		$paged_var = 'paged' . $generator_id;
		$args      = array(
			'format'    => '?paged' . $generator_id . '=%#%',
			'total'     => $filter_members_query->max_num_pages,
			'current'   => isset( $_GET[ "$paged_var" ] ) ? $_GET[ "$paged_var" ] : 1,
			'prev_next' => true,
			'next_text' => '<i class="fa fa-angle-right"></i>',
			'prev_text' => '<i class="fa fa-angle-left"></i>',
		);
		echo paginate_links( $args );
		?>
		</div>
		<?php
	endif;
	wp_reset_postdata();
endif;
