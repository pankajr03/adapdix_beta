<?php
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      2.0.0
 * @package   WP_Team
 * @subpackage WP_Team/includes
 * @author     ShapedPlugin <support@shapedplugin.com>
 */

class WP_Team {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      WP_Team_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function __construct() {

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$active_plugins = get_option( 'active_plugins' );
		foreach ( $active_plugins as $active_plugin ) {
			$_temp = strpos( $active_plugin, 'team-free.php' );
			if ( $_temp != false ) {
				add_filter( 'plugin_action_links_' . $active_plugin, array( $this, 'add_generator_links' ) );
			}
		}
		add_theme_support( 'post-thumbnails' );
	}

	/**
	 * Create team link at plugins bottom.
	 *
	 * @since 2.0.0
	 * @param string $links links probived by WordPress.
	 */
	public function add_generator_links( $links ) {
		$mylinks = array(
			'<a href="' . admin_url( 'post-new.php?post_type=sptp_generator' ) . '">' . __( 'Create Team', 'wp-team' ) . '</a>',
		);
		$links[] = '<a href="https://shapedplugin.com/plugin/wp-team-pro/" style="color: #35b747; font-weight: 700;">' . __( 'Go Premium!', 'wp-team' ) . '</a>';
		return array_merge( $mylinks, $links );
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Team_Pro_Loader. Orchestrates the hooks of the plugin.
	 * - Team_Pro_i18n. Defines internationalization functionality.
	 * - Team_Pro_Admin. Defines all hooks for the admin area.
	 * - Team_Pro_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    2.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-team-loader.php';
		/**
		 * The class responsible for premium tab.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-team-premium.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-team-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-team-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-team-public.php';

		$this->loader = new WP_Team_Loader();

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/shapedplugin-framework/classes/setup.class.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/shapedplugin-framework/classes/options.class.php';

		/**
		 * The class responsible for image resize functionality
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/class-wp-team-widget.php';

		/**
		 * The class responsible for admin notice functionality
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/notices/review.php';
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the WP_Team_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new WP_Team_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin         = new WP_Team_Admin( SPT_PLUGIN_NAME, SPT_PLUGIN_VERSION );
		$plugin_review_notice = new WP_Team_Review( SPT_PLUGIN_NAME, SPT_PLUGIN_VERSION );
		$plugin_premium       = new WP_Team_Premium( SPT_PLUGIN_NAME, SPT_PLUGIN_VERSION );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_print_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_admin, 'sptp_member_post_type' );
		$this->loader->add_action( 'init', $plugin_admin, 'sptp_generator_post_type' );
		$this->loader->add_action( 'admin_menu', $plugin_premium, 'premium_page', 100 );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'sptp_help_admin_submenu', 100 );
		$this->loader->add_action( 'admin_head-post.php', $plugin_admin, 'hide_publishing_actions' );
		$this->loader->add_action( 'admin_head-post-new.php', $plugin_admin, 'hide_publishing_actions' );
		$this->loader->add_action( 'manage_sptp_member_posts_custom_column', $plugin_admin, 'get_member_columns', 10, 2 );
		$this->loader->add_action( 'manage_sptp_generator_posts_custom_column', $plugin_admin, 'get_generator_columns', 10, 2 );
		$this->loader->add_action( 'post_updated', $plugin_admin, 'custom_image_size', 10, 3 );
		$this->loader->add_action( 'admin_head', $plugin_admin, 'sptp_member_add_meta_boxes' );
		$this->loader->add_action( 'current_screen', $plugin_admin, 'sptp_current_screen' );
		$this->loader->add_action( 'widgets_init', $plugin_admin, 'register_wpteam_widget' );
		$this->loader->add_action( 'activated_plugin', $plugin_admin, 'redirect_to_help', 10, 2 );

		$this->loader->add_filter( 'manage_sptp_member_posts_columns', $plugin_admin, 'set_member_columns' );
		$this->loader->add_filter( 'manage_sptp_generator_posts_columns', $plugin_admin, 'set_generator_columns' );
		$this->loader->add_filter( 'enter_title_here', $plugin_admin, 'member_name' );
		$this->loader->add_filter( 'admin_footer_text', $plugin_admin, 'sptp_review_text', 10, 2 );
		$this->loader->add_filter( 'post_updated_messages', $plugin_admin, 'sptp_update', 10, 1 );

		$this->loader->add_action( 'admin_notices', $plugin_review_notice, 'display_admin_notice' );
		$this->loader->add_action( 'wp_ajax_sp-wpt-never-show-review-notice', $plugin_review_notice, 'dismiss_review_notice' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new WP_Team_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    2.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     2.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     2.0.0
	 * @return    WP_Team_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     2.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
