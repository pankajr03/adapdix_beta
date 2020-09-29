<?php
/**
 * Mosaic layout.
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
	<div class="sptp-grid sptp-mosaic">
		<div class="sptp-row sptp-mosaic-row 
		<?php
		echo ( 'drawer' == $page_link_type ) ? 'gridder' : '';
		?>
		">
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
			?>
				<?php foreach ( $members_array as $key => $member ) : ?>

				<div class="sptp-member <?php echo ( 'drawer' == $page_link_type ) ? ' gridder-list ' : ''; ?>
					<?php echo esc_html( $responsive_classes ); ?>
					<?php
					if ( ( 'pagination_btn' === $pagination_type || 'pagination_scrl' === $pagination_type ) && ( $key < $show_per_page ) ) {
						echo ' first-row';}
					?>
					<?php
					if ( 'drawer' == $page_link_type ) {
						?>
						data-griddercontent="#gridder-content-<?php	echo esc_attr( $member->ID ); } ?>">
					<?php require 'single-member.php'; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
		endif;
		require 'pagination.php';
	if ( 'drawer' == $page_link_type ) {
		include 'drawer-content.php';
	}
	if ( 'modal' == $page_link_type ) {
		require 'sptp-modal.php';
	}
	?>
	</div>
</div>
</div>
