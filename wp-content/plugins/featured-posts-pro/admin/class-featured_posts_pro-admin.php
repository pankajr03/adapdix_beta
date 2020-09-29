<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://lakshman.com.np
 * @since      1.0.0
 *
 * @package    Featured_Posts_Pro
 * @subpackage Featured_Posts_Pro/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Featured_Posts_Pro
 * @subpackage Featured_Posts_Pro/admin
 * @author     Laxman Thapa <thapa.laxman@gmail.com>
 */
class Featured_Posts_Pro_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Featured_Posts_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Featured_Posts_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
	    global $pagenow;
	    if($pagenow == 'edit.php' 
	        || 
	        ($pagenow == 'admin.php' && ($_GET['page'] == 'featured_posts_pro_list' || $_GET['page'] == 'featured_posts_pro_post_type'))
	        ){
            wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/featured_posts_pro-admin.css', array(), $this->version, 'all' );
            wp_enqueue_style( $this->plugin_name.'-fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css', $this->version, 'all' );
            
            
            if(isset($_GET['page']) && $_GET['page'] == 'featured_posts_pro_list'){
                wp_enqueue_style( $this->plugin_name.'-jquery-ui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui-1.12.1.custom/jquery-ui.min.css', array(), $this->version, 'all' );
                wp_enqueue_style( $this->plugin_name.'-jquery-ui-theme', plugin_dir_url( __FILE__ ) . 'css/jquery-ui-1.12.1.custom/jquery-ui.theme.min.css', array(), $this->version, 'all' );
            }
	    }

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Featured_Posts_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Featured_Posts_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
	    global $pagenow;
	    if($pagenow == 'edit.php' || ($pagenow == 'admin.php' && $_GET['page'] == 'featured_posts_pro_list')){
            if(isset($_GET['page']) && $_GET['page'] == 'featured_posts_pro_list'){
                wp_enqueue_script( $this->plugin_name.'-jquery-ui', plugin_dir_url( __FILE__ ) . 'js/jquery-ui-1.12.1.custom/jquery-ui.min.js', '', $this->version, false );
            }
            wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/featured_posts_pro-admin.js', array( 'jquery' ), $this->version, false );
	    }

	}
	
	
	public function add_meta_boxes()
	{
	 
	    $allowedPostTypes = Featured_Posts_Pro::getAllowedPostTypes();
	    if($allowedPostTypes){
            add_meta_box('featured_custom_post', __('Featured Posts', $this->plugin_name), array($this, 'add_meta_box_handler'), $allowedPostTypes, 'side' ,'low');
	    }
	}
	
	/**
	 * Build custom field meta box
	 * @param Post $post The post object
	 */
	public function add_meta_box_handler($post)
	{
	    wp_nonce_field(basename(__FILE__), $this->plugin_name.'_nounce');
	    $isFeatured = get_post_meta($post->ID, 'is_post_featured', true);
	    ?>
	    <div class='inside'>
	    	<p>
	    		<label class="selectit">
	    			<input value='1' type="checkbox" name="is_post_featured" <?php checked($isFeatured, true) ?>> <?php _e('set featured', $this->plugin_name); ?>
	    		</label>
	    	</p>
	    </div>
	    <?php
	}
	
	public function save_post_handler($post_id)
	{
	    // return if autosave
	    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
	        return;
	    }
	    
	    // verify meta box nonce
	    if(!isset($_POST[$this->plugin_name.'_nounce']) || !wp_verify_nonce($_POST[$this->plugin_name.'_nounce'], basename(__FILE__))){
	        return;
	    }
	    
	    if(isset($_REQUEST['is_post_featured'])){
	        update_post_meta($post_id, 'is_post_featured', 1);
	    }else{
	        delete_post_meta($post_id, 'is_post_featured');
	    }
	}
	
	public function custom_columns_hander($column, $post_id)
	{
		//var_dump($column);
		if($column != 'is_featured') return;
	    $isFeatured = get_post_meta($post_id, 'is_post_featured', true);
	    ?>
		<input value='1' data-id='<?php echo $post_id; ?>' type="checkbox" name="is_post_featured" <?php checked($isFeatured, true) ?>>
		<?php
	}
	
	public function add_posts_columns($defaults)
	{
	    $defaults['is_featured'] = 'Featured Post';
	    return $defaults;
	}
	
	/*
	public function posts_column_edit()
	{
	    global $pagenow;
	    if($pagenow != 'edit.php') return;
	    //if(is_numeric(strpos($_SERVER['REQUEST_URI'], '/edit.php'))){ }
	}
	*/
	
	/**
	 * ajax handler
	 */
	public function toggle_featured_post()
	//public function posts_column_edit_handler()
	{
	    $post_id = (int) ((isset($_POST['post_id'])) ? $_POST['post_id'] : '');
	    if(!$post_id) return;
	    
	    if(isset($_POST['is_post_featured']) && $_POST['is_post_featured'] == '1'){
	        update_post_meta($post_id, 'is_post_featured', 1);
	    }else{
	        delete_post_meta($post_id, 'is_post_featured');
	    }
	    wp_send_json_success();
	}
	
	/**
	 * ajax handler for the posts position
	 */
	public function set_position()
	{
	    
	    $post_ids = ((isset($_GET['post_ids'])) ? $_GET['post_ids'] : '');
	    $post_ids = explode(',', $post_ids);
	    if(!$post_ids) return;
	        
	    //$post_ids = array_map($post_ids, 'int');
	    $post_ids = array_filter($post_ids, 'is_numeric');
	    $counter = 1;
	    foreach ($post_ids as $post_id){
	        update_post_meta($post_id, 'post_featured_position', $counter);
	        $counter++;
	    }
	}
	
	
	//admin_menu
	public function admin_menu()
	{
        $menuSlug = $this->plugin_name.'_list';
	    add_menu_page( 'Featured Posts Pro', 'Featured Posts List', 'manage_options', $menuSlug, [$this, 'pageFeaturedPostsList']);
	    add_submenu_page($menuSlug, 'Select Custom Posts', 'Select Custom Posts', 'manage_options', $this->plugin_name.'_post_type', [$this, 'pageFeaturedPostCustom']);
	}
	
	public function pageFeaturedPostsList()
	{
	    $featuredPosts = Featured_Posts_Pro::getFeaturedPosts();
	    include __DIR__.'/partials/featured_posts_pro-admin-display.php';
	}


	
	public function pageFeaturedPostCustom()
	{
		$showMessage = false;
	    $args = array('public'   => true,'_builtin' => false);
	    $postTypes = array_keys(get_post_types($args));
	    array_push($postTypes, 'post');
	    array_push($postTypes, 'page');

		asort($postTypes);
	    
	    //get custom post types for featured posts
	    //$allowedPostTypes = (get_option('featured_posts_pro_allowed_post_types')) ? : array();
		$allowedPostTypes = Featured_Posts_Pro::getAllowedPostTypes();

		if(isset($_POST['save-featured-posts-posttypes'])){
			$submittedPostTypes = $_POST['is_post_featured'];
			if(!is_array($submittedPostTypes)){
			    $submittedPostTypes = array();
			}
			
			asort($submittedPostTypes);

			$allowedPostTypes = array_intersect($postTypes, $submittedPostTypes);
			//update_option('featured_posts_pro_allowed_post_types', $allowedPostTypes);
			update_option(Featured_Posts_Pro::ALLOWED_POSTS, $allowedPostTypes);
			$showMessage = true;
		}
	    
	    include __DIR__.'/partials/featured_posts_pro-admin-display-custom-post.php';
	}
	
	
	
	
	
}










