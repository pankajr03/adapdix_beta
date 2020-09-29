<?php
/**
 * This page shows the procedural or functional example
 * OOP way example is given on the main plugin file.
 * @author Tareq Hasan <tareq@weDevs.com>
 */
 
/**
 * WordPress settings API demo class
 * @author Tareq Hasan
 */

 
if ( !class_exists('GS_team_Settings_Config' ) ):
class GS_team_Settings_Config {

    private $settings_api;

    function __construct() {
        $this->settings_api = new GS_Team_WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
	
		add_submenu_page( 'edit.php?post_type=gs_team', 'Team Settings', 'Team Settings', 'delete_posts', 'team-settings', array($this, 'plugin_page'));
        if ( gtm_fs()->is_not_paying() && !( gtm_fs()->is_trial() ) ) {

          add_submenu_page( 'edit.php?post_type=gs_team', 'Free Pro Trial', 'Free Pro Trial', 'delete_posts', gtm_fs()->get_trial_url()); 
        } 
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' 	=> 'gs_team_settings',
                'title' => __( 'GS Team Settings', 'gsteam' )
            ),
            array(
                'id'    => 'gs_team_style_settings',
                'title' => __( 'Style Settings', 'gsteam' )
            ),
            array(
                'id'    => 'gs_team_adv_settings',
                'title' => __( 'Advanced Settings', 'gsteam' )
            ),
            array(
                'id'    => 'gs_team_level_settings',
                'title' => __( 'Localization', 'gsteam' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'gs_team_settings' => array(
                // Columns
                array(
                    'name'      => 'gs_team_cols',
                    'label'     => __( 'Columns', 'gsteam' ),
                    'desc'      => __( 'Select number of Team columns', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => '3',
                    'options'   => array(
                        '6'    => '2 Columns',
                        '4'    => '3 Columns',
                        '3'    => '4 Columns'
                    )
                ),
                // teams theme
                array(
                    'name'  => 'gs_team_theme',
                    'label' => __( 'Style & Theming', 'gsteam' ),
                    'desc'  => __( 'Select preffered Style & Theme', 'gsteam' ),
                    'type'  => 'select',
                    'default'   => 'gs_tm_theme1',
                    'options'   => array(
                        'gs_tm_theme1'   => 'Grid 1 (Hover) - Free',
                        'gs_tm_theme2'   => 'Circle 1 (Hover) - Free',
                        'gs_tm_theme3'   => 'Horizontal 1 (Square Right Info) - Free',
                        'gs_tm_theme4'   => 'Horizontal 2 (Square Left Info) - Free',
                        'gs_tm_theme5'   => 'Horizontal 3 (Circle Right Info) - Free',
                        'gs_tm_theme6'   => 'Horizontal 4 (Circle Left Info) - Free',
                        'gs_tm_grid2'    => 'Grid 2 (Tooltip) - Pro',
                        'gs_tm_theme20'  => 'Grid 3 (Static) - Pro',
                        'gs_tm_theme23'  => 'Flip - Pro',
                        'gs_tm_theme13'  => 'Drawer 1 (3 cols) - Pro',
                        'gs_tm_drawer2'  => 'Drawer 2 (4 cols) - Pro',
                        'gs_tm_theme14'  => 'Table 1 (Underline) - Pro',
                        'gs_tm_theme15'  => 'Table 2 (Box Border) - Pro',
                        'gs_tm_theme16'  => 'Table 3 (Odd Even) - Pro',
                        'gs_tm_theme21'  => 'Table & Filter - Pro',
                        'gs_tm_theme22'  => 'Filter Grid & To Single - Pro',
                        'gs_tm_theme17'  => 'List 1 (Square Right Info) - Pro',
                        'gs_tm_theme18'  => 'List 2 (Square Left Info) - Pro',
                        'gs_tm_theme7'   => 'Slider 1 (Hover) - Pro',
                        'gs_tm_theme8'   => 'Popup 1 - Pro',
                        'gs_tm_theme11'  => 'To Single - Pro',
                        'gs_tm_theme9'   => 'Filter 1 (Hover & Pop) - Pro',
                        'gs_tm_theme12'  => 'Filter 2 (Selected Cats) - Pro',
                        'gs_tm_theme19'  => 'Panel Slide - Pro',
                        'gs_tm_theme10'  => 'Gray 1 (Square) - Pro'
                    )
                ),
                // Team Member Name
                array(
                    'name'      => 'gs_member_name',
                    'label'     => __( 'Member Name', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Team Member Name', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Team Member Designation
                array(
                    'name'      => 'gs_member_role',
                    'label'     => __( 'Member Designation', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Team Member Designation', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Team Member Details
                array(
                    'name'      => 'gs_member_details',
                    'label'     => __( 'Member Details', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Team Member Details', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Team Member Social Connection
                array(
                    'name'      => 'gs_member_connect',
                    'label'     => __( 'Social Connection', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Team Member Social Connections', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Team Member number Pagination
                array(
                    'name'      => 'gs_member_pagination',
                    'label'     => __( 'Pagination', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Team Member paginations', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // Team Member Next / Prev Link
                array(
                    'name'      => 'gs_member_nxt_prev',
                    'label'     => __( 'Next / Prev Member', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Next / Prev Member link at Single Team Template', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                 // Team Member Instant Search
                array(
                    'name'      => 'gs_member_srch_by_name',
                    'label'     => __( 'Instant Search by Name', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Instant Search, applicable for theme 9', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                 // Team Member Instant Search
                array(
                    'name'      => 'gs_member_filter_by_desig',
                    'label'     => __( 'Filter by Designation', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Filter by Designation, applicable for theme 9', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                array(
                    'name'      => 'gs_member_filter_by_Location',
                    'label'     => __( 'Filter by Location', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Filter by Location, applicable for theme 9', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                array(
                    'name'      => 'gs_member_filter_by_language',
                    'label'     => __( 'Filter by Language', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Filter by Language, applicable for theme 9', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                array(
                    'name'      => 'gs_member_filter_by_gender',
                    'label'     => __( 'Filter by Gender', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Filter by gender, applicable for theme 9', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                array(
                    'name'      => 'gs_member_filter_by_speciality',
                    'label'     => __( 'Filter by speciality', 'gsteam' ),
                    'desc'      => __( 'Show or Hide Filter by speciality, applicable for theme 9', 'gsteam' ),
                    'type'      => 'switch',
                    'switch_default' => 'ON'
                ),
                // single team breadcrumb
                // array(
                //     'name'      => 'gs_member_breadcrumb',
                //     'label'     => __( 'Single Page Breadcrumb', 'gsteam' ),
                //     'desc'      => __( 'Show or Hide single page breadcrumb', 'gsteam' ),
                //     'type'      => 'switch',
                //     'switch_default' => 'on'
                // ),
                // Clickable Logos
                array(
                    'name'      => 'gs_tm_link_tar',
                    'label'     => __( 'Social Link Target', 'gsteam' ),
                    'desc'      => __( 'Specify target to load the Links, Default New Tab ', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => '_blank',
                    'options'   => array(
                        '_blank'    => 'New Tab',
                        '_self'     => 'Same Window'
                    )
                ),
                // Title char limit
                array(
                    'name'  => 'gs_tm_details_contl',
                    'label' => __( 'Details Control', 'gswps' ),
                    'desc'  => __( 'Define maximum number of characters in Member details. Default 100', 'gsteam' ),
                    'type'  => 'number',
                    'min'   => 1,
                    'max'   => 300,
                    'default' => 100
                )
            ),
            'gs_team_style_settings' => array(
                // Font Size
                array(
                    'name'      => 'gs_tm_m_fz',
                    'label'     => __( 'Font Size', 'gsteam' ),
                    'desc'      => __( 'Set Font Size for <b>Member Name</b>', 'gsteam' ),
                    'type'      => 'number',
                    'default'   => '18',
                    'options'   => array(
                        'min'   => 1,
                        'max'   => 30,
                        'default' => 18
                    )
                ),
                // Font weight
                array(
                    'name'      => 'gs_tm_m_fntw',
                    'label'     => __( 'Font Weight', 'gsteam' ),
                    'desc'      => __( 'Select Font Weight for <b>Member Name</b>', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => 'normal',
                    'options'   => array(
                        'normal'    => 'Normal',
                        'bold'      => 'Bold',
                        'lighter'   => 'Lighter'
                    )
                ),
                // Font style
                array(
                    'name'      => 'gs_tm_m_fnstyl',
                    'label'     => __( 'Font Style', 'gsteam' ),
                    'desc'      => __( 'Select Font Weight for <b>Member Name</b>', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => 'normal',
                    'options'   => array(
                        'normal'    => 'Normal',
                        'italic'      => 'Italic'
                    )
                ),
                // Member Name Color
                array(
                    'name'    => 'gs_tm_mname_color',
                    'label'   => __( 'Member Name Color', 'gsteam' ),
                    'desc'    => __( 'Select color for <b>Member Name</b>.', 'gsteam' ),
                    'type'    => 'color',
                    'default' => '#141412'
                ), 

                // Member Name Background Color
                array(
                    'name'    => 'gs_tm_mname_background',
                    'label'   => __( 'Member Name BG Color', 'gsteam' ),
                    'desc'    => __( 'Select color for <b>Member Name BG</b> color. Applicable for theme 8,9,11,12,19', 'gsteam' ),
                    'type'    => 'color',
                    'default' => 'rgba(0,185,235,0.8)'
                ), 
                // Hover Icon Background Color
                array(
                    'name'    => 'gs_tm_hover_icon_background',
                    'label'   => __( 'Hover Icon BG Color', 'gsteam' ),
                    'desc'    => __( 'Select color for <b>Hover Icon BG</b> color. Applicable for theme 8,9,11,12,19', 'gsteam' ),
                    'type'    => 'color',
                    'default' => '#00B9EB'
                ), 

                // ribon Background Color
                array(
                    'name'    => 'gs_tm_ribon_color',
                    'label'   => __( 'Ribon Background Color', 'gsteam' ),
                    'desc'    => __( 'Select color for <b>Ribon Background</b>.', 'gsteam' ),
                    'type'    => 'color',
                    'default' => '#1DA642'
                ), 

                // Font Size Role
                array(
                    'name'      => 'gs_tm_role_fz',
                    'label'     => __( 'Font Size', 'gsteam' ),
                    'desc'      => __( 'Set Font Size for <b>Member Role</b>', 'gsteam' ),
                    'type'      => 'number',
                    'default'   => '18',
                    'options'   => array(
                        'min'   => 1,
                        'max'   => 30,
                        'default' => 15
                    )
                ),
                // Font weight
                array(
                    'name'      => 'gs_tm_role_fntw',
                    'label'     => __( 'Font Weight', 'gsteam' ),
                    'desc'      => __( 'Select Font Weight for <b>Member Role</b>', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => 'normal',
                    'options'   => array(
                        'normal'    => 'Normal',
                        'bold'      => 'Bold',
                        'lighter'   => 'Lighter'
                    )
                ),
                // Font style
                array(
                    'name'      => 'gs_tm_role_fnstyl',
                    'label'     => __( 'Font Style', 'gsteam' ),
                    'desc'      => __( 'Select Font Weight for <b>Member Role</b>', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => 'italic',
                    'options'   => array(
                        'italic'      => 'Italic',
                        'normal'    => 'Normal'
                    )
                ),
                // Member Name Color
                array(
                    'name'    => 'gs_tm_role_color',
                    'label'   => __( 'Member Role Color', 'gsteam' ),
                    'desc'    => __( 'Select color for <b>Member Role</b>.', 'gsteam' ),
                    'type'    => 'color',
                    'default' => '#141412'
                ),
                array(
                    'name'    => 'gs_tm_arrow_color',
                    'label'   => __( 'Pop Up Arrow Color', 'gsteam' ),
                    'desc'    => __( 'Select color for <b>Pop up Arrow </b>.', 'gsteam' ),
                    'type'    => 'color',
                    'default' => '#1d9ff3'
                ),
                array(
                    'name'      => 'gs_tm_filter_cat_pos',
                    'label'     => __( 'Filter Category Position', 'gsteam' ),
                    'desc'      => __( 'Select Filter Category Position', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => 'center',
                    'options'   => array(
                        'left'    => 'Left',
                        'center'  => 'Center',
                        'right'   => 'Right'
                    )
                ),
                // Team Custom CSS
                array(
                    'name'    => 'gs_tm_custom_css',
                    'label'   => __( 'Team Custom CSS', 'gsteam' ),
                    'desc'    => __( 'You can write your own custom css', 'gsteam' ),
                    'type'    => 'textarea'
                ), 
            ),
            'gs_team_adv_settings' => array(
                array(
                    'name'      => 'gs_teammembers_slug',
                    'label'     => __( 'Team Members Slug', 'gsteam' ),
                    'desc'      => __( 'After updating GS Team Members slug, Member may NOT found with 404 error. In this senario go to Settings > Permalinks. It\'ll flush URL. Clear cache if needed & refresh Single Team Member page to display.', 'gsteam' ),
                    'type'      => 'text',
                    'default'   => 'team-members'
                ),
                array(
                    'name'      => 'gs_teammembers_pop_clm',
                    'label'     => __( 'Popup Column', 'gsteam' ),
                    'desc'      => __( 'Set Column for Popup', 'gsteam' ),
                    'type'      => 'select',
                    'default'   => 'two',
                    'options'   => array(
                        'one'    => 'One',
                        'two'  => 'Two',
                    )  
                ),
                array(
                    'name'      => 'gs_teamfliter_designation',
                    'label'     => __( 'Filter Designation Text', 'gsteam' ),
                    'desc'      => __( 'Replace desired text for Designation', 'gsteam' ),
                    'type'      => 'text',
                    'default'   => 'Show All Designation'
                ),

                array(
                    'name'      => 'gs_teamfliter_name',
                    'label'     => __( 'Serach Text', 'gsteam' ),
                    'desc'      => __( 'Replace desired text for Search', 'gsteam' ),
                    'type'      => 'text',
                    'default'   => 'Search By Name'
                ),
            ),
            'gs_team_level_settings' => array(

                array(
                    'name'      => 'gs_teamcom_meta',
                    'label'     => __( 'Company', 'gsteam' ),
                    'desc'      => __( 'Replace desired text for Company', 'gsteam' ),
                    'default'   => 'Company'
                ),

                array(
                    'name'      => 'gs_teamadd_meta',
                    'label'     => __( 'Address', 'gsteam' ),
                    'desc'      => __( 'Replace desired text for Address', 'gsteam' ),
                    'type'      => 'text',
                    'default'   => 'Address'
                ),
                array(
                    'name'      => 'gs_teamlandphone_meta',
                    'label'     => __( 'Land Phone', 'gsteam' ),
                    'desc'      => __( 'Replace desired text for Land Phone', 'gsteam' ),
                    'type'      => 'text',
                    'default'   => 'Land Phone'
                ),
                array(
                    'name'      => 'gs_teamcellPhone_meta',
                    'label'     => __( 'Cell Phone', 'gsteam' ),
                    'desc'      => __( 'Replace desired text for Cell Phone', 'gsteam' ),
                    'type'      => 'text',
                    'default'   => 'Cell Phone'
                ),
                array(
                    'name'      => 'gs_teamemail_meta',
                    'label'     => __( 'Email', 'gsteam' ),
                    'desc'      => __( 'Replace desired text for Email', 'gsteam' ),
                    'type'      => 'text',
                    'default'   => 'Email'
                ),
                array(
                    'name'      => 'gs_teamlocation_meta',
                    'label'     => __( 'Location', 'gsteam' ),
                    'desc'      => __( 'Replace desired text for Location', 'gsteam' ),
                    'type'      => 'text',
                    'default'   => 'Location'
                ),
                array(
                    'name'      => 'gs_teamlanguage_meta',
                    'label'     => __( 'Language', 'gsteam' ),
                    'desc'      => __( 'Replace desired text for Language', 'gsteam' ),
                    'type'      => 'text',
                    'default'   => 'Language'
                ),
                array(
                    'name'      => 'gs_teamspecialty_meta',
                    'label'     => __( 'Specialty', 'gsteam' ),
                    'desc'      => __( 'Replace desired text for Specialty', 'gsteam' ),
                    'type'      => 'text',
                    'default'   => 'Specialty'
                ),
                array(
                    'name'      => 'gs_teamgender_meta',
                    'label'     => __( 'Gender', 'gsteam' ),
                    'desc'      => __( 'Replace desired text for Gender', 'gsteam' ),
                    'type'      => 'text',
                    'default'   => 'Gender'
                ),
            )
        );

        return $settings_fields;
    }

    function plugin_page() {
        settings_errors();
        // echo '<div class="wrap gs_team_wrap" style="width: 845px; float: left;">';
        echo '<div class="gsp-options-wrap gs_team_wrap" style="width: 845px; float: left;">';
        // echo '<div id="post-body-content">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';

        ?> 
            <div class="gswps-admin-sidebar" style="width: 277px; float: left; margin-top: 62px;">
                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Support / Report a bug' ) ?></span></h3>
                    <div class="inside centered">
                        <p>Please feel free to let me know if you got any bug to report. Your report / suggestion can make the plugin awesome!</p>
                        <p style="margin-bottom: 1px! important;"><a href="https://gsplugins.com/support" target="_blank" class="button button-primary">Get Support</a></p>
                    </div>
                </div>
                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Buy me a coffee' ) ?></span></h3>
                    <div class="inside centered">
                        <p>If you like the plugin, please buy me a coffee to inspire me to develop further.</p>
                        <p style="margin-bottom: 1px! important;"><a href='https://www.2checkout.com/checkout/purchase?sid=202460873&quantity=1&product_id=8' class="button button-primary" target="_blank">Donate</a></p>
                    </div>
                </div>

                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Join GS Plugins on facebook' ) ?></span></h3>
                    <div class="inside centered">
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/gsplugins&amp;width&amp;height=258&amp;colorscheme=dark&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=723137171103956" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:220px;" allowTransparency="true"></iframe>
                    </div>
                </div>

                <div class="postbox">
                    <h3 class="hndle"><span><?php _e( 'Follow GS Plugins on twitter' ) ?></span></h3>
                    <div class="inside centered">
                        <a href="https://twitter.com/gsplugins" target="_blank" class="button button-secondary">Follow @gsplugins<span class="dashicons dashicons-twitter" style="position: relative; top: 3px; margin-left: 3px; color: #0fb9da;"></span></a>
                    </div>
                </div>
            </div>
        <?php
    }


    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;

$settings = new GS_team_Settings_Config();