<?php

/**
 *
 * @package   GS_Team
 * @author    GS Plugins <samdani1997@gmail.com>
 * @license   GPL-2.0+
 * @link      https://gsplugins.com
 * @copyright 2016 GS Plugins
 *
 * @wordpress-plugin
 * Plugin Name:			GS Team Members
 * Plugin URI:			https://gsplugins.com/wordpress-plugins
 * Description:     Best Responsive Team member plugin for Wordpress to showcase member Image, Name, Designation, Social connectivity links. Display anywhere at your site using shortcode like [gs_team] or [gs_team theme="gs_tm_theme1"] & widgets. Check more shortcode examples and documentation at <a href="http://team.gsplugins.com">GS Team PRO Demos & Docs</a>
 * Version:         1.9.14
 * Author:       		GS Plugins
 * Author URI:      https://gsplugins.com
 * Text Domain:     gsteam
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 */
if ( !defined( 'GSTEAM_HACK_MSG' ) ) {
    define( 'GSTEAM_HACK_MSG', __( 'Sorry cowboy! This is not your place', 'gsteam' ) );
}
/**
 * Protect direct access
 */
if ( !defined( 'ABSPATH' ) ) {
    die( GSTEAM_HACK_MSG );
}
/**
 * Defining constants
 */
if ( !defined( 'GSTEAM_VERSION' ) ) {
    define( 'GSTEAM_VERSION', '1.9.14' );
}
if ( !defined( 'GSTEAM_MENU_POSITION' ) ) {
    define( 'GSTEAM_MENU_POSITION', 39 );
}
if ( !defined( 'GSTEAM_PLUGIN_DIR' ) ) {
    define( 'GSTEAM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
if ( !defined( 'GSTEAM_PLUGIN_URI' ) ) {
    define( 'GSTEAM_PLUGIN_URI', plugins_url( '', __FILE__ ) );
}
if ( !defined( 'GSTEAM_FILES_DIR' ) ) {
    define( 'GSTEAM_FILES_DIR', GSTEAM_PLUGIN_DIR . 'gsteam-files' );
}
if ( !defined( 'GSTEAM_FILES_URI' ) ) {
    define( 'GSTEAM_FILES_URI', GSTEAM_PLUGIN_URI . '/gsteam-files' );
}

if ( !function_exists( 'gtm_fs' ) ) {
    // Create a helper function for easy SDK access.
    function gtm_fs()
    {
        global  $gtm_fs ;
        
        if ( !isset( $gtm_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $gtm_fs = fs_dynamic_init( array(
                'id'              => '1851',
                'slug'            => 'gs-team-members',
                'type'            => 'plugin',
                'public_key'      => 'pk_e88759b9ba026403ad505a5877eac',
                'is_premium'      => false,
                'has_addons'      => false,
                'has_paid_plans'  => true,
                'trial'           => array(
                'days'               => 14,
                'is_require_payment' => true,
            ),
                'has_affiliation' => 'selected',
                'menu'            => array(
                'slug'    => 'edit.php?post_type=gs_team',
                'support' => false,
            ),
                'is_live'         => true,
            ) );
        }
        
        return $gtm_fs;
    }
    
    // Init Freemius.
    gtm_fs();
    // Signal that SDK was initiated.
    do_action( 'gtm_fs_loaded' );
}

// define('GSTEAM_PLUGIN_FILE', __FILE__ );
// $status  = get_option( 'GS_TEAM_LICENSE_STATUS' );
require_once GSTEAM_FILES_DIR . '/includes/gs-team-cpt.php';
require_once GSTEAM_FILES_DIR . '/includes/gs-team-meta-fields.php';
require_once GSTEAM_FILES_DIR . '/includes/gs-team-column.php';
require_once GSTEAM_FILES_DIR . '/includes/gs-team-shortcode.php';
// if( $status !== false && $status == 'valid' ) {

if ( gtm_fs()->is__premium_only() or gtm_fs()->can_use_premium_code() ) {
    require_once GSTEAM_FILES_DIR . '/includes/gs-team-widgets.php';
    require_once GSTEAM_FILES_DIR . '/includes/gs-team-sortable.php';
}

require_once GSTEAM_FILES_DIR . '/gs-teams-scripts.php';
require_once GSTEAM_FILES_DIR . '/admin/class.settings-api.php';
require_once GSTEAM_FILES_DIR . '/admin/gs_team_options_config.php';
// }
//require_once GSTEAM_FILES_DIR . '/lic/gs_team_lic.php';
require_once GSTEAM_FILES_DIR . '/gs-plugins/gs-plugins.php';
require_once GSTEAM_FILES_DIR . '/gs-plugins/gs-plugins-free.php';
require_once GSTEAM_FILES_DIR . '/gs-plugins/gs-team-help.php';

if ( !function_exists( 'gs_team_change_image_box' ) ) {
    function gs_team_change_image_box()
    {
        remove_meta_box( 'postimagediv', 'gs_team', 'side' );
        add_meta_box(
            'postimagediv',
            __( 'Team Member Image' ),
            'post_thumbnail_meta_box',
            'gs_team',
            'side',
            'low'
        );
    }
    
    add_action( 'do_meta_boxes', 'gs_team_change_image_box' );
}

function gs_team_img_size_note( $content )
{
    global  $post_type, $post ;
    if ( $post_type == 'gs_team' ) {
        if ( !has_post_thumbnail( $post->ID ) ) {
            $content .= '<p>' . __( 'Recommended image size 400px X 400px for perfect view on various devices.', 'gsteam' ) . '</p>';
        }
    }
    return $content;
}

add_filter( 'admin_post_thumbnail_html', 'gs_team_img_size_note' );

if ( gtm_fs()->is__premium_only() or gtm_fs()->can_use_premium_code() ) {
    
    if ( !function_exists( 'gs_team_single_template' ) ) {
        function gs_team_single_template( $single_team_template )
        {
            global  $post ;
            if ( $post->post_type == 'gs_team' ) {
                $single_team_template = GSTEAM_FILES_DIR . '/includes/templates/single-team.php';
            }
            return $single_team_template;
        }
        
        add_filter( 'single_template', 'gs_team_single_template' );
    }
    
    
    if ( !function_exists( 'gs_team_archive_template' ) ) {
        function gs_team_archive_template( $archive_template )
        {
            global  $post ;
            if ( is_post_type_archive( 'gs_team' ) ) {
                $archive_template = GSTEAM_FILES_DIR . '/includes/templates/gs-team-archive.php';
            }
            return $archive_template;
        }
        
        add_filter( 'archive_template', 'gs_team_archive_template' );
    }

}


if ( !function_exists( 'gs_team_pro_link' ) ) {
    function gs_team_pro_link( $gsTeam_links )
    {
        $gsTeam_links[] = '<a href="https://gsplugins.com/wordpress-plugins" target="_blank">GS Plugins</a>';
        return $gsTeam_links;
    }
    
    add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'gs_team_pro_link' );
}

// MCE button

if ( gtm_fs()->is__premium_only() or gtm_fs()->can_use_premium_code() ) {
    add_action( 'init', 'GSTEAM_buttons' );
    function GSTEAM_buttons()
    {
        add_filter( "mce_external_plugins", "GSTEAM_add_buttons" );
        add_filter( 'mce_buttons', 'GSTEAM_register_buttons' );
    }
    
    function GSTEAM_add_buttons( $plugin_array )
    {
        $plugin_array['GSTEAM_mce_button'] = GSTEAM_FILES_URI . '/admin/js/gsteam-mce.js';
        return $plugin_array;
    }
    
    function GSTEAM_register_buttons( $buttons )
    {
        array_push( $buttons, 'GSTEAM_mce_button' );
        return $buttons;
    }

}

/**
 * Dropdown Builder
 * @since   1.0
 */
function selectbuilder(
    $name,
    $options,
    $selected = "",
    $selecttext = "",
    $class = "",
    $optionvalue = 'value'
)
{
    
    if ( is_array( $options ) ) {
        $select_html = "<select name=\"{$name}\" id=\"{$name}\" class=\"{$class}\">";
        if ( $selecttext ) {
            $select_html .= '<option value="">' . $selecttext . '</option>';
        }
        foreach ( $options as $key => $option ) {
            
            if ( $optionvalue == 'value' ) {
                $value = $option;
            } else {
                $value = $key;
            }
            
            $select_html .= "<option value=\"{$value}\"";
            if ( $value == $selected ) {
                $select_html .= ' selected="selected"';
            }
            $select_html .= ">{$option}</option>\n";
        }
        $select_html .= '</select>';
        echo  $select_html ;
    } else {
    }

}


if ( gtm_fs()->is__premium_only() or gtm_fs()->can_use_premium_code() ) {
    /**
     * Visual composer integration
     * @since   1.0
     */
    add_action( 'vc_before_init', 'gsteam_integrateWithVC' );
    function gsteam_integrateWithVC()
    {
        vc_map( array(
            "name"     => __( "GS Team Members", "gsteam" ),
            "base"     => "gs_team",
            "class"    => "",
            "category" => __( "GS Plugins", "gsteam" ),
            "params"   => array(
            array(
            "type"        => "textfield",
            "holder"      => "div",
            "class"       => "",
            "heading"     => __( "Number Of Member", "gsteam" ),
            "param_name"  => "num",
            "value"       => 10,
            'admin_label' => true,
        ),
            array(
            'type'       => 'dropdown',
            'heading'    => __( 'Select Theme', "gsteam" ),
            'param_name' => 'theme',
            'value'      => array(
            'Grid 1 (Hover)'                   => 'gs_tm_theme1',
            'Grid 2 (Tooltip)'                 => 'gs_tm_grid2',
            'Grid 3 (Static)'                  => 'gs_tm_theme20',
            'Circle 1 (Hover)'                 => 'gs_tm_theme2',
            'Horizontal 1 (Square Right Info)' => 'gs_tm_theme3',
            'Horizontal 2 (Square Left Info)'  => 'gs_tm_theme4',
            'Horizontal 3 (Circle Right Info)' => 'gs_tm_theme5',
            'Horizontal 4 (Circle Left Info)'  => 'gs_tm_theme6',
            'Drawer 1 (3 cols)'                => 'gs_tm_theme13',
            'Drawer 2 (4 cols)'                => 'gs_tm_drawer2',
            'Table 1 (Underline)'              => 'gs_tm_theme14',
            'Table 2 (Box Border)'             => 'gs_tm_theme15',
            'Table 3 (Odd Even)'               => 'gs_tm_theme16',
            'List 1 (Square Right Info)'       => 'gs_tm_theme17',
            'List 2 (Square Left Info)'        => 'gs_tm_theme18',
            'Slider 1 (Hover)'                 => 'gs_tm_theme7',
            'Popup 1'                          => 'gs_tm_theme8',
            'To Single'                        => 'gs_tm_theme11',
            'Filter 1 (Hover & Pop)'           => 'gs_tm_theme9',
            'Filter 2 (Selected Cats)'         => 'gs_tm_theme12',
            'Panel Slide'                      => 'gs_tm_theme19',
            'Gray 1 (Square)'                  => 'gs_tm_theme10',
        ),
            'std'        => 'gs_tm_theme1',
        ),
            array(
            'type'       => 'dropdown',
            'heading'    => __( 'Select column', "gsteam" ),
            'param_name' => 'cols',
            'value'      => array(
            '4 Columns' => '3',
            '2 Columns' => '6',
            '3 Columns' => '4',
        ),
            'std'        => '3',
        ),
            array(
            'type'       => 'dropdown',
            'heading'    => __( 'Category Name Show/Hide', "gsteam" ),
            'param_name' => 'cats_name',
            'value'      => array(
            'None'    => 'none',
            'Initial' => 'initial',
        ),
            'std'        => 'none',
        ),
            array(
            'type'       => 'dropdown',
            'heading'    => __( 'Order', "gsteam" ),
            'param_name' => 'order',
            'value'      => array(
            'DESC' => 'DESC',
            'ASC'  => 'ASC',
        ),
            'std'        => 'none',
        ),
            array(
            'type'       => 'dropdown',
            'heading'    => __( 'Order By', "gsteam" ),
            'param_name' => 'orderby',
            'value'      => array(
            'Date'     => 'date',
            'ID'       => 'ID',
            'Title'    => 'title',
            'Modified' => 'modified',
            'Random'   => 'rand',
        ),
            'std'        => 'date',
        ),
            array(
            "type"       => "textfield",
            "holder"     => "div",
            "class"      => "",
            "heading"    => __( "Team Gruop", "gsteam" ),
            "param_name" => "group",
            "value"      => __( " ", "gsteam" ),
        )
        ),
        ) );
    }

}


if ( gtm_fs()->is__premium_only() or gtm_fs()->can_use_premium_code() ) {
    /**
     * Main Elementor GS Team Extension Class
     *
     * The main class that initiates and runs the plugin.
     *
     * @since 1.9.9
     */
    final class Elementor_GS_Team_Extension
    {
        /**
         * Plugin Version
         *
         * @since 1.9.9
         *
         * @var string The plugin version.
         */
        const  VERSION = '1.9.9' ;
        /**
         * Instance
         *
         * @since 1.9.9
         *
         * @access private
         * @static
         *
         * @var Elementor_GS_Team_Extension The single instance of the class.
         */
        private static  $_instance = null ;
        /**
         * Instance
         *
         * Ensures only one instance of the class is loaded or can be loaded.
         *
         * @since 1.9.9
         *
         * @access public
         * @static
         *
         * @return Elementor_GS_Team_Extension An instance of the class.
         */
        public static function instance()
        {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        
        /**
         * Constructor
         *
         * @since 1.9.9
         *
         * @access public
         */
        public function __construct()
        {
            add_action( 'init', [ $this, 'i18n' ] );
            add_action( 'plugins_loaded', [ $this, 'init' ] );
        }
        
        /**
         * Load Textdomain
         *
         * Load plugin localization files.
         *
         * Fired by `init` action hook.
         *
         * @since 1.9.9
         *
         * @access public
         */
        public function i18n()
        {
            load_plugin_textdomain( 'gsteam' );
        }
        
        /**
         * Initialize the plugin
         *
         * Load the plugin only after Elementor (and other plugins) are loaded.
         * Checks for basic plugin requirements, if one check fail don't continue,
         * if all check have passed load the files required to run the plugin.
         *
         * Fired by `plugins_loaded` action hook.
         *
         * @since 1.9.9
         *
         * @access public
         */
        public function init()
        {
            // Add Plugin actions
            add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
        }
        
        /**
         * Init Widgets
         *
         * Include widgets files and register them
         *
         * @since 1.9.9
         *
         * @access public
         */
        public function init_widgets()
        {
            // Include Widget files
            require_once __DIR__ . '/gsteam-files/includes/gs-team-elementor-widget.php';
            // Register widget
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_GsTeam_Widget() );
        }
    
    }
    Elementor_GS_Team_Extension::instance();
}

function gs_pagination()
{
    $output = '<div class="row clearfix">';
    // start row
    
    if ( get_query_var( 'paged' ) ) {
        $gs_tm_paged = get_query_var( 'paged' );
    } else {
        $gs_tm_paged = get_query_var( 'page' );
    }
    
    $gsbig = 999999999;
    // need an unlikely integer
    $output .= '<div class="col-md-12 gs-pagination">';
    $output .= paginate_links( array(
        'base'    => str_replace( $gsbig, '%#%', esc_url( get_pagenum_link( $gsbig ) ) ),
        'format'  => '?paged=%#%',
        'current' => max( 1, $gs_tm_paged ),
        'total'   => $GLOBALS['gs_team_loop']->max_num_pages,
    ) );
    $output .= '</div>';
    $output .= '</div>';
    // end row
    return $output;
}

function gs_team_lite_usage_admin_script()
{
    $media = 'all';
    wp_register_style(
        'gs_free_plugins_css',
        GSTEAM_FILES_URI . '/admin/css/gs_free_plugins.css',
        '',
        GSTEAM_VERSION,
        $media
    );
    wp_enqueue_style( 'gs_free_plugins_css' );
}

add_action( 'admin_enqueue_scripts', 'gs_team_lite_usage_admin_script' );

if ( gtm_fs()->is_free_plan() ) {
    // if ( ! gtm_fs()->is__premium_only() ) {
    add_action( 'admin_footer', 'gs_select_theme_premium_disabled' );
    function gs_select_theme_premium_disabled()
    {
        ?>
    <script>
      (function( $ ) {
        $(function() {
        
        $(document).ready(function() {
          $(".gs_team_wrap select option:nth-child(n+7)").attr("disabled","disabled");
        });
      });
      })(jQuery);
    </script>;

    <?php 
        echo  '
    <style type="text/css" media="screen">
      div#gs_team_style_settings {
        position: relative;
      }
      .gs_team_wrap .description {
        display: inline-block;
        margin-left: 20px;
        font-size: 13px;
      }
    </style>' ;
    }

}

function gs_team_Plugin_activate()
{
    GS_Team();
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'gs_team_Plugin_activate' );

if ( gtm_fs()->is__premium_only() or gtm_fs()->can_use_premium_code() ) {
    if ( !function_exists( 'gsteam_location' ) ) {
        function gsteam_location()
        {
            global  $post ;
            
            if ( !empty(get_the_terms( $post->ID, 'team_location' )) ) {
                $terms = get_the_terms( $post->ID, 'team_location' );
                
                if ( $terms && !is_wp_error( $terms ) ) {
                    $gs_team_cats_link = array();
                    foreach ( $terms as $term ) {
                        $gs_team_cats_link[] = $term->name;
                    }
                    // $gs_team_cats_link = str_replace(' ', '-', $gs_team_cats_link);
                    $gs_team_cats = join( ", ", $gs_team_cats_link );
                    // $gs_team_cats = strtolower($gs_team_cats);
                }
                
                return $gs_team_cats;
            }
        
        }
    
    }
    if ( !function_exists( 'gsteam_language' ) ) {
        function gsteam_language()
        {
            global  $post ;
            
            if ( !empty(get_the_terms( $post->ID, 'team_language' )) ) {
                $terms = get_the_terms( $post->ID, 'team_language' );
                
                if ( $terms && !is_wp_error( $terms ) ) {
                    $gs_team_cats_link = array();
                    foreach ( $terms as $term ) {
                        $gs_team_cats_link[] = $term->name;
                    }
                    $gs_team_cats_link = str_replace( ' ', '-', $gs_team_cats_link );
                    $gs_team_cats = join( ", ", $gs_team_cats_link );
                }
                
                return $gs_team_cats;
            }
        
        }
    
    }
    if ( !function_exists( 'gsteam_specialty' ) ) {
        function gsteam_specialty()
        {
            global  $post ;
            
            if ( !empty(get_the_terms( $post->ID, 'team_specialty' )) ) {
                $terms = get_the_terms( $post->ID, 'team_specialty' );
                
                if ( $terms && !is_wp_error( $terms ) ) {
                    $gs_team_cats_link = array();
                    foreach ( $terms as $term ) {
                        $gs_team_cats_link[] = $term->name;
                    }
                    // $gs_team_cats_link = str_replace(' ', '-', $gs_team_cats_link);
                    $gs_team_cats = join( ", ", $gs_team_cats_link );
                }
                
                return $gs_team_cats;
            }
        
        }
    
    }
}

function GS_flush_rewrite_rules()
{
    GS_Team();
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'GS_flush_rewrite_rules' );