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
    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-146488988-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-146488988-1');
	</script>
	<?php
	wp_head();
    ?>
    
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	
</head>

<body <?php body_class(); ?>> 

<div class="body-wrap">
   
	<nav class="navbar navbar-expand-xl pt-4 transparent-nav" id="stickyHeader">
		
		<div class="container custom-container p-0">
			
			<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png">
			</a>
			
			
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"><img src="<?php echo get_template_directory_uri(); ?>/img/open.png"></span>
            </button>
                
            <div class="collapse navbar-collapse main-menu" id="navbarTogglerDemo03">
				
				<div class="mob-menu-logo">
					<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
					  <span class="navbar-toggler-icon"><img src="<?php echo get_template_directory_uri(); ?>/img/close.png"></span>
					</button>
					
				</div>
		
				  <?php 
				  
				  echo wp_nav_menu(array(
                'menu' => 'Members',
                //'container_class' => 'nav-collapse collapse',
                'menu_class' => 'navbar-nav ml-auto mt-2 mt-lg-0',
                'walker' => new SecondaryMenuCustomizer));
				
				?>
					
					
	  
					<div class="social-menu-top">
                    	<ul>        
							<li>
								<a><i class="fa fa-twitter" aria-hidden="true"></i></a>
							</li>                        
							<li>
								<a><i class="fa fa-facebook" aria-hidden="true"></i></a>
							</li>
							 
							<li>
								  <a href="https://www.linkedin.com/company/adapdix/"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
							</li>
							<li>
								  <a>
									<img src="<?php echo get_template_directory_uri(); ?>/img/medium.png" class="medium-icon">
								  </a>
							</li>
							  
						</ul>
					</div> 
            </div>
			
		</div>
		
		  
	  </nav>
	  
	 