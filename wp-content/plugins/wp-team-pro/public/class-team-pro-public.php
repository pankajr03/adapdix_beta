<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    WP_Team_Pro
 * @subpackage WP_Team_Pro/public
 * @author     ShapedPlugin <support@shapedplugin.com>
 */
class Team_Pro_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Generator
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $generator_id    Generator ID of team.
	 */
	private $generator_id;
	/**
	 * Settings
	 */
	private $settings;
	/**
	 * Member
	 */
	private $member;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		add_action( 'init', array( $this, 'sptp_pagination_cookie' ) );
		add_shortcode( 'wpteam', array( $this, 'sptp_shortcode_func' ) );

		add_action( 'wp_ajax_nopriv_sptp_action', array( $this, 'sptp_action' ) );
		add_action( 'wp_ajax_sptp_action', array( $this, 'sptp_action' ) );
		add_action( 'wp_ajax_thumbnail_click_function', array( $this, 'thumbnail_click_function' ) );
		add_action( 'wp_ajax_thumbnail_click_function', array( $this, 'thumbnail_click_function' ) );
		add_action( 'wp_ajax_pagination_function', array( $this, 'pagination_function' ) );
		add_action( 'wp_ajax_nopriv_pagination_function', array( $this, 'pagination_function' ) );
		add_action( 'wp_ajax_pagination_load_more_function', array( $this, 'pagination_load_more_function' ) );
		add_filter( 'single_template', array( $this, 'get_custom_post_type_template' ) );
	}

	public function get_custom_post_type_template( $single_template ) {
		global $post;
		if ( 'sptp_member' === $post->post_type ) {
			wp_enqueue_script( 'jquery' );
			return plugin_dir_path( __FILE__ ) . '/partials/sptp-single.php';
			wp_reset_postdata();
		}
		return $single_template;
	}

	public function sptp_pagination_cookie() {
		foreach ( $_COOKIE as $key => $value ) {
			if ( ( strpos( $key, 'sptpPagination' ) !== false ) || ( strpos( $key, 'sptpThumbnail' ) !== false ) ) {
				setcookie( $key, '', 1 );
				setcookie( $key, 0 );
			}
		}
	}

	public function pagination_function() {
		if ( ! wp_verify_nonce( wp_unslash( $_POST['nonce'] ), 'sptp-pagination' ) ) {
			return false;
		}
		wp_die();
	}

	public function pagination_load_more_function() {
		if ( ! wp_verify_nonce( wp_unslash( $_POST['nonce'] ), 'sptp-pagination' ) ) {
			return false;
		}
		// echo 'Hello';
		// print_r( $_POST['members'] );
		die();
	}

	public function thumbnail_modal_return() {
		$member_id = $this->member;
		return get_post( $this->member );
	}

	public function thumbnail_modal_function() {
		if ( ! wp_verify_nonce( wp_unslash( $_POST['nonce'] ), 'sptp-modal' ) ) {
			return false;
		}
		$this->member = $_POST['member'];
		echo $this->member;

		wp_die();
	}

	/**
	 * Click functionality on thumbnail.
	 *
	 * @version 2.0
	 * @access public
	 */
	public function thumbnail_click_function() {
		if ( ! wp_verify_nonce( wp_unslash( $_POST['nonce'] ), 'sptp-thumbnail' ) ) {
			return false;
		}
		wp_die();
	}

	/**
	 * Autoload class files on demand
	 *
	 * @param string $class requested class name.
	 * @since 2.0
	 */
	private function autoload( $class ) {
		$name = explode( '_', $class );
		if ( isset( $name[2] ) ) {
			$class_name        = strtolower( $name[2] );
			$spto_config_paths = array( 'partials/' );
			foreach ( $spto_config_paths as $sptp_path ) {
				$filename = plugin_dir_path( __FILE__ ) . '/' . $sptp_path . 'class-team-pro-' . $class_name . '.php';
				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}
	}

	/**
	 * Allowed html.
	 *
	 * @since 2.0
	 */
	public static function sptp_allowed_html() {
		$allowed_tags = array(
			'a'          => array(
				'class' => array(),
				'href'  => array(),
				'rel'   => array(),
				'title' => array(),
			),
			'abbr'       => array(
				'title' => array(),
			),
			'b'          => array(),
			'blockquote' => array(
				'cite' => array(),
			),
			'cite'       => array(
				'title' => array(),
			),
			'code'       => array(),
			'del'        => array(
				'datetime' => array(),
				'title'    => array(),
			),
			'dd'         => array(),
			'div'        => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'dl'         => array(),
			'dt'         => array(),
			'em'         => array(),
			'h1'         => array(),
			'h2'         => array(),
			'h3'         => array(),
			'h4'         => array(),
			'h5'         => array(),
			'h6'         => array(),
			'i'          => array(),
			'img'        => array(
				'alt'    => array(),
				'class'  => array(),
				'height' => array(),
				'src'    => array(),
				'width'  => array(),
			),
			'li'         => array(
				'class' => array(),
			),
			'ol'         => array(
				'class' => array(),
			),
			'p'          => array(
				'class' => array(),
			),
			'q'          => array(
				'cite'  => array(),
				'title' => array(),
			),
			'span'       => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'strike'     => array(),
			'strong'     => array(),
			'ul'         => array(
				'class' => array(),
			),
		);
		return $allowed_tags;
	}

	/**
	 * Function sptp_action.
	 *
	 * @since 2.0
	 */
	public function sptp_action() {
		$members     = wp_json_encode( $_POST['members'] );
		$display     = $_POST['display'];
		$pagination  = $_POST['page'];
		$_temp       = $pagination * $display;
		$new_members = wp_json_encode( array_slice( json_decode( $members, true ), $_temp, $display ) );
		foreach ( json_decode( $new_members, true ) as $key => $member ) {
			echo wp_json_encode( $member );
		}
		wp_die();
	}

	/**
	 * Function get layout from atts and create class depending on it.
	 *
	 * @param array $atts shortcode's all option.
	 * @since 2.0
	 */
	public function sptp_shortcode_func( $atts ) {
		$generator_id       = $atts['id'];
		$this->generator_id = $generator_id;
		$generator_status   = get_post_status( $generator_id );
		if ( 'trash' !== get_post_status( $generator_id ) ) {
			$layout             = get_post_meta( $generator_id, '_sptp_generator_layout', true );
			$settings           = get_post_meta( $generator_id, '_sptp_generator', true );
			$this->settings     = $settings;
			$this->generator_id = $generator_id;
			$page_link_type     = isset( $settings['page_link_type'] ) ? $settings['page_link_type'] : '';

			ob_start();
			include 'partials/settings.php';
			include 'partials/dynamic-style.php';

			$layout_preset                                    = isset( $layout['layout_preset'] ) ? $layout['layout_preset'] : '';
			$carousel_accessibility                           = isset( get_option( '_sptp_settings' )['carousel_accessibility'] ) ? get_option( '_sptp_settings' )['carousel_accessibility'] : '';
			$carousel_accessibility_enabled                   = ( isset( $carousel_accessibility['accessibility'] ) && ( $carousel_accessibility['accessibility'] ) ) ? 'true' : 'false';
			$carousel_accessibility_prev_slide_message        = isset( $carousel_accessibility['prev_slide_message'] ) ? $carousel_accessibility['prev_slide_message'] : '';
			$carousel_accessibility_next_slide_message        = isset( $carousel_accessibility['next_slide_message'] ) ? $carousel_accessibility['next_slide_message'] : '';
			$carousel_accessibility_first_slide_message       = isset( $carousel_accessibility['first_slide_message'] ) ? $carousel_accessibility['first_slide_message'] : '';
			$carousel_accessibility_last_slide_message        = isset( $carousel_accessibility['last_slide_message'] ) ? $carousel_accessibility['last_slide_message'] : '';
			$carousel_accessibility_pagination_bullet_message = isset( $carousel_accessibility['pagination_bullet_message'] ) ? $carousel_accessibility['pagination_bullet_message'] : '';
			if ( $preloader ) {
				$preloader_class = ' wp-team-pro-preloader';
			}

			if ( ! empty( $layout_preset ) ) {
				switch ( $layout_preset ) {
					case 'carousel':
						wp_enqueue_style( 'simpleBar' );
						if ( 'ticker' === $carousel_mode ) {
							wp_enqueue_style( 'bxslider' );
							wp_enqueue_script( 'bxslider' );
						}
						if ( $sptp_swiper_css ) {
							wp_enqueue_style( 'swiper' );
						}
						if ( $sptp_simplebar_js ) {
							wp_enqueue_script( 'simpleBarJS' );
						}
						if ( $sptp_swiper_js ) {
							wp_enqueue_script( 'swiper' );
						}
						wp_enqueue_script( 'modals' );
						include 'partials/carousel.php';
						break;
					case 'grid':
						wp_enqueue_style( 'simpleBar' );
						if ( $sptp_swiper_css ) {
							wp_enqueue_style( 'swiper' );
						}
						if ( $sptp_simplebar_js ) {
							wp_enqueue_script( 'simpleBarJS' );
						}
						if ( $sptp_swiper_js ) {
							wp_enqueue_script( 'swiper' );
						}
						wp_enqueue_script( 'modals' );
						wp_enqueue_script( 'gridder' );
						include 'partials/grid.php';
						break;
					case 'filter':
						if ( $sptp_swiper_css ) {
							wp_enqueue_style( 'swiper' );
						}
						if ( $sptp_simplebar_js ) {
							wp_enqueue_script( 'simpleBarJS' );
						}
						if ( $sptp_isotope_js ) {
							wp_enqueue_script( 'isotope' );
						}
						if ( $sptp_swiper_js ) {
							wp_enqueue_script( 'swiper' );
						}
						$filter_obj = 'filterPagination' . $generator_id;
						wp_localize_script(
							SPTP_PLUGIN_NAME,
							$filter_obj,
							array(
								//'column'               => $desktop,
								'filter_member_number' => $filter_member_number,
								'filter_members'       => $filter_members,
								'filter_pagination'    => $filter_pagination,
								'filter_per_page'      => $filter_pagination_show_per_page,
								'filter_per_click'     => $filter_pagination_per_click,
							)
						);
						wp_enqueue_script( 'modals' );
						include 'partials/filter.php';
						break;
					case 'list':
						if ( $sptp_swiper_css ) {
							wp_enqueue_style( 'swiper' );
						}
						if ( $sptp_swiper_js ) {
							wp_enqueue_script( 'swiper' );
						}
						if ( $sptp_simplebar_js ) {
							wp_enqueue_script( 'simpleBarJS' );
						}
						wp_enqueue_script( 'modals' );
						wp_enqueue_script( 'matchHeight' );
						include 'partials/list.php';
						break;
					case 'mosaic':
						if ( $sptp_swiper_css ) {
							wp_enqueue_style( 'swiper' );
						}
						if ( $sptp_swiper_js ) {
							wp_enqueue_script( 'swiper' );
						}
						if ( $sptp_simplebar_js ) {
							wp_enqueue_script( 'simpleBarJS' );
						}
						wp_enqueue_script( 'modals' );
						wp_enqueue_script( 'gridder' );
						include 'partials/mosaic.php';
						break;
					case 'inline':
						if ( $sptp_swiper_css ) {
							wp_enqueue_style( 'swiper' );
						}
						if ( $sptp_swiper_js ) {
							wp_enqueue_script( 'swiper' );
						}
						if ( $sptp_simplebar_js ) {
							wp_enqueue_script( 'simpleBarJS' );
						}
						wp_enqueue_script( 'modals' );
						wp_enqueue_script( 'gridder' );
						include 'partials/inline.php';
						break;
					case 'table':
						if ( $sptp_swiper_css ) {
							wp_enqueue_style( 'swiper' );
						}
						if ( $sptp_swiper_js ) {
							wp_enqueue_script( 'swiper' );
						}
						if ( $sptp_simplebar_js ) {
							wp_enqueue_script( 'simpleBarJS' );
						}
						wp_enqueue_script( 'modals' );
						include 'partials/table.php';
						break;
					case 'thumbnail-pager':
						wp_localize_script(
							SPTP_PLUGIN_NAME,
							'thumbnail',
							array(
								'ajax_url' => admin_url( 'admin-ajax.php' ),
								'nonce'    => wp_create_nonce( 'sptp-thumbnail' ),
							)
						);
						include 'partials/thumbnail-pager.php';
						break;
					default:
						return false;
				}
			}
			wp_localize_script(
				SPTP_PLUGIN_NAME,
				'pagination',
				array(
					'ajax_url'        => admin_url( 'admin-ajax.php' ),
					'nonce'           => wp_create_nonce( 'sptp-pagination' ),
					'per_page'        => $show_per_page,
					'per_click'       => $show_per_click,
					'total'           => $total_page,
					'pagination_type' => $pagination_type,
					'members'         => $filter_members,
				)
			);

			if ( $sptp_google_fonts ) :
				$unique_id       = uniqid();
				$enqueue_fonts   = array();
				$sptp_typography = array();
				if ( $section_title && $team_title_font_load && isset( $team_title_font_family ) && ( 'google' === $team_title_font_type ) ) {
					$team_title_arr           = array(
						'font-family' => isset( $team_title['font-family'] ) ? $team_title['font-family'] : 'Open Sans',
						'font-weight' => isset( $team_title['font-weight'] ) ? $team_title['font-weight'] : '600',
						'font-style'  => isset( $team_title['font-style'] ) ? $team_title['font-style'] : 'normal',
						'type'        => isset( $team_title['type'] ) ? $team_title['type'] : 'google',
					);
					$sptp_typography['title'] = $team_title_arr;
				}
				if ( ( $name_switch || ( ! empty( array_intersect( [ 'name' ], $detail_page_fields ) ) ) ) &&
				$member_name_font_load &&
				isset( $member_name_font_family ) &&
				( 'google' === $member_name_font_type ) && isset( $member_name ) ) {
					$member_name_arr         = array(
						'font-family' => isset( $member_name['font-family'] ) ? $member_name['font-family'] : 'Open Sans',
						'font-weight' => isset( $member_name['font-weight'] ) ? $member_name['font-weight'] : '600',
						'font-style'  => isset( $member_name['font-style'] ) ? $member_name['font-style'] : 'normal',
						'type'        => isset( $member_name['type'] ) ? $member_name['type'] : 'google',
					);
					$sptp_typography['name'] = $member_name_arr;
				}
				if ( ( $position_switch || ( ! empty( array_intersect( [ 'position' ], $detail_page_fields ) ) ) ) && $member_position_font_load &&
				isset( $member_position_font_load ) &&
				( 'google' === $member_position_font_type ) && isset( $member_position ) ) {
					$member_position_arr         = array(
						'font-family' => isset( $member_position['font-family'] ) ? $member_position['font-family'] : 'Open Sans',
						'font-weight' => isset( $member_position['font-weight'] ) ? $member_position['font-weight'] : '400',
						'font-style'  => isset( $member_position['font-style'] ) ? $member_position['font-style'] : 'normal',
						'type'        => isset( $member_position['type'] ) ? $member_position['type'] : 'google',
					);
					$sptp_typography['position'] = $member_position_arr;
				}
				if ( ( $bio_switch || ( ! empty( array_intersect( [ 'desc' ], $detail_page_fields ) ) ) ) && $member_description_font_load &&
				isset( $member_description_font_family ) &&
				( 'google' === $member_description_font_type ) && isset( $member_description ) ) {
					$member_description_arr         = array(
						'font-family' => isset( $member_description['font-family'] ) ? $member_description['font-family'] : 'Open Sans',
						'font-weight' => isset( $member_description['font-weight'] ) ? $member_description['font-weight'] : '300',
						'font-style'  => isset( $member_description['font-style'] ) ? $member_description['font-style'] : 'normal',
						'type'        => isset( $member_description['type'] ) ? $member_description['type'] : 'google',
					);
					$sptp_typography['description'] = $member_description_arr;
				}
				if ( ( ( $email_switch || $mobile_switch || $phone_switch || $location_switch || $website_switch ) ||
				( ! empty( array_intersect( [ 'email', 'mobile', 'phone', 'location', 'website' ], $detail_page_fields ) ) ) ) &&
				$member_information_font_load &&
				isset( $member_information_font_family ) &&
				( 'google' === $member_information_font_type ) && isset( $member_information ) ) {
					$member_information_arr     = array(
						'font-family' => isset( $member_information['font-family'] ) ? $member_information['font-family'] : 'Open Sans',
						'font-weight' => isset( $member_information['font-weight'] ) ? $member_information['font-weight'] : '400',
						'font-style'  => isset( $member_information['font-style'] ) ? $member_information['font-style'] : 'normal',
						'type'        => isset( $member_information['type'] ) ? $member_information['type'] : 'google',
					);
					$sptp_typography['details'] = $member_information_arr;
				}
				if ( ( $skill_switch || ( ! empty( array_intersect( [ 'skills' ], $detail_page_fields ) ) ) ) &&
				$member_skills_font_load &&
				isset( $member_skills_font_family ) &&
				( 'google' === $member_skills_font_type ) && isset( $member_skills ) ) {
					$member_skills_arr        = array(
						'font-family' => isset( $member_skills['font-family'] ) ? $member_skills['font-family'] : 'Open Sans',
						'font-weight' => isset( $member_skills['font-weight'] ) ? $member_skills['font-weight'] : '400',
						'font-style'  => isset( $member_skills['font-style'] ) ? $member_skills['font-style'] : 'normal',
						'type'        => isset( $member_skills['type'] ) ? $member_skills['type'] : 'google',
					);
					$sptp_typography['skill'] = $member_skills_arr;
				}

				if ( ! empty( $sptp_typography ) ) {
					foreach ( $sptp_typography as $font ) {
						if ( isset( $font['type'] ) && 'google' === $font['type'] ) {
							$weight          = isset( $font['font-weight'] ) ? ( ( 'normal' !== $font['font-weight'] ) ? ':' . $font['font-weight'] : ':400' ) : ':400';
							$style           = isset( $font['font-style'] ) ? substr( $font['font-style'], 0, 1 ) : '';
							$enqueue_fonts[] = str_replace( ' ', '+', $font['font-family'] ) . $weight . $style;
						}
					}
				}
				if ( ! empty( $enqueue_fonts ) ) {
					wp_enqueue_style( 'sptp-google-fonts' . $unique_id, 'https://fonts.googleapis.com/css?family=' . implode( '|', $enqueue_fonts ), array(), SPTP_PLUGIN_VERSION );
				}
			endif;

			if ( $sptp_fontawesome ) {
				wp_enqueue_style( 'fontawesome' );
			}
			wp_enqueue_style( 'animate' );
			wp_enqueue_style( 'custom-style' );
			wp_add_inline_style( 'custom-style', $sptp_custom_css );
			wp_enqueue_script( 'infiniteScroll' );
			wp_enqueue_script( 'main-js', SPTP_PLUGIN_ROOT . 'public/js/custom.js', array(), '1.0', true );
			wp_add_inline_script( 'main-js', $sptp_custom_js );
			wp_enqueue_style( SPTP_PLUGIN_NAME );
			wp_enqueue_script( SPTP_PLUGIN_NAME );
			return ob_get_clean();
		}
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    2.0
	 */
	public function enqueue_styles() {
		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Team_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Team_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_style( 'fontawesome', SPTP_PLUGIN_ROOT . 'public/css/font-awesome.min.css', array(), SPTP_PLUGIN_VERSION, 'all' );
		wp_register_style( 'swiper', SPTP_PLUGIN_ROOT . 'public/css/swiper.min.css', array(), SPTP_PLUGIN_VERSION, 'all' );
		wp_register_style( 'bxslider', SPTP_PLUGIN_ROOT . 'public/css/jquery.bxslider.min.css', array(), SPTP_PLUGIN_VERSION, 'all' );
		wp_register_style( 'animate', SPTP_PLUGIN_ROOT . 'public/css/animate.min.css', array(), SPTP_PLUGIN_VERSION, 'all' );
		wp_register_style( 'w3', SPTP_PLUGIN_ROOT . 'public/css/w3.css', array(), SPTP_PLUGIN_VERSION, 'all' );
		wp_register_style( SPTP_PLUGIN_NAME, SPTP_PLUGIN_ROOT . 'public/css/public.min.css', array(), SPTP_PLUGIN_VERSION, 'all' );
		wp_register_style( 'dynamic-css', SPTP_PLUGIN_ROOT . 'public/css/dynamic.css', array(), SPTP_PLUGIN_VERSION, 'all' );
		wp_register_style( 'custom-style', SPTP_PLUGIN_ROOT . 'public/css/custom.css', array(), SPTP_PLUGIN_VERSION, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    2.0
	 */
	public function enqueue_scripts() {
		$sptp_settings = get_option( '_sptp_settings' );
		$preloader     = isset( $settings['preloader_switch'] ) ? $settings['preloader_switch'] : true;
		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Team_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Team_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_script( 'swiper', SPTP_PLUGIN_ROOT . 'public/js/swiper.min.js', array(), SPTP_PLUGIN_VERSION, true );
		wp_register_script( 'infiniteScroll', SPTP_PLUGIN_ROOT . 'public/js/infinite-scroll.pkgd.min.js', array(), SPTP_PLUGIN_VERSION, true );
		wp_register_script( 'bxslider', SPTP_PLUGIN_ROOT . 'public/js/jquery.bxslider.min.js', array( 'jquery' ), SPTP_PLUGIN_VERSION, true );
		wp_register_script( 'gridder', SPTP_PLUGIN_ROOT . 'public/js/jquery.gridder.js', array( 'jquery' ), SPTP_PLUGIN_VERSION, true );
		wp_register_script( 'modals', SPTP_PLUGIN_ROOT . 'public/js/sptp.modals.min.js', array( 'jquery' ), SPTP_PLUGIN_VERSION, true );
		wp_register_script( 'isotope', SPTP_PLUGIN_ROOT . 'public/js/isotope.pkgd.min.js', array( 'jquery' ), SPTP_PLUGIN_VERSION, true );
		wp_register_script( 'simpleBarJS', SPTP_PLUGIN_ROOT . 'public/js/simplebar.min.js', array( 'jquery' ), SPTP_PLUGIN_VERSION, true );
		if ( $preloader ) {
			wp_enqueue_script( 'wptpro-preloader-js', SPTP_PLUGIN_ROOT . 'public/js/preloader.min.js', array( 'jquery' ), SPTP_PLUGIN_VERSION, true );
		}
		wp_register_script( SPTP_PLUGIN_NAME, SPTP_PLUGIN_ROOT . 'public/js/script.js', array( 'jquery', 'infiniteScroll' ), SPTP_PLUGIN_VERSION, true );

	}

}
