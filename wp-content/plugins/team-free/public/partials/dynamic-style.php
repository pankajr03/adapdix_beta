<?php
/**
 * Dynamic styles.
 *
 * @package WP_Team
 * @since 2.0.0
 */

$css = array(
	'#sptp-' . $generator_id . ' .sptp-member-avatar-img'  => array(
		'border'           => $border,
		'background-color' => $image_bg,
	),
	'#sptp-' . $generator_id . ' .sptp-member-avatar-img:hover' => array(
		'border-color' => $border_hover,
	),
	'#sptp-' . $generator_id . ' .sptp-main-carousel .swiper-button-next' => array(
		'color'            => $navigation_color['color'],
		'background-color' => $navigation_color['bg_color'],
		'outline'          => $navigation_border_css,
	),
	'#sptp-' . $generator_id . ' .sptp-main-carousel .swiper-button-next:hover' => array(
		'color'            => $navigation_color['hover_color'],
		'background-color' => $navigation_color['bg_hover_color'],
		'outline-color'    => $navigation_border['hover_color'],
	),
	'#sptp-' . $generator_id . ' .sptp-main-carousel .swiper-button-prev' => array(
		'color'            => $navigation_color['color'],
		'background-color' => $navigation_color['bg_color'],
		'outline'          => $navigation_border_css,
	),
	'#sptp-' . $generator_id . ' .sptp-main-carousel .swiper-button-prev:hover' => array(
		'color'            => $navigation_color['hover_color'],
		'background-color' => $navigation_color['bg_hover_color'],
		'outline-color'    => $navigation_border['hover_color'],
	),
	'#sptp-' . $generator_id . ' .swiper-pagination-bullet' => array(
		'background-color' => $pagination_color['color'],
	),
	'#sptp-' . $generator_id . ' .swiper-pagination-bullet-active' => array(
		'background-color' => $pagination_color['active_color'],
	),
	'#sptp-' . $generator_id . ' .sptp-section-title'      => array(
		'margin-bottom' => $section_title_margin_bottom,
	),
	'#sptp-' . $generator_id . ' .sptp-section-title span' => array(
		'color' => $team_title_color,
	),
	'#sptp-' . $generator_id . ' .sptp-member-name h2'     => array(
		'color' => $member_name_color,
	),
	'#sptp-' . $generator_id . ' .sptp-member-profession h4' => array(
		'color' => $member_position_color,
	),
	'#sptp-' . $generator_id . ' .sptp-member-desc'        => array(
		'color' => $member_description_color,
	),

	'#sptp-' . $generator_id . ' .sptp-member-social'      => array(
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
		'border-color' => $social_icon_border_hover,
	),
	'#sptp-' . $generator_id . ' .swiper-wrapper.left_img_right_content' => array(
		'margin-left' => $margin_between_member . 'px',
	),
	'#sptp-' . $generator_id . ' .swiper-wrapper.left_content_right_img' => array(
		'margin-left' => $margin_between_member . 'px',
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
		'border-color' => $border_around_member_hover_color,
	),
	'#sptp-' . $generator_id . ' .sptp-member'             => array(
		'margin' => $margin_between_member / 2 . 'px ' . $margin_between_member / 2 . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-main-carousel .sptp-member' => array(
		'margin' => 0,
	),
	'#sptp-' . $generator_id . ' .sptp-popup-content-main .sptp-member' => array(
		'margin' => '0',
	),
	'#sptp-' . $generator_id . ' .sptp-list .sptp-row'     => array(
		'margin-right' => '-' . $margin_between_member . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-member.sptp-list-item' => array(
		'border'           => $border_around_member_border,
		'border-radius'    => $border_radius_around_member,
		'background-color' => $background_around_member,
		'margin-left'      => 0,
		'margin-right'     => $margin_between_member . 'px',
	),
	'#sptp-' . $generator_id . ' .sptp-member.sptp-list-item:hover' => array(
		'border-color' => $border_around_member_hover_color,
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
// content the style as mobile images are not working correctly -->
//echo '<style>' . $final_css . '</style>';?>