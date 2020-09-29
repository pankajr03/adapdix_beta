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
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>

    <![endif]-->
    <?php
    wp_enqueue_style('mytradesignals-members', get_template_directory_uri() . '/css/private-members-land.css', array(), '20130723');
    wp_head();
    ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
</head>

<body <?php body_class(); ?>>
<div class="top-logos clearfix">
    <div class="container">
        <div class="left-log">
            <a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><img
                    src="<?php echo get_template_directory_uri(); ?>/images/dwe-logo.png"/></a>
        </div>
        <div  class="right-log">
            <a class="logo-members" href="#">Members Area</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Static navbar -->
<div class="navbar navbar-static-top">

    <div class="navbar-inner">
        <div class="container">


            <?php echo wp_nav_menu(array(
                'menu' => 'Members',
                //'container_class' => 'nav-collapse collapse',
                'menu_class' => 'nav',
                'walker' => new SecondaryMenuCustomizer));
            ?>

            <!--/.nav-collapse -->
        </div>
    </div>
</div>