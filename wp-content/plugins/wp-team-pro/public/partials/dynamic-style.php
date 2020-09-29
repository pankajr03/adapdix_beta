<?php
/**
 * Dynamic styles.
 *
 * @package WP_Team_Pro
 * @since 2.0.0
 */

$css = array(

	'.wp-team-pro-preloader'                               => array(
		'opacity' => '0',
	),
	'#sptp-' . $generator_id . ' .sptp-member-avatar-img-area' => array(
		'padding' => $image_padding_css,
	),
	'#sptp-' . $generator_id . ' .sptp-member-avatar-img'  => array(
		'background-color' => $image_bg,
		'padding'          => $image_inner_padding_css,
		'box-shadow'       => $image_box,
		'border'           => $border,
	),
	'#sptp-' . $generator_id . ' .sptp-member-avatar-img:hover' => array(
		'border-color' => $border_hover,
	),
	'#sptp-' . $generator_id . ' .sptp-member-avatar-img img' => array(
		'-webkit-filter' => $image_grayscale_normal,
		'filter'         => $image_grayscale_normal,
	),
	'#sptp-' . $generator_id . ' .sptp-member-avatar-img:hover img' => array(
		'-webkit-filter' => $image_grayscale_hover,
		'filter'         => $image_grayscale_hover,
	),
	'#sptp-' . $generator_id . ' .sptp-main-carousel .swiper-button-next' => array(
		'color'            => $navigation_color['color'],
		'background-color' => $navigation_color['bg_color'],
		'outline'          => $navigation_border_css,
	),
	'#sptp-' . $generator_id . ' .sptp-main-carousel .swiper-button-next:hover' => array(
		'color'            => $navigation_color['hover_color'],
		'background-color' => $navigation_color['bg_hover_color'],
		'outline-color'    => $navigation_color['bg_hover_color'],
	),
	'#sptp-' . $generator_id . ' .sptp-main-carousel .swiper-button-prev' => array(
		'color'            => $navigation_color['color'],
		'background-color' => $navigation_color['bg_color'],
		'outline'          => $navigation_border_css,
	),
	'#sptp-' . $generator_id . ' .sptp-main-carousel .swiper-button-prev:hover' => array(
		'color'            => $navigation_color['hover_color'],
		'background-color' => $navigation_color['bg_hover_color'],
		'outline-color'    => $navigation_color['bg_hover_color'],
	),
	'#sptp-' . $generator_id . ' .swiper-pagination-bullet' => array(
		'background-color' => $pagination_color['color'],
	),
	'#sptp-' . $generator_id . ' .swiper-pagination-bullet-active' => array(
		'background-color' => $pagination_color['active_color'],
	),
	'#sptp-' . $generator_id . ' .sptp-filter-load-more span,
	#sptp-' . $generator_id . ' .sptp-post-load-more span,
	#sptp-' . $generator_id . ' .sptp-post-pagination .ajax-page-numbers,
	#sptp-' . $generator_id . ' .sptp-post-pagination .page-numbers,
	#sptp-' . $generator_id . ' .sptp-post-pagination a.page-numbers,
	#sptp-' . $generator_id . ' .sptp-post-pagination ul li span' => array(
	'color'        => $pagination_btn_color['color'],
	'background'   => $pagination_btn_color['bg'],
	'border-color' => $pagination_btn_color['border'],
),
	'#sptp-' . $generator_id . ' .sptp-filter-load-more span:hover,
	#sptp-' . $generator_id . ' .sptp-post-load-more span:hover,
	#sptp-' . $generator_id . ' .sptp-post-pagination .ajax-page-numbers.current,
	#sptp-' . $generator_id . ' .sptp-post-pagination .page-numbers.current,
	#sptp-' . $generator_id . ' .sptp-post-pagination a.page-numbers:hover, 
	#sptp-' . $generator_id . ' .sptp-post-pagination ul li span.current, 
	#sptp-' . $generator_id . ' .sptp-post-pagination ul li span:hover' => array(
	'color'        => $pagination_btn_color['hover_color'],
	'background'   => $pagination_btn_color['hover_bg'],
	'border-color' => $pagination_btn_color['hover_border'],
),
	'#sptp-' . $generator_id . ' .sptp-section-title'      => array(
		'margin-bottom' => $section_title_margin_bottom,
		'text-align'    => $team_title_alignment,
	),
	'#sptp-' . $generator_id . ' .sptp-section-title span' => array(
		'color'          => $team_title_color,
		'font-family'    => $team_title_font_family,
		'font-style'     => $team_title_font_style,
		'font-weight'    => $team_title_font_weight,
		'font-size'      => $team_title_font_size,
		'line-height'    => $team_title_line_height,
		'text-transform' => $team_title_transform ? $team_title_transform : 'none',
		'letter-spacing' => $team_title_letter_spacing,
		'margin-top'     => $team_title_margin_top ? $team_title_margin_top . 'px' : 0,
		'margin-bottom'  => $team_title_margin_bottom ? $team_title_margin_bottom . 'px' : 0,
	),
	'#sptp-' . $generator_id . ' .sptp-member-avatar'      => array(
		'order' => ( isset( $sptp_order_array['image_switch'] ) ) ? $sptp_order_array['image_switch'] : '',
	),
	'#sptp-' . $generator_id . ' .sptp-member-name'        => array(
		'order' => ( isset( $sptp_order_array['name_switch'] ) ) ? $sptp_order_array['name_switch'] : '',
	),
	'#sptp-' . $generator_id . ' .sptp-member-name h2'     => array(
		'color'          => $member_name_color,
		'font-family'    => $member_name_font_family,
		'font-style'     => $member_name_font_style,
		'font-weight'    => $member_name_font_weight,
		'font-size'      => $member_name_font_size . 'px',
		'line-height'    => $member_name_line_height,
		'text-align'     => $member_name_alignment,
		'text-transform' => $member_name_transform,
		'letter-spacing' => $member_name_letter_spacing,
		'margin-top'     => $member_name_margin_top . 'px',
		'margin-bottom'  => $member_name_margin_bottom . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-member-profession'  => array(
		'order' => ( isset( $sptp_order_array['job_position_switch'] ) ) ? $sptp_order_array['job_position_switch'] : '',
	),
	'#sptp-' . $generator_id . ' .sptp-member-profession h4' => array(
		'color'          => $member_position_color,
		'font-family'    => $member_position_font_family,
		'font-style'     => $member_position_font_style,
		'font-weight'    => $member_position_font_weight,
		'font-size'      => $member_position_font_size . 'px',
		'line-height'    => $member_position_line_height,
		'text-align'     => $member_position_alignment,
		'text-transform' => $member_position_transform,
		'letter-spacing' => $member_position_letter_spacing,
		'margin-top'     => $member_position_margin_top . 'px',
		'margin-bottom'  => $member_position_margin_bottom . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-list .content'      => array(
		'padding' => $member_content_padding['top'] . 'px ' . $member_content_padding['right'] . 'px ' . $member_content_padding['left'] . 'px ' . $member_content_padding['bottom'] . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-content-on-image .content' => array(
		'background-color' => $overlay_bg_color_covered,
	),
	'#sptp-' . $generator_id . ' .sptp-content-on-image:hover>.content' => array(
		'-webkit-animation' => $image_animation . ' 1s',
		'animation'         => $image_animation . ' 1s',
		'background-color'  => $overlay_bg_color_covered,
	),
	'#sptp-' . $generator_id . ' .sptp-content-on-image .caption' => array(
		'background-color' => $overlay_bg_color_content,
	),
	'#sptp-' . $generator_id . ' .sptp-member-desc'        => array(
		'order'          => ( isset( $sptp_order_array['bio_switch'] ) ) ? $sptp_order_array['bio_switch'] : '',
		'color'          => $member_description_color,
		'font-family'    => $member_description_font_family,
		'font-style'     => $member_description_font_style,
		'font-weight'    => $member_description_font_weight,
		'font-size'      => $member_description_font_size . 'px',
		'line-height'    => $member_description_line_height,
		'text-align'     => $member_description_alignment,
		'text-transform' => $member_description_transform,
		'letter-spacing' => $member_description_letter_spacing,
		'margin-top'     => $member_description_margin_top . 'px',
		'margin-bottom'  => $member_description_margin_bottom . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-member-location'    => array(
		'order'         => ( isset( $sptp_order_array['location_switch'] ) ) ? $sptp_order_array['location_switch'] : '',
		'text-align'    => $member_information_alignment,
		'margin-top'    => $member_information_margin_top . 'px',
		'margin-bottom' => $member_information_margin_bottom . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-member-location span' => array(
		'color'          => $member_information_color,
		'font-family'    => $member_information_font_family,
		'font-style'     => $member_information_font_style,
		'font-weight'    => $member_information_font_weight,
		'font-size'      => $member_information_font_size . 'px',
		'line-height'    => $member_information_line_height,
		'text-transform' => $member_information_transform,
		'letter-spacing' => $member_information_letter_spacing,
	),
	'#sptp-' . $generator_id . ' .sptp-member-location .fa' => array(
		'color'          => $member_information_color,
		'font-style'     => $member_information_font_style,
		'font-weight'    => $member_information_font_weight,
		'font-size'      => $member_information_font_size . 'px',
		'line-height'    => $member_information_line_height,
		'text-transform' => $member_information_transform,
		'letter-spacing' => $member_information_letter_spacing,
	),
	'#sptp-' . $generator_id . ' .sptp-member-email'       => array(
		'order'         => ( isset( $sptp_order_array['email_switch'] ) ) ? $sptp_order_array['email_switch'] : '',
		'text-align'    => $member_information_alignment,
		'margin-top'    => $member_information_margin_top . 'px',
		'margin-bottom' => $member_information_margin_bottom . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-member-email span'  => array(
		'color'          => $member_information_color,
		'font-family'    => $member_information_font_family,
		'font-style'     => $member_information_font_style,
		'font-weight'    => $member_information_font_weight,
		'font-size'      => $member_information_font_size . 'px',
		'line-height'    => $member_information_line_height,
		'text-transform' => $member_information_transform,
		'letter-spacing' => $member_information_letter_spacing,
	),
	'#sptp-' . $generator_id . ' .sptp-member-email .fa'   => array(
		'color' => $member_information_color,
	),
	'#sptp-' . $generator_id . ' .sptp-member-phone'       => array(
		'order'         => ( isset( $sptp_order_array['phone_switch'] ) ) ? $sptp_order_array['phone_switch'] : '',
		'text-align'    => $member_information_alignment,
		'margin-top'    => $member_information_margin_top . 'px',
		'margin-bottom' => $member_information_margin_bottom . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-member-phone span'  => array(
		'color'          => $member_information_color,
		'font-family'    => $member_information_font_family,
		'font-style'     => $member_information_font_style,
		'font-weight'    => $member_information_font_weight,
		'font-size'      => $member_information_font_size . 'px',
		'line-height'    => $member_information_line_height,
		'text-transform' => $member_information_transform,
		'letter-spacing' => $member_information_letter_spacing,
	),
	'#sptp-' . $generator_id . ' .sptp-member-phone .fa'   => array(
		'color' => $member_information_color,
	),
	'#sptp-' . $generator_id . ' .sptp-member-mobile'      => array(
		'order'         => ( isset( $sptp_order_array['mobile_switch'] ) ) ? $sptp_order_array['mobile_switch'] : '',
		'text-align'    => $member_information_alignment,
		'margin-top'    => $member_information_margin_top . 'px',
		'margin-bottom' => $member_information_margin_bottom . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-member-mobile span' => array(
		'color'          => $member_information_color,
		'font-family'    => $member_information_font_family,
		'font-style'     => $member_information_font_style,
		'font-weight'    => $member_information_font_weight,
		'font-size'      => $member_information_font_size . 'px',
		'line-height'    => $member_information_line_height,
		'text-transform' => $member_information_transform,
		'letter-spacing' => $member_information_letter_spacing,
	),
	'#sptp-' . $generator_id . ' .sptp-member-mobile .fa'  => array(
		'color' => $member_information_color,
	),
	'#sptp-' . $generator_id . ' .sptp-member-website'     => array(
		'order'         => ( isset( $sptp_order_array['website_switch'] ) ) ? $sptp_order_array['website_switch'] : '',
		'text-align'    => $member_information_alignment,
		'margin-top'    => $member_information_margin_top . 'px',
		'margin-bottom' => $member_information_margin_bottom . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-member-website span' => array(
		'color'          => $member_information_color,
		'font-family'    => $member_information_font_family,
		'font-style'     => $member_information_font_style,
		'font-weight'    => $member_information_font_weight,
		'font-size'      => $member_information_font_size . 'px',
		'line-height'    => $member_information_line_height,
		'text-transform' => $member_information_transform,
		'letter-spacing' => $member_information_letter_spacing,
	),
	'#sptp-' . $generator_id . ' .sptp-member-website .fa' => array(
		'color' => $member_information_color,
	),
	'#sptp-' . $generator_id . ' .sptp-member-skill-progress' => array(
		'order'         => ( isset( $sptp_order_array['skill_switch'] ) ) ? $sptp_order_array['skill_switch'] : '',
		'margin-top'    => $member_skills_margin_top . 'px',
		'margin-bottom' => $member_skills_margin_bottom . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-progress-text'      => array(
		'color'          => $member_skills_color,
		'font-family'    => $member_skills_font_family,
		'font-style'     => $member_skills_font_style,
		'font-weight'    => $member_skills_font_weight,
		'font-size'      => $member_skills_font_size . 'px',
		'line-height'    => $member_skills_line_height,
		'text-transform' => $member_skills_transform,
		'text-align'     => $member_skills_alignment,
		'letter-spacing' => $member_skills_letter_spacing,
	),
	'#sptp-' . $generator_id . ' .sptp-progress-bar'       => array(
		'background-color' => $skillbar_progressbar_color,
	),
	'#sptp-' . $generator_id . ' .sptp-progress-container' => array(
		'background-color' => $skillbar_progressbar_bg_color,
	),
	'#sptp-' . $generator_id . ' .sptp-top'                => array(
		'background-color' => $skillbar_tooltip_bg_color,
		'color'            => $skillbar_tooltip_color,
	),
	'#sptp-' . $generator_id . ' .sptp-top:after'          => array(
		'border-top-color' => $skillbar_tooltip_bg_color,
	),
	'#sptp-' . $generator_id . ' .sptp-member-social'      => array(
		'order'      => ( isset( $sptp_order_array['social_switch'] ) ) ? $sptp_order_array['social_switch'] : '',
		'text-align' => $social_position,
	),
	'#sptp-' . $generator_id . ' .sptp-member-social li'   => array(
		'margin' => $social_margin_css,
	),
	'#sptp-' . $generator_id . ' .sptp-member-social li a' => array(
		'color'            => $social_icon_main_color,
		'background-color' => $social_icon_bg_main_color,
		'border'           => $social_icon_border_main,
	),
	'#sptp-' . $generator_id . ' .sptp-member-social li a:hover' => array(
		'color'            => $social_icon_hover_color,
		'background-color' => $social_icon_bg_hover_color,
		'border-color'     => $social_icon_border_hover,
	),
	'#sptp-' . $generator_id . ' .sptp-popup-items .sptp-member-social' => array(
		'text-align' => $social_position,
	),
	'#sptp-' . $generator_id . ' .swiper-wrapper.left_img_right_content' => array(
		'margin-left' => $margin_between_member . 'px',
	),
	'#sptp-' . $generator_id . ' .swiper-wrapper.left_content_right_img' => array(
		'margin-left' => $margin_between_member . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-thumbnail-pager .sptp-col-md-2-half .sptp-row>div' => array(
		'padding' => $margin_between_member / 2 . 'px',
	),
	'#sptp-' . $generator_id . ' .left_img_right_content .sptp-member' => array(
		'flex-direction' => 'row',
	),
	'#sptp-' . $generator_id . ' .left_content_right_img .sptp-member' => array(
		'flex-direction' => 'row-reverse',
	),
	'#sptp-' . $generator_id . ' .left_img_right_content .image' => array(
		'width' => '50%',
	),
	'#sptp-' . $generator_id . ' .left_img_right_content .content' => array(
		'width'          => '50%',
		'display'        => 'flex',
		'flex-direction' => 'column',
	),
	'#sptp-' . $generator_id . ' .left_content_right_img .image' => array(
		'width' => '50%',
	),
	'#sptp-' . $generator_id . ' .left_content_right_img .content' => array(
		'width'          => '50%',
		'display'        => 'flex',
		'flex-direction' => 'column',
	),
	'#sptp-' . $generator_id . ' .border-bg-around-member:not(.sptp-content-on-image)' => array(
		'border'           => $border_around_member_border,
		'border-radius'    => $border_radius_around_member,
		'background-color' => $background_around_member,
	),
	'#sptp-' . $generator_id . ' .border-bg-around-member:not(.sptp-content-on-image):hover' => array(
		'border-color' => $border_around_member_hover,
	),
	'#sptp-' . $generator_id . ' .sptp-icon-on-image:hover .sptp-icon' => array(
		'background-color' => $icon_over_img_bg_color,
	),
	'#sptp-' . $generator_id . ' .sptp-member-avatar-img:hover .sptp-icon' => array(
		'background-color' => $icon_over_img_bg_color,
	),
	'#sptp-' . $generator_id . ' .sptp-icon-on-image .fa'  => array(
		'color' => $icon_over_img_color,
	),
	'#sptp-' . $generator_id . ' .sptp-icon-on-image .fa:hover' => array(
		'color' => $icon_over_img_hover_color,
	),
	'#sptp-' . $generator_id . ' .sptp-member-avatar-img .fa' => array(
		'color' => $icon_over_img_color,
	),
	'#sptp-' . $generator_id . ' .sptp-member-avatar-img .fa:hover' => array(
		'color' => $icon_over_img_hover_color,
	),
	'#sptp-' . $generator_id . ' .sptp-member'             => array(
		'margin' => $margin_between_member / 2 . 'px ' . $margin_between_member / 2 . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-thumbnail-pager .sptp-member' => array(
		'margin' => '0 ' . $margin_between_member . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-thumbnail-pager .sptp-icon' => array(
		'color' => $icon_over_img_color,
	),
	'#sptp-' . $generator_id . ' .sptp-thumbnail-pager .sptp-icon:hover' => array(
		'color' => $icon_over_img_hover_color,
	),
	'#sptp-' . $generator_id . ' .sptp-main-carousel .sptp-member' => array(
		'margin' => 0,
	),
	'#sptp-' . $generator_id . ' .sptp-inline .sptp-member' => array(
		'margin'           => '0',
		'border'           => $border_around_member_border,
		'border-radius'    => $border_radius_around_member,
		'background-color' => $background_around_member,
		'margin'           => '0 -1px -1px 0',
	),
	'#sptp-' . $generator_id . ' .sptp-inline .sptp-member:hover' => array(
		'border-color' => $border_around_member_hover,
	),
	'#sptp-' . $generator_id . ' .sptp-table-layout table tbody tr' => array(
		'border' => $border_around_member_border,
	),
	'#sptp-' . $generator_id . ' .sptp-table-layout table thead th:first-of-type' => array(
		'border-top-left-radius' => $border_radius_around_member,
	),
	'#sptp-' . $generator_id . ' .sptp-table-layout table thead th:last-of-type' => array(
		'border-top-right-radius' => $border_radius_around_member,
	),
	'#sptp-' . $generator_id . ' .sptp-table-layout table thead th' => array(
		'background-color' => $background_around_member . '33',
	),
	'#sptp-' . $generator_id . ' .sptp-table-layout table tfoot td' => array(
		'background-color' => $background_around_member . '33',
	),
	'#sptp-' . $generator_id . ' .sptp-table-layout table tfoot td:first-of-type' => array(
		'border-bottom-left-radius' => $border_radius_around_member,
	),
	'#sptp-' . $generator_id . ' .sptp-table-layout table tfoot td:last-of-type' => array(
		'border-bottom-right-radius' => $border_radius_around_member,
	),
	'#sptp-' . $generator_id . ' .sptp-table-layout table tbody tr:nth-child(even)' => array(
		'background-color' => $background_around_member . '33',
	),
	'#sptp-' . $generator_id . ' .sptp-table-layout table tbody tr:nth-child(odd)' => array(
		'background-color' => $background_around_member . '',
	),
	'#sptp-' . $generator_id . ' .sptp-mosaic .sptp-member' => array(
		'margin' => '0',
	),
	'#sptp-' . $generator_id . ' .sptp-mosaic .sptp-member-info' => array(
		'background-color' => $mosaic_bg_color,
	),
	'#sptp-' . $generator_id . ' .sptp-mosaic .sptp-member-avatar-img' => array(
		'box-shadow' => $image_box,
		'padding'    => ( $image_box_shadow && ( 'inset' === $settings['box']['style'] ) ) ? 2 * $settings['box']['blur'] . 'px ' . 2 * $settings['box']['blur'] . 'px ' . 2 * $settings['box']['blur'] . 'px ' . 2 * $settings['box']['blur'] . 'px' : $image_padding_css,
	),
	'#sptp-' . $generator_id . ' .sptp-mosaic .sptp-member-avatar-img img' => array(
		'box-shadow' => 'none',
	),
	'#sptp-' . $generator_id . ' .sptp-mosaic .sptp-member-info .sptp-arrow' => array(
		'border-color' => $mosaic_bg_color,
	),
	'#sptp-' . $generator_id . ' .sptp-popup-content-main .sptp-member' => array(
		'margin' => '0',
	),
	'#sptp-' . $generator_id . ' .sptp-member.sptp-list-item' => array(
		'border'           => $border_around_member_border,
		'border-radius'    => $border_radius_around_member,
		'background-color' => $background_around_member,
		'margin-left'      => 0,
		'margin-right'     => 0,
	),
	'#sptp-' . $generator_id . ' .sptp-member.sptp-list-item:hover' => array(
		'border-color' => $border_around_member_hover,
	),
	'#sptp-' . $generator_id . ' .filtr-item.element-item' => array(
		'padding-right'  => $margin_between_member . 'px',
		'padding-bottom' => $margin_between_member . 'px',
	),
	'#sptp-' . $generator_id . ' .filtr-item .sptp-member' => array(
		'margin' => '0',
	),
	'#sptp-' . $generator_id . ' .filters-button-group'    => array(
		'justify-content' => $filter_btn_align,
	),
	'#sptp-' . $generator_id . ' .filters-button-group button' => array(
		'color'            => $filter_btn_color,
		'border-color'     => $filter_btn_border,
		'background-color' => $filter_btn_bg_color,
	),
	'#sptp-' . $generator_id . ' .filters-button-group button:hover' => array(
		'color'            => $filter_btn_active_color,
		'border-color'     => $filter_btn_hover_border,
		'background-color' => $filter_btn_active_hover_bg_color,
	),
	'#sptp-' . $generator_id . ' .filters-button-group button.is-checked' => array(
		'color'            => $filter_btn_active_color,
		'border-color'     => $filter_btn_hover_border,
		'background-color' => $filter_btn_active_hover_bg_color,
	),
	'#sptp-' . $generator_id . ' .filters-button-group button.is-checked:hover' => array(
		'color'            => $filter_btn_active_color,
		'background-color' => $filter_btn_active_hover_bg_color,
	),
	'#sptp-' . $generator_id . ' .filterSelect'            => array(
		'left' => $filter_dropdown_align_style,
	),
	'#sptp-' . $generator_id . ' .sptp-popup-items.sptp-popup-on' => array(
		'z-index' => $modal_z_index . '!important',
	),
	'#sptp-' . $generator_id . ' .sptp-popup-items .sptp-popup-item .sptp-popup-content,
	#sptp-' . $generator_id . ' .sptp-popup-items.style-2 .sptp-popup-item,
	#sptp-' . $generator_id . ' .sptp-popup-items.style-3 .sptp-popup-item,
	#sptp-' . $generator_id . ' .sptp-popup-items.style-4 .sptp-popup-item' => array(
	'background-color' => $modal_background_color,
),
	'#sptp-' . $generator_id . ' .sptp-mosaic-row .sptp-row>div' => array(
		'margin-bottom' => 0,
	),
	'#sptp-' . $generator_id . ' .sptp-table-layout .sptp-top' => array(
		'color'            => $skillbar_progressbar_bg_color,
		'background-color' => $skillbar_progressbar_color,
	),
	'#sptp-' . $generator_id . ' .sptp-table-layout .sptp-top' => array(
		'color'            => $skillbar_progressbar_bg_color,
		'background-color' => $skillbar_progressbar_color,
	),


);
$final_css = '';
foreach ( $css as $style => $style_array ) {
	$final_css .= $style . '{';
	foreach ( $style_array as $property => $value ) {
		$final_css .= $property . ':' . $value . ';';
	}
	$final_css .= '}';
}

echo '<style>' . $final_css . '</style>';
