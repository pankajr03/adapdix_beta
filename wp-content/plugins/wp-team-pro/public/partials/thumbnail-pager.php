<?php
/**
 * Thumbnail Pager layout
 *
 * @package WP_Team_Pro
 * @since 2.0.0
 */

?>
<div class="sp-wp-team-pro-wrapper<?php echo esc_html( $preloader_class ); ?>">
<div class="sp-team-pro sptp-section" id="<?php echo esc_html( 'sptp-' . $generator_id ); ?>">
	<?php if ( $preloader ) : ?>
		<div id="page-loading-image" class="page-loading-image"></div>
	<?php endif; ?>
	<?php if ( get_the_title( $generator_id ) && $settings['style_title'] ) : ?>
		<h2 class="sptp-section-title"><span><?php echo esc_html( get_the_title( $generator_id ) ); ?></span></h2>
	<?php endif; ?>
	<div class="sptp-row sptp-thumbnail-pager">
		<div class="sptp-col-md-2-half">
			<div class="sptp-row">
			<?php
			foreach ( $filter_members as $member ) :
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
						$member_image_src = get_the_post_thumbnail_url( $member->ID, $image_size );
					} else {
						if ( empty( $gallery_attachment ) ) {
							$member_image_src = SPTP_PLUGIN_ROOT . 'public/img/Placeholder-Image.png';
						} else {
							$member_image_src = $gallery_attachment[0];
						}
					}
				}
				$image_alt = get_post_meta( get_post_thumbnail_id( $member->ID ), '_wp_attachment_image_alt', true );
				?>
				<div class="<?php echo esc_html( $responsive_classes ); ?>">
					<div class="sptp-member-avatar-img-area">
					<div class="sptp-team-inline-thumb">
						<div class="sptp-member-avatar-img <?php echo esc_html( $image_shape . ' ' . $image_zoom . ' ' . $image_grayscale ); ?>">
						<div class="sptp-overflow-h">
							<img src="<?php echo esc_html( $member_image_src ); ?>" alt="<?php echo ( $image_alt ) ? esc_html( $image_alt ) : esc_html( get_the_title( $generator_id ) ); ?>" data-member=<?php echo $member->ID; ?>
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
						<?php if ( $icon_over_img && ( ( 'content_over_image' !== $position ) || ( 'thumbnail-pager' === $layout['layout_preset'] ) ) ) : ?>
							<div class="sptp-icon text-center">
								<?php if ( $icon_over_img_type == 'plus' ) : ?>
								<i class="fa fa-plus"></i>
									<?php
								endif;
								if ( $icon_over_img_type == 'search' ) :
									?>
								<i class="fa fa-search"></i>
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
									<?php
								endif;
								if ( $icon_over_img_type == 'angle' ) :
									?>
								<i class="fa fa-angle-right"></i>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						</div>
						</div>
					</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="sptp-col-md-4" id="special-member-<?php echo esc_html( $generator_id ); ?>">
		<?php if ( $preloader ) : ?>
			<div class="page-loading-image"></div>
		<?php endif; ?>
			<?php
			$member_thumbnail_cookie = $generator_id . 'sptpThumbnail';
			$member                  = ! empty( $_COOKIE[ "$member_thumbnail_cookie" ] ) ? get_post( esc_html( $_COOKIE[ "$member_thumbnail_cookie" ] ) ) : $filter_members[0];

			require 'single-member.php';
			?>
		</div>
	</div>
</div>
</div>
