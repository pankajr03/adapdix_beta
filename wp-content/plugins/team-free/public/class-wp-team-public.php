<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    WP_Team
 * @subpackage WP_Team/public
 * @author     ShapedPlugin <info@shapedplugin.com>
 */
class WP_Team_Public {

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
	 * @var      integer    $generator_id    Generator ID of team.
	 */
	private $generator_id;
	/**
	 * @since    2.0.0
	 * @access private
	 * @var mixed Settings
	 */
	private $settings;
	/**
	 * @since    2.0.0
	 * @access private
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
		print_r( $_POST['members'] );
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
	 * @version 2.0.0
	 * @access public
	 */
	public function thumbnail_click_function() {
		if ( ! wp_verify_nonce( wp_unslash( $_POST['nonce'] ), 'sptp-thumbnail' ) ) {
			return false;
		}
		wp_die();
	}

	/**
	 * Allowed html.
	 *
	 * @since 2.0.0
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
	 * @since 2.0.0
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
	 * @since 2.0.0
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

			$layout_preset = isset( $layout['layout_preset'] ) ? $layout['layout_preset'] : 'carousel';
			if ( ! empty( $layout_preset ) ) {
				switch ( $layout_preset ) {
					case 'carousel':
						if ( $sptp_swiper_css ) {
							wp_enqueue_style( 'swiper' );
						}
						if ( $sptp_swiper_js ) {
							wp_enqueue_script( 'swiper' );
						}
						include 'partials/carousel.php';
						break;
					case 'grid':
						if ( $sptp_swiper_css ) {
							wp_enqueue_style( 'swiper' );
						}
						if ( $sptp_swiper_js ) {
							wp_enqueue_script( 'swiper' );
						}
						include 'partials/grid.php';
						break;
					case 'list':
						if ( $sptp_swiper_css ) {
							wp_enqueue_style( 'swiper' );
						}
						if ( $sptp_swiper_js ) {
							wp_enqueue_script( 'swiper' );
						}
						include 'partials/list.php';
						break;
					default:
						return false;
				}
			}

			if ( $sptp_fontawesome ) {
				wp_enqueue_style( 'fontawesome' );
			}
			wp_enqueue_style( 'custom-style' );
			wp_add_inline_style( 'custom-style', $sptp_custom_css );
			wp_enqueue_script( 'main-js', SPT_PLUGIN_ROOT . 'public/js/custom.js', array(), '1.0', true );
			wp_add_inline_script( 'main-js', $sptp_custom_js );
			// wp_enqueue_style( SPT_PLUGIN_NAME );
			wp_enqueue_script( SPT_PLUGIN_NAME );
			return ob_get_clean();
		}
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    2.0.0
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
		wp_register_style( 'fontawesome', SPT_PLUGIN_ROOT . 'public/css/font-awesome.min.css', array(), SPT_PLUGIN_VERSION, 'all' );
		wp_register_style( 'swiper', SPT_PLUGIN_ROOT . 'public/css/swiper.min.css', array(), SPT_PLUGIN_VERSION, 'all' );
		wp_enqueue_style( SPT_PLUGIN_NAME, SPT_PLUGIN_ROOT . 'public/css/public.min.css', array(), SPT_PLUGIN_VERSION, 'all' );
		wp_register_style( 'custom-style', SPT_PLUGIN_ROOT . 'public/css/custom.css', array(), SPT_PLUGIN_VERSION, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {
		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Team_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Team_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_script( 'swiper', SPT_PLUGIN_ROOT . 'public/js/swiper.min.js', array(), SPT_PLUGIN_VERSION, true );
		wp_register_script( SPT_PLUGIN_NAME, SPT_PLUGIN_ROOT . 'public/js/script.js', array( 'jquery' ), SPT_PLUGIN_VERSION, true );

	}

}
