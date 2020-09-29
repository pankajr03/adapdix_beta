<?php
/**
 * All settings of WP_Team_Pro.
 *
 * @package WP_Team_Pro
 * @since 2.0.0
 */

// Main settings.
$sptp_settings            = get_option( '_sptp_settings' );
$sptp_google_fonts        = isset( $sptp_settings['enqueue_google_font'] ) ? $sptp_settings['enqueue_google_font'] : true;
$sptp_swiper_js           = isset( $sptp_settings['enqueue_swiper_js'] ) ? $sptp_settings['enqueue_swiper_js'] : '';
$sptp_simplebar_js        = isset( $sptp_settings['enqueue_simplebar_js'] ) ? $sptp_settings['enqueue_simplebar_js'] : '';
$sptp_isotope_js          = isset( $sptp_settings['enqueue_isotope_js'] ) ? $sptp_settings['enqueue_isotope_js'] : '';
$sptp_fontawesome         = isset( $sptp_settings['enqueue_fontawesome'] ) ? $sptp_settings['enqueue_fontawesome'] : '';
$sptp_swiper_css          = isset( $sptp_settings['enqueue_swiper'] ) ? $sptp_settings['enqueue_swiper'] : true;
$sptp_custom_css          = isset( $sptp_settings['custom_css'] ) ? $sptp_settings['custom_css'] : '';
$sptp_custom_js           = isset( $sptp_settings['custom_js'] ) ? $sptp_settings['custom_js'] : '';
$sptp_link_mailto         = isset( $sptp_settings['link_mailto'] ) ? $sptp_settings['link_mailto'] : '';
$sptp_no_follow           = isset( $sptp_settings['no_follow'] ) ? $sptp_settings['no_follow'] : '';
$sptp_link_telephone      = isset( $sptp_settings['link_telephone'] ) ? $sptp_settings['link_telephone'] : '';
$sptp_link_css            = isset( $sptp_settings['link_css'] ) ? $sptp_settings['link_css'] : '';
$sptp_link_rel_attributes = isset( $sptp_settings['link_rel_attributes'] ) ? $sptp_settings['link_rel_attributes'] : '';

// layout settings.
$group_relation = isset( $layout['group_relation'] ) ? $layout['group_relation'] : '';
$layout_preset  = isset( $layout['layout_preset'] ) ? $layout['layout_preset'] : '';

// General settings.
if ( 'list' == $layout_preset ) {
	$desktop = isset( $settings['responsive_columns_list']['desktop'] ) ? $settings['responsive_columns_list']['desktop'] : '';
	$laptop  = isset( $settings['responsive_columns_list']['laptop'] ) ? $settings['responsive_columns_list']['laptop'] : '';
	$tablet  = isset( $settings['responsive_columns_list']['tablet'] ) ? $settings['responsive_columns_list']['tablet'] : '';
	$mobile  = isset( $settings['responsive_columns_list']['mobile'] ) ? $settings['responsive_columns_list']['mobile'] : '';
} else {
	$desktop = isset( $settings['responsive_columns']['desktop'] ) ? $settings['responsive_columns']['desktop'] : '';
	$laptop  = isset( $settings['responsive_columns']['laptop'] ) ? $settings['responsive_columns']['laptop'] : '';
	$tablet  = isset( $settings['responsive_columns']['tablet'] ) ? $settings['responsive_columns']['tablet'] : '';
	$mobile  = isset( $settings['responsive_columns']['mobile'] ) ? $settings['responsive_columns']['mobile'] : '';
}
$responsive_classes       = "sptp-col-lg-{$desktop} sptp-col-md-{$laptop} sptp-col-sm-{$tablet} sptp-col-xs-{$mobile}";
$filter_member_number     = isset( $settings['total_member_display'] ) && ! empty( $settings['total_member_display'] ) ? $settings['total_member_display'] : 12;
$max_group_member_display = isset( $settings['max_group_member_display'] ) ? $settings['max_group_member_display'] : -1;
$order_by                 = isset( $settings['order_by'] ) ? $settings['order_by'] : '';
$sptp_order               = isset( $settings['order'] ) ? $settings['order'] : '';
$sptp_member_order        = $sptp_order;
if ( 'menu_order' == $order_by ) {
	$sptp_member_order = 'ASC';
}
$filter_order = isset( $settings['filter_order'] ) ? $settings['filter_order'] : 'none';

$preloader = isset( $settings['preloader_switch'] ) ? $settings['preloader_switch'] : true;

// get members of this layout.
$filter_members = isset( $layout['filter_members'] ) ? $layout['filter_members'] : '';
if ( ! empty( $filter_members ) ) {
	switch ( $filter_members ) {
		case 'newest':
			$paged_var = 'paged' . $generator_id;

			$paged = ( ! empty( $_GET[ "$paged_var" ] ) ) ? $_GET[ "$paged_var" ] : 1;

			$latest_posts = get_posts(
				array(
					'post_type'      => 'sptp_member',
					'posts_per_page' => $filter_member_number,
					'orderby'        => $settings['order_by'],
					'order'          => 'ASC',
					'fields'         => 'ids',
				)
			);
			if ( 'ASC' == $settings['order'] ) {
				krsort( $latest_posts, SORT_STRING );
			}

			if ( 'carousel' === $layout['layout_preset'] || 'filter' === $layout['layout_preset'] ) {
				$sptp_newest_arg = array(
					'post_type'      => 'sptp_member',
					'posts_per_page' => $filter_member_number,
					'post__in'       => $latest_posts,
					'orderby'        => 'post__in',
				);
			} else {
				if ( $settings['pagination_fields']['universal_pagination_type'] == 'pagination_number' ) {
					$sptp_newest_arg = array(
						'post_type'      => 'sptp_member',
						'posts_per_page' => $filter_member_number,
						'post__in'       => $latest_posts,
						'orderby'        => 'post__in',
					);
				} elseif ( ( $settings['pagination_fields']['universal_pagination_type'] == 'pagination_normal' ) || ( $settings['pagination_fields']['universal_pagination_type'] == 'pagination_scrl' ) ) {
					$sptp_newest_arg = array(
						'post_type'      => 'sptp_member',
						'posts_per_page' => $settings['pagination_fields']['pagination_show_per_page'],
						'post__in'       => $latest_posts,
						'orderby'        => 'post__in',
						'paged'          => $paged,
					);
				} elseif ( $settings['pagination_fields']['universal_pagination_type'] == 'pagination_btn' ) {
					$sptp_newest_arg = array(
						'post_type'      => 'sptp_member',
						'posts_per_page' => $settings['pagination_fields']['pagination_per_click'],
						'post__in'       => $latest_posts,
						'orderby'        => 'post__in',
						'paged'          => $paged,
					);
				}
			}
			$filter_members_query = new WP_Query( $sptp_newest_arg );

			$filter_members = $filter_members_query->posts;
			break;
		case 'group':
			if ( ! empty( $layout['filter_group'] ) ) {
				if ( 'menu_order' === $settings['order_by'] ) {
					switch ( $group_relation ) {
						case 'in':
							$args           = array(
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
							$members        = new WP_Query( $args );
							$filter_members = $members->posts;
							break;
						case 'and':
							$args           = array(
								'post_type'      => 'sptp_member',
								'posts_per_page' => $filter_member_number,
								'tax_query'      => array(
									array(
										'taxonomy' => 'sptp_group',
										'field'    => 'term_id',
										'terms'    => $layout['filter_group'],
										'operator' => 'AND',
									),
								),
								'orderby'        => $settings['order_by'],
								'order'          => $sptp_member_order,
							);
							$members        = new WP_Query( $args );
							$filter_members = $members->posts;
							break;
						case 'not_in':
							$args           = array(
								'post_type'      => 'sptp_member',
								'posts_per_page' => $filter_member_number,
								'tax_query'      => array(
									array(
										'taxonomy' => 'sptp_group',
										'field'    => 'term_id',
										'terms'    => $layout['filter_group'],
										'operator' => 'NOT IN',
									),
								),
								'orderby'        => $settings['order_by'],
								'order'          => $sptp_member_order,
							);
							$members        = new WP_Query( $args );
							$filter_members = $members->posts;
							break;
					}
				} else {
					$args           = array(
						'post_type'      => 'sptp_member',
						'posts_per_page' => $filter_member_number,
						'tax_query'      => array(
							array(
								'taxonomy' => 'sptp_group',
								'field'    => 'term_id',
								'terms'    => $layout['filter_group'],
								'operator' => $layout['group_relation'],
							),
						),
						'orderby'        => $settings['order_by'],
						'order'          => $sptp_member_order,
					);
					$query          = new WP_Query( $args );
					$filter_members = $query->posts;
				}
			} else {
				$args           = array(
					'post_type'      => 'sptp_member',
					'posts_per_page' => $filter_member_number,
					'orderby'        => $settings['order_by'],
					'order'          => $sptp_member_order,
				);
				$query          = new WP_Query( $args );
				$filter_members = $query->posts;
			}
			break;
		case 'specific':
			$spacific_orderby      = ( 'menu_order' == $settings['order_by'] ? 'post__in' : $settings['order_by'] );
			$specific_members      = $layout['filter_specific'];
			$filter_specific_query = new WP_Query(
				array(
					'post_type' => 'sptp_member',
					'post__in'  => $specific_members,
					'orderby'   => $spacific_orderby,
					'order'     => $sptp_member_order,
				)
			);
				$filter_members    = $filter_specific_query->posts;
			break;
		case 'exclude':
			$exclude_members      = $layout['filter_exclude'];
			$filter_exclude_query = new WP_Query(
				array(
					'post_type'    => 'sptp_member',
					'post__not_in' => $exclude_members,
					'orderby'      => $settings['order_by'],
					'order'        => $sptp_member_order,
				)
			);
			$filter_members       = $filter_exclude_query->posts;
			break;
	};
}

// Filter settings.
$filter_type                      = isset( $settings['filter_type'] ) ? $settings['filter_type'] : '';
$filter_by                        = isset( $settings['filter_by'] ) ? $settings['filter_by'] : '';
$filter_search                    = isset( $settings['filter_search'] ) ? $settings['filter_search'] : '';
$filter_auto_sugg                 = ( $filter_search && isset( $settings['filter_auto_sugg'] ) ) ? true : '';
$filter_btn_colors                = isset( $settings['filter_btn_colors'] ) ? $settings['filter_btn_colors'] : '';
$filter_btn_color                 = ( ! empty( $filter_btn_colors ) && isset( $filter_btn_colors['color'] ) ) ? $filter_btn_colors['color'] : '';
$filter_btn_active_color          = ( ! empty( $filter_btn_colors ) && isset( $filter_btn_colors['active_color'] ) ) ? $filter_btn_colors['active_color'] : '';
$filter_btn_border                = ( ! empty( $filter_btn_colors ) && isset( $filter_btn_colors['border'] ) ) ? $filter_btn_colors['border'] : '';
$filter_btn_hover_border          = ( ! empty( $filter_btn_colors ) && isset( $filter_btn_colors['hover_border'] ) ) ? $filter_btn_colors['hover_border'] : '';
$filter_btn_bg_color              = ( ! empty( $filter_btn_colors ) && isset( $filter_btn_colors['bg_color'] ) ) ? $filter_btn_colors['bg_color'] : '';
$filter_btn_active_hover_bg_color = ( ! empty( $filter_btn_colors ) && isset( $filter_btn_colors['active_hover_bg_color'] ) ) ? $filter_btn_colors['active_hover_bg_color'] : '';
$filter_dropdown_align            = isset( $settings['filter_dropdown_align'] ) ? $settings['filter_dropdown_align'] : '';
$filter_dropdown_align_style      = ( 'left' == $filter_dropdown_align ) ? '0%' : '87%';
$filter_btn_align                 = isset( $settings['filter_btn_align'] ) ? $settings['filter_btn_align'] : '';
if ( 'right' === $filter_btn_align ) {
	$filter_btn_align = 'flex-end';
}
$filter_all_btn_switch           = isset( $settings['filter_all_btn_switch'] ) ? $settings['filter_all_btn_switch'] : '';
$filter_all_btn_text             = ( isset( $settings['filter_all_btn_text'] ) && $filter_all_btn_switch ) ? $settings['filter_all_btn_text'] : '';
$filter_pagination               = isset( $settings['filter_pagination'] ) ? $settings['filter_pagination'] : false;
$filter_load_more_btn_text       = isset( $settings['filter_load_more_btn_text'] ) ? $settings['filter_load_more_btn_text'] : '';
$filter_pagination_show_per_page = isset( $settings['filter_pagination_show_per_page'] ) ? $settings['filter_pagination_show_per_page'] : '';
$filter_pagination_per_click     = isset( $settings['filter_pagination_per_click'] ) ? $settings['filter_pagination_per_click'] : '';

// Carousel settings.
$carousel_mode     = isset( $settings['carousel_mode'] ) ? $settings['carousel_mode'] : 'standard';
$carousel_items    = isset( $settings['responsive_columns']['desktop'] ) ? min( $settings['responsive_columns']['desktop'], count( $filter_members ) ) : '';
$carousel_speed    = isset( $settings['carousel_speed'] ) ? $settings['carousel_speed'] : 300;
$carousel_autoplay = ( isset( $settings['carousel_autoplay'] ) && $settings['carousel_autoplay'] ) ? 'true' : 'false';
$autoplay_speed    = ( isset( $settings['carousel_autoplay_speed'] ) && $settings['carousel_autoplay_speed'] && ( 'true' === $carousel_autoplay ) ) ? $settings['carousel_autoplay_speed'] : 5000;

$navigation_position   = isset( $settings['carousel_navigation_position'] ) ? $settings['carousel_navigation_position'] : 'top-right';
$navigation_color      = isset( $settings['carousel_navigation_color'] ) ? $settings['carousel_navigation_color'] : false;
$navigation_border     = isset( $settings['carousel_navigation_border'] ) ? $settings['carousel_navigation_border'] : false;
$navigation_border_css = isset( $settings['carousel_navigation_border'] ) ? $navigation_border['all'] . 'px ' . $navigation_border['style'] . ' ' . $navigation_border['color'] : '';

$pagination_color = isset( $settings['carousel_pagination_color'] ) ? $settings['carousel_pagination_color'] : false;

$loop         = ( isset( $settings['carousel_loop'] ) && $settings['carousel_loop'] ) ? 'true' : 'false';
$auto_height  = ( isset( $settings['carousel_auto_height'] ) && $settings['carousel_auto_height'] ) ? 'true' : 'false';
$lazy_load    = ( isset( $settings['carousel_lazy_load'] ) && $settings['carousel_lazy_load'] ) ? 'true' : 'false';
$stop_onhover = ( isset( $settings['carousel_onhover'] ) && $settings['carousel_onhover'] ) ? 'true' : 'false';

// Display settings.
$section_title               = isset( $settings['style_title'] ) ? $settings['style_title'] : true;
$section_title_margin_bottom = isset( $settings['style_title_margin_bottom']['bottom'] ) && ! empty( $settings['style_title_margin_bottom']['bottom'] ) ? $settings['style_title_margin_bottom']['bottom'] . 'px' : '0px';
$margin_between_member       = isset( $settings['style_margin_between_member'] ) ? intval( $settings['style_margin_between_member']['all'] ) : 0;

if ( 'list' === $layout_preset ) {
	$position = isset( $settings['style_member_content_position_list'] ) ? $settings['style_member_content_position_list'] : '';
} else {
	$position = isset( $settings['style_member_content_position'] ) ? $settings['style_member_content_position'] : '';
}
switch ( $position ) {
	case 'top_img_bottom_content':
		$position_class = '';
		break;
	case 'left_img_right_content':
		$position_class = 'sptp-list-item';
		break;
	case 'left_content_right_img':
		$position_class = 'sptp-list-item sptp-left-content';
		break;
	case 'top_content_bottom_img':
		$position_class = 'sptp-top-content';
		break;
	case 'content_over_image':
		$position_class = 'sptp-content-on-image';
		break;
}
$border_bg_around_member       = isset( $settings['border_bg_around_member'] ) ? intval( $settings['border_bg_around_member'] ) : '';
$border_bg_around_member_class = ( $border_bg_around_member ) ? 'border-bg-around-member' : '';

if ( 'inline' === $layout_preset ) {
	$border_around_member = isset( $settings['border_bg_around_member']['border_around_member_inline'] ) ? $settings['border_bg_around_member']['border_around_member_inline'] : '';
} else {
	$border_around_member = isset( $settings['border_bg_around_member']['border_around_member'] ) ? $settings['border_bg_around_member']['border_around_member'] : '';
}
$border_around_member_width  = ( ! empty( $border_around_member['all'] ) && ( $border_around_member['all'] > 0 ) ) ? intval( $border_around_member['all'] ) : 0;
$navigation_position_right   = ( $border_around_member_width == 0 ) ? 3 : ( ( $border_around_member_width == 1 ) ? 2 : ( ( $border_around_member_width == 2 ) ? 1 : 0 ) );
$border_around_member_style  = isset( $border_around_member['style'] ) ? $border_around_member['style'] : 'none';
$border_around_member_color  = isset( $border_around_member['color'] ) ? $border_around_member['color'] : 'transparent';
$border_around_member_hover  = isset( $border_around_member['hover_color'] ) ? $border_around_member['hover_color'] : '#FFFFFF';
$border_around_member_border = ( ( 'inline' !== $layout_preset ) ) ? $border_around_member_width . 'px ' . $border_around_member_style . ' ' . $border_around_member_color : '1px solid #88888824';
$border_radius_around_member = isset( $settings['border_bg_around_member']['border_radius_around_member'] ) ? $settings['border_bg_around_member']['border_radius_around_member'] . 'px' : 0;
$background_around_member    = isset( $settings['border_bg_around_member']['bg_color_around_member'] ) ? $settings['border_bg_around_member']['bg_color_around_member'] : 'transparent';
$member_content_padding      = isset( $settings['member_content_padding'] ) ? $settings['member_content_padding'] : '';

$overlay_on_image                   = ( ( 'content_over_image' == $position ) && isset( $settings['overlay_on_image'] ) ) ? $settings['overlay_on_image'] : false;
$overlay_on_image_class             = ( $overlay_on_image ) ? 'overlay_on_image' : '';
$overlay_content_type               = ( ( 'content_over_image' == $position ) && isset( $settings['overlay_content_type'] ) ) ? $settings['overlay_content_type'] : '';
$overlay_bg_color_covered           = ( ( 'content_over_image' == $position ) && isset( $settings['overlay_bg_color'] ) && ( 'covered' === $overlay_content_type ) ) ? $settings['overlay_bg_color'] : '';
$overlay_bg_color_content           = ( ( 'content_over_image' == $position ) && isset( $settings['overlay_bg_color'] ) && ( 'lower' === $overlay_content_type ) ) ? $settings['overlay_bg_color'] : '';
$overlay_content_visibility         = ( ( 'content_over_image' == $position ) && isset( $settings['overlay_content_visibility'] ) ) ? $settings['overlay_content_visibility'] : '';
$overlay_content_visibility_class   = ( 'always' == $overlay_content_visibility ) ? 'overlay-always' : ( ( 'hover' == $overlay_content_visibility ) ? 'overlay-hover' : '' );
$overlay_content_position           = ( ( 'content_over_image' == $position ) && isset( $settings['overlay_content_position'] ) ) ? $settings['overlay_content_position'] : '';
$overlay_clickable                  = ( ( 'content_over_image' == $position ) && isset( $settings['overlay_clickable'] ) ) ? $settings['overlay_clickable'] : true;
$overlay_clickable_class            = ( $overlay_clickable ) ? 'clickable' : 'not-clickable';
$disable_overlay_small_screen       = ( ( 'content_over_image' == $position ) && isset( $settings['disable_overlay_small_screen'] ) ) ? $settings['disable_overlay_small_screen'] : '';
$disable_overlay_small_screen_class = ( $disable_overlay_small_screen ) ? 'disable_overlay_small_screen' : '';
$image_animation                    = ( ( 'content_over_image' == $position ) && ( 'hover' === $overlay_content_visibility ) && isset( $settings['image_animation'] ) ) ? $settings['image_animation'] : '';
$image_animation_css                = ( $image_animation ) ? $image_animation . ' delay-1s' : '';

$sptp_order_array = array();
$sptp_order       = 1;
$style_members    = isset( $settings['style_members'] ) ? $settings['style_members'] : '';
if ( ! empty( $style_members ) ) {
	foreach ( $style_members as $key => $value ) {
		$sptp_order_array[ $key ] = $sptp_order;
		$sptp_order++;
	}
}
$name_switch     = isset( $style_members['name_switch'] ) ? $style_members['name_switch'] : true;
$position_switch = isset( $style_members['job_position_switch'] ) ? $style_members['job_position_switch'] : true;
if ( 'mosaic' === $layout_preset ) {
	$bio_switch = isset( $style_members['bio_switch_mosaic'] ) ? $style_members['bio_switch_mosaic'] : false;
} else {
	$bio_switch = isset( $style_members['bio_switch'] ) ? $style_members['bio_switch'] : true;
}
$email_switch    = isset( $style_members['email_switch'] ) ? $style_members['email_switch'] : false;
$mobile_switch   = isset( $style_members['mobile_switch'] ) ? $style_members['mobile_switch'] : false;
$phone_switch    = isset( $style_members['phone_switch'] ) ? $style_members['phone_switch'] : false;
$location_switch = isset( $style_members['location_switch'] ) ? $style_members['location_switch'] : false;
$website_switch  = isset( $style_members['website_switch'] ) ? $style_members['website_switch'] : false;
$skill_switch    = isset( $style_members['skill_switch'] ) ? $style_members['skill_switch'] : false;

$icon_over_img             = isset( $settings['icon_over_img'] ) ? $settings['icon_over_img'] : '';
$icon_over_img_class       = ( $icon_over_img ) ? 'sptp-icon-on-image' : '';
$icon_over_img_type        = isset( $settings['icon_over_img_type'] ) ? $settings['icon_over_img_type'] : '';
$icon_over_img_color_array = isset( $settings['icon_over_img_color'] ) ? $settings['icon_over_img_color'] : '';
$icon_over_img_color       = ( ! empty( $icon_over_img_color_array['color'] ) ) ? $icon_over_img_color_array['color'] : '';
$icon_over_img_hover_color = ( ! empty( $icon_over_img_color_array['hove_color'] ) ) ? $icon_over_img_color_array['hove_color'] : '#ffffff';
$icon_over_img_bg_color    = ( ! empty( $settings['icon_over_img_bg_color'] ) ) ? $settings['icon_over_img_bg_color'] : '';

$description_character_limit = isset( $settings['style_description_character_limit'] ) ? $settings['style_description_character_limit'] : '';
$mosaic_bg_color             = isset( $settings['mosaic_bg_color'] ) ? $settings['mosaic_bg_color'] : '#63a37b';
$small_icon                  = isset( $settings['icon_switch'] ) ? $settings['icon_switch'] : '';
$social_settings             = isset( $settings['social_settings'] ) ? $settings['social_settings'] : '';
$social_position             = isset( $social_settings['social_position'] ) ? $social_settings['social_position'] : '';

$social_margin      = isset( $social_settings['social_margin'] ) ? $social_settings['social_margin'] : '';
$social_margin_css  = '';
$social_margin_css .= ( ! empty( $social_margin['top'] ) ) ? $social_margin['top'] . 'px ' : ' 0 ';
$social_margin_css .= ( ! empty( $social_margin['right'] ) ) ? $social_margin['right'] . 'px ' : ' 0 ';
$social_margin_css .= ( ! empty( $social_margin['bottom'] ) ) ? $social_margin['bottom'] . 'px ' : ' 0 ';
$social_margin_css .= ( ! empty( $social_margin['left'] ) ) ? $social_margin['left'] . 'px ' : ' 0 ';

$social_icon_shape        = isset( $social_settings['social_icon_shape'] ) ? $social_settings['social_icon_shape'] : '';
$social_icon_custom_color = isset( $social_settings['social_icon_custom_color'] ) ? $social_settings['social_icon_custom_color'] : '';

$social_icon_color       = ! empty( $social_icon_custom_color ) && isset( $social_settings['icon_color_group'] ) ? $social_settings['icon_color_group'] : '';
$social_icon_main_color  = isset( $social_icon_color['icon_color'] ) ? $social_icon_color['icon_color'] : '';
$social_icon_hover_color = isset( $social_icon_color['icon_hover_color'] ) ? $social_icon_color['icon_hover_color'] : '';

$social_icon_bg_color       = ! empty( $social_icon_custom_color ) && isset( $social_settings['icon_bg_color_group'] ) ? $social_settings['icon_bg_color_group'] : '';
$social_icon_bg_main_color  = isset( $social_icon_bg_color['icon_bg'] ) ? $social_icon_bg_color['icon_bg'] : '';
$social_icon_bg_hover_color = isset( $social_icon_bg_color['icon_bg_hover'] ) ? $social_icon_bg_color['icon_bg_hover'] : '';

$social_icon_border       = ! empty( $social_icon_custom_color ) && isset( $social_settings['icon_border'] ) ? $social_settings['icon_border'] : '';
$social_icon_border_main  = '';
$social_icon_border_main .= ( ! empty( $social_icon_border['all'] ) ) ? $social_icon_border['all'] . 'px' : ' 0 ';
$social_icon_border_main .= ( ! empty( $social_icon_border['style'] ) ) ? ' ' . $social_icon_border['style'] : '';
$social_icon_border_main .= ( ! empty( $social_icon_border['color'] ) ) ? ' ' . $social_icon_border['color'] : '';
$social_icon_border_hover = ( ! empty( $social_icon_border['hover_color'] ) ) ? $social_icon_border['hover_color'] : '';

$skillbar_settings = isset( $settings['skill_settings'] ) ? $settings['skill_settings'] : '';

$skillbar_progressbar_color_group = ! empty( $skillbar_settings ) && isset( $skillbar_settings['progressbar_color_group'] ) ? $skillbar_settings['progressbar_color_group'] : '';
$skillbar_progressbar_color       = ! empty( $skillbar_progressbar_color_group ) && isset( $skillbar_progressbar_color_group['progress_color'] ) ? $skillbar_progressbar_color_group['progress_color'] : '';
$skillbar_progressbar_bg_color    = ! empty( $skillbar_progressbar_color_group ) && isset( $skillbar_progressbar_color_group['progress_bg_color'] ) ? $skillbar_progressbar_color_group['progress_bg_color'] : '';

$skillbar_tooltip_color_group = ! empty( $skillbar_settings ) && isset( $skillbar_settings['tooltip_color_group'] ) ? $skillbar_settings['tooltip_color_group'] : '';
$skillbar_tooltip_color       = ! empty( $skillbar_tooltip_color_group ) && isset( $skillbar_tooltip_color_group['progress_tooltip_color'] ) ? $skillbar_tooltip_color_group['progress_tooltip_color'] : '';
$skillbar_tooltip_bg_color    = ! empty( $skillbar_tooltip_color_group ) && isset( $skillbar_tooltip_color_group['progress_tooltip_bg_color'] ) ? $skillbar_tooltip_color_group['progress_tooltip_bg_color'] : '';

$pagination           = isset( $settings['pagination_fields']['pagination_universal'] ) ? $settings['pagination_fields']['pagination_universal'] : true;
$pagination_type      = isset( $settings['pagination_fields']['universal_pagination_type'] ) ? $settings['pagination_fields']['universal_pagination_type'] : '';
$pagination_btn_color = isset( $settings['pagination_fields']['pagination_color'] ) ? $settings['pagination_fields']['pagination_color'] : '';

$show_per_page          = isset( $settings['pagination_fields']['pagination_show_per_page'] ) ? $settings['pagination_fields']['pagination_show_per_page'] : '';
$show_dynamic_flex_wrap = ( ! empty( $filter_members ) && count( $filter_members ) > $show_per_page ) ? 'nowrap' : 'wrap';
$show_per_click         = isset( $settings['pagination_fields']['pagination_per_click'] ) ? $settings['pagination_fields']['pagination_per_click'] : '';
if ( 'pagination_btn' == $pagination_type ) {
	$total_page = ( ! empty( $filter_members ) && $show_per_page > 0 ) ? ceil( count( $filter_members ) / $show_per_click ) : '';
} else {
	$total_page = ( ! empty( $filter_members ) && $show_per_page > 0 ) ? ceil( count( $filter_members ) / $show_per_page ) : '';
}
$load_more_label        = isset( $settings['pagination_fields']['load_more_label'] ) ? $settings['pagination_fields']['load_more_label'] : __( 'Load more', 'wp-team-pro' );
$scroll_load_more_label = isset( $settings['pagination_fields']['scroll_load_more_label'] ) ? $settings['pagination_fields']['scroll_load_more_label'] : __( 'Scroll to Load more', 'wp-team-pro' );

// Image settings.
$image_on_off = isset( $settings['image_on_off'] ) ? $settings['image_on_off'] : '';
if ( 'thumbnail-pager' === $layout_preset ) {
	$image_shape = isset( $settings['image_shape_thumbnail'] ) ? $settings['image_shape_thumbnail'] : '';
} else {
	$image_shape = isset( $settings['image_shape'] ) ? $settings['image_shape'] : '';
}
if ( 'table' === $layout_preset ) {
	$image_size  = isset( $settings['image_size_table'] ) ? $settings['image_size_table'] : 'thumbnail';
	$custom_size = ( $image_size == 'custom' && isset( $settings['custom_image_option_table'] ) ) ? $settings['custom_image_option_table'] : '';
} else {
	$image_size  = isset( $settings['image_size'] ) ? $settings['image_size'] : '';
	$custom_size = ( $image_size == 'custom' && isset( $settings['custom_image_option'] ) ) ? $settings['custom_image_option'] : '';
}
$custom_image_width  = isset( $custom_size['custom_image_width'] ) ? $custom_size['custom_image_width'] : '';
$custom_image_height = isset( $custom_size['custom_image_height'] ) ? $custom_size['custom_image_height'] : '';
$custom_image_crop   = isset( $custom_size['custom_image_crop'] ) ? $custom_size['custom_image_crop'] : '';
$custom_size_name    = isset( $custom_size ) ? "$generator_id" . '-sptp-custom' : '';
$image_border        = isset( $settings['image_border'] ) ? $settings['image_border'] : '';
if ( $image_border ) {
	$border  = '';
	$border .= ( $settings['border']['all'] > 0 ) ? $settings['border']['all'] . 'px ' : '0px ';
	$border .= ( '' !== $settings['border']['style'] ) ? $settings['border']['style'] . ' ' : ' ';
	$border .= ( '' !== $settings['border']['color'] ) ? $settings['border']['color'] : ' ';
} else {
	$border = 'none';
}
$border_hover = $image_border && isset( $settings['border']['hover_color'] ) ? $settings['border']['hover_color'] : 'inherit';

$image_box_shadow = isset( $settings['image_box_shadow'] ) ? $settings['image_box_shadow'] : '';
if ( $image_box_shadow ) {
	$image_box  = '';
	$image_box .= ( $settings['box']['vertical'] >= 0 ) ? $settings['box']['vertical'] . 'px ' : ' ';
	$image_box .= ( $settings['box']['horizontal'] >= 0 ) ? $settings['box']['horizontal'] . 'px ' : ' ';
	$image_box .= ( $settings['box']['blur'] >= 0 ) ? $settings['box']['blur'] . 'px ' : ' ';
	$image_box .= ( $settings['box']['spread'] >= 0 ) ? $settings['box']['spread'] . 'px ' : ' ';
	$image_box .= ( '' !== $settings['box']['color'] ) ? $settings['box']['color'] . ' ' : ' ';
	$image_box .= ( 'outset' !== $settings['box']['style'] ) ? $settings['box']['style'] : ' ';
} else {
	$image_box = 'none';
}

$image_grayscale = isset( $settings['image_grayscale'] ) ? $settings['image_grayscale'] : 'none';
switch ( $image_grayscale ) {
	case 'normal_on_hover':
		$image_grayscale_normal = 'grayscale(100%)';
		$image_grayscale_hover  = 'grayscale(0)';
		break;
	case 'on_hover':
		$image_grayscale_normal = 'grayscale(0)';
		$image_grayscale_hover  = 'grayscale(100%)';
		break;
	case 'always':
		$image_grayscale_normal = 'grayscale(100%)';
		$image_grayscale_hover  = 'grayscale(100%)';
		break;
	case 'none':
		$image_grayscale_normal = 'grayscale(0)';
		$image_grayscale_hover  = 'grayscale(0)';
		break;
}
$image_zoom = isset( $settings['image_zoom'] ) ? $settings['image_zoom'] : '';

$image_bg            = ( ( ! empty( $filter_members ) ) && isset( $settings['background'] ) ) ? $settings['background'] : '';
$image_padding       = isset( $settings['padding'] ) ? $settings['padding'] : '';
$image_inner_padding = isset( $settings['inner_padding'] ) ? $settings['inner_padding'] : '';
if ( $image_padding ) {
	$image_padding_css  = '';
	$image_padding_css .= ( ! empty( $image_padding['top'] ) && ( $image_padding['top'] >= 0 ) ) ? $image_padding['top'] . 'px ' : '0 ';
	$image_padding_css .= ( ! empty( $image_padding['right'] ) && ( $image_padding['right'] >= 0 ) ) ? $image_padding['right'] . 'px ' : '0 ';
	$image_padding_css .= ( ! empty( $image_padding['bottom'] ) && ( $image_padding['bottom'] >= 0 ) ) ? $image_padding['bottom'] . 'px ' : '0 ';
	$image_padding_css .= ( ! empty( $image_padding['left'] ) && ( $image_padding['left'] >= 0 ) ) ? $image_padding['left'] . 'px ' : '0 ';
} else {
	$image_padding_css = 'inherit';
}
if ( $image_inner_padding ) {
	$image_inner_padding_css  = '';
	$image_inner_padding_css .= ( ! empty( $image_inner_padding['top'] ) && ( $image_inner_padding['top'] >= 0 ) ) ? $image_inner_padding['top'] . 'px ' : '0 ';
	$image_inner_padding_css .= ( ! empty( $image_inner_padding['right'] ) && ( $image_inner_padding['right'] >= 0 ) ) ? $image_inner_padding['right'] . 'px ' : '0 ';
	$image_inner_padding_css .= ( ! empty( $image_inner_padding['bottom'] ) && ( $image_inner_padding['bottom'] >= 0 ) ) ? $image_inner_padding['bottom'] . 'px ' : '0 ';
	$image_inner_padding_css .= ( ! empty( $image_inner_padding['left'] ) && ( $image_inner_padding['left'] >= 0 ) ) ? $image_inner_padding['left'] . 'px ' : '0 ';
} else {
	$image_inner_padding_css = 'inherit';
}

$page_link_type = ( isset( $settings['link_detail_fields']['page_link_type'] ) && $settings['link_detail'] ) ? $settings['link_detail_fields']['page_link_type'] : '';
if ( 'content_over_image' === $position && '0' === $overlay_clickable ) {
	$page_link_type = '';
}
$modal_layout = ( ( 'modal' === $page_link_type ) && ! empty( $settings['link_detail_fields']['modal_layout'] ) ) ? $settings['link_detail_fields']['modal_layout'] : '';
switch ( $modal_layout ) {
	case 'modal-classic':
		$modal_layout_class = 'style-1';
		break;
	case 'modal-left':
		$modal_layout_class = 'style-3';
		break;
	case 'modal-center':
		$modal_layout_class = 'style-4';
		break;
	case 'modal-right':
		$modal_layout_class = 'style-2';
		break;
}
$modal_type = isset( $settings['link_detail_fields']['modal_type'] ) ? $settings['link_detail_fields']['modal_type'] : '';

$modal_background_color = isset( $settings['link_detail_fields']['modal_background'] ) ? $settings['link_detail_fields']['modal_background'] : '';
$modal_z_index          = isset( $settings['link_detail_fields']['modal_z_index'] ) ? $settings['link_detail_fields']['modal_z_index'] : '';

$new_page_target    = isset( $settings['link_detail_fields']['page_link_open'] ) ? $settings['link_detail_fields']['page_link_open'] : '';
$link_detail_fields = ! empty( $settings['link_detail_fields'] ) ? $settings['link_detail_fields'] : '';
$detail_page_fields = ! empty( $link_detail_fields['detail_page_fields'] ) ? $link_detail_fields['detail_page_fields'] : '';

// Typography settings.
$team_title_font_load      = isset( $settings['team_title_font_load'] ) ? $settings['team_title_font_load'] : true;
$team_title                = isset( $settings['typo_team_title'] ) ? $settings['typo_team_title'] : '';
$team_title_font_type      = isset( $team_title['type'] ) ? $team_title['type'] : '';
$team_title_font_family    = isset( $team_title['font-family'] ) && $team_title['font-family'] ? $team_title['font-family'] : 'Open Sans';
$team_title_font_style     = isset( $team_title['font-style'] ) && $team_title['font-style'] ? $team_title['font-style'] : 'normal';
$team_title_font_weight    = isset( $team_title['font-weight'] ) && $team_title['font-weight'] ? $team_title['font-weight'] : 400;
$team_title_font_size      = isset( $team_title['font-size'] ) && $team_title['font-size'] ? $team_title['font-size'] . 'px' : 0;
$team_title_line_height    = isset( $team_title['line-height'] ) && $team_title['line-height'] ? $team_title['line-height'] . 'px' : '1';
$team_title_alignment      = isset( $team_title['text-align'] ) && $team_title['text-align'] ? $team_title['text-align'] : 'left';
$team_title_transform      = isset( $team_title['text-transform'] ) ? $team_title['text-transform'] : 'none';
$team_title_letter_spacing = isset( $team_title['letter-spacing'] ) ? $team_title['letter-spacing'] : 'normal';
$team_title_color          = isset( $team_title['color'] ) ? $team_title['color'] : '';
$team_title_margin_top     = isset( $team_title['margin-top'] ) ? $team_title['margin-top'] : '';
$team_title_margin_bottom  = isset( $team_title['margin-bottom'] ) ? $team_title['margin-bottom'] : '';

$member_name_font_load      = isset( $settings['member_name_font_load'] ) ? $settings['member_name_font_load'] : true;
$member_name                = isset( $settings['typo_member_name'] ) ? $settings['typo_member_name'] : '';
$member_name_font_type      = isset( $member_name['type'] ) ? $member_name['type'] : '';
$member_name_font_family    = isset( $member_name['font-family'] ) && $member_name['font-family'] ? $member_name['font-family'] : 'Open Sans';
$member_name_font_style     = isset( $member_name['font-style'] ) && $member_name['font-style'] ? $member_name['font-style'] : 'normal';
$member_name_font_weight    = isset( $member_name['font-weight'] ) && $member_name['font-weight'] ? $member_name['font-weight'] : 400;
$member_name_font_size      = isset( $member_name['font-size'] ) && $member_name['font-size'] ? $member_name['font-size'] : 0;
$member_name_line_height    = isset( $member_name['line-height'] ) && $member_name['line-height'] ? $member_name['line-height'] . 'px' : '1';
$member_name_alignment      = isset( $member_name['text-align'] ) && $member_name['text-align'] ? $member_name['text-align'] : 'center';
$member_name_transform      = isset( $member_name['text-transform'] ) && $member_name['text-transform'] ? $member_name['text-transform'] : 'none';
$member_name_letter_spacing = isset( $member_name['letter-spacing'] ) ? $member_name['letter-spacing'] : 'normal';
$member_name_color          = isset( $member_name['color'] ) ? $member_name['color'] : '';
$member_name_margin_top     = isset( $member_name['margin-top'] ) && $member_name['margin-top'] ? $member_name['margin-top'] : 0;
$member_name_margin_bottom  = isset( $member_name['margin-bottom'] ) && $member_name['margin-bottom'] ? $member_name['margin-bottom'] : 0;

$member_position_font_load      = isset( $settings['member_position_font_load'] ) ? $settings['member_position_font_load'] : true;
$member_position                = isset( $settings['typo_member_position'] ) ? $settings['typo_member_position'] : true;
$member_position_font_type      = isset( $member_position['type'] ) ? $member_position['type'] : '';
$member_position_font_family    = isset( $member_position['font-family'] ) && $member_position['font-family'] ? $member_position['font-family'] : '';
$member_position_font_style     = isset( $member_position['font-style'] ) && $member_position['font-style'] ? $member_position['font-style'] : 'normal';
$member_position_font_weight    = isset( $member_position['font-weight'] ) && $member_position['font-weight'] ? $member_position['font-weight'] : 400;
$member_position_font_size      = isset( $member_position['font-size'] ) && $member_position['font-size'] ? $member_position['font-size'] : 0;
$member_position_line_height    = isset( $member_position['line-height'] ) && $member_position['line-height'] ? $member_position['line-height'] . 'px' : '1';
$member_position_alignment      = isset( $member_position['text-align'] ) && $member_position['text-align'] ? $member_position['text-align'] : 'center';
$member_position_transform      = isset( $member_position['text-transform'] ) && $member_position['text-transform'] ? $member_position['text-transform'] : 'none';
$member_position_letter_spacing = isset( $member_position['letter-spacing'] ) ? $member_position['letter-spacing'] : 'normal';
$member_position_color          = isset( $member_position['color'] ) ? $member_position['color'] : '';
$member_position_margin_top     = isset( $member_position['margin-top'] ) && $member_position['margin-top'] ? $member_position['margin-top'] : 0;
$member_position_margin_bottom  = isset( $member_position['margin-bottom'] ) && $member_position['margin-bottom'] ? $member_position['margin-bottom'] : 0;

$member_description_font_load      = isset( $settings['member_description_font_load'] ) ? $settings['member_description_font_load'] : true;
$member_description                = isset( $settings['typo_desc_bio'] ) ? $settings['typo_desc_bio'] : true;
$member_description_font_type      = isset( $member_description['type'] ) ? $member_description['type'] : '';
$member_description_font_family    = isset( $member_description['font-family'] ) && $member_description['font-family'] ? $member_description['font-family'] : 'Open Sans';
$member_description_font_style     = isset( $member_description['font-style'] ) && $member_description['font-style'] ? $member_description['font-style'] : 'normal';
$member_description_font_weight    = isset( $member_description['font-weight'] ) && $member_description['font-weight'] ? $member_description['font-weight'] : 400;
$member_description_font_size      = isset( $member_description['font-size'] ) && $member_description['font-size'] ? $member_description['font-size'] : 0;
$member_description_line_height    = isset( $member_description['line-height'] ) && $member_description['line-height'] ? $member_description['line-height'] . 'px' : '1';
$member_description_alignment      = isset( $member_description['text-align'] ) && $member_description['text-align'] ? $member_description['text-align'] : 'center';
$member_description_transform      = isset( $member_description['text-transform'] ) && $member_description['text-transform'] ? $member_description['text-transform'] : 'none';
$member_description_letter_spacing = isset( $member_description['letter-spacing'] ) ? $member_description['letter-spacing'] : 'normal';
$member_description_color          = isset( $member_description['color'] ) ? $member_description['color'] : '';
$member_description_margin_top     = isset( $member_description['margin-top'] ) && $member_description['margin-top'] ? $member_description['margin-top'] : 0;
$member_description_margin_bottom  = isset( $member_description['margin-bottom'] ) && $member_description['margin-bottom'] ? $member_description['margin-bottom'] : 0;

$member_information_font_load      = isset( $settings['member_details_font_load'] ) ? $settings['member_details_font_load'] : true;
$member_information                = isset( $settings['additional_info'] ) ? $settings['additional_info'] : true;
$member_information_font_type      = isset( $member_information['type'] ) ? $member_information['type'] : '';
$member_information_font_family    = isset( $member_information['font-family'] ) && $member_information['font-family'] ? $member_information['font-family'] : 'Open Sans';
$member_information_font_style     = isset( $member_information['font-style'] ) && $member_information['font-style'] ? $member_information['font-style'] : 'normal';
$member_information_font_weight    = isset( $member_information['font-weight'] ) && $member_information['font-weight'] ? $member_information['font-weight'] : 400;
$member_information_font_size      = isset( $member_information['font-size'] ) && $member_information['font-size'] ? $member_information['font-size'] : 0;
$member_information_line_height    = isset( $member_information['line-height'] ) && $member_information['line-height'] ? $member_information['line-height'] . 'px' : '1';
$member_information_alignment      = isset( $member_information['text-align'] ) && $member_information['text-align'] ? $member_information['text-align'] : 'center';
$member_information_transform      = isset( $member_information['text-transform'] ) && $member_information['text-transform'] ? $member_information['text-transform'] : 'none';
$member_information_letter_spacing = isset( $member_information['letter-spacing'] ) ? $member_information['letter-spacing'] : 'normal';
$member_information_color          = isset( $member_information['color'] ) ? $member_information['color'] : '';
$member_information_margin_top     = isset( $member_information['margin-top'] ) && $member_information['margin-top'] ? $member_information['margin-top'] : 0;
$member_information_margin_bottom  = isset( $member_information['margin-bottom'] ) && $member_information['margin-bottom'] ? $member_information['margin-bottom'] : 0;

$member_skills_font_load      = isset( $settings['member_skills_font_load'] ) ? $settings['member_skills_font_load'] : true;
$member_skills                = isset( $settings['typo_skills'] ) ? $settings['typo_skills'] : true;
$member_skills_font_type      = isset( $member_skills['type'] ) ? $member_skills['type'] : '';
$member_skills_font_family    = isset( $member_skills['font-family'] ) && $member_skills['font-family'] ? $member_skills['font-family'] : 'Open Sans';
$member_skills_font_style     = isset( $member_skills['font-style'] ) && $member_skills['font-style'] ? $member_skills['font-style'] : 'normal';
$member_skills_font_weight    = isset( $member_skills['font-weight'] ) && $member_skills['font-weight'] ? $member_skills['font-weight'] : 400;
$member_skills_font_size      = isset( $member_skills['font-size'] ) && $member_skills['font-size'] ? $member_skills['font-size'] : 0;
$member_skills_line_height    = isset( $member_skills['line-height'] ) && $member_skills['line-height'] ? $member_skills['line-height'] . 'px' : '1';
$member_skills_alignment      = isset( $member_skills['text-align'] ) && $member_skills['text-align'] ? $member_skills['text-align'] : 'left';
$member_skills_transform      = isset( $member_skills['text-transform'] ) && $member_skills['text-transform'] ? $member_skills['text-transform'] : 'none';
$member_skills_letter_spacing = isset( $member_skills['letter-spacing'] ) ? $member_skills['letter-spacing'] : 'normal';
$member_skills_color          = isset( $member_skills['color'] ) ? $member_skills['color'] : '';
$member_skills_margin_top     = isset( $member_skills['margin-top'] ) && $member_skills['margin-top'] ? $member_skills['margin-top'] : 0;
$member_skills_margin_bottom  = isset( $member_skills['margin-bottom'] ) && $member_skills['margin-bottom'] ? $member_skills['margin-bottom'] : 0;
