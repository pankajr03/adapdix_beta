<?php
/**
 * Single member.
 *
 * @package WP_Team
 * @since 2.0.0
 */

$member_info = get_post_meta( $member->ID, '_sptp_add_member', true );

if ( has_post_thumbnail( $member->ID ) ) {
	$member_image_src       = get_the_post_thumbnail_url( $member->ID, $image_size );
	$member_image_thumbnail = get_the_post_thumbnail_url( $member->ID, 'full' );
} else {
	if ( empty( $gallery_attachment ) ) {
		$member_image_src = SPT_PLUGIN_ROOT . 'public/img/Placeholder-Image.png';
	} else {
		$member_image_src = $gallery_attachment[0];
	}
}

$image_alt = get_post_meta( get_post_thumbnail_id( $member->ID ), '_wp_attachment_image_alt', true );
?>
<div class="sptp-member <?php echo esc_html( $border_bg_around_member_class ) . ' ' . esc_html( $position_class ); ?>">
	<?php
	if ( 'left_img_right_content' === $position || 'left_content_right_img' === $position || 'content_over_image' === $position ) {
		?>
		<div class="<?php echo ( ! empty( $member_image_src ) && ( $style_members['image_switch'] ) && $image_on_off ) ? 'image' : ''; ?>">
		<?php
	}
	if ( ! empty( $member_image_src ) && ( $style_members['image_switch'] ) && $image_on_off ) {

		if ( $link_detail && ( 'new_page' === $page_link_type ) ) {
			?>
			<a class='sptp-member-avatar' href = "<?php echo esc_html( get_permalink( $member->ID ) ) . '&team=' . $generator_id; ?>" target="<?php echo esc_html( $new_page_target ); ?>">
		<?php } else { ?>
			<span class='sptp-member-avatar'>
		<?php } ?>
			<span class="sptp-member-avatar-img <?php echo esc_html( $image_shape ) . ' ' . esc_html( $image_zoom ); ?>">
				<img src="<?php echo esc_html( $member_image_src ); ?>" alt="<?php echo ( $image_alt ) ? esc_html( $image_alt ) : esc_html( get_the_title( $generator_id ) ); ?>" data-member="<?php echo esc_html( $member->ID ); ?>"
				<?php
				if ( $member_image_src == SPT_PLUGIN_ROOT . 'public/img/Placeholder-Image.png' ) {
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
		<?php
		if ( $link_detail && ( 'new_page' === $page_link_type ) ) {
			?>
			</a>
		<?php } else { ?>
		</span>
		<?php } ?>
		<?php
	}
	if ( 'left_img_right_content' === $position || 'left_content_right_img' === $position || 'content_over_image' === $position ) {
		?>
		</div> 
		<div class="content <?php echo ( empty( $member_image_src ) || ( $style_members['image_switch'] ) || ! $image_on_off ) ? '' : 'no-image' . ' ' . esc_html( $image_shape ); ?>">
		<?php
	}

	if ( ( ! empty( $member->post_title ) ) && $style_members['name_switch'] ) :
		?>
		<div class="sptp-member-name">
			<h2><?php echo esc_html( $member->post_title ); ?></h2>
		</div>
		<?php
	endif;
	if ( ( ! empty( $member_info['sptp_job_title'] ) ) && ( $style_members['job_position_switch'] ) ) :
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
			$allowed_html = WP_Team_Public::sptp_allowed_html();
			echo '<span>' . nl2br( wp_kses( $member_info['sptp_short_bio'], $allowed_html ) ) . '</span>';
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
	if ( 'left_img_right_content' === $position || 'left_content_right_img' === $position || 'content_over_image' === $position ) {
		?>
		</div>
		<?php
	}
	?>
</div><!-- .sptp-member -->
