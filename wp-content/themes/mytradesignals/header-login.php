<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>

    <![endif]-->
    <?php
    wp_enqueue_style('mytradesignals-login', get_template_directory_uri() . '/css/login.css', array(), '20130723');
    wp_enqueue_style('mytradesignals-home', get_template_directory_uri() . '/css/home.css', array(), '20130723');
    wp_head();
    ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
</head>

<body <?php body_class('login'); ?> >
<div id="wrap">
<div class="navbar navbar-static-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><img
                    src="<?php echo get_template_directory_uri(); ?>/img/logo.png"/></a>

            <?php echo wp_nav_menu(array(
                'menu' => 'Home',
                'container_class' => 'nav-collapse collapse',
                'menu_class' => 'nav pull-right',
                'walker' => new MenuCustomizer)); ?>

            <!--/.nav-collapse -->
        </div>
    </div>
</div>
