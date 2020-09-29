<?php 
/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
if ( ! function_exists( 'GS_Team' ) ) {

	function GS_Team() {
		$labels = array(
			'name'               => _x( 'Teams', 'gsteam' ),
			'singular_name'      => _x( 'Team', 'gsteam' ),
			'menu_name'          => _x( 'GS Team', 'admin menu', 'gsteam' ),
			'name_admin_bar'     => _x( 'GS Team', 'add new on admin bar', 'gsteam' ),
			'add_new'            => _x( 'Add New Member', 'team', 'gsteam' ),
			'add_new_item'       => __( 'Add New Member', 'gsteam' ),
			'new_item'           => __( 'New Team', 'gsteam' ),
			'edit_item'          => __( 'Edit Team', 'gsteam' ),
			'view_item'          => __( 'View Team', 'gsteam' ),
			'all_items'          => __( 'All Members', 'gsteam' ),
			'search_items'       => __( 'Search Members', 'gsteam' ),
			'parent_item_colon'  => __( 'Parent Teams:', 'gsteam' ),
			'not_found'          => __( 'No Teams found.', 'gsteam' ),
			'not_found_in_trash' => __( 'No Teams found in Trash.', 'gsteam' ),
		);

		$gs_teammembers_slug  = gs_team_getoption('gs_teammembers_slug', 'gs_team_adv_settings', 'team-members');

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $gs_teammembers_slug ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => GSTEAM_MENU_POSITION,
			'menu_icon'          => 'dashicons-image-filter',
			'supports'           => array( 'title', 'editor','thumbnail')
		);

		register_post_type( 'gs_team', $args );
	}
}

add_action( 'init', 'GS_Team' );

 // =============taxonomy==================
// if ( gtm_fs()->is__premium_only() or gtm_fs()->can_use_premium_code() ) {
	
	if ( ! function_exists( 'gs_team_group' ) ) {
	// Register Custom Taxonomy For Team
	function gs_team_group() {

		$labels = array(
			'name'                       => _x( 'Team Group', 'Taxonomy General Name', 'gsteam' ),
			'singular_name'              => _x( 'Team Group', 'Taxonomy Singular Name', 'gsteam' ),
			'menu_name'                  => __( 'Team Group', 'gsteam' ),
			'all_items'                  => __( 'All Team Group', 'gsteam' ),
			'parent_item'                => __( 'Parent Team Group', 'gsteam' ),
			'parent_item_colon'          => __( 'Parent Team Group:', 'gsteam' ),
			'new_item_name'              => __( 'New Team Group', 'gsteam' ),
			'add_new_item'               => __( 'Add New Team Group', 'gsteam' ),
			'edit_item'                  => __( 'Edit Team Group', 'gsteam' ),
			'update_item'                => __( 'Update Team Group', 'gsteam' ),
			'separate_items_with_commas' => __( 'Separate Team Group with commas', 'gsteam' ),
			'search_items'               => __( 'Search Team Group', 'gsteam' ),
			'add_or_remove_items'        => __( 'Add or remove Team Group', 'gsteam' ),
			'choose_from_most_used'      => __( 'Choose from the most used Team Groups', 'gsteam' ),
			'not_found'                  => __( 'Not Found', 'gsteam' ),
		);
		$rewrite = array(
			'slug'                       => 'gs-team-group',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'team_group', array( 'gs_team' ), $args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'gs_team_group', 0 );
	}

if ( gtm_fs()->is__premium_only() or gtm_fs()->can_use_premium_code() ) {

	// =============taxonomy Language==================
	if ( ! function_exists( 'gs_team_language' ) ) {

		// Register Custom Taxonomy For Team
		function gs_team_language() {

			$labels = array(
				'name'                       => _x( 'Language', 'Taxonomy General Name', 'gsteam' ),
				'singular_name'              => _x( 'Language', 'Taxonomy Singular Name', 'gsteam' ),
				'menu_name'                  => __( 'Language', 'gsteam' ),
				'all_items'                  => __( 'All Language', 'gsteam' ),
				'parent_item'                => __( 'Parent Language', 'gsteam' ),
				'parent_item_colon'          => __( 'Parent Language:', 'gsteam' ),
				'new_item_name'              => __( 'New Language', 'gsteam' ),
				'add_new_item'               => __( 'Add New Language', 'gsteam' ),
				'edit_item'                  => __( 'Edit Language', 'gsteam' ),
				'update_item'                => __( 'Update Language', 'gsteam' ),
				'separate_items_with_commas' => __( 'Separate Language with commas', 'gsteam' ),
				'search_items'               => __( 'Search Language', 'gsteam' ),
				'add_or_remove_items'        => __( 'Add or remove Language', 'gsteam' ),
				'choose_from_most_used'      => __( 'Choose from the most used Languages', 'gsteam' ),
				'not_found'                  => __( 'Not Found', 'gsteam' ),
			);
			$rewrite = array(
				'slug'                       => 'gs-team-language',
				'with_front'                 => true,
				'hierarchical'               => false,
			);
			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => false,
				'show_tagcloud'              => false,
				'rewrite'                    => $rewrite,
			);
			register_taxonomy( 'team_language', array( 'gs_team' ), $args );

		}

		// Hook into the 'init' action
		add_action( 'init', 'gs_team_language', 0 );
	}

	// =============taxonomy location==================
	if ( ! function_exists( 'gs_team_location' ) ) {

		// Register Custom Taxonomy For Team
		function gs_team_location() {

			$labels = array(
				'name'                       => _x( 'Location', 'Taxonomy General Name', 'gsteam' ),
				'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'gsteam' ),
				'menu_name'                  => __( 'Location', 'gsteam' ),
				'all_items'                  => __( 'All Location', 'gsteam' ),
				'parent_item'                => __( 'Parent Location', 'gsteam' ),
				'parent_item_colon'          => __( 'Parent Location:', 'gsteam' ),
				'new_item_name'              => __( 'New Location', 'gsteam' ),
				'add_new_item'               => __( 'Add New Location', 'gsteam' ),
				'edit_item'                  => __( 'Edit Location', 'gsteam' ),
				'update_item'                => __( 'Update Location', 'gsteam' ),
				'separate_items_with_commas' => __( 'Separate Location with commas', 'gsteam' ),
				'search_items'               => __( 'Search Location', 'gsteam' ),
				'add_or_remove_items'        => __( 'Add or remove Location', 'gsteam' ),
				'choose_from_most_used'      => __( 'Choose from the most used Locations', 'gsteam' ),
				'not_found'                  => __( 'Not Found', 'gsteam' ),
			);
			$rewrite = array(
				'slug'                       => 'gs-team-location',
				'with_front'                 => true,
				'hierarchical'               => false,
			);
			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => false,
				'show_tagcloud'              => false,
				'rewrite'                    => $rewrite,
			);
			register_taxonomy( 'team_location', array( 'gs_team' ), $args );

		}

		// Hook into the 'init' action
		add_action( 'init', 'gs_team_location', 0 );
	}

	// =============taxonomy gender==================
	if ( ! function_exists( 'gs_team_gender' ) ) {

		// Register Custom Taxonomy For Team
		function gs_team_gender() {

			$labels = array(
				'name'                       => _x( 'Gender', 'Taxonomy General Name', 'gsteam' ),
				'singular_name'              => _x( 'Gender', 'Taxonomy Singular Name', 'gsteam' ),
				'menu_name'                  => __( 'Gender', 'gsteam' ),
				'all_items'                  => __( 'All Gender', 'gsteam' ),
				'parent_item'                => __( 'Parent Gender', 'gsteam' ),
				'parent_item_colon'          => __( 'Parent Gender:', 'gsteam' ),
				'new_item_name'              => __( 'New Gender', 'gsteam' ),
				'add_new_item'               => __( 'Add New Gender', 'gsteam' ),
				'edit_item'                  => __( 'Edit Gender', 'gsteam' ),
				'update_item'                => __( 'Update Gender', 'gsteam' ),
				'separate_items_with_commas' => __( 'Separate Gender with commas', 'gsteam' ),
				'search_items'               => __( 'Search Gender', 'gsteam' ),
				'add_or_remove_items'        => __( 'Add or remove Gender', 'gsteam' ),
				'choose_from_most_used'      => __( 'Choose from the most used Locations', 'gsteam' ),
				'not_found'                  => __( 'Not Found', 'gsteam' ),
			);
			$rewrite = array(
				'slug'                       => 'gs-team-gender',
				'with_front'                 => true,
				'hierarchical'               => false,
			);
			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => false,
				'show_tagcloud'              => false,
				'rewrite'                    => $rewrite,
			);
			register_taxonomy( 'team_gender', array( 'gs_team' ), $args );

		}

		// Hook into the 'init' action
		add_action( 'init', 'gs_team_gender', 0 );
	}

	// =============taxonomy specialty==================
	if ( ! function_exists( 'gs_team_specialty' ) ) {

		// Register Custom Taxonomy For Team
		function gs_team_specialty() {

			$labels = array(
				'name'                       => _x( 'Specialty', 'Taxonomy General Name', 'gsteam' ),
				'singular_name'              => _x( 'Specialty', 'Taxonomy Singular Name', 'gsteam' ),
				'menu_name'                  => __( 'Specialty', 'gsteam' ),
				'all_items'                  => __( 'All specialty', 'gsteam' ),
				'parent_item'                => __( 'Parent specialty', 'gsteam' ),
				'parent_item_colon'          => __( 'Parent specialty:', 'gsteam' ),
				'new_item_name'              => __( 'New Specialty', 'gsteam' ),
				'add_new_item'               => __( 'Add New Specialty', 'gsteam' ),
				'edit_item'                  => __( 'Edit Specialty', 'gsteam' ),
				'update_item'                => __( 'Update specialty', 'gsteam' ),
				'separate_items_with_commas' => __( 'Separate specialty with commas', 'gsteam' ),
				'search_items'               => __( 'Search specialty', 'gsteam' ),
				'add_or_remove_items'        => __( 'Add or remove specialty', 'gsteam' ),
				'choose_from_most_used'      => __( 'Choose from the most used specialty', 'gsteam' ),
				'not_found'                  => __( 'Not Found', 'gsteam' ),
			);
			$rewrite = array(
				'slug'                       => 'gs-team-specialty',
				'with_front'                 => true,
				'hierarchical'               => false,
			);
			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => false,
				'show_tagcloud'              => false,
				'rewrite'                    => $rewrite,
			);
			register_taxonomy( 'team_specialty', array( 'gs_team' ), $args );

		}

		// Hook into the 'init' action
		add_action( 'init', 'gs_team_specialty', 0 );
	}
	
} // end gtm_fs
// }

// Register Theme Features (feature image for Team)
if ( ! function_exists('gs_team_theme_support') ) {

	function gs_team_theme_support()  {
		// Add theme support for Featured Images
		add_theme_support( 'post-thumbnails', array( 'gs_team' ) );
		add_theme_support( 'post-thumbnails', array( 'post' ) ); // Add it for posts
		add_theme_support( 'post-thumbnails', array( 'page' ) ); // Add it for pages
		add_theme_support( 'post-thumbnails', array( 'product' ) ); // Add it for products
		add_theme_support( 'post-thumbnails');
		// Add Shortcode support in text widget
		add_filter('widget_text', 'do_shortcode'); 
	}

	// Hook into the 'after_setup_theme' action
	add_action( 'after_setup_theme', 'gs_team_theme_support' );
}

