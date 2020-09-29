<?php 
// ============== Displaying Additional Columns ===============

if ( ! function_exists('gs_team_screen_columns') ) {
    add_filter( 'manage_edit-gs_team_columns', 'gs_team_screen_columns' );

    function gs_team_screen_columns( $columns ) {
        unset( $columns['date'] );
        unset( $columns['taxonomy-team_group'] );
        $columns['title'] = 'Member Name';
        $columns['gsteam_featured_image'] = 'Member Image';
        $columns['_gs_des'] = 'Designation';
        $columns['taxonomy-team_group'] = 'Team Group';
        $columns['date'] = 'Date';
        return $columns;
    }
}

// GET FEATURED IMAGE
if ( ! function_exists('gs_team_featured_image') ) {
    function gs_team_featured_image($post_ID) {
        $post_thumbnail_id = get_post_thumbnail_id($post_ID);
        if ($post_thumbnail_id) {
            $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id);
            return $post_thumbnail_img[0];
        }
    }
}

if ( ! function_exists('gs_team_columns_content') ) {
    add_action('manage_posts_custom_column', 'gs_team_columns_content', 10, 2);
    // SHOW THE FEATURED IMAGE
    function gs_team_columns_content($column_name, $post_ID) {
        if ($column_name == 'gsteam_featured_image') {
            $post_featured_image = gs_team_featured_image($post_ID);
            if ($post_featured_image) {
                echo '<img src="' . $post_featured_image . '" width="34"/>';
            }
        }
    }
}

//Populating the Columns
if ( ! function_exists('gs_team_populate_columns') ) {
    
    add_action( 'manage_posts_custom_column', 'gs_team_populate_columns' );

    function gs_team_populate_columns( $column ) {
        if ( '_gs_des' == $column ) {
            $tm_m_desig = get_post_meta( get_the_ID(), '_gs_des', true );
            echo $tm_m_desig;
        }
    }
}

// Columns as Sortable
if ( ! function_exists('gs_team_sort') ) {
    add_filter( 'manage_edit-gs_team_sortable_columns', 'gs_team_sort' );

    function gs_team_sort( $columns ) {
        $columns['taxonomy-team_group'] = 'taxonomy-team_group';
        return $columns;
    }
}