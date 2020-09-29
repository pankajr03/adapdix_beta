<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @since        2.0.0
 * @version      2.0.0
 *
 * @package    WP_Team
 * @subpackage WP_Team/admin
 * @author     ShapedPlugin<support@shapedplugin.com>
 */

class WP_Team_Admin {

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
	 * All setting option.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $sptp_option
	 */
	private $sptp_options;

	/**
	 * Rename member name.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $sptp_member_name
	 */
	private $sptp_member_name;

	/**
	 * Rename team name.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $sptp_team_name
	 */
	private $sptp_team_name;

	/**
	 * Rename group name.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $sptp_group_name
	 */
	private $sptp_group_name;

	/**
	 * Rename team slug.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $sptp_team_slug
	 */
	private $sptp_team_slug;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		// Autoloading system.
		spl_autoload_register( array( $this, 'autoload' ) );

		$this->sptp_options              = get_option( '_sptp_settings' );
		$this->sptp_member_singular_name = ( ! empty( $this->sptp_options['rename_member_singular'] ) ) ? $this->sptp_options['rename_member_singular'] : __( 'Member', 'wp-team' );
		$this->sptp_member_plural_name   = ( ! empty( $this->sptp_options['rename_member_plural'] ) ) ? $this->sptp_options['rename_member_plural'] : __( 'Members', 'wp-team' );
		$this->sptp_group_singular_name  = ( ! empty( $this->sptp_options['rename_group_singular'] ) ) ? $this->sptp_options['rename_group_singular'] : __( 'Group', 'wp-team' );
		$this->sptp_group_plural_name    = ( ! empty( $this->sptp_options['rename_group_plural'] ) ) ? $this->sptp_options['rename_group_plural'] : __( 'Groups', 'wp-team' );
		$this->sptp_team_name            = ( ! empty( $this->sptp_options['rename_team'] ) ) ? $this->sptp_options['rename_team'] : __( 'Team', 'wp-team' );

		SPTP_Member::metaboxes( 'sptp_member', '_sptp_add_member', $this->sptp_member_singular_name );
		SPTP_Settings::metaboxes( '_sptp_settings' );
		SPTP_Generator::layout_metaboxes( '_sptp_generator_layout' );
		SPTP_Generator::metaboxes( '_sptp_generator' );
		SPTP_Generator::output_metaboxes( '_sptp_generator_output' );
	}

	/**
	 * Autoload class files on demand
	 *
	 * @param string $class requested class name.
	 * @since 2.0.0
	 */
	private function autoload( $class ) {
		$name = explode( '_', $class );
		if ( isset( $name[1] ) ) {
			$class_name        = strtolower( $name[1] );
			$spto_config_paths = array( 'partials/', 'partials/section/settings/', 'partials/section/generator/' );
			foreach ( $spto_config_paths as $sptp_path ) {
				$filename = plugin_dir_path( __FILE__ ) . '/' . $sptp_path . 'class-wp-team-' . $class_name . '.php';
				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, SPT_PLUGIN_ROOT . 'admin/css/admin.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'font-awesome', SPT_PLUGIN_ROOT . 'public/css/font-awesome.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/team-admin.js', array( 'jquery' ), $this->version, true );
	}

	/**
	 * Custom Image Size functionality.
	 *
	 * @since 2.0.0
	 *
	 * @param int $post_ID generator id.
	 * @param int $post_after generator post after publish.
	 * @param int $post_before generator post before publish.
	 */
	public function custom_image_size( $post_ID, $post_after, $post_before ) {
		$post_type = get_post_type( $post_ID );
		if ( 'sptp_generator' === $post_type ) {
			$all_meta   = get_post_meta( $post_ID, '_sptp_generator', true );
			$image_size = isset( $all_meta['image_size'] ) ? $all_meta['image_size'] : '';

			if ( 'custom' === $image_size ) {
				$custom_image_size   = isset( $all_meta['custom_image_option'] ) ? $all_meta['custom_image_option'] : '';
				$custom_image_width  = isset( $custom_image_size['custom_image_width'] ) ? $custom_image_size['custom_image_width'] : '';
				$custom_image_height = isset( $custom_image_size['custom_image_height'] ) ? $custom_image_size['custom_image_height'] : '';
				$custom_image_crop   = isset( $custom_image_size['custom_image_crop'] ) && ( 1 === $custom_image_size['custom_image_crop'] ) ? 'true' : 'false';
				$query               = new WP_Query(
					array(
						'post_type'      => 'sptp_member',
						'posts_per_page' => -1,
						'fields'         => 'ids',
					)
				);
				$image_query         = new WP_Query(
					array(
						'post_type'       => 'attachment',
						'post_status'     => 'inherit',
						'post_mime_type'  => 'image',
						'posts_per_page'  => -1,
						'post_parent__in' => $query->posts,
						'order'           => 'DESC',
					)
				);
				$filesname           = [];
				foreach ( $image_query->posts as $key => $media ) {
					$filesname[] = $media->guid;

					$filename = $media->guid;

					sptp_image_resize( $filename, $custom_image_width, $custom_image_height, $custom_image_crop );
				}
			}
		}
	}

	/**
	 * Register the widget for the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function register_wpteam_widget( $widget ) {
		register_widget( 'WP_Team_Widget' );
		return $widget;
	}

	/**
	 * Register member post type from Team Pro plugin
	 *
	 * @since    2.0.0
	 */
	public function sptp_member_post_type() {
		$labels = array(
			'name'                  => wp_sprintf( ( esc_html( 'All %s', 'wp-team' ) ), $this->sptp_member_plural_name ),
			'singular_name'         => wp_sprintf( ( esc_html( '%1$1s %2$2s', 'wp-team' ) ), $this->sptp_team_name, $this->sptp_member_singular_name ),
			'add_new'               => wp_sprintf( esc_html( 'Add New %s', 'wp-team' ), $this->sptp_member_singular_name ),
			'add_new_item'          => wp_sprintf( esc_html( 'Add New %s', 'wp-team' ), $this->sptp_member_singular_name ),
			'edit_item'             => wp_sprintf( esc_html( 'Edit %s', 'wp-team' ), $this->sptp_member_singular_name ),
			'new_item'              => wp_sprintf( esc_html( 'New %s', 'wp-team' ), $this->sptp_member_singular_name ),
			'all_items'             => wp_sprintf( esc_html( 'All %s', 'wp-team' ), $this->sptp_member_plural_name ),
			'view_item'             => wp_sprintf( esc_html( 'View %s', 'wp-team' ), $this->sptp_member_singular_name ),
			'search_items'          => wp_sprintf( esc_html( 'Search %s', 'wp-team' ), $this->sptp_member_singular_name ),
			'not_found'             => wp_sprintf( esc_html( 'No %1$1s %2$2s Found', 'wp-team' ), $this->sptp_team_name, $this->sptp_member_singular_name ),
			'not_found_in_trash'    => wp_sprintf( esc_html( 'No %1$1s %2$2s Found in Trash', 'wp-team' ), $this->sptp_team_name, $this->sptp_member_singular_name ),
			'parent_item_colon'     => null,
			'menu_name'             => __( 'WP Team', 'wp-team' ),
			'featured_image'        => wp_sprintf( esc_html( '%s Image', 'wp-team' ), $this->sptp_member_singular_name ),
			'set_featured_image'    => wp_sprintf( esc_html( 'Set %s image', 'wp-team' ), $this->sptp_member_singular_name ),
			'remove_featured_image' => wp_sprintf( esc_html( 'Remove %s image', 'wp-team' ), $this->sptp_member_singular_name ),
		);
		// Base 64 encoded SVG image.
		$menu_icon = 'data:image/svg+xml;base64,' . base64_encode(
			'<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="256px" height="256px" viewBox="0 0 256 256" enable-background="new 0 0 256 256" xml:space="preserve">  <image id="image0" width="256" height="256" x="0" y="0" href="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNy4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzAwcHgiIGhlaWdodD0iMzAwcHgiIHZpZXdCb3g9IjAgMCAzMDAgMzAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAzMDAgMzAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxwYXRoIGZpbGw9IiM3MUIyODAiIGQ9Ik0xMzAuOCwxOTMuNWwtMC4zLDEuMmwtMjAuMSw2Yy01LjcsMS44LTEyLjMsMTguNi0xNy40LDQ1YzE3LjEsMTAuMiwzNi45LDE1LjYsNTcsMTUuNg0KCQljMi40LDAsNS4xLDAsNy41LTAuM2MxNy40LTEuMiwzNC44LTYuMyw0OS44LTE1LjNjLTUuMS0yNi4xLTExLjctNDMuNS0xNy40LTQ1bC0yMC4xLTZsLTAuMy0xLjJjLTAuMy0wLjktMC45LTEuOC0yLjEtMi40DQoJCWwtMi40LTEuNWwxLjUtMS44YzEuOC0xLjgsMy0zLjYsMy42LTQuOGMyLjQtMy4zLDQuMi02LjksNS40LTEwLjVjMC42LTEuNSwxLjItMywxLjgtNC41bDAuMy0wLjZsMC42LTAuM2MxLjUtMS4yLDIuMS0yLjcsMi4xLTQuNQ0KCQl2LTZjMC0xLjItMC4zLTIuNC0xLjItMy42bC0wLjMtMC42di05YzAtMTMuNS0xMS4xLTI0LjYtMjQuNi0yNC42aC04LjdjLTEzLjUsMC0yNC42LDExLjEtMjQuNiwyNC42djlsLTAuMywwLjYNCgkJYy0wLjYsMC45LTEuMiwyLjQtMS4yLDMuNnY2YzAsMS44LDAuOSwzLjYsMi4xLDQuNWwwLjYsMC4zbDAuMywwLjZjMC4zLDEuNSwwLjksMywxLjUsNC4yYzEuNSwzLjYsMy4zLDcuMiw1LjcsMTAuNQ0KCQljMS4yLDEuOCwyLjQsMy4zLDMuNiw0LjhsMS41LDEuOGwtMi4xLDEuNUMxMzIsMTkyLDEzMS4xLDE5Mi42LDEzMC44LDE5My41eiIvPg0KCTxwYXRoIGZpbGw9IiM3MUIyODAiIGQ9Ik04Mi44LDIzOS4xYzAuNi0zLjMsMS41LTYuNiwyLjQtMTAuMmM3LjUtMzAuOSwxNS4zLTM2LjksMjEuOS0zOWwxMS40LTMuM2MtMS44LTMtMy42LTYuMy00LjgtOS42DQoJCWMtMC4zLTAuOS0wLjktMi4xLTEuMi0zbDAsMGwtMTIuMy0zLjZsLTAuMy0xLjJjLTAuMy0wLjktMC45LTEuOC0yLjEtMi40bC0yLjEtMS44bDEuNS0xLjhjMS4yLTEuNSwyLjQtMywzLjYtNC44DQoJCWMyLjQtMy4zLDQuMi02LjksNS40LTEwLjJjMC42LTEuNSwxLjItMywxLjgtNC41bDAuMy0wLjZsMC42LTAuM2MxLjUtMS4yLDIuMS0yLjcsMi4xLTQuNXYtNmMwLTEuMi0wLjMtMi40LTEuMi0zLjZsLTAuMy0wLjZ2LTkNCgkJYzAtMTMuNS0xMS4xLTI0LjYtMjQuNi0yNC42aC04LjdjLTEzLjUsMC0yNC42LDExLjEtMjQuNiwyNC42djlsLTAuMywwLjZjLTAuNiwwLjktMS4yLDIuNC0xLjIsMy42djZjMCwxLjgsMC45LDMuNiwyLjEsNC41DQoJCWwwLjYsMC4zbDAuMywwLjZjMC4zLDEuNSwwLjksMywxLjgsNC4yYzEuNSwzLjYsMy4zLDcuMiw1LjcsMTAuNWMxLjIsMS44LDIuNCwzLjMsMy42LDQuOGwxLjUsMS44bC0yLjEsMS41DQoJCWMtMS4yLDAuOS0xLjgsMS41LTIuMSwyLjRsLTAuMywxLjJsLTIwLjEsNmgtMC4zQzQ3LjEsMjAxLjMsNjIuMSwyMjMuNSw4Mi44LDIzOS4xeiIvPg0KCTxwYXRoIGZpbGw9IiM3MUIyODAiIGQ9Ik0yMjMuNSw5NC4yaC04LjdjLTEzLjUsMC0yNC42LDExLjEtMjQuNiwyNC42djlsLTAuMywwLjZjLTAuNiwxLjItMC45LDIuNC0wLjksMy42djYNCgkJYzAsMS44LDAuOSwzLjYsMi4xLDQuNWwwLjYsMC4zbDAuMywwLjZjMC42LDEuNSwwLjksMywxLjUsNC4yYzEuNSwzLjYsMy4zLDcuMiw1LjcsMTAuNWMwLjksMS4yLDIuMSwzLDMuNiw0LjhsMS41LDEuOGwtMi4xLDEuNQ0KCQljLTEuMiwwLjktMS44LDEuNS0yLjEsMi40bC0wLjMsMS4ybC0xMi4zLDMuNmwwLDBjLTAuMywxLjItMC45LDIuMS0xLjIsMy4zYy0xLjIsMy0zLDYuMy00LjgsOS42bDExLjQsMy4zDQoJCWM2LjYsMS44LDE0LjQsOC4xLDIxLjksMzguNGMwLjksMy42LDEuOCw3LjIsMi40LDEwLjhjNi4zLTQuOCwxMi4zLTEwLjIsMTcuNC0xNi4yYzExLjctMTMuNSwyMC40LTI5LjcsMjQuNi00Ni44aC0wLjNsLTIwLjEtNg0KCQlsLTAuMy0xLjJjLTAuMy0wLjktMC45LTEuOC0yLjEtMi40bC0yLjEtMS4ybDEuOC0xLjhjMS4yLTEuNSwyLjQtMywzLjYtNC44YzIuNC0zLjMsNC4yLTYuOSw1LjQtMTAuMmMwLjYtMS41LDEuMi0zLDEuOC00LjUNCgkJbDAuMy0wLjZsMC42LTAuM2MxLjUtMS4yLDIuMS0yLjcsMi4xLTQuNXYtNmMwLTEuMi0wLjMtMi40LTEuMi0zLjZsLTAuMy0wLjZ2LTlDMjQ4LjEsMTA1LjMsMjM3LjMsOTQuMiwyMjMuNSw5NC4yeiIvPg0KCTxwYXRoIGZpbGw9IiM3MUIyODAiIGQ9Ik03NS4zLDUyLjVMNjYsNTIuMkM4OS40LDMyLjEsMTE5LjEsMjEsMTUwLDIxczYwLjYsMTEuMSw4NCwzMS4ybC05LjMsMC4zbDUuNyw1LjRsMTMuMi0wLjZMMjQzLDQ0LjQNCgkJbC01LjctNS40bDAuMyw5LjNDMjEzLjMsMjcsMTgyLjQsMTUuNiwxNTAsMTUuNlM4Ni43LDI3LDYyLjQsNDhsMC4zLTkuM0w1Nyw0NC40bC0wLjYsMTMuMmwxMy4yLDAuNkw3NS4zLDUyLjV6Ii8+DQoJPHBhdGggZmlsbD0iIzcxQjI4MCIgZD0iTTI3MS4yLDkwLjNsLTYuNiwzLjNjOC43LDE3LjcsMTMuMiwzNi42LDEzLjIsNTYuMWMwLDcwLjUtNTcuMywxMjcuOC0xMjcuOCwxMjcuOFMyMi4yLDIyMC4yLDIyLjIsMTQ5LjcNCgkJYzAtMTkuNSw0LjUtMzguNCwxMy4yLTU2LjFsLTYuNi0zLjNDMTkuNSwxMDkuMiwxNSwxMjksMTUsMTQ5LjRjMCw3NC40LDYwLjYsMTM1LDEzNSwxMzVzMTM1LTYwLjYsMTM1LTEzNQ0KCQlDMjg1LDEyOSwyODAuNSwxMDkuMiwyNzEuMiw5MC4zeiIvPg0KPC9nPg0KPC9zdmc+DQo=" /></svg>'
		);

		register_post_type(
			'sptp_member',
			array(
				'labels'          => $labels,
				'public'          => true,
				'has_archive'     => false,
				'capability_type' => 'post',
				'supports'        => array( 'title', 'editor', 'thumbnail' ),
				'rewrite'         => false,
				'menu_icon'       => $menu_icon,
				'menu_position'   => 80,
			)
		);

	}

	/**
	 * Register sptp_generator custom post type
	 *
	 * @since    2.0.0
	 */
	public function sptp_generator_post_type() {
		$labels = array(
			'name'               => __( 'All Teams', 'wp-team' ),
			'singular_name'      => __( 'Team', 'wp-team' ),
			'add_new'            => __( 'Add New Team', 'wp-team' ),
			'add_new_item'       => __( 'Add New Team', 'wp-team' ),
			'edit_item'          => __( 'Edit Team', 'wp-team' ),
			'new_item'           => __( 'New Generator', 'wp-team' ),
			/* translators: %s is replaced with 'Singular team name' */
			'all_items'          => wp_sprintf( __( '%s Generator', 'wp-team' ), $this->sptp_team_name ),
			'view_item'          => __( 'View Generator', 'wp-team' ),
			'search_items'       => __( 'Search Generator', 'wp-team' ),
			'not_found'          => __( 'No Generator Found', 'wp-team' ),
			'not_found_in_trash' => __( 'No Generator Found in Trash', 'wp-team' ),
			'parent_item_colon'  => null,
			/* translators: %s is replaced with 'Singular team name' */
			'menu_name'          => wp_sprintf( __( '%s Generator', 'wp-team' ), $this->sptp_team_name ),
		);
		register_post_type(
			'sptp_generator',
			array(
				'labels'              => $labels,
				'has_archive'         => true,
				'capability_type'     => 'post',
				'supports'            => array( 'title' ),
				'rewrite'             => array( 'slug' => 'generator' ),
				'show_in_menu'        => 'edit.php?post_type=sptp_member',
				'public'              => false,
				'publicly_queryable'  => false,
				'show_ui'             => true,
				'exclude_from_search' => true,
				'show_in_nav_menus'   => false,
				'has_archive'         => false,
				'rewrite'             => false,
				'show_in_rest'        => true,
			)
		);
	}

	public function sptp_single_member_template( $single ) {
		global $post;

		if ( 'sptp_member' === $post->post_type ) {
			$single = SPT_PLUGIN_ROOT . 'public/sptp_member_template.php';
		}
		return $single;
	}

	/**
	 * Remove slug on sptp_member post type.
	 *
	 * @since        2.0.0
	 */
	public function sptp_member_add_meta_boxes() {
		remove_meta_box( 'slugdiv', 'sptp_member', 'normal' );
	}

	/**
	 * Admin help page
	 *
	 * @since    2.0.0
	 */
	public function sptp_help_admin_submenu() {
		add_submenu_page(
			'edit.php?post_type=sptp_member',
			__( 'Help', 'wp-team' ),
			__( 'Help', 'wp-team' ),
			'manage_options',
			'team_help',
			array( $this, 'sptp_help_callback' )
		);
	}

	/**
	 * Admin help callback function
	 *
	 * @since    2.0.0
	 */
	public function sptp_help_callback() {
		?>
		<div class="wrap about-wrap sp-sptp-help">
			<h1><?php esc_html_e( 'Welcome to WP Team!', 'wp-team' ); ?></h1>
			<p class="about-text"><span class="text">
			<?php
			esc_html_e( 'Thank you for installing WP Team! You\'re now running the most popular Team Showcase plugin. This video will help you get started with the plugin.', 'wp-team' );
			?>
				</span><span class="help-badge"></span></p>
			<hr>
			<div class="headline-feature feature-video">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/ix7iyS0Fms4" frameborder="0" allowfullscreen></iframe>
			</div>
			<hr>
			<div class="feature-section three-col">
				<div class="col">
					<div class="sp-sptp-feature sp-sptp-text-center">
						<i class="sp-font fa fa-life-ring"></i>
						<h3><?php esc_html_e( 'Need any Assistance?', 'wp-team' ); ?></h3>
						<p><?php esc_html_e( 'Our Expert Support Team is always ready to help you out promptly.', 'wp-team' ); ?></p>
						<a href="https://shapedplugin.com/support-forum/" target="_blank" class="button button-primary"><?php esc_html_e( 'Contact Support', 'wp-team' ); ?></a>
					</div>
				</div>
				<div class="col">
					<div class="sp-sptp-feature sp-sptp-text-center">
						<i class="sp-font fa fa-file-text" aria-hidden="true"></i>
						<h3><?php esc_html_e( 'Looking for Documentation?', 'wp-team' ); ?></h3>
						<p><?php esc_html_e( 'We have detailed documentation on every aspect of WP Team.', 'wp-team' ); ?></p>
						<a href="https://shapedplugin.com/docs/docs/wp-team/" target="_blank" class="button button-primary"><?php esc_html_e( 'Documentation', 'wp-team' ); ?></a>
					</div>
				</div>
				<div class="col">
					<div class="sp-sptp-feature sp-sptp-text-center">
						<i class="sp-font fa fa-heart" aria-hidden="true"></i>
						<h3><?php esc_html_e( 'Love This Plugin?', 'wp-team' ); ?></h3>
						<p><?php esc_html_e( 'If you love WP Team, please leave us a 5 star rating.', 'wp-team' ); ?></p>
						<a href="https://wordpress.org/plugins/team-free/#reviews" target="_blank" class="button button-primary"><?php esc_html_e( 'Rate the Plugin', 'wp-team' ); ?></a>
					</div>
				</div>
			</div>

		</div>
		<?php
	}

	/**
	 * Rename member columns for WP Team plugin.
	 *
	 * @since    2.0.0
	 * @param  mixed $columns columns of all member page.
	 */
	public function set_member_columns( $columns ) {
		return array(
			'cb'       => '<input type="checkbox" />',
			'title'    => __( 'Name', 'wp-team' ),
			'position' => __( 'Position', 'wp-team' ),
			'image'    => __( 'Image', 'wp-team' ),
		);
	}
	/**
	 * Get data in member columns for WP Team plugin.
	 *
	 * @since    2.0.0
	 * @param  mixed   $column columns of all member page.
	 * @param integer $post_id post id of member.
	 */
	public function get_member_columns( $column, $post_id ) {

		$member_info = get_post_meta( $post_id, '_sptp_add_member', true );
		if ( is_array( $member_info ) ) {
			if ( has_post_thumbnail( $post_id ) ) {
				$image_url = get_the_post_thumbnail_url( $post_id, 'thumbnail' );
			} else {
				$image_url = isset( $member_info['member_image_gallery'] ) ? wp_get_attachment_url( $member_info['member_image_gallery'] ) : '';
			}
			$feature_image = '<img src="' . $image_url . '" class="list-image"/>';
			switch ( $column ) {
				case 'position':
					echo isset( $member_info['sptp_job_title'] ) ? esc_html( $member_info['sptp_job_title'] ) : '';
					break;
				case 'image':
					echo wp_kses(
						$feature_image,
						array(
							'img' => array(
								'src'   => array(),
								'class' => array(),
							),
						)
					);
					break;
				default:
					break;
			}
		}
	}
	/**
	 * Rename columns in all team page for WP Team plugin.
	 *
	 * @since    2.0.0
	 * @param  mixed $columns columns of all team page.
	 */
	public function set_generator_columns( $columns ) {
		return array(
			'cb'        => '<input type="checkbox" />',
			'title'     => __( 'Name', 'wp-team' ),
			'shortcode' => __( 'Shortcode', 'wp-team' ),
			'layout'    => __( 'Layout', 'wp-team' ),
			'date'      => __( 'Date', 'wp-team' ),
		);
	}
	/**
	 * Get generator columns
	 *
	 * @since    2.0.0
	 * @param  mixed   $column columns of all team page.
	 * @param integer $post_id post id of team.
	 */
	public function get_generator_columns( $column, $post_id ) {

		$team_layout = get_post_meta( $post_id, '_sptp_generator_layout', true );
		switch ( $column ) {
			case 'shortcode':
				echo "<input style='width: 230px; padding: 6px;' readonly='readonly' type='text' onclick='this.select()' value='";
				echo '[wpteam id="' . esc_html( $post_id ) . '"]';
				echo "'/>";
				break;
			case 'layout':
				echo isset( $team_layout['layout_preset'] ) ? $team_layout['layout_preset'] : '';
				break;
			default:
				echo '';
		}

	}
	/**
	 * 'Member Name' from 'Enter Title Here'
	 *
	 * @since    2.0.0
	 * @param mixed $input post type input.
	 */
	public function member_name( $input ) {
		if ( 'sptp_member' === get_post_type() ) {
			return wp_sprintf( '%s Name', $this->sptp_member_name );
		}
		return $input;
	}

	public function hide_publishing_actions() {
		$sptp_post_type = 'sptp_generator';
		global $post;
		if ( $post->post_type == $sptp_post_type ) {
		}
	}

	/**
	 * Bottom review notice.
	 *
	 * @param string $text The review notice.
	 * @return string
	 */
	public function sptp_review_text( $text ) {
		$screen = get_current_screen();
		if ( ( 'sptp_member' === get_post_type() ) || ( 'sptp_member_page_team_help' === $screen->id ) || ( 'sptp_member_page_team_settings' === $screen->id ) || ( 'sptp_generator' === get_post_type() ) || ( 'edit-sptp_group' === $screen->id ) ) {
			$url  = 'https://wordpress.org/support/plugin/team-free/reviews/?filter=5#new-post';
			$text = sprintf( __( 'If you like <strong>WP Team</strong>, please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'wp-team' ), $url );
		}

		return $text;
	}

	/**
	 * Custom post type Save and update alert in Admin Dashboard created by WP Team
	 *
	 * @param array $messages alert messages.
	 */
	public function sptp_update( $messages ) {
		global $post, $post_ID;
		$messages['sptp_generator'][1] = __( 'Team Updated', 'wp-team' );
		$messages['sptp_generator'][6] = __( 'Team Published', 'wp-team' );
		/* translators: %s is replaced with respective permalink */
		$messages['sptp_member'][1] = wp_sprintf( __( 'Member Updated. <a href="%s">View Member</a>', 'wp-team' ), esc_url( get_permalink( $post_ID ) ) );
		/* translators: %s is replaced with respective permalink */
		$messages['sptp_member'][6] = wp_sprintf( __( 'Member Published. <a href="%s">View Member</a>', 'wp-team' ), esc_url( get_permalink( $post_ID ) ) );
		return $messages;
	}

	public function sptp_current_screen( $current_screen ) {
		$current_post = $current_screen->post_type;
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) && ( 'sptp_member' !== $current_post ) ) {
			add_action( 'admin_print_footer_scripts', array( $this, 'sptp_quicktag_text' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'sptp_quicktag_view' ) );
		}
	}

	/**
	 * WP Team quicktag in text for classic editor
	 */
	public function sptp_quicktag_text() {
		if ( wp_script_is( 'quicktags' ) ) {
			$team_arr   = get_posts(
				array(
					'post_type'      => 'sptp_generator',
					'posts_per_page' => -1,
				)
			);
			$team       = [];
			$team_id    = [];
			$team_title = [];
			foreach ( $team_arr as $team ) {
				$team_id[]    = $team->ID;
				$team_title[] = $team->post_title;
			}
			$team = array_combine( $team_id, $team_title );
			?>
			<script>
			function team_list() {
			var data = <?php echo json_encode( $team ); ?>;
			var s = $('<select />');
			s.attr('id','my-shortcodes');
			for(var val in data) {
				$('<option />', {value: val, text: data[val]}).appendTo(s);
			}

			$('#qt_content_sptp_quicktag')[0].outerHTML = s[0].outerHTML;

			$('#my-shortcodes').on('change', function(){
				var sc = '[wpteam id="' + $(this).val() + '"]';
				QTags.insertContent(sc);
			});
			}
			QTags.addButton( 'sptp_quicktag', 'Team', team_list, '', '', 'Team created with WP Team', 9999 );
			</script>
			<?php
		}
	}

	/**
	 * WP Team quicktag in view for classic editor
	 */
	public function sptp_quicktag_view( $hook ) {
		if ( 'true' === get_user_option( 'rich_editing' ) && ( 'post.php' === $hook || 'post-new.php' === $hook ) ) {
			add_action( 'admin_head', array( $this, 'sptp_team_tinymce' ) );
			add_filter( 'mce_external_plugins', array( $this, 'sptp_team_tinymce_button' ) );
			add_filter( 'mce_buttons', array( $this, 'sptp_team_tinymce_register' ) );
		}
	}

	public function sptp_team_tinymce_button( $plugin_array ) {
		$plugin_array['sptp_tinymce_button'] = SPT_PLUGIN_ROOT . '/admin/js/tinymce.js';
		return $plugin_array;
	}

	public function sptp_team_tinymce_register( $buttons ) {
		array_push( $buttons, 'sptp_tinymce_button' );
		return $buttons;
	}

	public function sptp_team_tinymce() {
		$posts_array = get_posts(
			array(
				'post_type'      => 'sptp_generator',
				'posts_per_page' => -1,
			)
		);
		$posts       = wp_list_pluck( $posts_array, 'post_title', 'ID' );
		?>
		<script>
			var posts = <?php echo wp_json_encode( $posts ); ?>;
		</script>
		<?php
	}

	/**
	 * Redirect to help page after activation.
	 *
	 * @param string $plugin_admin Path to the plugin file, relative to the plugin.
	 * @return void
	 */
	public function redirect_to_help( $plugin_admin ) {
		if ( SPT_PLUGIN_BASENAME === $plugin_admin ) {
			exit( esc_url( wp_safe_redirect( admin_url( 'edit.php?post_type=sptp_member&page=team_help' ) ) ) );
		}
	}
}
