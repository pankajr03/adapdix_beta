<?php
/**
 * Carousel layout.
 *
 * @package WP_Team
 * @since 2.0
 */

?>
<div id="<?php echo esc_html( 'sptp-' . $generator_id ); ?>"  class="sp-team sptp-carousel sptp-section <?php echo 'sptp-' . esc_html( $page_link_type ); ?>">

	<?php if ( ! empty( get_the_title( $generator_id ) ) && $section_title ) : ?>
		<h2 class="sptp-section-title"><span><?php echo esc_html( get_the_title( $generator_id ) ); ?></span></h2>
		<?php
	endif;
	if ( ! empty( $filter_members ) ) :
		if ( $preloader ) :
			?>
		<div class="page-loading-image"></div>
			<?php
		endif;
		if ( 'vertically-center-outer' === $navigation_position ) :
			?>
		<div><!--  swiper-container -->
		<?php endif ?>
		<?php
		$carousel_accessibility                           = isset( get_option( '_sptp_settings' )['carousel_accessibility'] ) ? get_option( '_sptp_settings' )['carousel_accessibility'] : '';
		$carousel_accessibility_enabled                   = ( isset( $carousel_accessibility['accessibility'] ) && ( $carousel_accessibility['accessibility'] ) ) ? 'true' : 'false';
		$carousel_accessibility_prev_slide_message        = isset( $carousel_accessibility['prev_slide_message'] ) ? $carousel_accessibility['prev_slide_message'] : '';
		$carousel_accessibility_next_slide_message        = isset( $carousel_accessibility['next_slide_message'] ) ? $carousel_accessibility['next_slide_message'] : '';
		$carousel_accessibility_first_slide_message       = isset( $carousel_accessibility['first_slide_message'] ) ? $carousel_accessibility['first_slide_message'] : '';
		$carousel_accessibility_last_slide_message        = isset( $carousel_accessibility['last_slide_message'] ) ? $carousel_accessibility['last_slide_message'] : '';
		$carousel_accessibility_pagination_bullet_message = isset( $carousel_accessibility['pagination_bullet_message'] ) ? $carousel_accessibility['pagination_bullet_message'] : '';
		?>
		<div class="swiper-container sptp-main-carousel <?php echo esc_html( $navigation_position ); ?>" data-carousel='{
			"speed": <?php echo esc_html( $carousel_speed ); ?>,
			"items": <?php echo esc_html( $settings['responsive_columns']['desktop'] ); ?>,
			"spaceBetween": <?php echo esc_html( $margin_between_member ); ?>,
			"autoplay": <?php echo esc_html( $carousel_autoplay ); ?>,
			"autoplay_speed": <?php echo esc_html( $autoplay_speed ); ?>,
			"loop": <?php echo esc_html( $loop ); ?>,
			"freeMode": false,
			"autoHeight": <?php echo esc_html( $auto_height ); ?>,
			"watchOverflow": true,
			"lazy": <?php echo esc_html( $lazy_load ); ?>,
			"breakpoints": {
				"desktop": <?php echo esc_html( $settings['responsive_columns']['desktop'] ); ?>,
				"laptop": <?php echo esc_html( $settings['responsive_columns']['laptop'] ); ?>,
				"tablet": <?php echo esc_html( $settings['responsive_columns']['tablet'] ); ?>,
				"mobile": <?php echo esc_html( $settings['responsive_columns']['mobile'] ); ?>
			},
			"stop_onhover": <?php echo esc_html( $stop_onhover ); ?>,
			"enabled": <?php echo esc_html( $carousel_accessibility_enabled ); ?>,
			"prevSlideMessage": "<?php echo esc_html( $carousel_accessibility_prev_slide_message ); ?>",
			"nextSlideMessage": "<?php echo esc_html( $carousel_accessibility_next_slide_message ); ?>",
			"firstSlideMessage": "<?php echo esc_html( $carousel_accessibility_first_slide_message ); ?>",
			"lastSlideMessage": "<?php echo esc_html( $carousel_accessibility_last_slide_message ); ?>",
			"paginationBulletMessage": "<?php echo esc_html( $carousel_accessibility_pagination_bullet_message ); ?>"
		}'>
			<div class="swiper-wrapper <?php echo esc_html( $position ); ?>">
		<?php
		foreach ( $filter_members as $member ) :
			?>
			<div class="swiper-slide">
			<?php
			include 'single-member.php';
			?>
			</div>
			<?php
	endforeach;
		?>
	</div>

		<?php if ( $settings['carousel_pagination'] && ( count( $filter_members ) > $settings['responsive_columns']['desktop'] ) ) : ?>
		<div class="sptp-pagination swiper-pagination"></div>
		<?php endif; ?>
		<?php if ( 'vertically-center-outer' === $navigation_position ) : ?>
		</div>
		<?php endif ?>
		<?php
		if ( $settings['carousel_navigation'] && ( count( $filter_members ) > $settings['responsive_columns']['desktop'] ) && ( $carousel_mode == 'standard' ) ) :
			?>
			<div class="sptp-button-next swiper-button-next <?php echo esc_html( $navigation_position ); ?>"><i class="fa fa-angle-right"></i></div>
			<div class="sptp-button-prev swiper-button-prev <?php echo esc_html( $navigation_position ); ?>"><i class="fa fa-angle-left"></i></div>
		<?php endif; ?>
		</div>
			<?php
endif;
	?>
</div>
