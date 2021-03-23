<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="preconnect" href="https://fonts.gstatic.com"> <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;600&display=swap" rel="stylesheet"> 
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="uk-navbar-container" uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent ; top: 300">	
	<nav class="uk-navbar-container uk-container" uk-navbar>
		<div class="uk-navbar-left">
			<a href="<?php echo home_url(); ?>/" class="uk-navbar-item uk-logo uk-text-center">
				<img src="<?php echo get_template_directory_uri(); ?>/img/silicodevalley-logo.svg" width="100px" alt="<?php bloginfo('title'); ?> - <?php bloginfo('description'); ?>">
			</a>
		</div>
		<div class="uk-navbar-right">
			<?php if ( has_nav_menu('main_menu') ): ?>
			<?php wp_nav_menu(
				array(
					'theme_location' 	=> 	'main_menu',
					'container' 		=> 	false,
					'menu_class' 		=> 	'uk-navbar-nav uk-visible@m',
					'walker' 			=> 	new silicodevalley_acf_wp_theme_top_menu
				)
			); ?>
			<?php endif; ?>
			<?php if ( has_nav_menu('mobile_menu')): ?>
			<a class="uk-navbar-toggle uk-hidden@m uk-hidden@l" uk-toggle="target: #main-nav">
				<span uk-navbar-toggle-icon></span><span class="uk-margin-small-left">Menú</span>
			</a>
			<?php endif ;?>
		</div>
	</nav>
	</header>
	
	<?php // OFFCANVAS ?>
	<aside id="main-nav" uk-offcanvas="flip: true; overlay: true">
		<button class="uk-offcanvas-close uk-close uk-icon uk-position-fixed" type="button" data-uk-close=""></button>
		<div class="msp-main-nav uk-offcanvas-bar uk-box-shadow-small uk-offcanvas-bar-animation uk-offcanvas-slide">
			<?php wp_nav_menu(
				array(
					'theme_location' 	=> 	'mobile_menu',
					'container' 		=> 	false,
					'menu_class' 		=> 	'uk-nav uk-nav-primary',
					'walker' 			=> 	new silicodevalley_acf_wp_theme_offcanvas_menu	
				)
			); ?>
		</div>
	</aside>
	<?php // /OFFCANVAS ?>