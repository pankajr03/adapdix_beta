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
 * Register plugin design page in admin menu
 * 
 * @package Post grid and filter ultimate
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
		.wpos-pro-box.postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.pgafu-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.pgafu-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
		.upgrade-to-pro{font-size:18px; text-align:center; margin-bottom:15px;}
	</style>

	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">

			<!--How it workd HTML -->
			<div id="post-body-content">
				<div class="meta-box-sortables">
					<div class="postbox">

						<h3 class="hndle">
							<span><?php _e( 'How It Works - Display and shortcode', 'post-grid-and-filter-ultimate' ); ?></span>
						</h3>

						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr>
										<th>
											<label><?php _e('Geeting Started with Post Slider', 'post-grid-and-filter-ultimate'); ?>:</label>
										</th>
										<td>
											<ul>
												<li><?php _e('Step-1. This plugin create a tab under "Post grid and filter ultimate – How It Works".', 'post-grid-and-filter-ultimate'); ?></li>
												<li><?php _e('Step-2. This plugin display WordPres default standard POST with a simple shortcode.', 'post-grid-and-filter-ultimate'); ?></li>
											</ul>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e('How Shortcode Works', 'post-grid-and-filter-ultimate'); ?>:</label>
										</th>
										<td>
											<ul>
												<li><?php _e('Step-1. Create a page like Latest Post OR add the shortcode in a page.', 'post-grid-and-filter-ultimate'); ?></li>
												<li><?php _e('Step-2. Put below shortcode as per your need.', 'post-grid-and-filter-ultimate'); ?></li>
											</ul>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e('All Shortcodes', 'post-grid-and-filter-ultimate'); ?>:</label>
										</th>
										<td>
											<span class="pgafu-shortcode-preview">[pgaf_post_grid]</span> – <?php _e('Post Grid Shortcode.', 'post-grid-and-filter-ultimate'); ?><br>
											<span class="pgafu-shortcode-preview">[pgaf_post_filter]</span> – <?php _e('Post Filter Shortcode, which provide you to use 4 designs.', 'post-grid-and-filter-ultimate'); ?>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e('Need Support?', 'post-grid-and-filter-ultimate'); ?></label>
										</th>
										<td>
											<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'post-grid-and-filter-ultimate'); ?></p> <br/>
											<a class="button button-primary" href="https://docs.wponlinesupport.com/post-grid-and-filter-ultimate/?utm_source=WP&event=doc" target="_blank"><?php _e('Documentation', 'post-grid-and-filter-ultimate'); ?></a>
											<a class="button button-primary" href="https://demo.wponlinesupport.com/post-grid-and-filter-ultimate-demo/?utm_source=WP&event=demo" target="_blank"><?php _e('Demo for Designs', 'post-grid-and-filter-ultimate'); ?></a>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables -->
			</div><!-- #post-body-content -->

			<!--Upgrad to Pro HTML -->
			<div id="postbox-container-1" class="postbox-container">
				<div class="meta-box-sortables">
					<div class="postbox wpos-pro-box">
						<h3 class="hndle">
							<span><?php _e( 'Upgrate to Pro', 'post-grid-and-filter-ultimate' ); ?></span>
						</h3>
						<div class="inside">
							<ul class="wpos-list">
								<li><?php _e('10 Designs for Post Grid, 10 Designs for Post Grid Filter.', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('2 - (Post Grid Shortcode, Post Filter Shortcode)', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('35+ Shortcode Parameters', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('WP Templating Features', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('Shortcode Generator', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('Drag & Drop Post Order Change.', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('Gutenberg Block Supports.', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('Visual Composer/WPBakery Page Builder Supports.', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('Custom Read More link for Post.', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('Display Desired Post.', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('Exclude Some Posts.', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('Exclude Some Categories.', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('Post Order / Order By Parameters', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('Fully responsive', 'post-grid-and-filter-ultimate'); ?></li>
								<li><?php _e('100% Multi language', 'post-grid-and-filter-ultimate'); ?></li>
							</ul>
							<div class="upgrade-to-pro"><?php sprintf('Gain access to <strong>Post grid and filter ultimate</strong> included in <br /><strong>Essential Plugin Bundle', 'post-grid-and-filter-ultimate'); ?></div>
							<a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/wp-plugin/post-grid-filter-ultimate/?ref=WposPratik&utm_source=WP&utm_medium=Post-Grid-and-Filter&utm_campaign=Upgrade-PRO" target="_blank"><?php _e('Go Premium', 'post-grid-and-filter-ultimate'); ?></a>
							<p><a class="button button-primary wpos-button-full" href="https://demo.wponlinesupport.com/prodemo/post-grid-and-filter-with-popup-pro-demo/" target="_blank"><?php _e('View PRO Demo', 'post-grid-and-filter-ultimate'); ?></a></p>
						</div><!-- .inside -->
					</div><!-- #general -->

					<div class="postbox">
						<h3 class="hndle">
							<span><?php _e( 'Help to improve this plugin!', 'post-grid-and-filter-ultimate' ); ?></span>
						</h3>
						<div class="inside">
							<p><?php _e('Enjoyed this plugin? You can help by rate this plugin ', 'post-grid-and-filter-ultimate'); ?><a href="https://wordpress.org/support/plugin/post-grid-and-filter-ultimate/reviews/?filter=5#new-post" target="_blank"><?php _e('5 stars!', 'post-grid-and-filter-ultimate'); ?></a></p>
						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables -->
			</div><!-- #post-container-1 -->

		</div><!-- #post-body -->
	</div><!-- #poststuff -->
<?php }