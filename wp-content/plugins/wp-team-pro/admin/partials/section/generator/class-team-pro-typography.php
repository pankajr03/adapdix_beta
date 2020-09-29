<?php
/**
 * Typography tab.
 *
 * @since      2.0.0
 * @version    2.0.0
 *
 * @package    WP_Team_Pro
 * @subpackage WP_Team_Pro/admin
 * @author     ShapedPlugin<support@shapedplugin.com>
 */

// Cannot access directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * This class is responsible for Typography tab in Team page.
 *
 * @since      2.0.0
 */
class SPTP_Typography {

	/**
	 * Typography Settings.
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_generator.
	 */
	public static function section( $prefix ) {
		SPF::createSection(
			$prefix,
			array(
				'title'  => __( 'Typography', 'wp-team-pro' ),
				'icon'   => 'fa fa-font',
				'fields' => array(
					array(
						'id'       => 'team_title_font_load',
						'type'     => 'switcher',
						'title'    => __( 'Load Team Section Title Font', 'wp-team-pro' ),
						'subtitle' => __( 'On/Off google font for team section title.', 'wp-team-pro' ),
						'default'  => false,
					),
					array(
						'id'            => 'typo_team_title',
						'type'          => 'typography',
						'title'         => __( 'Team Section Title', 'wp-team-pro' ),
						'subset'        => false,
						// 'font-style'        => true,
						'class'         => 'advanced',
						'preview'       => 'always',
						'margin_top'    => true,
						'margin_bottom' => true,
						'default'       => array(
							'color'          => '#333333',
							'font-family'    => 'Open Sans',
							'font-size'      => '24',
							'font-weight'    => '600',
							'line-height'    => '28',
							'letter-spacing' => 'normal',
							'text-align'     => 'center',
							'text-transform' => 'capitalize',
							'margin-top'     => '0',
							'margin-bottom'  => '0',
							'unit'           => 'px',
							'type'           => 'google',
						),
						'preview_text'  => __( 'Our Team Members', 'wp-team-pro' ),
						// 'chosen'        => true,
					),
					array(
						'id'       => 'member_name_font_load',
						'type'     => 'switcher',
						'title'    => __( 'Load Member Name Font', 'wp-team-pro' ),
						'subtitle' => __( 'On/Off google font for member name.', 'wp-team-pro' ),
						'default'  => false,
					),
					array(
						'id'            => 'typo_member_name',
						'type'          => 'typography',
						'title'         => __( 'Member Name', 'wp-team-pro' ),
						'subset'        => false,
						'class'         => 'advanced',
						'preview'       => 'always',
						'margin_top'    => true,
						'margin_bottom' => true,
						'default'       => array(
							'color'          => '#333333',
							'font-family'    => 'Open Sans',
							'font-size'      => '18',
							'font-weight'    => '600',
							'line-height'    => '24',
							'letter-spacing' => 'normal',
							'text-align'     => 'center',
							'text-transform' => 'default',
							'margin-top'     => '12',
							'margin-bottom'  => '0',
							'unit'           => 'px',
							'type'           => 'google',
						),
						'preview_text'  => __( 'John Doe', 'wp-team-pro' ),
						// 'chosen'        => true,
					),
					array(
						'id'       => 'member_position_font_load',
						'type'     => 'switcher',
						'title'    => __( 'Load Member Position/Job Title Font', 'wp-team-pro' ),
						'subtitle' => __( 'On/Off google font for member position.', 'wp-team-pro' ),
						'default'  => false,
					),
					array(
						'id'            => 'typo_member_position',
						'type'          => 'typography',
						'title'         => __( 'Position/Job Title', 'wp-team-pro' ),
						'subset'        => false,
						'class'         => 'advanced',
						'preview'       => 'always',
						'margin_top'    => true,
						'margin_bottom' => true,
						'default'       => array(
							'color'          => '#333333',
							'font-family'    => 'Open Sans',
							'font-size'      => '15',
							'line-height'    => '18',
							'text-align'     => 'center',
							'text-transform' => 'default',
							'letter-spacing' => 'normal',
							'margin-top'     => '4',
							'margin-bottom'  => '0',
							'unit'           => 'px',
							'type'           => 'google',
						),
						'preview_text'  => __( 'Manager', 'wp-team-pro' ),
						// 'chosen'        => true,
					),
					array(
						'id'       => 'member_description_font_load',
						'type'     => 'switcher',
						'title'    => __( 'Load Member Description Font', 'wp-team-pro' ),
						'subtitle' => __( 'On/Off google font for the member description.', 'wp-team-pro' ),
						'default'  => false,
					),
					array(
						'id'            => 'typo_desc_bio',
						'type'          => 'typography',
						'title'         => __( 'Description/Short Bio', 'wp-team-pro' ),
						'subset'        => false,
						'class'         => 'advanced',
						'preview'       => 'always',
						'margin_top'    => true,
						'margin_bottom' => true,
						'default'       => array(
							'color'          => '#333333',
							'font-family'    => 'Open Sans',
							'font-size'      => '14',
							'font-weight'    => '300',
							'line-height'    => '22',
							'text-align'     => 'center',
							'text-transform' => 'default',
							'letter-spacing' => 'normal',
							'margin-top'     => '6',
							'margin-bottom'  => '8',
							'unit'           => 'px',
							'type'           => 'google',
						),
						'preview_text'  => __( 'Hi, This is John Doe from New York city. He loves creating web applications based on WordPress.', 'wp-team-pro' ),
						// 'chosen'        => true,
					),
					array(
						'id'       => 'member_details_font_load',
						'type'     => 'switcher',
						'title'    => __( 'Load Member Additional Infomation Font', 'wp-team-pro' ),
						'subtitle' => __( 'On/Off google font for the member additionl infomaion.', 'wp-team-pro' ),
						'default'  => false,
					),
					array(
						'id'            => 'additional_info',
						'type'          => 'typography',
						'title'         => __( 'Member Additional Information', 'wp-team-pro' ),
						'subset'        => false,
						'class'         => 'advanced',
						'preview'       => 'always',
						'margin_top'    => true,
						'margin_bottom' => true,
						'default'       => array(
							'color'          => '#333333',
							'font-family'    => 'Open Sans',
							'font-size'      => '15',
							'line-height'    => '20',
							'text-align'     => 'center',
							'text-transform' => 'default',
							'letter-spacing' => 'normal',
							'margin-top'     => '0',
							'margin-bottom'  => '3',
							'unit'           => 'px',
							'type'           => 'google',
						),
						'preview_text'  => __( 'john@shapedplugin.com', 'wp-team-pro' ),
					),
					array(
						'id'       => 'member_skills_font_load',
						'type'     => 'switcher',
						'title'    => __( 'Load Member Skills Font', 'wp-team-pro' ),
						'subtitle' => __( 'On/Off google font for the member skills.', 'wp-team-pro' ),
						'default'  => false,
					),
					array(
						'id'            => 'typo_skills',
						'type'          => 'typography',
						'title'         => __( 'Member Skills', 'wp-team-pro' ),
						'subset'        => false,
						'preview'       => 'always',
						'font_style'    => false,
						'class'         => 'advanced',
						'margin_top'    => true,
						'margin_bottom' => true,
						'default'       => array(
							'color'          => '#333333',
							'font-family'    => 'Open Sans',
							'font-weight'    => '400',
							'font-size'      => '13',
							'line-height'    => '24',
							'text-align'     => 'left',
							'text-transform' => 'default',
							'letter-spacing' => 'normal',
							'margin-top'     => '6',
							'margin-bottom'  => '12',
							'unit'           => 'px',
							'type'           => 'google',
						),
						'preview_text'  => __( 'WordPress', 'wp-team-pro' ),
						// 'chosen'        => true,
					),
				),
			)
		);
	}
}
