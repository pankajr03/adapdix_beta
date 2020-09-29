<?php
/**
 * Single member.
 *
 * @package WP_Team_Pro
 * @since 2.0.0
 */

$member_feature_img = wp_get_attachment_image_src( get_post_thumbnail_id( $member->ID ), 'thumbnail' );
$member_info        = get_post_meta( $member->ID, '_sptp_add_member', true );
if ( ! empty( $member_info['member_image_gallery'] ) ) {
	$member_gallery     = explode( ',', $member_info['member_image_gallery'] );
	$gallery_attachment = [];
	foreach ( $member_gallery as $gallery_img ) {
		$gallery_attachment[] = wp_get_attachment_image_src( $gallery_img, $image_size )[0];
	}
} else {
	$gallery_attachment = [];
}
if ( 'custom' === $image_size ) {
	if ( has_post_thumbnail( $member->ID ) ) {
		$member_image_main_name = get_the_post_thumbnail_url( $member->ID, 'full' );

		$custom_image_name = sptp_image_resize( $member_image_main_name, $custom_image_width, $custom_image_height, $custom_image_crop );
		$member_image_src  = ! empty( $custom_image_name ) ? $custom_image_name : $member_image_main_name;
	} else {
		if ( empty( $gallery_attachment ) ) {
			$member_image_src = SPTP_PLUGIN_ROOT . 'public/img/Placeholder-Image.png';
		} else {
			$custom_image_name = sptp_image_resize( $gallery_attachment[0], $custom_image_width, $custom_image_height, $custom_image_crop );
			$member_image_src  = $custom_image_name;
		}
	}
} else {
	if ( has_post_thumbnail( $member->ID ) ) {
		$member_image_src       = get_the_post_thumbnail_url( $member->ID, $image_size );
		$member_image_thumbnail = get_the_post_thumbnail_url( $member->ID, 'full' );
	} else {
		if ( empty( $gallery_attachment ) ) {
			$member_image_src = SPTP_PLUGIN_ROOT . 'public/img/Placeholder-Image.png';
		} else {
			$member_image_src = $gallery_attachment[0];
		}
	}
}
$image_alt = get_post_meta( get_post_thumbnail_id( $member->ID ), '_wp_attachment_image_alt', true );
$social_link = '';
foreach ( $member_info['sptp_member_social'] as $social ) :
	if ( '' != $social['social_group'] ) :
		$social_link = $social['social_link'];
		if ( preg_match( '#^https?://#i', $social_link ) ) {
			$social_link = $social_link;
		} else {
			$social_link = 'http://' . $social_link;
		}
	endif;
endforeach;
					
if ( $layout['layout_preset'] === 'mosaic' ) { ?>
<div class="sptp-row sptp-no-gutters">
	<div class="sptp-col-xs-2 sptp-member-avatar">
		<?php
		if ( ! empty( $member_image_src ) && $style_members['image_switch'] && $image_on_off ) :
			?>
			<?php if ( $settings['link_detail'] && 'modal' === $page_link_type ) : ?>
		<a class="sptp-member-avatar <?php echo ( $overlay_clickable ) ? 'sptp-popup-trigger' : ' '; ?>"
		wptpmodal="#sptp-modal-<?php echo esc_html( $member->ID ) . $generator_id; ?>" href="">
			<?php endif; if ( $settings['link_detail'] && ( 'new_page' === $page_link_type ) ) : ?>
			<a class='sptp-member-avatar'
				href="<?php echo esc_html( get_permalink( $member->ID ) ) . '&team=' . $generator_id; ?>"
				target="<?php echo esc_html( $new_page_target ); ?>">
				<?php endif; ?>
				<div class="sptp-member-avatar-img-area">
				<span
					class="sptp-member-avatar-img <?php echo esc_html( $image_shape ) . ' ' . esc_html( $image_zoom ); ?>">
				<span class="sptp-overflow-h">
				<?php if ( $icon_over_img && ( 'content_over_image' !== $position ) && 'thumbnail-pager' !== $layout_preset ) : ?>
					<div class="sptp-icon text-center">
						<?php
						switch ( $icon_over_img_type ) {
							case 'plus':
								echo '<i class="fa fa-plus"></i>';
								break;
							case 'search':
								echo '<i class="fa fa-search"></i>';
								break;
							case 'zoom':
								echo '<i class="fa fa-search-plus"></i>';
								break;
							case 'eye':
								echo '<i class="fa fa-eye"></i>';
								break;
							case 'info':
								echo '<i class="fa fa-info"></i>';
								break;
							case 'angle':
								echo '<i class="fa fa-angle-right"></i>';
								break;
						}
						?>
					</div>
					<?php endif; ?>
					<img src="<?php echo esc_html( $member_image_src ); ?>"
						alt="<?php echo ( $image_alt ) ? esc_html( $image_alt ) : esc_html( get_the_title( $generator_id ) ); ?>">
				</span>
				</span>
				</div>
			</a>
			<?php endif; ?>
	</div>
	<div class="sptp-col-xs-2 sptp-member-info text-center">
		<div class="sptp-info-details">
			<?php
			if ( ( ! empty( $member->post_title ) ) && $name_switch ) :
				?>
			<div class="sptp-member-name">
				<h2><?php echo esc_html( $member->post_title ); ?></h2>
			</div>
				<?php
			endif;
			if ( ( ! empty( $member_info['sptp_job_title'] ) ) && ( $position_switch ) ) :
				?>
			<div class="sptp-member-profession">
				<h4><?php echo esc_html( $member_info['sptp_job_title'] ); ?></h4>
			</div>
				<?php
			endif;
			if ( ( ! empty( $member_info['sptp_short_bio'] ) ) && $bio_switch ) :
				?>
			<div class="sptp-member-desc">
				<?php
					$allowed_html = Team_Pro_Public::sptp_allowed_html();
					echo nl2br( wp_kses( $member_info['sptp_short_bio'], $allowed_html ) );
				?>
			</div>
				<?php
			endif;
			if ( ( ! empty( $member_info['sptp_location'] ) ) && ( $style_members['location_switch'] ) ) :
				?>
			<div class="sptp-member-location">
				<?php if ( $small_icon ) : ?>
				<i class="fa fa-map-marker"></i>
				<?php endif; ?>
				<span><?php echo esc_html( $member_info['sptp_location'] ); ?></span>
			</div>
				<?php
			endif;
			if ( ( ! empty( $member_info['sptp_email'] ) ) && ( $email_switch ) ) :
				?>
			<div class="sptp-member-email">
				<?php if ( $small_icon ) : ?>
				<i class="fa fa-envelope"></i>
				<?php endif; ?>
				<a href="<?php echo 'mailto:' . esc_html( $member_info['sptp_email'] ); ?>">
					<span><?php echo esc_html( $member_info['sptp_email'] ); ?></span>
				</a>
			</div>
				<?php
			endif;
			if ( ( ! empty( $member_info['sptp_phone'] ) ) && ( $phone_switch ) ) :
				?>
			<div class="sptp-member-phone">
				<?php if ( $small_icon ) : ?>
				<i class="fa fa-phone"></i>
				<?php endif; ?>
				<a href="<?php echo 'tel:' . esc_html( $member_info['sptp_phone'] ); ?>">
					<span><?php echo esc_html( $member_info['sptp_phone'] ); ?></span>
				</a>
			</div>
				<?php
								endif;
			if ( ( ! empty( $member_info['sptp_mobile'] ) ) && ( $mobile_switch ) ) :
				?>
			<div class="sptp-member-mobile">
				<?php if ( $small_icon ) : ?>
				<i class="fa fa-mobile"></i>
				<?php endif; ?>
				<a href="<?php echo 'tel:' . esc_html( $member_info['sptp_mobile'] ); ?>">
					<span><?php echo esc_html( $member_info['sptp_mobile'] ); ?></span>
				</a>
			</div>
				<?php
								endif;
			if ( ( ! empty( $member_info['sptp_website'] ) ) && ( $style_members['website_switch'] ) && ( filter_var( $member_info['sptp_website'], FILTER_VALIDATE_URL ) ) ) :
				$website = $member_info['sptp_website'];
				if ( preg_match( '#^https?://#i', $website ) ) {
					$website = $website;
				} else {
					$website = 'http://' . $website;
				}
				?>
			<div class="sptp-member-website">
				<?php if ( $small_icon ) : ?>
				<i class="fa fa-globe"></i>
				<?php endif; ?>
				<a href="<?php echo esc_html( $website ); ?>">
					<span><?php echo esc_html( $website ); ?></span>
				</a>
			</div>
				<?php
								endif;
			if ( ( ! empty( $member_info['sptp_skills'] ) ) && ( $skill_switch ) ) :
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
			if ( ( ! empty( $member_info['sptp_member_social'] ) ) && ( $style_members['social_switch'] ) ) :
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
						<a class="<?php echo 'sptp-' . esc_html( $social['social_group'] ); ?>"
							href="<?php echo esc_html( $social_link ); ?>" target="_blank"
							<?php echo ( $sptp_no_follow ) ? ' rel="nofollow"' : ''; ?>>
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
		<div class="sptp-arrow"></div>
	</div>
</div>
	<?php
} else {
	?>
<div
	class="sptp-member <?php echo esc_html( $border_bg_around_member_class ) . ' ' . esc_html( $position_class ) . ' ' . esc_html( $overlay_content_visibility_class ) . ' ' . esc_html( $disable_overlay_small_screen_class ) . ' ' . esc_html( $image_shape ) . ' ' . esc_html( $overlay_on_image_class ); ?>">
	<?php
	if ( 'left_img_right_content' === $position || 'left_content_right_img' === $position || 'content_over_image' === $position ) :
		?>
	<div
		class="<?php echo ( ! empty( $member_image_src ) && ( $style_members['image_switch'] ) && $image_on_off ) ? 'image' : ''; ?>">
		<?php
		endif;
	if ( ! empty( $member_image_src ) && ( $style_members['image_switch'] ) && $image_on_off ) :
		?>
		<?php if ( ( $layout['layout_preset'] != 'thumbnail-pager' ) && ( $settings['link_detail'] && 'modal' === $page_link_type ) ) { ?>
		<a class="sptp-member-avatar <?php echo ( $overlay_clickable ) ? 'sptp-popup-trigger' : ' '; ?>"
		wptpmodal="#sptp-modal-<?php echo esc_html( $member->ID ) . $generator_id; ?>" href="">
			<?php
		} elseif ( $layout['layout_preset'] === 'thumbnail-pager' ) {
			?>
			<a class="sptp-member-avatar <?php echo ( $overlay_clickable ) ? 'sptp-popup-trigger' : ' '; ?>" href="#0">
				<?php } elseif ( $settings['link_detail'] && ( 'new_page' === $page_link_type ) ) { ?>
				<!-- a class='sptp-member-avatar'
					href="<?php echo esc_html( get_permalink( $member->ID ) ) . '&team=' . $generator_id; ?>"
					target="<?php echo esc_html( $new_page_target ); ?>" -->
				<a class='team-member' href="<?php echo esc_html( $social_link )?>" target="<?php echo esc_html( $new_page_target ); ?>">
					
					
					<?php } else { ?>
					<span class="sptp-member-avatar">
						<?php } ?>
					<div class="sptp-member-avatar-img-area">
					<?php
					if ( 'thumbnail-pager' != $layout['layout_preset'] ) :
						?>
						<span
							class="sptp-member-avatar-img <?php echo esc_html( $image_shape ) . ' ' . esc_html( $icon_over_img_class ) . ' ' . esc_html( $image_zoom ); ?>">
							<?php
					endif;
					if ( 'thumbnail-pager' == $layout['layout_preset'] ) :
						?>
							<span class="sptp-member-avatar-img <?php echo esc_html( $image_shape ); ?>">
								<?php
					endif;
					?>
					<div class="img-effect" >
					<?php
					if ( $icon_over_img && ( 'content_over_image' !== $position ) && 'thumbnail-pager' !== $layout_preset ) :
						?>
								<div class="sptp-icon text-center">
									<?php
									switch ( $icon_over_img_type ) {
										case 'plus':
											//echo '<i class="fa fa-plus"></i>';
											break;
										case 'search':
											echo '<i class="fa fa-search"></i>';
											break;
										case 'zoom':
											echo '<i class="fa fa-search-plus"></i>';
											break;
										case 'eye':
											echo '<i class="fa fa-eye"></i>';
											break;
										case 'info':
											echo '<i class="fa fa-info"></i>';
											break;
										case 'angle':
											echo '<i class="fa fa-angle-right"></i>';
											break;
									}
									?>
								</div>
								<?php endif; ?>
								<img src="<?php echo esc_html( $member_image_src ); ?>"
									alt="<?php echo ( $image_alt ) ? esc_html( $image_alt ) : esc_html( get_the_title( $generator_id ) ); ?>"
									data-member="<?php echo esc_html( $member->ID ); ?>" 
								<?php
								if ( $member_image_src == SPTP_PLUGIN_ROOT . 'public/img/Placeholder-Image.png' ) {
									$image_width  = get_option( "{$image_size}_size_w" );
									$image_height = get_option( "{$image_size}_size_h" );
									if ( 'custom' === $image_size ) {
										$image_width  = $custom_image_width;
										$image_height = $custom_image_width;
									}
									echo 'width="' . $image_width . 'px"';
									echo ' height="' . $image_height . 'px"';
								}
								?>
					 class="img-fluid w-100">
					<div class="border-img"></div>
					
							</div>
					</a>					
					</span>
							</div>
							<?php
							if ( $layout['layout_preset'] === 'thumbnail-pager' || $settings['link_detail'] ) {
								echo '</a>';
							} else {
								echo '</span>';
							}

			endif;
	if ( 'left_img_right_content' === $position || 'left_content_right_img' === $position || 'content_over_image' === $position ) :
		?>
	</div>
	<div class="content <?php echo ( empty( $member_image_src ) || ( $style_members['image_switch'] ) || ! $image_on_off ) ? '' : 'no-image'; ?> <?php echo esc_html( $overlay_content_position ) . ' ' . esc_html( $overlay_clickable_class ) . ' ' . esc_html( $overlay_content_type ) . ' ' . esc_html( $image_shape ); ?>">
		<?php
		if ( ( 'content_over_image' === $position ) && $settings['link_detail'] && ( 'modal' === $page_link_type ) ) :
			?>
		<a class="sptp-member-avatar <?php echo ( $overlay_clickable ) ? 'sptp-popup-trigger' : ' '; ?>"
		wptpmodal="#sptp-modal-<?php echo esc_html( $member->ID ) . $generator_id; ?>" href="">
			<?php endif; if ( 'content_over_image' === $position && $settings['link_detail'] && ( 'new_page' === $page_link_type ) ) : ?>
			<a class='sptp-member-avatar'
				href="<?php echo esc_html( get_permalink( $member->ID ) ) . '&team=' . $generator_id; ?>"
				target="<?php echo esc_html( $new_page_target ); ?>">
				<?php
			endif;
			if ( 'lower' === $overlay_content_type ) :
				?>
				<div class="caption">
					<?php
			endif;
		endif;
	if ( 'filter' === $layout['layout_preset'] && ! $name_switch ) :
		?>
					<div class="hidden">
					<?php echo esc_html( $member->post_title ); ?>
					</div>
				<?php
		endif;
	if ( ( ! empty( $member->post_title ) ) && $name_switch ) :
		?>
					<h4><?php echo esc_html( $member->post_title ); ?></h4>
					
				<?php
		endif;
	if ( ( ! empty( $member_info['sptp_job_title'] ) ) && ( $position_switch ) ) :
		?>
						<h5><?php echo esc_html( $member_info['sptp_job_title'] ); ?></h5>
				<?php
		endif;
	if ( ( ! empty( $member_info['sptp_short_bio'] ) ) && $bio_switch ) :
		?>
					<!-- div class="sptp-member-desc" -->
					<?php
					$short_bio    = substr( $member_info['sptp_short_bio'], 0, $description_character_limit );
					$full_bio     = get_post_field( 'post_content', $member->ID );
					$allowed_html = Team_Pro_Public::sptp_allowed_html();
					if ( $layout['layout_preset'] == 'thumbnail-pager' ) {
						echo '<p>' . nl2br( wp_kses( $full_bio, $allowed_html ) ) . '</p>';
					} else {
						echo '<p>' . nl2br( wp_kses( $short_bio, $allowed_html ) ) . '</p>';
					}
					?>
					<!-- /div -->
					<?php
		endif;
	if ( ( ! empty( $member_info['sptp_location'] ) ) && ( $style_members['location_switch'] ) ) :
		?>
					<div class="sptp-member-location">
					<?php if ( $small_icon ) : ?>
						<i class="fa fa-map-marker"></i>
						<?php endif; ?>
						<span><?php echo esc_html( $member_info['sptp_location'] ); ?></span>
					</div>
				<?php
		endif;
	if ( ( ! empty( $member_info['sptp_email'] ) ) && ( $email_switch ) ) :
		?>
					<div class="sptp-member-email">
					<?php if ( $small_icon ) : ?>
						<i class="fa fa-envelope"></i>
						<?php endif; ?>
						<a href="<?php echo ( $sptp_link_mailto ) ? 'mailto:' . esc_html( $member_info['sptp_email'] ) : '#0'; ?>"
						<?php echo ( $sptp_no_follow ) ? ' rel="nofollow"' : ''; ?>
						<?php echo ( $sptp_link_css ) ? ' class="' . esc_html( $sptp_link_css ) . '"' : ''; ?>>
							<span><?php echo esc_html( $member_info['sptp_email'] ); ?></span>
						</a>
					</div>
				<?php
		endif;
	if ( ( ! empty( $member_info['sptp_phone'] ) ) && ( $phone_switch ) ) :
		?>
					<div class="sptp-member-phone">
					<?php if ( $small_icon ) : ?>
						<i class="fa fa-phone"></i>
						<?php endif; ?>
						<a href="<?php echo ( $sptp_link_telephone ) ? 'tel:' . esc_html( $member_info['sptp_phone'] ) : '#0'; ?>"
						<?php echo ( $sptp_no_follow ) ? ' rel="nofollow"' : ''; ?>
						<?php echo ( $sptp_link_css ) ? ' class="' . esc_html( $sptp_link_css ) . '"' : ''; ?>>
							<span><?php echo esc_html( $member_info['sptp_phone'] ); ?></span>
						</a>
					</div>
				<?php
		endif;
	if ( ( ! empty( $member_info['sptp_mobile'] ) ) && ( $mobile_switch ) ) :
		?>
					<div class="sptp-member-mobile">
					<?php if ( $small_icon ) : ?>
						<i class="fa fa-mobile"></i>
						<?php endif; ?>
						<a href="<?php echo ( $sptp_link_telephone ) ? 'tel:' . esc_html( $member_info['sptp_mobile'] ) : '#0'; ?>"
						<?php echo ( $sptp_no_follow ) ? ' rel="nofollow"' : ''; ?>
						<?php echo ( $sptp_link_css ) ? ' class="' . esc_html( $sptp_link_css ) . '"' : ''; ?>>
							<span><?php echo esc_html( $member_info['sptp_mobile'] ); ?></span>
						</a>
					</div>
				<?php
		endif;
	if ( ( ! empty( $member_info['sptp_website'] ) ) && ( $style_members['website_switch'] ) ) :
		?>
					<div class="sptp-member-website">
					<?php if ( $small_icon ) : ?>
						<i class="fa fa-globe"></i>
						<?php
				endif;
					$member_website = isset( $member_info['sptp_website'] ) ? $member_info['sptp_website'] : '';
					if ( preg_match( '#^https?://#i', $member_website ) ) {
						$member_website = $member_website;
					} else {
						$member_website = 'http://' . $member_website;
					}
					?>
						<a href="<?php echo esc_html( $member_website ); ?>"
						<?php echo ( $sptp_no_follow ) ? ' rel="nofollow"' : ''; ?>
						<?php echo ( $sptp_link_css ) ? ' class="' . esc_html( $sptp_link_css ) . '"' : ''; ?>
							target="_blank">
							<span><?php echo esc_html( $member_info['sptp_website'] ); ?></span>
						</a>
					</div>
				<?php
		endif;
	if ( ( ! empty( $member_info['sptp_skills'] ) ) && ( $skill_switch ) ) :
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
	if ( ( ! empty( $member_info['sptp_member_social'] ) ) && ( $style_members['social_switch'] ) ) :
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
								<a class="<?php echo 'sptp-' . esc_html( $social['social_group'] ); ?>"
									href="<?php echo esc_html( $social_link ); ?>" target="_blank"
									<?php echo ( $sptp_no_follow ) ? ' rel="nofollow"' : ''; ?>>
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
	if ( 'lower' === $overlay_content_type ) :
		?>
				</div> <!-- caption end -->
			<?php
			endif;

	if ( 'left_img_right_content' === $position || 'left_content_right_img' === $position || 'content_over_image' === $position ) :
		?>
			<?php
			if ( 'content_over_image' === $position ) :
				?>
				<?php
		endif;
			?>
	</div>
		<?php
		if ( 'content_over_image' === $position ) :
			?>
	</a>
			<?php
			endif;
		?>
		<?php
		endif;
	?>
</div>
	<?php
}
