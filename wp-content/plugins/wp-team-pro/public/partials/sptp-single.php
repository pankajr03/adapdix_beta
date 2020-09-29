<?php
/**
 * @package WP_Team_Pro
 * @since 2.0.0
 */
get_header('home'); ?>
<div class="spacer-mobi"></div>
<div class="section-hp sm-section-p pb-0">
	<div class="custom-container">
		<div class="row bio-mob">
<?php

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
	}
	?>
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
		<?php
		if ( isset( $team_settings['typo_member_name']['text-align'] ) ) :
			?>
		text-align: <?php echo esc_html( $team_settings['typo_member_name']['text-align'] ); ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['font-size'] ) ) :
			?>
		font-size: <?php echo esc_html( $team_settings['typo_member_name']['font-size'] . 'px' ); ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['color'] ) ) :
			?>
		color: <?php echo esc_html( $team_settings['typo_member_name']['color'] ); ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['line-height'] ) ) :
			?>
		line-height: <?php echo $team_settings['typo_member_name']['line-height'] . 'px'; ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['text-transform'] ) ) :
			?>
		text-transform: <?php echo $team_settings['typo_member_name']['text-transform']; ?> ;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['margin-top'] ) ) :
			?>
		margin-top: <?php echo $team_settings['typo_member_name']['margin-top'] . 'px'; ?> ;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['margin-bottom'] ) ) :
			?>
		margin-bottom: <?php echo $team_settings['typo_member_name']['margin-bottom'] . 'px'; ?> ;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['letter-spacing'] ) ) :
			?>
		letter-spacing: <?php echo $team_settings['typo_member_name']['letter-spacing'] . 'px'; ?> ;
			<?php
		endif;
		?>
	}
	.sptp-member-profession h4 {
		<?php
		if ( isset( $team_settings['typo_member_name']['text-align'] ) ) :
			?>
		text-align: <?php echo esc_html( $team_settings['typo_member_position']['text-align'] ); ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['font-size'] ) ) :
			?>
		font-size: <?php echo esc_html( $team_settings['typo_member_position']['font-size'] . 'px' ); ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['color'] ) ) :
			?>
		color: <?php echo esc_html( $team_settings['typo_member_position']['color'] ); ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['line-height'] ) ) :
			?>
		line-height: <?php echo $team_settings['typo_member_position']['line-height'] . 'px'; ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['text-transform'] ) ) :
			?>
		text-transform: <?php echo $team_settings['typo_member_position']['text-transform']; ?> ;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['margin-top'] ) ) :
			?>
		margin-top: <?php echo $team_settings['typo_member_position']['margin-top'] . 'px'; ?> ;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['margin-bottom'] ) ) :
			?>
		margin-bottom: <?php echo $team_settings['typo_member_position']['margin-bottom'] . 'px'; ?> ;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['letter-spacing'] ) ) :
			?>
		letter-spacing: <?php echo $team_settings['typo_member_position']['letter-spacing'] . 'px'; ?> ;
			<?php
		endif;
		?>
	}
	.sptp-member-mobile span,
	.sptp-member-mobile .fa,
	.sptp-member-location span,
	.sptp-member-location .fa,
	.sptp-member-email span,
	.sptp-member-email .fa,
	.sptp-member-website span,
	.sptp-member-website .fa {
		<?php
		if ( isset( $team_settings['typo_member_name']['text-align'] ) ) :
			?>
		text-align: <?php echo esc_html( $team_settings['additional_info']['text-align'] ); ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['font-size'] ) ) :
			?>
		font-size: <?php echo esc_html( $team_settings['additional_info']['font-size'] . 'px' ); ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['color'] ) ) :
			?>
		color: <?php echo esc_html( $team_settings['additional_info']['color'] ); ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['line-height'] ) ) :
			?>
		line-height: <?php echo $team_settings['additional_info']['line-height'] . 'px'; ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['text-transform'] ) ) :
			?>
		text-transform: <?php echo $team_settings['additional_info']['text-transform']; ?> ;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['margin-top'] ) ) :
			?>
		margin-top: <?php echo $team_settings['additional_info']['margin-top'] . 'px'; ?> ;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['margin-bottom'] ) ) :
			?>
		margin-bottom: <?php echo $team_settings['additional_info']['margin-bottom'] . 'px'; ?> ;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['letter-spacing'] ) ) :
			?>
		letter-spacing: <?php echo $team_settings['additional_info']['letter-spacing'] . 'px'; ?> ;
			<?php
		endif;
		?>
	}
	.sptp-member-skill-progress .sptp-progress-text {
		<?php
		if ( isset( $team_settings['typo_member_name']['text-align'] ) ) :
			?>
		text-align: <?php echo esc_html( $team_settings['typo_skills']['text-align'] ); ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['font-size'] ) ) :
			?>
		font-size: <?php echo esc_html( $team_settings['typo_skills']['font-size'] . 'px' ); ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['color'] ) ) :
			?>
		color: <?php echo esc_html( $team_settings['typo_skills']['color'] ); ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['line-height'] ) ) :
			?>
		line-height: <?php echo $team_settings['typo_skills']['line-height'] . 'px'; ?>;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['text-transform'] ) ) :
			?>
		text-transform: <?php echo $team_settings['typo_skills']['text-transform']; ?> ;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['margin-top'] ) ) :
			?>
		margin-top: <?php echo $team_settings['typo_skills']['margin-top'] . 'px'; ?> ;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['margin-bottom'] ) ) :
			?>
		margin-bottom: <?php echo $team_settings['typo_skills']['margin-bottom'] . 'px'; ?> ;
			<?php
		endif;
		if ( isset( $team_settings['typo_member_name']['letter-spacing'] ) ) :
			?>
		letter-spacing: <?php echo $team_settings['typo_skills']['letter-spacing'] . 'px'; ?> ;
			<?php
		endif;
		?>
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
	<?php if ( in_array( 'img', $detail_fields ) ) : ?>
	<div class="sptp-member-avatar-area">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} else {
				if ( ! empty( $member_info['member_image_gallery'] ) ) {
					$member_gallery = explode( ',', $member_info['member_image_gallery'] );
					$gallery_attachment = [];
					foreach ( $member_gallery as $gallery_img ) {
						$gallery_attachment[] = wp_get_attachment_image_src( $gallery_img, 'full' )[0];
					}
					echo "<img src='" . $gallery_attachment[0] . "' />";
				} else {
					echo "<img src='" . SPTP_PLUGIN_ROOT . "/public/img/Placeholder-Image.png' />";
				}
			}
	endif;
	?>
	</div><!-- .post-thumbnail -->
	<div class="sptp-info">
		<?php
		if ( ! empty( $post->post_title ) && in_array( 'name', $detail_fields ) ) :
			?>
			<div class="sptp-member-name">
				<h2><?php the_title(); ?>
				</h2>
			</div>
				<?php
				endif;
		if ( ( ! empty( $member_info['sptp_job_title'] ) ) && in_array( 'position', $detail_fields ) ) :
			?>
			<div class="sptp-member-profession">
				<h4><?php echo esc_html( $member_info['sptp_job_title'] ); ?></h4>
			</div>
			<?php
			endif;
		if ( ( ! empty( $member_info['sptp_mobile'] ) ) && in_array( 'mobile', $detail_fields ) ) :
			?>
			<div class="sptp-member-mobile">
				<?php if ( in_array( 'icon', $detail_fields, true ) ) : ?>
				<i class="fa fa-mobile"></i>
				<?php endif; ?>
				<a href="<?php echo 'tel:' . esc_html( $member_info['sptp_mobile'] ); ?>">
					<span><?php echo esc_html( $member_info['sptp_mobile'] ); ?></span>
				</a>
			</div>
			<?php
			endif;
		if ( ( ! empty( $member_info['sptp_phone'] ) ) && in_array( 'phone', $detail_fields ) ) :
			?>
			<div class="sptp-member-mobile">
				<?php if ( in_array( 'icon', $detail_fields, true ) ) : ?>
				<i class="fa fa-mobile"></i>
				<?php endif; ?>
				<a href="<?php echo 'tel:' . esc_html( $member_info['sptp_phone'] ); ?>">
					<span><?php echo esc_html( $member_info['sptp_phone'] ); ?></span>
				</a>
			</div>
			<?php
			endif;
		if ( ( ! empty( $member_info['sptp_location'] ) ) && in_array( 'location', $detail_fields ) ) :
			?>
			<div class="sptp-member-location">
				<?php if ( in_array( 'icon', $detail_fields, true ) ) : ?>
				<i class="fa fa-map-marker"></i>
				<?php endif; ?>
				<span><?php echo esc_html( $member_info['sptp_location'] ); ?></span>
			</div>
			<?php
			endif;
		if ( ( ! empty( $member_info['sptp_email'] ) ) && in_array( 'email', $detail_fields ) ) :
			?>
			<div class="sptp-member-email">
				<?php if ( in_array( 'icon', $detail_fields, true ) ) : ?>
				<i class="fa fa-envelope"></i>
				<?php endif; ?>
				<a href="<?php echo 'mailto:' . esc_html( $member_info['sptp_email'] ); ?>">
					<span><?php echo esc_html( $member_info['sptp_email'] ); ?></span>
				</a>
			</div>
			<?php
			endif;
		if ( ( ! empty( $member_info['sptp_website'] ) ) && in_array( 'website', $detail_fields ) ) :
			?>
			<div class="sptp-member-website">
				<?php if ( in_array( 'icon', $detail_fields, true ) ) : ?>
				<i class="fa fa-globe"></i>
				<?php endif; ?>
				<a href="<?php echo esc_html( $member_info['sptp_website'] ); ?>">
					<span><?php echo esc_html( $member_info['sptp_website'] ); ?></span>
				</a>
			</div>
			<?php
			endif;
		if ( ( ! empty( $member_info['sptp_skills'] ) ) && in_array( 'skills', $detail_fields ) ) :
			?>
						<style>
						.sptp-member-skill-progress .sptp-progress-text {
							text-align: left;
							display: block;
						}
						.sptp-member-skill-progress {
							font-size: 13px;
							font-weight: 400;
							line-height: 24px;
							padding-top: 6px;
							width: 100%;
						}
						.sptp-member-skill-progress .sptp-progress-container .sptp-progress-bar.sptp-tooltip {
								position: relative;
							}
							.sptp-member-skill-progress .sptp-progress-container .sptp-progress-bar.sptp-tooltip .sptp-top {
							width: 38px;
							top: -10px;
							right: -17px;
							-webkit-transform: translate(0,-100%);
							transform: translate(0,-100%);
							padding: 5px 7px;
							color: #fff;
							background-color: #3b993f;
							font-weight: 400;
							font-size: 10px;
							line-height: 12px;
							border-radius: 2px;
							position: absolute;
							z-index: 99999999;
							-webkit-box-sizing: border-box;
							box-sizing: border-box;
							display: none;
							opacity: 0;
							-webkit-transition: all .33s;
							transition: all .33s;
						} .sptp-member-skill-progress .sptp-progress-container .sptp-progress-bar {
							height: 4px;
							width: 0;
							background-color: #63a37b;
						}
						.sptp-member-skill-progress .sptp-progress-container {
							width: 100%;
							height: 4px;
							background-color: #c9dfd1;
						}
						.sptp-member-skill-progress .sptp-progress-container .sptp-progress-bar.sptp-tooltip .sptp-top:after,.sptp-member-skill-progress .sptp-progress-container .sptp-progress-bar.sptp-tooltip .sptp-top:before {
							top: 100%;
							left: 50%;
							border: solid transparent;
							content: "";
							height: 0;
							width: 0;
							position: absolute;
							pointer-events: none;
						} 
						.sptp-member-skill-progress .sptp-progress-container .sptp-progress-bar.sptp-tooltip .sptp-top:before {
							border-color: transparent;
							border-top-color: transparent;
							border-width: 8px;
							margin-left: -8px;
						}
						.sptp-member-skill-progress .sptp-progress-container .sptp-progress-bar.sptp-tooltip .sptp-top:after {
							border-color: transparent;
							border-top-color: #63a37b;
							border-width: 6px;
							margin-left: -6px;
						}
						.sptp-member-skill-progress .sptp-progress-container:hover .sptp-tooltip .sptp-top {
							display: block;
							opacity: 1;
						}
						</style>
						<script>
						jQuery(document).ready(function($) {
						$(".sptp-progress-container").each(function() {
								var percent = $(this).data("title");
								$(this)
								.find(".sptp-progress-bar")
								.animate({
									width: percent
								},
								1000);
								var percentInt = parseInt(percent);
								if( percentInt >= 95 ) {
								$(this).find('.sptp-top').css('right', 0);
								}
								if ( percentInt === 100 ) {
								$(this).find('.sptp-top').css('width', '40px');
								}
							});
						});
						</script>
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
		if ( ( ! empty( $member_info['sptp_memeber_social'] ) ) && in_array( 'social_profiles', $detail_fields ) ) :
			?>
				<div class="sptp-member-social <?php echo esc_html( $social_icon_shape ); ?>">
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
		if ( ( ! empty( $member_info['sptp_user_profile'] ) ) && in_array( 'author_posts', $detail_fields ) ) :
			$user_id      = $member_info['sptp_user_profile'];
			$member_posts = count_user_posts( $user_id ); // cout user's posts.
			if ( $member_posts > 0 ) {
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
			endif;
		?>
		</div>
	</div>
	<?php if ( in_array( 'desc', $detail_fields ) ) : ?>
	<div class="sptp-content">
		<?php
		the_content();
		?>
	</div>
		<?php endif; ?>
</div>
	<?php
		endwhile;
		?>
		</div>
		</div>
		</div>
		<?php get_footer('home');
