<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); // wp_head() should be just before the closing </head> tag, or many plugins will be broken ?>

</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

<div class="navbar navbar-inverse navbar-fixed-top">

	<div class="container site-container">
		<nav class="site-navigation main-navigation" role="navigation">
		<?php //wp_list_pages('title_li='); // list of pages ?>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary-nav',
			'container' => 'nav',
			'container_class' => 'nav-menu fx-menu fx-menu-dark-transparent clearfix',
			'menu_class' => 'nav',
			'fallback_cb' => 'activetab_list_pages'
		) );
		?>
		</nav><!-- .site-navigation .main-navigation -->
	</div><!-- .container .site-container -->

</div><!-- .container .site-container -->

<div class="site-content-pusher"><!-- push content because of fixed menu --></div>


<div class="container site-container">
<div class="site-wrapper border-radius">
<div class="row">
<div class="col-sm-12">
<div class="row">

	<div id="main" class="site-main">
