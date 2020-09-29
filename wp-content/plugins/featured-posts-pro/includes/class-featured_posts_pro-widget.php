<?php
/**
 * Widget API: WP_Widget_Featured_Posts class
 *
 * @package    Featured_Posts_Pro
 * @subpackage Featured_Posts_Pro/includes
 * @author     Laxman Thapa <thapa.laxman@gmail.com>
 */

/**
 * Core class used to implement a Featured Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Featured_Posts_Pro_Widget extends WP_Widget {
    protected $widgetSizes;// = array('large','small');
    protected $widgetTypes;
	/**
	 * Sets up a new Featured Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
	    $this->widgetSizes = array('small', 'large');
	    $this->widgetTypes = array('featured','recent');
	    
		$widget_ops = array(
			'classname' => 'Featured_Posts_Pro_Widget',
			'description' => __( 'Your site&#8217;s featured posts pro.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'featured-posts', __( 'Featured Posts Pro' ), $widget_ops );
		$this->alt_option_name = 'widget_featured_entries';
	}

	/**
	 * Outputs the content for the current Featured Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Featured Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';//__( 'Featured Posts' );
		//$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		
		$show_author = isset( $instance['show_author'] ) ? $instance['show_author'] : false;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : false;

		$widget_size = isset( $instance['widgetSize'] ) ? esc_attr( $instance['widgetSize'] ) : '';
		if(!in_array($widget_size, $this->widgetSizes)) $widget_size = $this->widgetSizes[0];
		
		$widget_type = isset( $instance['widgetType'] ) ? esc_attr( $instance['widgetType'] ) : '';
		if(!in_array($widget_type, $this->widgetTypes)) $widget_type = $this->widgetTypes[0];
		
		
		/**
		 * Filters the arguments for the Featured Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the Featured posts.
		 */
		
		if($widget_type == 'featured'){
		    $r = Featured_Posts_Pro::getFeaturedPosts($number);
		}else{
    		$postArgs = array(
    		    'post_type' => 'any',
    			'posts_per_page'      => $number,
    			'no_found_rows'       => true,
    			'post_status'         => 'publish',
    			'ignore_sticky_posts' => true
    		) ;
    		$r = new WP_Query( apply_filters( 'widget_posts_args', $postArgs) );
		}
		
		

		if ($r->have_posts()) :
		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<?php
		//check theme template
		//$viewPath = get_template_directory().'/featured_posts_pro_tpls/tpl_featured_posts_pro_'.$widget_size.'.php';
		$viewPath = get_stylesheet_directory().'/featured_posts_pro_tpls/tpl_featured_posts_pro_'.$widget_size.'.php';
		if(file_exists($viewPath) && is_readable($viewPath)){
		    //
		}else{
    		$viewPath = __DIR__.'/../public/partials/featured_posts_pro-widget.php';
		}
    	include $viewPath;
		
		/*
		?>
		<ul>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
			<?php if ( $show_date ) : ?>
				<span class="post-date"><?php echo get_the_date(); ?></span>
			<?php endif; ?>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php 
		*/
		echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
	}

	/**
	 * Handles updating the settings for the current Featured Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_thumbnail'] = isset( $new_instance[show_thumbnail] ) ? (bool) $new_instance['show_thumbnail'] : false;
		$instance['show_author'] = isset( $new_instance['show_author'] ) ? (bool) $new_instance['show_author'] : false;
		
		$instance['widgetSize'] = sanitize_text_field( $new_instance['widgetSize'] );
		if(!in_array($instance['widgetSize'], $this->widgetSizes)) $instance['widgetSize'] = $this->widgetSizes[0];

		$instance['widgetType'] = sanitize_text_field( $new_instance['widgetType'] );
		if(!in_array($instance['widgetType'], $this->widgetTypes)) $instance['widgetType'] = $this->widgetTypes[0];
		
		return $instance;
	}

	/**
	 * Outputs the settings form for the Featured Posts widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : true;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : true;
		$show_author = isset( $instance['show_author'] ) ? (bool) $instance['show_author'] : false;
		
		$widgetSize = isset( $instance['widgetSize'] ) ? esc_attr( $instance['widgetSize'] ) : '';
		if(!in_array($widgetSize, $this->widgetSizes)) $widgetSize = $this->widgetSizes[0];
		
		$widgetType = isset( $instance['widgetType'] ) ? esc_attr( $instance['widgetType'] ) : '';
		if(!in_array($widgetType, $this->widgetTypes)) $widgetType = $this->widgetTypes[0];
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'widgetType' ); ?>"><?php _e( 'Choose Featured or Recent Posts' ); ?>
		<select name="<?php echo $this->get_field_name( 'widgetType' ); ?>">
			<?php foreach ($this->widgetTypes as $wType):
			$selected = ($widgetType == $wType) ? "selected='selected'": '';
			?>
			<option <?php echo $selected; ?> <?php ?> value='<?php echo $wType?>'><?php echo $wType; ?></option>
			<?php endforeach; ?>
		</select>
		</label>
		</p>

		
		<p> 
		<label for="<?php echo $this->get_field_id( 'widgetSize' ); ?>"><?php _e( 'Widget Size' ); ?>
		<select name="<?php echo $this->get_field_name( 'widgetSize' ); ?>">
			<?php foreach ($this->widgetSizes as $wSize):
			$selected = ($widgetSize == $wSize) ? "selected='selected'": '';
			?>
			<option <?php echo $selected; ?> <?php ?> value='<?php echo $wSize?>'><?php echo $wSize; ?></option>
			<?php endforeach; ?>
		</select>
		</label>
		</p>
		
		<p>
		<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
		</p>
		
		<p>
		<input class="checkbox" type="checkbox"<?php checked( $show_thumbnail ); ?> id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>"><?php _e( 'Display thumbnail?' ); ?></label>
		</p>
		<p>
		<input class="checkbox" type="checkbox"<?php checked( $show_author ); ?> id="<?php echo $this->get_field_id( 'show_author' ); ?>" name="<?php echo $this->get_field_name( 'show_author' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_author' ); ?>"><?php _e( 'Display author?' ); ?></label>
		</p>
<?php
	}
}
