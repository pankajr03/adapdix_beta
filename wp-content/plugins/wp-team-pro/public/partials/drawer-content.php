<?php
/** Drawer layout
 *
 * @package WP_Team_Pro
 * @since 2.0
 */

?>
<div class="sptp-drawer-items">
<?php
if ( isset( $pagination ) && $pagination ) {
		$filter_members_chunk = array_chunk( $filter_members, $show_per_page );
		$cookie_name          = $generator_id . 'sptpPagination';
		$page_numb            = ( isset( $_COOKIE[ "$cookie_name" ] ) && ! empty( $_COOKIE[ "$cookie_name" ] ) ) ? (int) $_COOKIE[ "$cookie_name" ] : 1;

	if ( ( 'pagination_num' === $pagination_type ) || ( 'pagination_normal' === $pagination_type ) ) {
		$members_array = $filter_members_chunk[ $page_numb - 1 ];
	}
	if ( 'pagination_btn' === $pagination_type || 'pagination_scrl' === $pagination_type ) {
		$filter_members_chunk = array_chunk( $filter_members, $show_per_click );
		$members_array        = $filter_members_chunk[0];
		if ( $page_numb > 1 ) {
			$members_array = array_merge( $filter_members_chunk[0], $filter_members_chunk[ $page_numb - 1 ] );
		}
	}
} else {
	$members_array = $filter_members;
}
foreach ( $members_array as $member ) :
		$member_feature_img = wp_get_attachment_image_src( get_post_thumbnail_id( $member->ID ), 'thumbnail' );
		$member_info        = get_post_meta( $member->ID, '_sptp_add_member', true );
		$member_image_src   = has_post_thumbnail( $member->ID ) ? get_the_post_thumbnail_url( $member->ID, 'full' ) : wp_get_attachment_image_src( $member_info['member_image_gallery'] )[0];
	?>
	   
	<div id="gridder-content-<?php echo esc_attr( $member->ID ); ?>" class="gridder-content">
				<div class="sptp-row">
					<div class="sptp-col-w-58" >
						<div class="sptp-member sptp-left-content" data-simplebar>
					<?php	if ( ( ! empty( $member->post_title ) ) && in_array( 'name', $detail_page_fields ) ) : ?>
						<div class="sptp-member-name">
							<h2><?php echo esc_html( $member->post_title ); ?></h2>
						</div>
						<?php
					endif;
					if ( ( ! empty( $member_info['sptp_job_title'] ) ) && in_array( 'position', $detail_page_fields ) ) :
						?>
						<div class="sptp-member-profession">
							<h4><?php echo esc_html( $member_info['sptp_job_title'] ); ?></h4>
						</div>
						<?php
				endif;
					if ( in_array( 'desc', $detail_page_fields ) && ! empty( $member->post_content ) ) :
						?>
				<div class="sptp-member-desc">
						<?php
						$post_content = get_post_field( 'post_content', $member->ID );
						$allowed_html = Team_Pro_Public::sptp_allowed_html();
						echo '<span>' . nl2br( wp_kses( $post_content, $allowed_html ) ) . '</span>';
						?>
				</div>
						<?php
						endif;
					?>

						</div>
					</div>
					<div class="sptp-col-w-42">
						<div class="sptp-member sptp-right-content">
								<?php
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
									<a href="<?php echo ( $sptp_link_telephone ) ? 'tel:' . esc_html( $member_info['sptp_phone'] ) : '#0'; ?>">
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
							<a href="<?php echo ( $sptp_link_telephone ) ? 'tel:' . esc_html( $member_info['sptp_mobile'] ) : '#0'; ?>">
								<span><?php echo esc_html( $member_info['sptp_mobile'] ); ?></span>
							</a>
						</div>
									<?php
						endif;
								if ( ( ! empty( $member_info['sptp_website'] ) ) && in_array( 'website', $detail_page_fields ) ) :
									$website = $member_info['sptp_website'];
									if ( preg_match( '#^https?://#i', $website ) ) {
										$website = $website;
									} else {
										$website = 'http://' . $website;
									}
									?>
					<div class="sptp-member-website">
									<?php if ( in_array( 'icon', $detail_page_fields ) ) : ?>
						<i class="fa fa-globe"></i>
						<?php endif; ?>
						<a href="<?php echo esc_html( $website ); ?>" target="_blank">
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
								if ( ( ! empty( $member_info['sptp_memeber_social'] ) ) && in_array( 'social_profiles', $detail_page_fields ) ) :
									?>
				<div class="sptp-member-social">
					<ul>
									<?php
									foreach ( $member_info['sptp_memeber_social'] as $social ) :
										if ( '' != $social['social_group'] ) :
											$social_link = $social['social_link'];
											if ( preg_match( '#^https?://#i', $social_link ) ) {
												$social_link = $social_link;
											} else {
												$social_link = 'http://' . $social_link;
											}
											?>
									<li>
										<a class="<?php echo 'sptp-' . esc_html( $social['social_group'] ); ?>" href="<?php echo esc_html( $social_link ); ?>" target="_blank">
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
								?>
		</div>
		<?php
		$user_id = $member_info['sptp_user_profile'];
		$posts   = count_user_posts( $user_id ); // count user's posts.
		if ( $posts > 0 ) {
			$args       = array(
				'author'         => $user_id,
				'orderby'        => 'post_date',
				'order'          => 'ASC',
				'posts_per_page' => -1, // no limit.
			);
			$user_posts = get_posts( $args );
			foreach ( $user_posts as $post ) {
				echo '<div class="sptp-member-post"><i class="fa fa-square sptp-member-post-link-fa"></i><a href="' . get_permalink( $post->ID ) . '" target="_blank" class="sptp-member-post-link">' . esc_html( $post->post_title ) . '</a></div>';
			}
		}
		?>
	</div>
</div>
</div>
<?php endforeach; ?>
</div>
