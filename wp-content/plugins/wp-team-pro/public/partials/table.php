<?php
/**
 * Table layout
 *
 * @package WP_Team_Pro
 * @since 2.0.0
 */

?>
<div class="sp-wp-team-pro-wrapper<?php echo esc_html( $preloader_class ); ?>">
<div id="<?php echo esc_attr( 'sptp-' . $generator_id ); ?>" class="sp-team-pro sptp-section <?php echo 'sptp-' . esc_html( $page_link_type ) . ' ' . esc_html( $pagination_type ); ?>">
	<?php if ( $preloader ) : ?>
		<div id="page-loading-image" class="page-loading-image"></div>
	<?php endif; ?>
	<?php if ( ! empty( get_the_title( $generator_id ) ) && ( $settings['style_title'] != false ) ) : ?>
	<h2 class="sptp-section-title"><span><?php echo esc_attr( get_the_title( $generator_id ) ); ?></span></h2>
		<?php
	endif;
	if ( ! empty( $filter_members ) ) :
		?>
	<div class="sptp-table-layout">
		<table class="sptp-table-responsive">
			<thead>
				<tr>
					<?php
					foreach ( $style_members as $key => $value ) {
						if ( $value ) {
							switch ( $key ) {
								case 'image_switch':
									?>
									<th><?php echo __( 'Image', 'wp-team-pro' ); ?></th>
									<?php
									break;
								case 'name_switch':
									?>
									<th><?php echo __( 'Name', 'wp-team-pro' ); ?></th>
									<?php
									break;
								case 'job_position_switch':
									?>
									<th><?php echo __( 'Designation', 'wp-team-pro' ); ?></th>
									<?php
									break;
								case 'location_switch':
									?>
									<th><?php echo __( 'Location', 'wp-team-pro' ); ?></th>
									<?php
									break;
								case 'email_switch':
									?>
									<th><?php echo __( 'Email', 'wp-team-pro' ); ?></th>
									<?php
									break;
								case 'social_switch':
									?>
									<th><?php echo __( 'Social Link', 'wp-team-pro' ); ?></th>
									<?php
									break;
								case 'phone_switch':
									?>
									<th><?php echo __( 'Phone', 'wp-team-pro' ); ?></th>
									<?php
									break;
								case 'mobile_switch':
									?>
									<th><?php echo __( 'Mobile', 'wp-team-pro' ); ?></th>
									<?php
									break;
								case 'website_switch':
									?>
									<th><?php echo __( 'Website', 'wp-team-pro' ); ?></th>
									<?php
									break;
								case 'skill_switch':
									?>
									<th><?php echo __( 'Skills', 'wp-team-pro' ); ?></th>
									<?php
									break;
								default:
									break;
							}
						}
					}
					?>
				</tr>
			</thead>
			<tbody>
			<?php
			if ( $pagination ) {
				$cookie_name = $generator_id . 'sptpPagination';
				if ( isset( $_COOKIE[ "$cookie_name" ] ) && $_COOKIE[ "$cookie_name" ] ) {
					$page_numb = (int) $_COOKIE[ "$cookie_name" ];
				} else {
					$page_numb = 1;
				}
				if ( 'pagination_number' === $pagination_type ) {
					$filter_members_chunk = array_chunk( $filter_members, $show_per_page );
					$members_array        = $filter_members_chunk[0];
					if ( $page_numb > 1 ) {
						$members_array = $filter_members_chunk[ $page_numb - 1 ];
					}
				} else {
					$members_array = $filter_members;
				}
			} else {
				$members_array = $filter_members;
			}
			foreach ( $members_array as $key => $member ) :
				$member_info = get_post_meta( $member->ID, '_sptp_add_member', true );

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
						$custom_image_name      = sptp_image_resize( $member_image_main_name, $custom_image_width, $custom_image_height, $custom_image_crop );
						$member_image_src       = ! empty( $custom_image_name ) ? $custom_image_name : $member_image_main_name;
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
						$member_image_src = get_the_post_thumbnail_url( $member->ID, 'thumbnail' );
					} else {
						if ( empty( $gallery_attachment ) ) {
							$member_image_src = SPTP_PLUGIN_ROOT . 'public/img/Placeholder-Image.png';
						} else {
							$custom_image_name = sptp_image_resize( $gallery_attachment[0], $custom_image_width, $custom_image_height, $custom_image_crop );
							$member_image_src  = $custom_image_name;
						}
					}
				}
				$image_alt = get_post_meta( get_post_thumbnail_id( $member->ID ), '_wp_attachment_image_alt', true );
				?>
				<tr>
					<?php
					foreach ( $style_members as $key => $value ) {
						if ( $value ) {
							switch ( $key ) {
								case 'image_switch':
									?>
									<td>
									<?php
									if ( ! empty( $member_image_src ) ) :
										if ( $settings['link_detail'] && 'modal' === $page_link_type ) :
											?>
						<a class="sptp-member-avatar sptp-popup-trigger" wptpmodal="#sptp-modal-<?php echo esc_html( $member->ID ) . $generator_id; ?>" href="">
										<?php endif; if ( ( 'new_page' === $page_link_type ) && $settings['link_detail'] ) : ?>
						<a class = 'sptp-member-avatar' href="<?php echo esc_html( get_permalink( $member->ID ) ) . '&team=' . $generator_id; ?>" target="<?php echo esc_html( $new_page_target ); ?>" >
						<?php endif; ?>
								<div class="sptp-member-avatar-img-area">
								<div class="sptp-member-avatar-img <?php echo esc_html( $image_shape ) . ' ' . esc_html( $icon_over_img_class ) . ' ' . esc_html( $image_zoom ); ?>">
								<span class="sptp-overflow-h">
										<?php if ( $icon_over_img || ( $position !== 'content_over_image' ) ) : ?>
									<div class="sptp-icon text-center">
											<?php if ( $icon_over_img_type == 'plus' ) : ?>
										<i class="fa fa-plus"></i>
												<?php
										endif;
											if ( $icon_over_img_type == 'zoom' ) :
												?>
										<i class="fa fa-search-plus"></i>
												<?php
										endif;
											if ( $icon_over_img_type == 'eye' ) :
												?>
										<i class="fa fa-eye"></i>
												<?php
										endif;
											if ( $icon_over_img_type == 'info' ) :
												?>
										<i class="fa fa-info"></i>
											<?php endif; ?>
									</div>
									<?php endif; ?>
									<img src="<?php echo esc_html( $member_image_src ); ?>" alt="<?php echo esc_html( $image_alt ); ?>" data-member="<?php echo esc_html( $member->ID ); ?>"
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
									>
								</span>
								</div>
								</div>
							</a>
							</div>
										<?php endif; ?>
									</td>
										<?php
									break;
								case 'name_switch':
									$member_name = ( ! empty( $member->post_title ) ) ? $member->post_title : '';
									?>
									<td>
										<div class="sptp-member-name">
											<h2><?php echo esc_html( $member_name ); ?></h2>
										</div>
									</td>
										<?php
									break;
								case 'job_position_switch':
									$member_designation = ( ! empty( $member_info['sptp_job_title'] ) ) ? $member_info['sptp_job_title'] : '';
									?>
									<td>
										<div class="sptp-member-profession">
											<h4><?php echo esc_html( $member_designation ); ?></h4>
										</div>
									</td>
										<?php
									break;
								case 'location_switch':
									$member_location = ( ! empty( $member_info['sptp_location'] ) ) ? $member_info['sptp_location'] : '';
									$location_icon   = ( ! empty( $member_info['sptp_location'] ) ) ? 'fa fa-map-marker' : '';
									?>
									<td>
										<div class="sptp-member-location">
											<?php if ( $small_icon ) : ?>
											<i class="<?php echo esc_html( $location_icon ); ?>"></i>
											<?php endif; ?>
											<span><?php echo esc_html( $member_location ); ?></span>
										</div>
									</td>
									<?php
									break;
								case 'email_switch':
									$member_email = ( ! empty( $member_info['sptp_email'] ) ) ? $member_info['sptp_email'] : '';
									$email_icon   = ( ! empty( $member_info['sptp_email'] ) ) ? 'fa fa-envelope' : '';
									?>
									<td>
										<div class="sptp-member-email">
											<?php if ( $small_icon ) : ?>
											<i class="<?php echo esc_html( $email_icon ); ?>"></i>
											<?php endif; ?>
											<a href="<?php echo 'mailto:' . esc_html( $member_email ); ?>">
												<span><?php echo esc_html( $member_email ); ?></span>
											</a>
										</div>
									</td>
									<?php
									break;
								case 'social_switch':
									?>
									<td>
									<?php if ( ! empty( $member_info['sptp_member_social'] ) ) : ?>
										<ul class="sptp-member-social">
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
									<?php endif; ?>
									</td>
									<?php
									break;
								case 'phone_switch':
									?>
									<td>
									<?php if ( ! empty( $member_info['sptp_phone'] ) ) : ?>
										<ul class="sptp-member-phone">
										<?php if ( $small_icon ) : ?>
										<i class="fa fa-phone"></i>
										<?php endif; ?>
										<a href="<?php echo ( $sptp_link_telephone ) ? 'tel:' . esc_html( $member_info['sptp_phone'] ) : '#0'; ?>" 
										<?php echo ( $sptp_no_follow ) ? ' rel="nofollow"' : ''; ?> 
										<?php echo ( $sptp_link_css ) ? ' class="' . esc_html( $sptp_link_css ) . '"' : ''; ?>>
											<span><?php echo esc_html( $member_info['sptp_phone'] ); ?></span>
										</a>
										</ul>
									<?php endif; ?>
									</td>
									<?php
									break;
								case 'mobile_switch':
									?>
									<td>
									<?php if ( ! empty( $member_info['sptp_phone'] ) ) : ?>
										<ul class="sptp-member-mobile">
										<?php if ( $small_icon ) : ?>
										<i class="fa fa-mobile"></i>
										<?php endif; ?>
										<a href="<?php echo ( $sptp_link_telephone ) ? 'tel:' . esc_html( $member_info['sptp_mobile'] ) : '#0'; ?>" 
										<?php echo ( $sptp_no_follow ) ? ' rel="nofollow"' : ''; ?> 
										<?php echo ( $sptp_link_css ) ? ' class="' . esc_html( $sptp_link_css ) . '"' : ''; ?>>
											<span><?php echo esc_html( $member_info['sptp_mobile'] ); ?></span>
										</a>
										</ul>
									<?php endif; ?>
									</td>
									<?php
									break;
								case 'website_switch':
									?>
									<td class="sptp-member-website">
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
										<?php echo ( $sptp_link_css ) ? ' class="' . esc_html( $sptp_link_css ) . '"' : ''; ?> target="_blank">
											<span><?php echo esc_html( $member_info['sptp_website'] ); ?></span>
										</a>
									</td>
									<?php
									break;
								case 'skill_switch':
									?>
									<td class="sptp-member-skill-progress">
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
									</td>
									<?php
									break;
								default:
									break;
							}
						}
					}
					?>
				</tr>
				<?php
			endforeach;
			?>
		</tbody>
	</table>
				</div>
		<?php
		endif;
		require 'pagination.php';
	if ( 'modal' == $page_link_type ) {
		require 'sptp-modal.php';
	}
	?>
</div>
</div>
