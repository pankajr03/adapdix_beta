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

    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <![endif]-->
    <?php
    wp_enqueue_style('mytradesignals-home', get_template_directory_uri() . '/css/public-contact.css', array(), '201301723');
    wp_head();
    ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
</head>

<body <?php body_class(); ?>>
<div class="navbar navbar-static-top">
    <div class="navbar-inner">
        <div class="container">
            <div class="navbar-inner-left text-center">
                <img src="<?php echo get_template_directory_uri(); ?>/images/dwe-logo.png"/>
            </div>
            <div class="navbar-inner-right text-center">
                <?php echo wp_nav_menu(array(
                    'menu' => 'Home',
                    //'container_class' => 'nav-collapse collapse',
                    //'menu_class' => 'nav pull-right',
                    'items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul><div class="clearfix" ></div>',
                    'menu_class' => 'nav',
                    'walker' => new MenuCustomizer));
                ?>

            </div>
        </div>
    </div>
</div>
