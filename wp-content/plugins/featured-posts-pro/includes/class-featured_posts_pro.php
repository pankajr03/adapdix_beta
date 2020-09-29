<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://lakshman.com.np
 * @since      1.0.0
 *
 * @package    Featured_Posts_Pro
 * @subpackage Featured_Posts_Pro/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Featured_Posts_Pro
 * @subpackage Featured_Posts_Pro/includes
 * @author     Laxman Thapa <thapa.laxman@gmail.com>
 */
class Featured_Posts_Pro {
    
    const ALLOWED_POSTS = 'featured_posts_pro_allowed_post_types';

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Featured_Posts_Pro_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
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
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'featured_posts_pro';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Featured_Posts_Pro_Loader. Orchestrates the hooks of the plugin.
	 * - Featured_Posts_Pro_i18n. Defines internationalization functionality.
	 * - Featured_Posts_Pro_Admin. Defines all hooks for the admin area.
	 * - Featured_Posts_Pro_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-featured_posts_pro-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-featured_posts_pro-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-featured_posts_pro-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-featured_posts_pro-public.php';
		
		
		/**
		 * The class responsible for the featured posts widget
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-featured_posts_pro-widget.php';

		$this->loader = new Featured_Posts_Pro_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Featured_Posts_Pro_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Featured_Posts_Pro_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Featured_Posts_Pro_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		//TODO improve this line
		if(!function_exists('wp_get_current_user')) {
		    include(ABSPATH . "wp-includes/pluggable.php");
		}
		if(current_user_can( 'edit_others_posts' )) {
    		//add meta box
    		$this->loader->add_action('add_meta_boxes', $plugin_admin, 'add_meta_boxes');
    		$this->loader->add_action('save_post', $plugin_admin, 'save_post_handler', 10, 2 );
    		
    		//list screen
    		//$this->loader->add_action('admin_head', $plugin_admin, 'posts_column_edit');
    		$this->loader->add_action('wp_ajax_featured_posts_pro_is_featured_post', $plugin_admin, 'toggle_featured_post'); //ajax handler
    		$this->loader->add_action('wp_ajax_featured_posts_pro_order', $plugin_admin, 'set_position'); //ajax handler
    		

            //$allowedPostTypes = (get_option('featured_posts_pro_allowed_post_types')) ? : array();
            $allowedPostTypes = self::getAllowedPostTypes();

            foreach ($allowedPostTypes as $allowedPostType){
                $this->loader->add_filter('manage_'.$allowedPostType.'_posts_columns', $plugin_admin, 'add_posts_columns');
                $this->loader->add_filter('manage_'.$allowedPostType.'_posts_custom_column', $plugin_admin, 'custom_columns_hander', 10, 2);
            }

    		//admin menu
    		//list featured posts
    		$this->loader->add_action('admin_menu', $plugin_admin, 'admin_menu');
    		//allow users to add custom posts
		}
		
		
		//widget
		$this->loader->add_action('widgets_init', $this, 'register_featured_widget');
	}
	
	public function register_featured_widget()
	{
	    register_widget('Featured_Posts_Pro_Widget');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Featured_Posts_Pro_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		//$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Featured_Posts_Pro_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
	
	
	public static function getAllowedPostTypes()
	{
	    $allowedPostTypes = get_option(self::ALLOWED_POSTS);
	    if($allowedPostTypes === false) $allowedPostTypes = array('post');
	    //var_dump($allowedPostTypes);
	    //die();
	    
	    //$allowedPostTypes = (get_option(self::ALLOWED_POSTS)) ? : array();
	    if(is_array($allowedPostTypes)){
	        asort($allowedPostTypes);
	    }else{
	        $allowedPostTypes = array();
	    }
	    return $allowedPostTypes;
	}
	
	
	public static function getFeaturedPosts($number=-1)
	{
	    $allowedPostTypes = self::getAllowedPostTypes();
	    $postArgs = array(
	        'post_type' => $allowedPostTypes,
	        'posts_per_page'      => $number,
	        'no_found_rows'       => true,
	        'post_status'         => 'publish',
	        'ignore_sticky_posts' => true,
	        'meta_query' => array(
	            array(
	                'relation' => 'OR',
	                array(
	                    'key' => 'post_featured_position',
	                    'compare' => 'EXISTS'
	                ),
	                array(
	                    'key' => 'post_featured_position',
	                    'compare' => 'NOT EXISTS'
	                ),
	            ),
	            array(
	                'relation' => 'AND',
	                'key' => 'is_post_featured',
	                'compare' => '=',
	                'value' => 1
	            )
	        ),
	        'orderby' => 'meta_value_num',
	        'order' => 'ASC',
	        //'meta_key' => 'post_featured_position'
	    ) ;
	    return new WP_Query( apply_filters( 'widget_posts_args', $postArgs) );
	}
	

}
