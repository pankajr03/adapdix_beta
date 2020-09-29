<?php
/**
 * My Trade Signals functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since My Trade Signals 1.0
 */
/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if (!isset($content_width))
    $content_width = 625;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * My Trade Signals supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 *    custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since My Trade Signals 1.0
 */
function mytradesignals_setup()
{
    /*
     * Makes My Trade Signals available for translation.
     *
     * Translations can be added to the /languages/ directory.
     * If you're building a theme based on My Trade Signals, use a find and replace
     * to change 'mytradesignals' to the name of your theme in all the template files.
     */
    load_theme_textdomain('mytradesignals', get_template_directory() . '/languages');

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support('automatic-feed-links');

    // This theme supports a variety of post formats.
    add_theme_support('post-formats', array('aside', 'image', 'link', 'quote', 'status'));

    // This theme uses wp_nav_menu() in one location.
    register_nav_menu('primary', __('Primary Menu', 'mytradesignals'));
    /*
     * This theme supports custom background color and image, and here
     * we also set up the default background color.
     */
    add_theme_support('custom-background', array(
        'default-color' => 'e6e6e6',
    ));

    // This theme uses a custom image size for featured images, displayed on "standard" posts.
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(624, 9999); // Unlimited height, soft crop
}

add_action('after_setup_theme', 'mytradesignals_setup');

/**
 * Adds support for a custom header image.
 */
require(get_template_directory() . '/inc/custom-header.php');

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since My Trade Signals 1.0
 */
function mytradesignals_scripts_styles()
{
    global $wp_styles;

    /*
     * Adds JavaScript to pages with the comment form to support
     * sites with threaded comments (when in use).
     */
    if (is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');

    /*
     * Adds JavaScript for handling the navigation menu hide-and-show behavior.
     */
    wp_enqueue_script('mytradesignals-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true);

    /*
     * Loads our special font CSS file.
     *
     * The use of Open Sans by default is localized. For languages that use
     * characters not supported by the font, the font can be disabled.
     *
     * To disable in a child theme, use wp_dequeue_style()
     * function mytheme_dequeue_fonts() {
     *     wp_dequeue_style( 'mytradesignals-fonts' );
     * }
     * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
     */

    /* translators: If there are characters in your language that are not supported
      by Open Sans, translate this to 'off'. Do not translate into your own language. */
    if ('off' !== _x('on', 'Open Sans font: on or off', 'mytradesignals')) {
        $subsets = 'latin,latin-ext';

        /* translators: To add an additional Open Sans character subset specific to your language, translate
          this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
        $subset = _x('no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'mytradesignals');

        if ('cyrillic' == $subset)
            $subsets .= ',cyrillic,cyrillic-ext';
        elseif ('greek' == $subset)
            $subsets .= ',greek,greek-ext';
        elseif ('vietnamese' == $subset)
            $subsets .= ',vietnamese';

        $protocol = is_ssl() ? 'https' : 'http';
        $query_args = array(
            'family' => 'Open+Sans:400italic,700italic,400,700',
            'subset' => $subsets,
        );
        wp_enqueue_style('mytradesignals-fonts', add_query_arg($query_args, "$protocol://fonts.googleapis.com/css"), array(), null);
    }

    /*
     * Loads our main stylesheet.
     */
    //wp_enqueue_style( 'mytradesignals-style', get_stylesheet_uri() );
    //  wp_enqueue_style( 'mytradesignals-custom', get_template_directory_uri() . '/css/home.css', array(  ), '20130723' );


    /*
     * Loads the Internet Explorer specific stylesheet.
     */
    wp_enqueue_style('mytradesignals-ie', get_template_directory_uri() . '/css/ie.css', array('mytradesignals-style'), '20121010');
    $wp_styles->add_data('mytradesignals-ie', 'conditional', 'lt IE 9');
}

add_action('wp_enqueue_scripts', 'mytradesignals_scripts_styles');

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since My Trade Signals 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function mytradesignals_wp_title($title, $sep)
{
    global $paged, $page;

    if (is_feed())
        return $title;

    // Add the site name.
    $title .= get_bloginfo('name');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page()))
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2)
        $title = "$title $sep " . sprintf(__('Page %s', 'mytradesignals'), max($paged, $page));

    return $title;
}

add_filter('wp_title', 'mytradesignals_wp_title', 10, 2);

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since My Trade Signals 1.0
 */
function mytradesignals_page_menu_args($args)
{
    if (!isset($args['show_home']))
        $args['show_home'] = true;
    return $args;
}

add_filter('wp_page_menu_args', 'mytradesignals_page_menu_args');

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since My Trade Signals 1.0
 */
function mytradesignals_widgets_init()
{
    register_sidebar(array(
        'name' => __('Public Main Sidebar', 'mytradesignals'),
        'id' => 'sidebar-1',
        'description' => __('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'mytradesignals'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Public First Front Page Widget Area', 'mytradesignals'),
        'id' => 'sidebar-2',
        'description' => __('Appears when using the optional Front Page template with a page set as Static Front Page', 'mytradesignals'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Public Widget Area', 'twentyten'),
        'id' => 'public-widget-area',
        'description' => __('The public widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Public Second Front Page Widget Area', 'mytradesignals'),
        'id' => 'sidebar-3',
        'description' => __('Appears when using the optional Front Page template with a page set as Static Front Page', 'mytradesignals'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Public Blog Widget Area', 'twentyten'),
        'id' => 'primary-widget-area',
        'description' => __('The primary widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));


    register_sidebar(array(
        'name' => __('Public Footer', 'mytradesignals'),
        'id' => 'sidebar-4',
        'description' => __('Home page footer', 'mytradesignals'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Public Opt-in Form', 'mytradesignals'),
        'id' => 'sidebar-5',
        'description' => __('Opt-in Form', 'mytradesignals'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));

    register_sidebar(array(
        'name' => __('Public Footer OptIn', 'mytradesignals'),
        'id' => 'sidebar-6',
        'description' => __('Home OptIn', 'mytradesignals'),
        'before_widget' => '<div class="span4">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));


    register_sidebar(array(
        'name' => __('Members Home', 'twentyten'),
        'id' => 'members-home',
        'description' => __('Members home widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Members Getting Started', 'twentyten'),
        'id' => 'members-getting-started',
        'description' => __('Members getting started widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Members Platform', 'twentyten'),
        'id' => 'members-platform',
        'description' => __('Members platform widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Members Experts', 'twentyten'),
        'id' => 'members-experts',
        'description' => __('Members experts widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Members Materials', 'twentyten'),
        'id' => 'members-materials',
        'description' => __('Members materials widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));


    register_sidebar(array(
        'name' => __('Members Materials Course 1', 'twentyten'),
        'id' => 'members-materials-course-1',
        'description' => __('Members materials widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Members Materials Course 2', 'twentyten'),
        'id' => 'members-materials-course-2',
        'description' => __('Members materials widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Members Materials Course 3', 'twentyten'),
        'id' => 'members-materials-course-3',
        'description' => __('Members materials widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Members Materials Course 4', 'twentyten'),
        'id' => 'members-materials-course-4',
        'description' => __('Members materials widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Members Materials Course 5', 'twentyten'),
        'id' => 'members-materials-course-5',
        'description' => __('Members materials widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Members Materials Course 6', 'twentyten'),
        'id' => 'members-materials-course-6',
        'description' => __('Members materials widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Members Materials Course 7', 'twentyten'),
        'id' => 'members-materials-course-7',
        'description' => __('Members materials widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Members Materials Course 8', 'twentyten'),
        'id' => 'members-materials-course-8',
        'description' => __('Members materials widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Members Materials Course 9', 'twentyten'),
        'id' => 'members-materials-course-9',
        'description' => __('Members materials widget area', 'twentyten'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));


}

add_action('widgets_init', 'mytradesignals_widgets_init');

if (!function_exists('mytradesignals_content_nav')) :

    /**
     * Displays navigation to next/previous pages when applicable.
     *
     * @since My Trade Signals 1.0
     */
    function mytradesignals_content_nav($html_id)
    {
        global $wp_query;

        $html_id = esc_attr($html_id);

        if ($wp_query->max_num_pages > 1) :
            ?>
            <nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
                <h3 class="assistive-text"><?php _e('Post navigation', 'mytradesignals'); ?></h3>

                <div
                    class="nav-previous alignleft"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'mytradesignals')); ?></div>
                <div
                    class="nav-next alignright"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'mytradesignals')); ?></div>
            </nav><!-- #<?php echo $html_id; ?> .navigation -->
        <?php
        endif;
    }

endif;

if (!function_exists('mytradesignals_comment')) :

    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own mytradesignals_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * @since My Trade Signals 1.0
     */
    function mytradesignals_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
// Display trackbacks differently than normal comments.
                ?>
                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php _e('Pingback:', 'mytradesignals'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(__('(Edit)', 'mytradesignals'), '<span class="edit-link">', '</span>'); ?></p>
                <?php
                break;
            default :
                // Proceed with normal comments.
                global $post;
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <article id="comment-<?php comment_ID(); ?>" class="comment">
                    <header class="comment-meta comment-author vcard">
                        <?php
                        echo get_avatar($comment, 44);
                        printf('<cite class="fn">%1$s %2$s</cite>', get_comment_author_link(),
                            // If current post author is also comment author, make it known visually.
                            ($comment->user_id === $post->post_author) ? '<span> ' . __('Post author', 'mytradesignals') . '</span>' : ''
                        );
                        printf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>', esc_url(get_comment_link($comment->comment_ID)), get_comment_time('c'),
                            /* translators: 1: date, 2: time */
                            sprintf(__('%1$s at %2$s', 'mytradesignals'), get_comment_date(), get_comment_time())
                        );
                        ?>
                    </header>
                    <!-- .comment-meta -->

                    <?php if ('0' == $comment->comment_approved) : ?>
                        <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'mytradesignals'); ?></p>
                    <?php endif; ?>

                    <section class="comment-content comment">
                        <?php comment_text(); ?>
                        <?php edit_comment_link(__('Edit', 'mytradesignals'), '<p class="edit-link">', '</p>'); ?>
                    </section>
                    <!-- .comment-content -->

                    <div class="reply">
                        <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'mytradesignals'), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </div>
                    <!-- .reply -->
                </article>
                <!-- #comment-## -->
                <?php
                break;
        endswitch; // end comment_type check
    }

endif;

if (!function_exists('mytradesignals_entry_meta')) :

    /**
     * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
     *
     * Create your own mytradesignals_entry_meta() to override in a child theme.
     *
     * @since My Trade Signals 1.0
     */
    function mytradesignals_entry_meta()
    {
        // Translators: used between list items, there is a space after the comma.
        $categories_list = get_the_category_list(__(', ', 'mytradesignals'));

        // Translators: used between list items, there is a space after the comma.
        $tag_list = get_the_tag_list('', __(', ', 'mytradesignals'));

        $date = sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', esc_url(get_permalink()), esc_attr(get_the_time()), esc_attr(get_the_date('c')), esc_html(get_the_date())
        );

        $author = sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_attr(sprintf(__('View all posts by %s', 'mytradesignals'), get_the_author())), get_the_author()
        );

        // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
        if ($tag_list) {
            $utility_text = __('This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'mytradesignals');
        } elseif ($categories_list) {
            $utility_text = __('This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'mytradesignals');
        } else {
            $utility_text = __('This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'mytradesignals');
        }

        printf(
            $utility_text, $categories_list, $tag_list, $date, $author
        );
    }

endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since My Trade Signals 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function mytradesignals_body_class($classes)
{
    $background_color = get_background_color();

    if (!is_active_sidebar('sidebar-1') || is_page_template('page-templates/full-width.php'))
        $classes[] = 'full-width';

    if (is_page_template('page-templates/front-page.php')) {
        $classes[] = 'template-front-page';
        if (has_post_thumbnail())
            $classes[] = 'has-post-thumbnail';
        if (is_active_sidebar('sidebar-2') && is_active_sidebar('sidebar-3'))
            $classes[] = 'two-sidebars';
    }

    if (empty($background_color))
        $classes[] = 'custom-background-empty';
    elseif (in_array($background_color, array('fff', 'ffffff')))
        $classes[] = 'custom-background-white';

    // Enable custom font class only if the font CSS is queued to load.
    if (wp_style_is('mytradesignals-fonts', 'queue'))
        $classes[] = 'custom-font-enabled';

    if (!is_multi_author())
        $classes[] = 'single-author';

    return $classes;
}

add_filter('body_class', 'mytradesignals_body_class');

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since My Trade Signals 1.0
 */
function mytradesignals_content_width()
{
    if (is_page_template('page-templates/full-width.php') || is_attachment() || !is_active_sidebar('sidebar-1')) {
        global $content_width;
        $content_width = 960;
    }
}

add_action('template_redirect', 'mytradesignals_content_width');

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since My Trade Signals 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function mytradesignals_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
}

add_action('customize_register', 'mytradesignals_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since My Trade Signals 1.0
 */
function mytradesignals_customize_preview_js()
{
    wp_enqueue_script('mytradesignals-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array('customize-preview'), '20120827', true);
}

add_action('customize_preview_init', 'mytradesignals_customize_preview_js');


/**
 * Customization
 */
/**
 * Remove editor on the custom template
 */
add_action('init', 'init');

function init()
{
    /*$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
    $template_file = get_post_meta($post_id, '_wp_page_template', TRUE);

    if ($template_file == 'page-home.php') {
        //remove_post_type_support('page', 'editor');
    }*/


    // Add Post Type
    /*    register_post_type( 'signals',
      array(
      'labels' => array(
      'name' => __( 'Signals' ),
      'singular_name' => __( 'Signal' )
      ),
      'public' => true,
      'has_archive' => true,
      )
      ); */
}

class MenuCustomizer extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';
        $dropdown_arr_index = array_search('dropdown', $item->classes);
        if (($is_parent = ($dropdown_arr_index !== false)) && $depth > 0) {
            $item->classes[$dropdown_arr_index] = 'dropdown-submenu';
        }

        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;


        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';


        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= $is_parent ? ' class="dropdown-toggle" data-toggle="dropdown" ' : '';


        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . ($is_parent ? ' <b class="caret"></b> ' : '');
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * @see Walker::end_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Page data object. Not used.
     * @param int $depth Depth of page. Not Used.
     */
    function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= "</li>\n";
    }

}

add_filter('wp_nav_menu_objects', 'add_menu_parent_class', 10, 2);

function add_menu_parent_class($sorted_menu_items, $args)
{
    $parents = array();
    foreach ($sorted_menu_items as $item) {
        if ($item->menu_item_parent && $item->menu_item_parent > 0) {
            $parents[] = $item->menu_item_parent;
        }
    }

    foreach ($sorted_menu_items as $item) {
        if (in_array($item->ID, $parents)) {
            $item->classes[] = 'dropdown';
        }
    }


    if (isset($args->sub_menu)) {
        $root_id = 0;

        // find the current menu item
        foreach ($sorted_menu_items as $menu_item) {
            if ($menu_item->current) {
                // set the root id based on whether the current menu item has a parent or not
                $root_id = ($menu_item->menu_item_parent) ? $menu_item->menu_item_parent : $menu_item->ID;
                break;
            }
        }

        // find the top level parent
        if (!isset($args->direct_parent)) {
            $prev_root_id = $root_id;
            while ($prev_root_id != 0) {
                foreach ($sorted_menu_items as $menu_item) {
                    if ($menu_item->ID == $prev_root_id) {
                        $prev_root_id = $menu_item->menu_item_parent;
                        // don't set the root_id to 0 if we've reached the top of the menu
                        if ($prev_root_id != 0)
                            $root_id = $menu_item->menu_item_parent;
                        break;
                    }
                }
            }
        }

        $menu_item_parents = array();
        foreach ($sorted_menu_items as $key => $item) {
            // var_dump($key, $item->title);
            // init menu_item_parents
            if ($item->ID == $root_id)
                $menu_item_parents[] = $item->ID;

            if (in_array($item->menu_item_parent, $menu_item_parents)) {
                // part of sub-tree: keep!
                $menu_item_parents[] = $item->ID;
            } else if (!(isset($args->show_parent) && in_array($item->ID, $menu_item_parents))) {
                // not part of sub-tree: away with it!
                unset($sorted_menu_items[$key]);
            }
        }


        return $sorted_menu_items;
    } else {
        return $sorted_menu_items;
    }
}

// adds custom login message
function custom_login_message()
{
    $message = "<h1 class='login-message'>Login To Your Account:</h1>";
    return $message;
}

add_filter('login_message', 'custom_login_message');

function my_login_logo()
{
    ?>
    <link rel='stylesheet' id='mytradesignals-login-css' href='/wp-content/themes/mytradesignals/css/login.css'
          type='text/css' media='all'/>
<?php
}

add_action('login_enqueue_scripts', 'my_login_logo');

class SecondaryMenuCustomizer extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';
        $dropdown_arr_index = array_search('dropdown', $item->classes);
        if (($is_parent = ($dropdown_arr_index !== false)) && $depth > 0) {
            $item->classes[$dropdown_arr_index] = 'dropdown-submenu';
        }

        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;


        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= $is_parent ? ' class="dropdown-toggle" data-toggle="dropdown" ' : '';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . ($is_parent ? ' <b class="caret"></b> ' : '');
        $item_output .= '</a>' . ($item->current && !$item->menu_item_parent ? '<p class="white-pyramid"></p>' : '');
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * @see Walker::end_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Page data object. Not used.
     * @param int $depth Depth of page. Not Used.
     */
    function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= "</li>\n";
    }

}

function devpress_login_form_shortcode()
{
    if (is_user_logged_in())
        return '';

    return wp_login_form(array('echo' => false));
}

/*function wpse_11244_restrict_admin()
{
    if (!current_user_can('manage_options')) {
        wp_redirect(home_url());
    }
}

add_action('admin_init', 'wpse_11244_restrict_admin', 1);*/

// show admin bar only for admins
if (!current_user_can('manage_options')) {
    add_filter('show_admin_bar', '__return_false');
}
// show admin bar only for admins and editors
if (!current_user_can('edit_posts')) {
    add_filter('show_admin_bar', '__return_false');
}

/*function my_login_redirect($redirect_to, $request, $user)
{
    //is there a user to check?
    global $user;
    if (isset($user->roles) && is_array($user->roles)) {
        //check for admins
        if (in_array("administrator", $user->roles)) {
            // redirect them to the default place
            return $redirect_to;
        } else {
            return '/members-area/home';
        }
    } else {
        return $redirect_to;
    }
}*/

//add_filter("login_redirect", "my_login_redirect", 10, 3);

/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_filter('wp_nav_menu_items', 'search_box_function', 10, 2);

remove_action('wp_head', 'noindex', 1);

function search_box_function($nav, $args)
{

    if ($args->menu == 'Members' && !$args->sub_menu)
        return $nav . '<li class=\'login-menu-bar\'><a href="' . wp_logout_url('/wp-login.php') . '" title="Logout">Logout</a></li>';

    return $nav;
}

add_shortcode('dw_videobox', function ($attr) {
    ob_start();
    ?>
    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit">
        <div class="row-fluid">
            <div class="span8">
                <?php
                $is_child = (wp_get_post_parent_id(get_the_ID()) > 0);
                query_posts(array('post_type' => 'video', 'meta_query' => array(array('key' => 'page_selector', 'value' => get_the_ID())), 'orderby' => 'title', 'order' => 'ASC'));
                ?>
                <?php
                $index = 0;
                while (have_posts()) : the_post();
                    $post_metas = get_post_meta(get_the_ID());
                    foreach ($post_metas as $key => $value) {
                        if (strpos($key, 'wpcf') === 0) {
                            $videos[$index][$key] = $value[0];
                        }
                    }
                    parse_str(str_replace(array(' ', '"'), array('&', ''), $videos[$index]['wpcf-iframe']), $videos[$index]['wpcf-iframe']);
                    $index++;
                endwhile;
                ?>
                <div class="sbox"></div>
                <div class="sboxForm">
                    <?php
                    echo $page_content;
                    ?>
                    <?php
                    dynamic_sidebar('sidebar-5');
                    ?>
                    <a href="#" class="skipVideo">Skip and continue to play</a>
                </div>
                <iframe
                    data-source="<?php echo $videos[0]['wpcf-iframe']['src'] . (isset($videos[0]['wpcf-onend']) ? '' : '|' . $videos[0]['wpcf-time']) ?>"
                    width="100%" height="390"
                    src="<?php echo $videos[0]['wpcf-iframe']['src'] ?>?enablejsapi=1&wmode=opaque" frameborder="0"
                    allowfullscreen id="player"></iframe>

            </div>
            <div class="span4 text-center video-control-container">
                <ul class="unstyled video-control<?php echo $is_child ? '-second' : 'l' ?>">
                    <?php
                    $videoCount = count($videos);
                    $iterator = 0;
                    foreach ($videos as $key => $value) {
                        ?>
                        <li>
                            <span class="video-play-icon"></span>
                            <a href="#"
                               data-source="<?php echo $value['wpcf-iframe']['src'] . (isset($value['wpcf-onend']) ? '' : '|' . $value['wpcf-time']) ?>"><span
                                    class="video-play-icon"></span><?php echo '<span>' . $value['wpcf-title'] . '</span><br />' . $value['wpcf-description'] ?>
                                <br/><?php echo $value[1] ?></a>
                            <?php if (++$iterator < $videoCount || $is_child) {
                                echo '<p class="d-line"></p>';
                            } ?>
                        </li>

                    <?php
                    }
                    ?>
                    <?php if ($is_child) {
                        echo '<li><a class="" href="' . get_permalink($page_metas['page_selector'][0]) . '">Click Here To Get<br />Started Now</a></li>}';
                    } ?>
                </ul>
            </div>
        </div>

    </div>
    <?php
    return ob_get_clean();
});
?>
<?php
add_shortcode('dw_videobox_single', function ($attr, $content) {

    ob_start();
    ?>
    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit">
        <div class="row-fluid">
            <div class="span12">
                <?php
                $is_child = (wp_get_post_parent_id(get_the_ID()) > 0);
                query_posts(array('post_type' => 'video', 'meta_query' => array(array('key' => 'page_selector', 'value' => get_the_ID())), 'orderby' => 'title', 'order' => 'ASC'));
                ?>
                <?php
                $index = 0;
                while (have_posts()) : the_post();
                    $post_metas = get_post_meta(get_the_ID());
                    foreach ($post_metas as $key => $value) {
                        if (strpos($key, 'wpcf') === 0) {
                            $videos[$index][$key] = $value[0];
                        }
                    }
                    parse_str(str_replace(array(' ', '"'), array('&', ''), $videos[$index]['wpcf-iframe']), $videos[$index]['wpcf-iframe']);
                    $index++;
                endwhile;
                ?>
                <div class="sbox"></div>
                <div class="sboxForm">
                    <?php
                    echo $page_content;
                    ?>
                    <?php
                    dynamic_sidebar('sidebar-5');
                    ?>
                    <a href="#" class="skipVideo">Skip and continue to play</a>
                </div>
                <?php if (isset($videos[0]['wpcf-iframe']['src'])) : ?>
                    <iframe
                        data-source="<?php echo $videos[0]['wpcf-iframe']['src'] . (isset($videos[0]['wpcf-onend']) ? '' : '|' . $videos[0]['wpcf-time']) ?>"
                        width="100%" height="390"
                        src="<?php echo $videos[0]['wpcf-iframe']['src']; ?>?enablejsapi=1&wmode=opaque" frameborder="0"
                        allowfullscreen id="player"></iframe>
                <?php else: ?>
                    <h3 style="color:red; text-align: center    ">No video for this page</h3>


                <?php endif; ?>
            </div>

        </div>
     <!--   <div class="opt-in-btn" style="outline: none;">
            <div
                class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin">
                <div

                    >
                    <a href="<?php /*echo $content; */?>"
                       class="elButton elButtonColor1 elButtonFull elButtonSize3 elButtonIcon7 elButtonGradient elButtonTxtColor2"
                        >
                        <div class="elButtonMain"><?php /*echo isset($attr['line1']) ? $attr['line1'] : ''; */?></div>
                        <div class="elButtonSub"><?php /*echo isset($attr['line2']) ? $attr['line2'] : ''; */?></div>
                    </a>
                </div>
            </div>
        </div>--><!--   <div class="opt-in-btn" style="outline: none;">
            <div
                class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin">
                <div

                    >
                    <a href="<?php /*echo $content; */?>"
                       class="elButton elButtonColor1 elButtonFull elButtonSize3 elButtonIcon7 elButtonGradient elButtonTxtColor2"
                        >
                        <div class="elButtonMain"><?php /*echo isset($attr['line1']) ? $attr['line1'] : ''; */?></div>
                        <div class="elButtonSub"><?php /*echo isset($attr['line2']) ? $attr['line2'] : ''; */?></div>
                    </a>
                </div>
            </div>
        </div>-->

    </div>


    <?php
    return ob_get_clean();
});
add_filter('protected_title_format', 'blank');
function blank($title) {
    return '%s';
}
?>
