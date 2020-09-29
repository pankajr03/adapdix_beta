<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_GsTeam_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'gs-team-members';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'GS Team Members', 'gsteam' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-users';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Shortcode Settings', 'gsteam' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		
        
        $this->add_control(
			'gs_team_numb',
			[
				'label' => __( 'Number Of Member', 'gsteam' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 10,
				'title' =>'Select number of Team.',
				
			]
		);

		$this->add_control(
			'gs_team_theme',
			[
				'label' => __( 'Select Theme', 'gsteam' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [

                    'gs_tm_theme1'=> 'Grid 1 (Hover)',                  
                    'gs_tm_grid2'=> 'Grid 2 (Tooltip)',                
                    'gs_tm_theme20'=>'Grid 3 (Static)' ,                 
                    'gs_tm_theme2'=> 'Circle 1 (Hover)' ,               
                    'gs_tm_theme3'=>'Horizontal 1 (Square Right Info)', 
                    'gs_tm_theme4'=>'Horizontal 2 (Square Left Info)' , 
                    'gs_tm_theme5'=>'Horizontal 3 (Circle Right Info)' ,
                    'gs_tm_theme6'=> 'Horizontal 4 (Circle Left Info)' ,
                    'gs_tm_theme13'=>'Drawer 1 (3 cols)' ,               
                    'gs_tm_drawer2'=>'Drawer 2 (4 cols)' ,               
                    'gs_tm_theme14'=>'Table 1 (Underline)',              
                    'gs_tm_theme15'=>'Table 2 (Box Border)',             
                    'gs_tm_theme16'=>'Table 3 (Odd Even)'   ,            
                    'gs_tm_theme17'=>'List 1 (Square Right Info)',       
                    'gs_tm_theme18'=>'List 2 (Square Left Info)'  ,      
                    'gs_tm_theme7'=> 'Slider 1 (Hover)' ,               
                    'gs_tm_theme8'=> 'Popup 1' ,                        
                    'gs_tm_theme11'=>'To Single',                        
                    'gs_tm_theme9'=> 'Filter 1 (Hover & Pop)',          
                    'gs_tm_theme12'=>'Filter 2 (Selected Cats)',         
                    'gs_tm_theme19'=>'Panel Slide' ,                     
                    'gs_tm_theme10'=> 'Gray 1 (Square)',                 

				],
				'default' => 'gs_tm_theme1',
			]
        );
        
        $this->add_control(
			'gs_team_cols',
			[
				'label' => __( 'Select column', 'gsteam' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    '3' => '4 Columns',
                    '6' => '2 Columns',
                    '4' => '3 Columns',
				],
				'default' => '3',
			]
        );

        $this->add_control(
			'gs_team_orderby',
			[
				'label' => __( 'Order By', 'gsteam' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [

                    'date'=>'Date'  ,
                    'ID'=>'ID'      ,
                    'title'=>'Title'   ,
                    'modified'=>'Modified',
                    'rand'=>'Random'  ,
				],
				'default' => 'date',
			]
        );

        $this->add_control(
			'gs_team_order',
			[
				'label' => __( 'Order', 'gsteam' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    'DESC' => 'DESC',
                    'ASC'  => 'ASC',
				],
				'default' => 'none',
			]
        );

        $this->add_control(
			'cats_name',
			[
				'label' => __( 'Category Name Show/Hide', 'gsteam' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    'none'    => 'None',
                    'initial' => 'Initial',
				],
				'default' => 'none',
			]
        );



		$this->add_control(
			'group',
			[
				'label' => __( 'Team Gruop', 'gsteam' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		//print_r($settings['gs_l_slide_speed']);

		echo do_shortcode('[gs_team theme="'.$settings['gs_team_theme'].'" num="'.$settings['gs_team_numb'].'" cols="'.$settings['gs_team_cols'].'" order="'.$settings['gs_team_order'].'" cats_name="'.$settings['cats_name'].'" orderby="'.$settings['gs_team_orderby'].'" group="'.$settings['group'].'"]');

	}

	// protected function _content_template() {
	// 	echo do_shortcode('[gs_logo theme="{{{settings.theme}}}"]');
	// }

}

//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_GsTeam_Widget() );