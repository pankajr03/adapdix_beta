<?php
/**
 * Modal.
 *
 * @package WP_Team_Pro
 * @since 2.0.0
 */

?>

<div class="sptp-popup-items <?php echo esc_html( $modal_layout ); ?>">
	<div class="sptp-popup-items-main">
		<div class="sptp-popup-header clearfix">
			<a href="#" class="sptp-popup-close"></a>
			<?php if ( 'multiple' === $modal_type ) : ?>
			<span class="sptp-popup-nav">
				<a href="#" class="sptp-nav-item sptp-nav-left"><i class="fa fa-angle-left"></i></a>
				<a href="#" class="sptp-nav-item sptp-nav-right"><i class="fa fa-angle-right"></i></a>
			</span>
			<?php endif; ?>
		</div>
		<!-- .sptp-popup-item -->
		<?php
		if ( 'carousel' == $layout['layout_preset'] ) {
			$members_array = $filter_members;
		} elseif ( 'filter' == $layout['layout_preset'] ) {
			$members_array_query = new WP_Query(
				array(
					'post_type'      => 'sptp_member',
					'posts_per_page' => -1,
				)
			);
			$members_array       = $members_array_query->posts;
		} else {
			if ( $pagination ) {
				if ( ( 'pagination_num' === $pagination_type ) || ( 'pagination_normal' === $pagination_type ) ) {
					$filter_members_chunk = array_chunk( $filter_members, $show_per_page );
					$members_array        = $filter_members_chunk[ $page_numb - 1 ];
				}
				if ( 'pagination_btn' === $pagination_type || 'pagination_scrl' === $pagination_type ) {
					$filter_members_chunk = array_chunk( $filter_members, $show_per_click );
					$members_array        = $filter_members_chunk[0];
					$members_array        = array_slice( $filter_members, 0, $show_per_page );
					if ( $page_numb > 1 ) {
						$members_array = array_slice( $filter_members, 0, ( $show_per_page + ( $show_per_click * ( $page_numb - 1 ) ) ) );
					}
				}
			} else {
				$members_array = $filter_members;
			}
		}

		foreach ( $members_array as $member ) :
				$member_feature_img = wp_get_attachment_image_src( get_post_thumbnail_id( $member->ID ), 'thumbnail' );
				$member_info        = get_post_meta( $member->ID, '_sptp_add_member', true );
			?>
			<div id="sptp-modal-<?php echo esc_html( $member->ID ) . $generator_id; ?>" class="sptp-popup-item">
				<div class="sptp-popup-content" data-simplebar>
					<div class="sptp-popup-content-main text-center">
						<?php
						if ( in_array( 'img', $detail_page_fields ) ) :
							$thumbnail_image = has_post_thumbnail( $member->ID ) ? get_the_post_thumbnail_url( $member->ID, 'full' ) : [];

							if ( ! empty( $member_info['member_image_gallery'] ) ) {
								$member_gallery     = explode( ',', $member_info['member_image_gallery'] );
								$gallery_attachment = [];
								foreach ( $member_gallery as $gallery_img ) {
									$gallery_attachment[] = wp_get_attachment_image_src( $gallery_img, 'full' )[0];
								}
								if ( has_post_thumbnail( $member->ID ) ) {
									array_unshift( $gallery_attachment, $thumbnail_image );
								}
								$modal_images = $gallery_attachment;
							} else {
								$modal_images = (array) $thumbnail_image;
							}
							?>
							<div class="sptp-member-avatar-area">
								<div class="swiper-container sptp-popup-carousel" data-items="1" data-carousel='{
				"enabled": <?php echo esc_html( $carousel_accessibility_enabled ); ?>,
				"prevSlideMessage": "<?php echo esc_html( $carousel_accessibility_prev_slide_message ); ?>",
				"nextSlideMessage": "<?php echo esc_html( $carousel_accessibility_next_slide_message ); ?>",
				"firstSlideMessage": "<?php echo esc_html( $carousel_accessibility_first_slide_message ); ?>",
				"lastSlideMessage": "<?php echo esc_html( $carousel_accessibility_last_slide_message ); ?>",
				"paginationBulletMessage": "<?php echo esc_html( $carousel_accessibility_pagination_bullet_message ); ?>"}'>
									<div class="swiper-wrapper">
										<?php foreach ( $modal_images as $key => $image ) : ?>
										<div class="swiper-slide">
											<div class="sptp-member-avatar">
												<span class="sptp-member-popup-img sptp-square">
													<img src="<?php echo $image; ?>" alt="" />
												</span>
											</div>
										</div>
										<?php endforeach; ?>
									</div>
									<div class="sptp-pagination swiper-pagination"></div>
									<div class="sptp-button-next swiper-button-next"><i class="fa fa-angle-right"></i></div>
									<div class="sptp-button-prev swiper-button-prev"><i class="fa fa-angle-left"></i></div>
								</div>
							</div>
						<?php endif; ?>
						<div class="sptp-member">
							<?php if ( ( ! empty( $member->post_title ) ) && in_array( 'name', $detail_page_fields ) ) : ?>
								<div class="sptp-member-name">
									<h2><?php echo esc_html( $member->post_title ); ?></h2>
								</div>
								<?php
							endif;
							if ( ( ! empty( $member_info['sptp_job_title'] ) ) && ( $position_switch ) && in_array( 'position', $detail_page_fields ) ) :
								?>
							<div class="sptp-member-profession">
								<h4><?php echo esc_html( $member_info['sptp_job_title'] ); ?></h4>
							</div>
								<?php
							endif;
							if ( ( ! empty( get_post_field( 'post_content', $member->ID ) ) ) && in_array( 'desc', $detail_page_fields ) ) :
								?>
							<div class="sptp-member-desc">
								<?php
								$content = get_post_field( 'post_content', $member->ID );
								echo do_shortcode( $content );
								?>
							</div>
								<?php
							endif;
							if ( ( ! empty( $member_info['sptp_location'] ) ) && in_array( 'location', $detail_page_fields ) ) :
								?>
					<div class="sptp-member-location">
										<?php if ( in_array( 'icon', $detail_page_fields ) ) : ?>
						<i class="fa fa-map-marker"></i>
						<?php endif; ?>
						<span><?php echo esc_html( $member_info['sptp_location'] ); ?></span>
					</div>
								<?php
				endif;
							if ( ( ! empty( $member_info['sptp_email'] ) ) && in_array( 'email', $detail_page_fields ) ) :
								?>
					<div class="sptp-member-email">
										<?php if ( in_array( 'icon', $detail_page_fields ) ) : ?>
						<i class="fa fa-envelope"></i>
						<?php endif; ?>
						<a href="<?php echo ( $sptp_link_mailto ) ? 'mailto:' . esc_html( $member_info['sptp_email'] ) : '#0'; ?>">
							<span><?php echo esc_html( $member_info['sptp_email'] ); ?></span>
						</a>
					</div>
								<?php
				endif;
							if ( ( ! empty( $member_info['sptp_phone'] ) ) && in_array( 'phone', $detail_page_fields ) ) :
								?>
				<div class="sptp-member-phone">
										<?php if ( in_array( 'icon', $detail_page_fields ) ) : ?>
						<i class="fa fa-phone"></i>
						<?php endif; ?>
						<a href="<?php echo 'tel:' . esc_html( $member_info['sptp_phone'] ); ?>">
							<span><?php echo esc_html( $member_info['sptp_phone'] ); ?></span>
						</a>
					</div>
								<?php
				endif;
							if ( ( ! empty( $member_info['sptp_mobile'] ) ) && in_array( 'mobile', $detail_page_fields ) ) :
								?>
					<div class="sptp-member-mobile">
										<?php if ( in_array( 'icon', $detail_page_fields ) ) : ?>
						<i class="fa fa-mobile"></i>
						<?php endif; ?>
						<a href="<?php echo 'tel:' . esc_html( $member_info['sptp_mobile'] ); ?>">
							<span><?php echo esc_html( $member_info['sptp_mobile'] ); ?></span>
						</a>
					</div>
								<?php
				endif;
							if ( ( ! empty( $member_info['sptp_website'] ) ) && in_array( 'website', $detail_page_fields ) ) :
								?>
					<div class="sptp-member-website">
										<?php if ( in_array( 'icon', $detail_page_fields ) ) : ?>
						<i class="fa fa-globe"></i>
						<?php endif; ?>
						<a href="<?php echo esc_html( $member_info['sptp_website'] ); ?>">
							<span><?php echo esc_html( $member_info['sptp_website'] ); ?></span>
						</a>
					</div>
								<?php
				endif;
							if ( ( ! empty( $member_info['sptp_skills'] ) ) && in_array( 'skills', $detail_page_fields ) ) :
								?>
					<div class="sptp-member-skill-progress">
								<?php
								foreach ( $member_info['sptp_skills'] as $skill ) :
									if ( '' != $skill['sptp_skill_name'] && ( $skill['sptp_skill_percentage'] > 0 ) ) :
										$skill_percent = $skill['sptp_skill_percentage'] . '%';
										?>
								<span class="sptp-progress-text"><?php echo esc_html( $skill['sptp_skill_name'] ); ?></span>
								<div class="sptp-progress-container" data-title="<?php echo esc_html( $skill_percent ); ?>">
									<div class="sptp-progress-bar sptp-tooltip">
										<div class="sptp-top">
										<?php echo esc_html( $skill_percent ); ?>
										</div>
									</div>
								</div>
										<?php
											endif;
									endforeach;
								?>
						</div>
								<?php
					endif;
							if ( ( ! empty( $member_info['sptp_member_social'] ) ) && in_array( 'social_profiles', $detail_page_fields ) ) :
								?>
						<div class="sptp-member-social <?php echo esc_html( $social_icon_shape ); ?>">
								<ul>
								<?php
								foreach ( $member_info['sptp_member_social'] as $social ) :
									if ( '' != $social['social_group'] ) :
										$social_link = $social['social_link'];
										if ( preg_match( '#^https?://#i', $social_link ) ) {
											$social_link = $social_link;
										} else {
											$social_link = 'http://' . $social_link;
										}
										?>
							<li>
								<a class="<?php echo 'sptp-' . esc_html( $social['social_group'] ); ?>" href="<?php echo esc_html( $social_link ); ?>" target="_blank" <?php echo ( $sptp_no_follow ) ? ' rel="nofollow"' : ''; ?>>
								<i class="<?php echo 'fa fa-' . esc_html( $social['social_group'] ); ?>"></i>
								</a>
							</li>
										<?php
										endif;
								endforeach;
								?>
								</ul>
							</div>
								<?php
						endif;
							if ( ( ! empty( $member_info['sptp_user_profile'] ) ) && in_array( 'author_posts', $detail_page_fields ) ) :
								$user_id      = $member_info['sptp_user_profile'];
								$member_posts = count_user_posts( $user_id ); // cout user's posts
								if ( $member_posts > 0 ) {
									$args       = array(
										'author'         => $user_id,
										'orderby'        => 'post_date',
										'order'          => 'ASC',
										'posts_per_page' => -1, // no limit
									);
									$user_posts = get_posts( $args );
									?>
								<div class="sptp-member-post">
									<ul>
									<?php
									foreach ( $user_posts as $post ) {
										echo '<li class="sptp-member-post"><i class="fa fa-square sptp-member-post-link-fa"></i><a href="' . get_permalink( $post->ID ) . '" target="_blank" class="sptp-member-post-link">' . esc_html( $post->post_title ) . '</a></li>';
									}
									?>
								</ul>
								</div>
									<?php
								}
						endif;
							?>
				<!-- .sptp-popup-details -->
			</div>
				</div>
			<!-- .sptp-popup-content-main -->
			</div>
		<!-- .sptp-popup-content -->
		</div>
		<?php endforeach; ?>
	</div>
<!-- .sptp-pop -->
</div>
