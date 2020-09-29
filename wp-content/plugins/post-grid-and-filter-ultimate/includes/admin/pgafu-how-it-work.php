<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package Post grid and filter ultimate
 * @since 1.1
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'pgafu_register_design_page');

/**
	 * Builds select drop down for form field: tax_term
	 *
	 * Note: prior to WP4.5 get_terms() accepted the taxonomy as a separate argument.  As of 4.5
	 * get_terms() accepts one array of arguments with the taxonomy arg passed as an array value.
	 * We're calling get_terms() using the older format for sites with older versions of WP.
	 *
	 * @uses WordPress get_terms()
	 *
	 * @access public
	 *
	 * @since 1.0
	 *
	 * @param string $taxonomy The registered name of the taxonomy. e.g., post_tag
	 * #param string $label    The common name of the taxonomy. e.g., Post Tag
	 * @param array  $instance Current settings.
	 * @param object $widget   Widget object.
	 */
	function build_term_select( $taxonomy, $label, $instance, $widget )
	{
		$args = apply_filters( 'acatw_build_term_select_args', array( 'hide_empty' => 0, 'number' => 99 ) );
		$args['fields'] = 'all'; // don't allow override
		$args['taxonomy'] = $taxonomy; // don't allow override
		$_terms = get_terms( $taxonomy, $args );

		if( empty( $_terms ) || is_wp_error( $_terms ) ) {
			return;
		}
		?>

		<?php printf( '<p>%s:</p>', sprintf( __( '%s', 'advanced-categories-widget' ), $label ) ); ?>

		<div class="widgin-multi-check">
			<?php foreach( $_terms as $_term ) : ?>
				<?php
				$checked = (  ! empty( $instance['tax_term'][$_term->taxonomy][$_term->term_id] )) ? 'checked="checked"' : '' ;

				printf( '<input id="%1$s" name="%2$s" value="%3$s" type="checkbox" %4$s/><label for="%1$s">%5$s (%6$s)</label><br />',
					$widget->get_field_id( 'tax_term-' . $taxonomy . '-' . $_term->term_id ),
					$widget->get_field_name( 'tax_term' ) . '['.$taxonomy.']['.$_term->term_id.']',
					$_term->term_id,
					$checked,
					sprintf( __( '%s', 'advanced-categories-widget' ), $_term->name ),
					$_term->count
				);
				?>
			<?php endforeach; ?>
		</div>
		<?php
	}


	/**
	 * Builds form field: tax_term
	 *
	 * @access public
	 *
	 * @since 1.0
	 *
	 * @param array  $instance Current settings.
	 * @param object $widget   Widget object.
	 */
 function build_field_tax_term( $instance, $widget )
	{
		ob_start();
		?>

		<?php
		$taxonomies = Advanced_Categories_Widget_Utils::get_allowed_taxonomies();

		if( count( $taxonomies ) ) :
			foreach ( $taxonomies as $name => $label ) {
				build_term_select( $name, $label, $instance, $widget );
			}
		endif;

		?>

		<?php
		$field = ob_get_clean();

		return $field;
	}
/**
 * Register plugin design page in admin menu
 * 
 * @package Album and Image Gallery Plus Lightbox
 * @since 1.0.0
 */

function pgafu_register_design_page() {
 	add_menu_page( __('Post Grid And Filter', 'post-grid-and-filter-ultimate'), __('Post Grid And Filter', 'post-grid-and-filter-ultimate'), 'manage_options', 'pgafu-about',  'pgafu_designs_page', 'dashicons-sticky', 6 );
}

/**
 * Function to display plugin design HTML
 * 
 * @package Post grid and filter ultimate
 * @since 1.1
 */
function pgafu_designs_page() {

	$wpos_feed_tabs = pgafu_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? $_GET['tab'] : 'how-it-work';
?>
		
	<div class="wrap pgafu-wrap">

		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array('page' => 'pgafu-about', 'tab' => $tab_key), admin_url('admin.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>

			<?php } ?>
		</h2>
		
		<div class="pgafu-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'how-it-work' ) {
				pgafu_howitwork_page();
			}
			else if( isset($active_tab) && $active_tab == 'plugins-feed' ) {
				echo pgafu_get_plugin_design( 'plugins-feed' );
			} else {
				echo pgafu_get_plugin_design( 'offers-feed' );
			}
		?>
		</div><!-- end .pgafu-tab-cnt-wrp -->

	</div><!-- end .pgafu-wrap -->

<?php
}

/**
 * Gets the plugin design part feed
 *
 * @package Post grid and filter ultimate
 * @since 1.1
 */
function pgafu_get_plugin_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
	
	// If tab is not set then return
	if( empty($active_tab) ) {
		return false;
	}

	// Taking some variables
	$wpos_feed_tabs = pgafu_help_tabs();
	$transient_key 	= isset($wpos_feed_tabs[$active_tab]['transient_key']) 	? $wpos_feed_tabs[$active_tab]['transient_key'] 	: 'pgafu_' . $active_tab;
	$url 			= isset($wpos_feed_tabs[$active_tab]['url']) 			? $wpos_feed_tabs[$active_tab]['url'] 				: '';
	$transient_time = isset($wpos_feed_tabs[$active_tab]['transient_time']) ? $wpos_feed_tabs[$active_tab]['transient_time'] 	: 172800;
	$cache 			= get_transient( $transient_key );
	
	if ( false === $cache ) {
		
		$feed 			= wp_remote_get( esc_url_raw( $url ), array( 'timeout' => 120, 'sslverify' => false ) );
		$response_code 	= wp_remote_retrieve_response_code( $feed );
		
		if ( ! is_wp_error( $feed ) && $response_code == 200 ) {
			if ( isset( $feed['body'] ) && strlen( $feed['body'] ) > 0 ) {
				$cache = wp_remote_retrieve_body( $feed );
				set_transient( $transient_key, $cache, $transient_time );
			}
		} else {
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'post-grid-and-filter-ultimate' ) . '</div>';
		}
	}
	return $cache;	
}

/**
 * Function to get plugin feed tabs
 *
 * @package Post grid and filter ultimate
 * @since 1.1
 */
function pgafu_help_tabs() {
	$wpos_feed_tabs = array(
						'how-it-work' 	=> array(
													'name' => __('How It Works', 'post-grid-and-filter-ultimate'),
												),
						'plugins-feed' 	=> array(
													'name' 				=> __('Our Plugins', 'post-grid-and-filter-ultimate'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/plugins-data.php',
													'transient_key'		=> 'wpos_plugins_feed',
													'transient_time'	=> 172800
												)
					);
	return $wpos_feed_tabs;
}

/**
 * Function to get 'How It Works' HTML
 *
 * @package Post grid and filter ultimate
 * @since 1.1
 */
function pgafu_howitwork_page() { ?>
	
	<style type="text/css">
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box .postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.pgafu-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.pgafu-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
		.upgrade-to-pro{font-size:18px; text-align:center; margin-bottom:15px;}
	</style>

	<div class="post-box-container">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
			
				<!--How it workd HTML -->
				<div id="post-body-content">
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								
								
								<h3 class="hndle">
									<span><?php _e( 'How It Works - Display and shortcode', 'post-grid-and-filter-ultimate' ); ?></span>
								</h3>
								
								<div class="inside">
									
									
									
									<!-- h3>
										<span><?php _e( 'Categories Filter', 'post-grid-and-filter-ultimate' ); ?></span>
									</h3>
									
									<div class="ci-select">
										<?php 
										$g_categories = get_categories();
										$g_cat_id_name = array();
										foreach ( $g_categories as $k=>$v ) {
											$g_cat_id_name[$v->term_id] = $v->name;
										}
										wp_dropdown_categories( $g_cat_id_name );

										?>
									</div -->

									
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Geeting Started with Post Slider', 'post-grid-and-filter-ultimate'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1. This plugin create a tab under "Post grid and filter ultimate – How It Works".', 'post-grid-and-filter-ultimate'); ?></li>
														<li><?php _e('Step-2. This plugin get all the POST from WordPress post section with a simple shortcode', 'post-grid-and-filter-ultimate'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('How Shortcode Works', 'post-grid-and-filter-ultimate'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1. Create a page like Latet Post OR add the shortcode in a page.', 'post-grid-and-filter-ultimate'); ?></li>
														<li><?php _e('Step-2. Put below shortcode as per your need.', 'post-grid-and-filter-ultimate'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'post-grid-and-filter-ultimate'); ?>:</label>
												</th>
												<td>
													<span class="pgafu-shortcode-preview">[pgaf_post_grid]</span> – <?php _e('Post Grid Shortcode', 'post-grid-and-filter-ultimate'); ?><br>
													<span class="pgafu-shortcode-preview">[pgaf_post_filter]</span> – <?php _e('Post grid Shortcode. Where you can use 4 designs', 'post-grid-and-filter-ultimate'); ?>
												</td>
											</tr>						
												
											<tr>
												<th>
													<label><?php _e('Need Support?', 'post-grid-and-filter-ultimate'); ?></label>
												</th>
												<td>
													<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'post-grid-and-filter-ultimate'); ?></p> <br/>
													<a class="button button-primary" href="https://www.wponlinesupport.com/plugins-documentation/post-grid-and-filter-ultimate/?utm_source=hp&event=doc" target="_blank"><?php _e('Documentation', 'post-grid-and-filter-ultimate'); ?></a>									
													<a class="button button-primary" href="https://demo.wponlinesupport.com/post-grid-and-filter-ultimate-demo/?utm_source=hp&event=demo" target="_blank"><?php _e('Demo for Designs', 'post-grid-and-filter-ultimate'); ?></a>
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-body-content -->
				
				<!--Upgrad to Pro HTML -->
				<div id="postbox-container-1" class="postbox-container">
					<div class="metabox-holder wpos-pro-box">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								<h3 class="hndle">
									<span><?php _e( 'Upgrate to Pro', 'timeline-and-history-slider' ); ?></span>
								</h3>
								<div class="inside">										
									<ul class="wpos-list">
										<li>10 Designs for Post Grid, 10 Designs for Post Grid Filter.</li>
										<li>2 - (Post Grid Shortcode, Post Filter Shortcode).</li>
										<li>35+ Shortcode Parameters.</li>
										<li>WP Templating Features.</li>
										<li>Shortcode Generator.</li>
										<li>Drag & Drop Post Order Change.</li>
										<li>Gutenberg Block Supports.</li>
										<li>Visual Composer/WPBakery Page Builder Supports.</li>
										<li>Custom Read More link for Post.</li>
										<li>Display Desired Post.</li>
										<li>Exclude Some Posts.</li>
										<li>Exclude Some Categories.</li>
										<li>Post Order / Order By Parameters </li>s										
										<li>Fully responsive</li>
										<li>100% Multi language</li>
									</ul>
									<div class="upgrade-to-pro">Gain access to <strong>Post grid and filter ultimate</strong> included in <br /><strong>Essential Plugin Bundle</div>
									<a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/wp-plugin/post-grid-filter-ultimate/?ref=WposPratik&utm_source=WP&utm_medium=WP-Plugins&utm_campaign=Upgrade-PRO" target="_blank"><?php _e('Go Premium ', 'timeline-and-history-slider'); ?></a>	
									<p><a class="button button-primary wpos-button-full" href="https://demo.wponlinesupport.com/prodemo/post-grid-and-filter-with-popup-pro-demo/" target="_blank"><?php _e('View PRO Demo ', 'timeline-and-history-slider'); ?></a>			</p>								
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					<!-- Help to improve this plugin! -->
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
									<h3 class="hndle">
										<span><?php _e( 'Help to improve this plugin!', 'post-grid-and-filter-ultimate' ); ?></span>
									</h3>									
									<div class="inside">										
										<p>Enjoyed this plugin? You can help by rate this plugin <a href="https://wordpress.org/support/plugin/post-grid-and-filter-ultimate/reviews/?filter=5" target="_blank">5 stars!</a></p>
									</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-container-1 -->

			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }