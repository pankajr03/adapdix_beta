<?php
/**
 * Layout section in team page.
 *
 * @since      2.0.0
 * @version    2.0.0
 *
 * @package    WP_Team
 * @subpackage WP_Team/admin
 * @author     ShapedPlugin<support@shapedplugin.com>
 */

// Cannot access directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * This class is responsible for Shortcode output in Team page.
 *
 * @since      2.0.0
 */
class SPTP_Output {

	/**
	 * Member Detail Settings.
	 *
	 * @since 2.0.0
	 * @param string $prefix _sptp_generator_output.
	 */
	public static function section( $prefix ) {
		if ( isset( $_GET['post'] ) ) {
			$post_id = $_GET['post'];

			SPF::createSection(
				$prefix,
				array(
					'fields' => array(
						array(
							'id'     => 'outputs',
							'type'   => 'fieldset',
							'class'  => '_sptp_output',
							'fields' => array(
								array(
									'id'         => 'output_shortcode',
									'type'       => 'text',
									'title'      => __( 'Shortcode:', 'wp-team' ),
									'default'    => wp_sprintf( '[wpteam id=%s%d%s]', '&quot;', $post_id, '&quot;' ),
									'attributes' => array(
										'readonly' => 'readonly',
									),
								),
								array(
									'id'         => 'output_tag',
									'type'       => 'text',
									'title'      => __( 'PHP Code:', 'wp-team' ),
									'default'    => wp_sprintf( '<?php echo do_shortcode(%s[wpteam id=%s%d%s]%s); ?>', '&apos;', '&quot;', $post_id, '&quot;', '&apos;' ),
									'attributes' => array(
										'readonly' => 'readonly',
									),
								),
							),
						),
					),
				)
			);
		}
	}
}
