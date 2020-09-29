<?php
/**
 * Filter layout
 *
 * @package WP_Team_Pro
 * @since 2.0.0
 */

?>
<div class="sp-wp-team-pro-wrapper<?php echo esc_html( $preloader_class ); ?>">
	<div id="<?php echo esc_html( 'sptp-' . $generator_id ); ?>"  class="sp-team-pro sptp-section sptp-filter <?php echo 'sptp-' . esc_html( $page_link_type ); ?>">
		<?php if ( $preloader ) : ?>
			<div id="page-loading-image" class="page-loading-image"></div>
		<?php endif; ?>
		<?php if ( ! empty( get_the_title( $generator_id ) ) && ( $settings['style_title'] ) ) : ?>
			<h2 class="sptp-section-title"><span><?php echo esc_html( get_the_title( $generator_id ) ); ?></span></h2>
			<?php
		endif;

		// get members of this layout.
		$filter_members = isset( $layout['filter_members'] ) ? $layout['filter_members'] : '';
		if ( ! empty( $filter_members ) ) {
			switch ( $filter_members ) {
				case 'newest':
					$latest_posts = get_posts(
						array(
							'post_type'      => 'sptp_member',
							'posts_per_page' => -1,
							'orderby'        => $settings['order_by'],
							'order'          => 'ASC',
							'fields'         => 'ids',
						)
					);
					$filter_layout_args    = array(
						'post_type'      => 'sptp_member',
						'posts_per_page' => $filter_member_number,
						'post__in'       => $latest_posts,
						'orderby'        => 'post__in',
						'order'          => $sptp_member_order,
					);
					$filter_layout_query   = new WP_Query( $filter_layout_args );
					$filter_layout_members = $filter_layout_query->posts;
					break;
				case 'group':
					if ( ! empty( $layout['filter_group'] ) ) {
						switch ( $group_relation ) {
							case 'in':
								$args                  = array(
									'post_type'      => 'sptp_member',
									'posts_per_page' => $filter_member_number,
									'tax_query'      => array(
										array(
											'taxonomy' => 'sptp_group',
											'field'    => 'term_id',
											'terms'    => $layout['filter_group'],
										),
									),
									'orderby'        => $settings['order_by'],
									'order'          => $sptp_member_order,
								);
								$members               = new WP_Query( $args );
								$filter_layout_members = $members->posts;
								break;
							case 'and':
								$args           = array(
									'post_type' => 'sptp_member',
									'tax_query' => array(
										array(
											'taxonomy' => 'sptp_group',
											'field'    => 'term_id',
											'terms'    => $layout['filter_group'],
											'operator' => 'AND',
										),
									),
									'orderby'   => $settings['order_by'],
									'order'     => $sptp_member_order,
								);
								$members        = new WP_Query( $args );
								$filter_members = $members->posts;
								break;
							case 'not_in':
								$args           = array(
									'post_type' => 'sptp_member',
									'tax_query' => array(
										array(
											'taxonomy' => 'sptp_group',
											'field'    => 'term_id',
											'terms'    => $layout['filter_group'],
											'operator' => 'NOT IN',
										),
									),
									'orderby'   => $settings['order_by'],
									'order'     => $sptp_member_order,
								);
								$members        = new WP_Query( $args );
								$filter_members = $members->posts;
								break;
						}
					} else {
						$args                  = array(
							'post_type'      => 'sptp_member',
							'posts_per_page' => -1,
							'orderby'        => $settings['order_by'],
							'order'          => $sptp_member_order,
						);
						$query                 = new WP_Query( $args );
						$filter_layout_members = $query->posts;
					}
					break;
				case 'specific':
					$specific_members          = $layout['filter_specific'];
					$filter_specific_query     = new WP_Query(
						array(
							'post_type'      => 'sptp_member',
							'posts_per_page' => $filter_member_number,
							'post__in'       => $specific_members,
							'orderby'        => $settings['order_by'],
							'order'          => $sptp_member_order,
						)
					);
						$filter_layout_members = $filter_specific_query->posts;
					break;
				case 'exclude':
					$exclude_members       = $layout['filter_exclude'];
					$filter_exclude_query  = new WP_Query(
						array(
							'post_type'    => 'sptp_member',
							'post__not_in' => $exclude_members,
							'orderby'      => $settings['order_by'],
							'order'        => $sptp_member_order,
						)
					);
					$filter_layout_members = $filter_exclude_query->posts;
					break;
			};
		}

		if ( ! empty( $filter_layout_members ) ) :
			$filter_array    = [];
			$member_position = [];
			$location        = [];
			foreach ( $filter_layout_members as $member ) {
				$member_meta = get_post_meta( $member->ID, '_sptp_add_member', true );
				if ( isset( $layout['filter_group'] ) && $layout['filter_group'] == ! '' && 'group' === $layout['filter_members'] ) {
					$_temps = $layout['filter_group'];
					if ( ! empty( $_temps ) ) {
						foreach ( $_temps as $_temp ) {
							$filter_array[] = get_term( $_temp );
						}
					}
				} else {
					$_temps = get_the_terms( $member->ID, 'sptp_group' );
					if ( ! empty( $_temps ) ) {
						foreach ( $_temps as $_temp ) {
							$object         = new stdClass();
							$object->id     = $_temp->term_id;
							$object->name   = $_temp->name;
							$object->order  = $_temp->order;
							$object->slug   = $_temp->slug;
							$filter_array[] = $object;
						}
					}
				}

				$member_position[] = ! empty( $member_meta['sptp_job_title'] ) ? $member_meta['sptp_job_title'] : '';
				$location[]        = ! empty( $member_meta['sptp_location'] ) ? $member_meta['sptp_location'] : '';
			}
			$unique_objs      = array_unique( $filter_array, SORT_REGULAR );
			$member_positions = array_filter( array_unique( $member_position ) );
			$locations        = array_filter( array_unique( $location ) );

			switch ( $filter_order ) {
				case 'asc':
					sort( $locations );
					sort( $member_positions );
					break;
				case 'desc':
					arsort( $locations );
					arsort( $member_positions );
					break;
				default:
					break;
			}
			?>

	<div class="button-group filters-button-group" style="visibility: <?php echo ( 'filter_button' === $filter_type ) ? 'visible' : 'hidden'; ?>;">
			<?php if ( $filter_all_btn_switch ) : ?>
				<button class="button is-checked" data-filter="*"><?php echo esc_html( $filter_all_btn_text ); ?></button>
					<?php
				endif;
			switch ( $filter_by ) {
				case 'taxonomy':
					foreach ( $unique_objs as $sptp_cat ) :
						?>
						<button class="button fltr-controls <?php echo esc_html( $sptp_cat->slug ); ?>" data-filter="<?php echo '.' . esc_html( $sptp_cat->slug ); ?>"><?php echo esc_html( $sptp_cat->name ); ?></button>
							<?php
						endforeach;
					break;
				case 'position':
					foreach ( $member_positions as $member_position ) :
						$stress_position = $member_position;
						if ( strpos( $member_position, ' ' ) !== false ) {
							$stress_position = str_replace( ' ', '', $member_position );
						}
						?>
						<button class="button fltr-controls <?php echo esc_html( $stress_position ); ?>" data-filter="<?php echo '.' . esc_html( $stress_position ); ?>"><?php echo esc_html( $member_position ); ?></button>
							<?php
						endforeach;
					break;
				case 'location':
					foreach ( $locations as $location ) :
						?>
						<button class="button fltr-controls" data-filter="<?php echo '.' . esc_html( $location ); ?>"><?php echo esc_html( $location ); ?></button>
							<?php
						endforeach;
					break;
				default:
					wp_die( 'default' );
			}
			?>
	</div>

			<?php if ( 'filter_button' !== $filter_type ) : ?>	
				<select class="filterSelect">
				<?php if ( $filter_all_btn_switch ) : ?>
					<option value="all"><?php echo esc_html( $filter_all_btn_text ); ?></option>
						<?php
						endif;
				switch ( $filter_by ) {
					case 'taxonomy':
						foreach ( $unique_objs as $sptp_cat ) :
							?>
						<option value="<?php echo esc_html( $sptp_cat->slug ); ?>"><?php echo esc_html( $sptp_cat->name ); ?></option>
							<?php
							endforeach;
						break;
					case 'position':
						foreach ( $positions as $position ) :
							$stress_position = $position;
							if ( strpos( $position, ' ' ) !== false ) {
								$stress_position = str_replace( ' ', '', $position );
							}
							?>
							<option class="button fltr-controls <?php echo esc_html( $stress_position ); ?>" data-filter="<?php echo '.' . esc_html( $stress_position ); ?>"><?php echo esc_html( $position ); ?></option>
								<?php
							endforeach;
						break;
					case 'location':
						foreach ( $locations as $location ) :
							?>
							<option class="button fltr-controls" data-filter="<?php echo '.' . esc_html( $location ); ?>"><?php echo esc_html( $location ); ?></option>
								<?php
							endforeach;
						break;
					default:
						wp_die( 'default' );
						?>
						<?php
				}
				?>
				</select>
				<?php endif; ?>

	<div class="grid sptp-row">
			<?php
			foreach ( $filter_layout_members as $member ) :
				if ( 'taxonomy' == $filter_by ) :
					$cats_arr = get_the_terms( $member->ID, 'sptp_group' );
					if ( ! empty( $cats_arr ) ) {
						$cats_list = wp_list_pluck( $cats_arr, 'slug' );
						$cats      = implode( ' ', $cats_list );
					} else {
						$cats = '';
					}
					?>
						<div class="<?php echo esc_html( $responsive_classes ); ?> filtr-item element-item <?php echo esc_html( $cats ); ?>" data-category="<?php echo ( ! empty( $cats_list ) ) ? esc_html( $cats ) : ''; ?>" >
						<?php
					endif;
				if ( 'position' === $filter_by ) :
					$member_meta     = get_post_meta( $member->ID, '_sptp_add_member', true );
					$member_position = $member_meta['sptp_job_title'];
					if ( strpos( $member_position, ' ' ) !== false ) {
						$member_position = str_replace( ' ', '', $member_position );
					}
					?>
						<div class="<?php echo esc_html( $responsive_classes ); ?> filtr-item element-item <?php echo esc_html( $member_position ); ?>" data-category="<?php echo ( ! empty( $member_position ) ) ? esc_html( $member_position ) : ''; ?>" >
						<?php
					endif;
				if ( 'location' === $filter_by ) :
					$member_meta = get_post_meta( $member->ID, '_sptp_add_member', true );
					$location    = $member_meta['sptp_location'];
					?>
						<div class="<?php echo esc_html( $responsive_classes ); ?> filtr-item element-item <?php echo esc_html( $location ); ?>" data-category="<?php echo ( ! empty( $location ) ) ? esc_html( $location ) : ''; ?>" >
						<?php
					endif;
				?>
				<?php include 'single-member.php'; ?>
				</div>
					<?php
				endforeach;
			?>
				</div>
				<?php
				if ( $filter_pagination ) :
					?>
		<div class="sptp-filter-load-more">
			<span> <?php echo esc_html( $filter_load_more_btn_text ); ?> </span>
		</div>
					<?php
			endif;
				if ( 'modal' == $page_link_type ) {
					include 'sptp-modal.php';
				}
				?>
	</div>
</div>
			<?php
endif;
