=== Featured Posts Pro ===
Contributors: thapa.laxman
Donate link: http://www.lakshman.com.np/featured-posts-pro/
Tags: featured, featured posts, featured post widget, plugin 
Requires at least: 3.0.1
Tested up to: 5.1.1
Stable tag: 1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin gives Administrator/Editor an easy option to mark posts, pages & custom posts as featured posts and provides a widget to list the recent featured posts.

== Description ==
<h3>Featured Posts Pro</h3> allows administrator and editor an option to set posts, pages & custom posts as a featured posts very easily. Posts, pages & custom posts can be set as featured posts using a checkbox on the posts list page or on the edit page of the post. Please see screenshots to be more clear.
<h3>Featured Posts Pro</h3> also adds a widget that will list the recent featured posts. This is similar to the default recent posts widget except this widget displays recent featured posts instead. The template for the <strong>Featured Posts Pro Widget</strong> can be customized with your theme.


== Installation ==
1. Install using the WordPress built-in Plugin installer, or Extract the zip file and drop the contents in the `wp-content/plugins/` directory of your WordPress installation.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. If you want to use the widget, then go to Apperance > Widgets > Featured Post Pro 
4. The options on the widget are self explained

== How to use in the theme ==
You can to get the featured posts, you need to make a custom query as follows

== sample code to get the featured posts with orders  ==
`$args = array(
	        'post_type' => 'any',
	        'posts_per_page'      => 10,
	        'no_found_rows'       => true,
	        'post_status'         => 'publish',
	        'ignore_sticky_posts' => true,
	        'meta_query' => array(
	            array(
	                'relation' => 'OR',
	                array(
	                    'key' => 'post_featured_position',
	                    'compare' => 'EXISTS'
	                ),
	                array(
	                    'key' => 'post_featured_position',
	                    'compare' => 'NOT EXISTS'
	                ),
	            ),
	            array(
	                'relation' => 'AND',
	                'key' => 'is_post_featured',
	                'compare' => '=',
	                'value' => 1
	            )
	        ),
	        'orderby' => 'meta_value_num',
	        'order' => 'ASC',
	    ) ;
	    
$featuredPosts = new WP_Query( $args );`

 == sample code to get the featured posts without order  ==
`$args = array(
	'posts_per_page'      => 10,
	'no_found_rows'       => true,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'meta_key'            => 'is_post_featured'	//this is the meta key used for the featured posts
) ;

$featuredPosts = new WP_Query( $args );`

or if you simple want tp

== How to customize the widget ==
You can customize the widget template as follows:
1. create a folder 'featured_posts_pro_tpls' inside your theme folder
2. create two php files named as 'tpl_featured_posts_pro_large.php' & 'tpl_featured_posts_pro_small.php' in the 'featured_posts_pro_tpls' folder you just created
3. template file 'tpl_featured_posts_pro_large.php' will be used to render the widget when widget size is selected as large & similarly 'tpl_featured_posts_pro_small.php' is for small widget size 
3. copy and paste the content from plugin_fold er > featured-posts-pro > public > partials > featured_posts_pro-widget.php in the above two files
4. make the layout changes as you wish.

== Screenshots ==

1. Posts list page with 'featured' option
1. 'Featured' option while creating or editing a new post
3. Featured Posts Pro as a widget
4. Widget template customization
5. Ability to use custom post types as well for the featured posts
6. Set ordering of the featured posts


== Frequently Asked Questions ==
= How can I contact you? =

You can contact me from http://www.lakshman.com.np/featured-posts-pro/


== Changelog ==
= 1.3.0 =
The ability to include custom post types for the featured posts. The featured post can now be ordered.

= 1.3.2 =
'Posts' post type is selected by default

= 1.3.5 =
bug on 'quick edit' on posts page fixed

= 1.3.8 =
bug fixes

= 1.4 =
fixed bug that prevented the plugin to be used on child theme. Thx to Shane Bill on identifying this issue.
