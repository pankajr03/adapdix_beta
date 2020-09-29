<?php
/**
 * All settings of WP_Team.
 *
 * @package WP_Team
 * @since 2.0.0
 */

// Main settings.
$sptp_settings            = get_option( '_sptp_settings' );
$sptp_google_fonts        = isset( $sptp_settings['enqueue_google_font'] ) ? $sptp_settings['enqueue_google_font'] : true;
$sptp_swiper_js           = isset( $sptp_settings['enqueue_swiper_js'] ) ? $sptp_settings['enqueue_swiper_js'] : true;
$sptp_fontawesome         = isset( $sptp_settings['enqueue_fontawesome'] ) ? $sptp_settings['enqueue_fontawesome'] : true;
$sptp_swiper_css          = isset( $sptp_settings['enqueue_swiper'] ) ? $sptp_settings['enqueue_swiper'] : true;
$sptp_custom_css          = isset( $sptp_settings['custom_css'] ) ? $sptp_settings['custom_css'] : '';
$sptp_custom_js           = isset( $sptp_settings['custom_js'] ) ? $sptp_settings['custom_js'] : '';
$sptp_link_mailto         = isset( $sptp_settings['link_mailto'] ) ? $sptp_settings['link_mailto'] : true;
$sptp_no_follow           = isset( $sptp_settings['no_follow'] ) ? $sptp_settings['no_follow'] : '';
$sptp_link_telephone      = isset( $sptp_settings['link_telephone'] ) ? $sptp_settings['link_telephone'] : true;
$sptp_link_css            = isset( $sptp_settings['link_css'] ) ? $sptp_settings['link_css'] : '';
$sptp_link_rel_attributes = isset( $sptp_settings['link_rel_attributes'] ) ? $sptp_settings['link_rel_attributes'] : '';

// layout settings.
$group_relation = isset( $layout['group_relation'] ) ? $layout['group_relation'] : '';

// General settings.
if ( $layout['layout_preset'] == 'list' ) {
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
$responsive_classes = "sptp-col-lg-{$desktop} sptp-col-md-{$laptop} sptp-col-sm-{$tablet} sptp-col-xs-{$mobile}";

$filter_member_number     = isset( $settings['total_member_display'] ) ? $settings['total_member_display'] : -1;
$max_group_member_display = isset( $settings['max_group_member_display'] ) ? $settings['max_group_member_display'] : -1;
$order_by                 = isset( $settings['order_by'] ) ? $settings['order_by'] : 'date';
$sptp_order               = isset( $settings['order'] ) ? $settings['order'] : 'DESC';
$preloader                = isset( $settings['preloader_switch'] ) ? $settings['preloader_switch'] : true;

// get members of this layout.
$filter_members = isset( $layout['filter_members'] ) ? $layout['filter_members'] : 'newest';
$filter_type = isset( $layout['filter_type'] ) ? $layout['filter_type'] : 'Our Team';

if ( ! empty( $filter_members ) ) {
	switch ( $filter_members ) {
		case 'newest':
			$latest_posts = get_posts(
				array(
					'post_type'      => 'sptp_member',
					'posts_per_page' => $filter_member_number,
					'orderby'        => $order_by,
					'order'          => 'ASC',
					'fields'         => 'ids',
				)
			);
			if ( 'ASC' == $sptp_order ) {
				krsort( $latest_posts, SORT_STRING );
			}

			$sptp_newest_arg      = array(
				'post_type'      => 'sptp_member',
				'posts_per_page' => $filter_member_number,
				'post__in'       => $latest_posts,
				'orderby'        => 'post__in',
			);
			$filter_members_query = new WP_Query( $sptp_newest_arg );
			$filter_members = $filter_members_query->posts;
			break;
		default:
			break;
	};
	
	
	
}

// Carousel settings.
$carousel_mode     = isset( $settings['carousel_mode'] ) ? $settings['carousel_mode'] : 'standard';
$carousel_items    = isset( $settings['responsive_columns']['desktop'] ) ? min( $settings['responsive_columns']['desktop'], count( $filter_members ) ) : '';
$carousel_speed    = isset( $settings['carousel_speed'] ) ? $settings['carousel_speed'] : 300;
$carousel_autoplay = ( isset( $settings['carousel_autoplay'] ) && $settings['carousel_autoplay'] ) ? 'true' : 'false';
$autoplay_speed    = ( isset( $settings['carousel_autoplay_speed'] ) && $settings['carousel_autoplay_speed'] && ( 'true' === $carousel_autoplay ) ) ? $settings['carousel_autoplay_speed'] : 5000;

$navigation_position   = isset( $settings['carousel_navigation_position'] ) ? $settings['carousel_navigation_position'] : 'top-right';
$navigation_color      = isset( $settings['carousel_navigation_color'] ) ? $settings['carousel_navigation_color'] : false;
$navigation_border     = isset( $settings['carousel_navigation_border'] ) ? $settings['carousel_navigation_border'] : false;
$navigation_border_css = isset( $settings['carousel_navigation_border'] ) ? ( isset( $navigation_border['all'] ) ? $navigation_border['all'] : '0' ) . 'px ' . ( isset( $navigation_border['style'] ) ? $navigation_border['style'] : 'solid' ) . ' ' . $navigation_border['color'] : '';

$pagination_color = isset( $settings['carousel_pagination_color'] ) ? $settings['carousel_pagination_color'] : false;

$loop         = ( isset( $settings['carousel_loop'] ) && $settings['carousel_loop'] ) ? 'true' : 'false';
$auto_height  = ( isset( $settings['carousel_auto_height'] ) && $settings['carousel_auto_height'] ) ? 'true' : 'false';
$lazy_load    = ( isset( $settings['carousel_lazy_load'] ) && $settings['carousel_lazy_load'] ) ? 'true' : 'false';
$stop_onhover = ( isset( $settings['carousel_onhover'] ) && $settings['carousel_onhover'] ) ? 'true' : 'false';

// Display settings.
$section_title               = isset( $settings['style_title'] ) ? $settings['style_title'] : true;
$section_title_margin_bottom = isset( $settings['style_title_margin_bottom']['bottom'] ) && ! empty( $settings['style_title_margin_bottom']['bottom'] ) ? $settings['style_title_margin_bottom']['bottom'] . 'px' : '0px';
$margin_between_member       = isset( $settings['style_margin_between_member'] ) ? intval( $settings['style_margin_between_member']['all'] ) : 24;

if ( 'list' === $layout['layout_preset'] ) {
	$position = isset( $settings['style_member_content_position_list'] ) ? $settings['style_member_content_position_list'] : '';
} else {
	$position = isset( $settings['style_member_content_position'] ) ? $settings['style_member_content_position'] : 'top_img_bottom_content';
}
switch ( $position ) {
	case 'top_img_bottom_content':
		$position_class = '';
		break;
	case 'left_img_right_content':
		$position_class = 'sptp-list-item';
		break;
	default:
		$position_class = '';
}
$border_bg_around_member       = isset( $settings['border_bg_around_member'] ) ? intval( $settings['border_bg_around_member'] ) : '';
$border_bg_around_member_class = ( $border_bg_around_member ) ? 'border-bg-around-member' : '';

$border_around_member             = isset( $settings['border_bg_around_member']['border_around_member'] ) ? $settings['border_bg_around_member']['border_around_member'] : '';
$border_around_member_width       = ( ! empty( $border_around_member['all'] ) && ( $border_around_member['all'] > 0 ) ) ? intval( $border_around_member['all'] ) : 0;
$navigation_position_right        = ( $border_around_member_width == 0 ) ? 3 : ( ( $border_around_member_width == 1 ) ? 2 : ( ( $border_around_member_width == 2 ) ? 1 : 0 ) );
$border_around_member_style       = isset( $border_around_member['style'] ) ? $border_around_member['style'] : 'none';
$border_around_member_color       = isset( $border_around_member['color'] ) ? $border_around_member['color'] : 'transparent';
$border_around_member_hover_color = isset( $border_around_member['hover_color'] ) ? $border_around_member['hover_color'] : 'transparent';
$border_around_member_border      = $border_around_member_width . 'px ' . $border_around_member_style . ' ' . $border_around_member_color;
$border_radius_around_member      = isset( $settings['border_bg_around_member']['border_radius_around_member'] ) ? $settings['border_bg_around_member']['border_radius_around_member'] . 'px' : 0;
$background_around_member         = isset( $settings['border_bg_around_member']['bg_color_around_member'] ) ? $settings['border_bg_around_member']['bg_color_around_member'] : 'transparent';

$image_animation = ( 'content_over_image' == $position ) && ( 'hover' === $overlay_content_visibility ) && isset( $settings['image_animation'] ) ? $settings['image_animation'] : '';

$sptp_order_array  = array();
$sptp_order        = 1;
$default_style_arr = array(
	'image_switch'        => true,
	'name_switch'         => true,
	'job_position_switch' => true,
	'social_switch'       => true,
);
$style_members     = isset( $settings['style_members'] ) ? $settings['style_members'] : $default_style_arr;

$name_switch     = isset( $style_members['name_switch'] ) ? $style_members['name_switch'] : true;
$position_switch = isset( $style_members['job_position_switch'] ) ? $style_members['job_position_switch'] : true;
if ( 'mosaic' === $layout['layout_preset'] ) {
	$bio_switch = isset( $style_members['bio_switch_mosaic'] ) ? $style_members['bio_switch_mosaic'] : false;
} else {
	$bio_switch = isset( $style_members['bio_switch'] ) ? $style_members['bio_switch'] : true;
}
$email_switch    = isset( $style_members['email_switch'] ) ? $style_members['email_switch'] : false;
$mobile_switch   = isset( $style_members['mobile_switch'] ) ? $style_members['mobile_switch'] : false;
$phone_switch    = isset( $style_members['phone_switch'] ) ? $style_members['phone_switch'] : true;
$location_switch = isset( $style_members['location_switch'] ) ? $style_members['location_switch'] : false;
$website_switch  = isset( $style_members['website_switch'] ) ? $style_members['website_switch'] : false;

$small_icon      = isset( $settings['icon_switch'] ) ? $settings['icon_switch'] : '';
$social_settings = isset( $settings['social_settings'] ) ? $settings['social_settings'] : '';
$social_position = isset( $social_settings['social_position'] ) ? $social_settings['social_position'] : 'center';

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

$pagination      = isset( $settings['pagination_fields']['pagination_universal'] ) ? $settings['pagination_fields']['pagination_universal'] : true;
$pagination_type = isset( $settings['pagination_fields']['universal_pagination_type'] ) ? $settings['pagination_fields']['universal_pagination_type'] : '';

$show_per_page          = isset( $settings['pagination_fields']['pagination_show_per_page'] ) ? $settings['pagination_fields']['pagination_show_per_page'] : '';
$show_dynamic_flex_wrap = ( ! empty( $filter_members ) && count( $filter_members ) > $show_per_page ) ? 'nowrap' : 'wrap';
$show_per_click         = isset( $settings['pagination_fields']['pagination_per_click'] ) ? $settings['pagination_fields']['pagination_per_click'] : '';
if ( 'pagination_btn' == $pagination_type ) {
	$total_page = ( ! empty( $filter_members ) && $show_per_page > 0 ) ? ceil( count( $filter_members ) / $show_per_click ) : '';
} else {
	$total_page = ( ! empty( $filter_members ) && $show_per_page > 0 ) ? ceil( count( $filter_members ) / $show_per_page ) : '';
}
// Image settings.
$image_on_off = isset( $settings['image_on_off'] ) ? $settings['image_on_off'] : true;
$image_shape  = isset( $settings['image_shape'] ) ? $settings['image_shape'] : '';
$image_size   = isset( $settings['image_size'] ) ? $settings['image_size'] : '';

$image_border = isset( $settings['image_border'] ) ? $settings['image_border'] : '';
if ( $image_border ) {
	$border  = '';
	$border .= ( $settings['border']['all'] > 0 ) ? $settings['border']['all'] . 'px ' : '0px ';
	$border .= ( '' !== $settings['border']['style'] ) ? $settings['border']['style'] . ' ' : ' ';
	$border .= ( '' !== $settings['border']['color'] ) ? $settings['border']['color'] : ' ';
} else {
	$border = 'none';
}
$border_hover = $image_border && isset( $settings['border']['hover_color'] ) ? $settings['border']['hover_color'] : 'inherit';

$image_zoom = isset( $settings['image_zoom'] ) ? $settings['image_zoom'] : '';

$image_bg = ( ( ! empty( $filter_members ) ) && isset( $settings['background'] ) ) ? $settings['background'] : '';

$link_detail    = isset( $settings['link_detail'] ) ? $settings['link_detail'] : true;
$page_link_type = ( isset( $settings['link_detail_fields']['page_link_type'] ) && $link_detail ) ? $settings['link_detail_fields']['page_link_type'] : '';

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
