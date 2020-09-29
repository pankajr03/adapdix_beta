<?php
/**
 * List layout.
 *
 * @package WP_Team
 * @since 2.0.0
 */

?>
<div id="<?php echo esc_attr( 'sptp-' . $generator_id ); ?>" class="sp-team sptp-section <?php echo 'sptp-' . esc_html( $page_link_type ); ?>">
	<?php if ( ! empty( get_the_title( $generator_id ) ) && ( $settings['style_title'] != false ) ) : ?>
	<h2 class="sptp-section-title"><span><?php echo esc_attr( get_the_title( $generator_id ) ); ?></span></h2>
		<?php
	endif;
	if ( ! empty( $filter_members ) ) :
		?>
	<div class="sptp-list">
		<?php if ( $preloader ) : ?>
			<div class="page-loading-image"></div>
		<?php endif; ?>
		<div class="sptp-row">
			<?php
			$members_array = $filter_members;
			foreach ( $members_array as $key => $member ) {
				?>
				<div class="<?php echo esc_html( $responsive_classes ); ?>">
				<?php
				include 'single-member.php';
				?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
		<?php
endif;
	?>
</div>
