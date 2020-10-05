<?php
/**
 * @package WP_Team
 * @since 2.0
 */
get_header();
// Start the loop.
while ( have_posts() ) :
	the_post();

	$member_info      = get_post_meta( get_the_ID(), '_sptp_add_member', true );
	$team_settings    = get_post_meta( $_GET['team'], '_sptp_generator', true );
	$detail_fields    = $team_settings['link_detail_fields']['detail_page_fields'];
	$sptp_settings    = get_option( '_sptp_settings' );
	$sptp_fontawesome = isset( $sptp_settings['enqueue_fontawesome'] ) ? $sptp_settings['enqueue_fontawesome'] : '';
	if ( $sptp_fontawesome ) {
		wp_enqueue_style( 'fontawesome' );
	} ?>
	<style>
	.sptp-single-post{
		max-width: 1000px;
		margin: auto;
		padding; 20px;
	}
	.sptp-list-style{
		display: -ms-flexbox;
		display: -webkit-box;
		display: flex;
		-ms-flex-align: start;
		-webkit-box-align: start;
		align-items: flex-start;
		margin: 15px auto;
	}

	.sptp-list-style .sptp-member-avatar-area {
		margin-right: 25px;
		max-width: 400px;
	}
	.sptp-list-style .sptp-info {
		-ms-flex: 1;
		-webkit-box-flex: 1;
		flex: 1;
	}
	.sptp-member-name h2 {
		text-align: center;
		<?php if ( isset( $team_settings['typo_member_name']['color'] ) ) { ?>
		color: <?php echo esc_html( $team_settings['typo_member_name']['color'] ); ?>;
		<?php }; ?>
	}
	.sptp-member-profession h4 {
		text-align: center;
		<?php if ( isset( $team_settings['typo_member_name']['color'] ) ) : ?>
		color: <?php echo esc_html( $team_settings['typo_member_position']['color'] ); ?>;
		<?php endif; ?>
	}
	@media only screen and (max-width: 767px) {
		.sptp-list-style{
			display: block;

		}
		.sptp-list-style .sptp-member-avatar-area {
			margin-bottom: 20px; 
			margin-right: 0px;
		}
	}
	</style>
	<div id="post-sptp-<?php the_ID(); ?>" <?php post_class( 'sptp-single-post' ); ?>>
	<div class="sptp-list-style">
	<?php if ( empty( $_GET['team'] ) || in_array( 'img', $detail_fields ) ) { ?>
		<div class="sptp-member-avatar-area">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} else {

				if ( ! empty( $member_info['member_image_gallery'] ) ) {
					$member_gallery     = explode( ',', $member_info['member_image_gallery'] );
					$gallery_attachment = [];
					foreach ( $member_gallery as $gallery_img ) {
						$gallery_attachment[] = wp_get_attachment_image_src( $gallery_img, 'full' )[0];
					}
					echo "<img src='" . $gallery_attachment[0] . "' />";
				} else {
					echo "<img src='" . SPT_PLUGIN_ROOT . "/public/img/Placeholder-Image.png' />";
				}
			}
			?>
		</div><!-- .post-thumbnail -->
		<?php
	}
	?>
	<div class="sptp-info">
		<?php
		if ( empty( $_GET['team'] ) || ! empty( $post->post_title ) && in_array( 'name', $detail_fields ) ) :
			?>
			<div class="sptp-member-name">
				<h2><?php the_title(); ?>
				</h2>
			</div>
				<?php
				endif;
		if ( empty( $_GET['team'] ) || ( ! empty( $member_info['sptp_job_title'] ) ) && in_array( 'position', $detail_fields, true ) ) :
			?>
			<div class="sptp-member-profession">
				<h4><?php echo esc_html( $member_info['sptp_job_title'] ); ?></h4>
			</div>
			<?php
			endif;
		if ( empty( $_GET['team'] ) || ( ! empty( $member_info['sptp_member_social'] ) ) && in_array( 'social_profiles', $detail_fields, true ) ) :
			$social_icon_shape = $team_settings['social_settings']['social_icon_shape'];
			?>
			<style>
				.sptp-member-social {
					margin: 0;
					padding: 0;
					padding-left: 0;
					padding-top: 10px;
					line-height: 0;
				}
				.sptp-member-social ul {
					list-style: none;
					margin: 0;
					text-align: center;
				}
				.sptp-member-social.circle a {
					border-radius: 50%;
				}
				.sptp-member-social.rounded a {
					border-radius: 5px;
				}
				.sptp-member-social li {
					display: inline-block;
					margin: 0;
					list-style: none;
					position: relative;
				}
				.sptp-member-social li:hover {
					opacity: 0.7;
				}
				.sptp-member-social li  a {
					cursor: pointer;
					display: flex;
					justify-content: center;
					align-items: center;
					text-decoration: none;
					height: 30px;
					width: 30px;
					border-radius: 50%;
					color: #ffffff;
					background-color: #333333;
					font-size: 15px;
					height: 30px;
					width: 30px;
					display: block;
					text-align: center;
				}
				.sptp-member-social li .fa {
					position: absolute;
					top: 50%;
					left: 50%;
					transform: translate(-50%, -50%);
				}

				.sptp-twitter {
					background-color: #55acee !important;
				}
				.sptp-facebook {
					background-color: #3b5999 !important;
				}
				.sptp-instagram {
					background-color: #e4405f !important;
				}
				.sptp-pinterest-p {
					background-color: #bd081c !important;
				}
				.sptp-linkedin {
					background-color: #0077b5 !important;
				}
				.sptp-youtube {
					background-color: #cd201f !important;
				}
				.sptp-medium {
					background-color: #02b875 !important;
				}
				.sptp-codepen {
					background-color: #76daff !important;
				}
			</style>
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
	</div>
	<?php if ( empty( $_GET['team'] ) || in_array( 'desc', $detail_fields ) ) { ?>
	<div class="sptp-content">
		<?php the_content(); ?>
	</div>
	<?php }; ?>
</div>
	<?php
	endwhile;
get_footer();
