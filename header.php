<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php // add support for html5 elements in older IE versions ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->

<?php wp_head(); // wp_head() should be just before the closing </head> tag, or many plugins will be broken ?>

</head>


<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

<?php
$menu_position_type = of_get_option( 'menu_position_type', 'fixed' );
if( $menu_position_type == 'fixed' ) {
	$menu_position_class = 'navbar-fixed-top';
} else { // static
	$menu_position_class = 'navbar-static-top';
}
?>

<div class="navbar navbar-inverse <?php echo $menu_position_class; ?>">

	<div class="container site-container">
		<nav class="site-navigation main-navigation" role="navigation">
		<?php //wp_list_pages('title_li='); // list of pages ?>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary-nav',
			'container' => 'nav',
			'container_class' => 'nav-menu clearfix',
			'menu_class' => 'nav',
			'fallback_cb' => 'activetab_list_pages'
		) );
		?>
		</nav> <!-- /.site-navigation /.main-navigation -->
	</div> <!-- /.container /.site-container -->

</div> <!-- /.container /.site-container -->

<?php if( $menu_position_type == 'fixed' ) : ?>
<div class="site-content-pusher"><!-- push content because of fixed menu --></div>
<?php endif; ?>




<div class="container site-container">
<div class="site-wrapper border-radius">
<div class="row">
<div class="col-sm-12">
<div class="row">

	<div id="main" class="site-main">
