
<?php

if ( activetab_is_homepage() ) {
	$link_before = '';
	$link_after = '';
} else {
	$link_before = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . $title_desc . '">';
	$link_after = '</a>';
}
?>

	<header id="masthead" class="site-header clearfix" role="banner">

		<h3 class="site-title"><?php echo $link_before; ?><?php bloginfo( 'name' ); ?><?php echo $link_after; ?></h3>

		<?php if ( get_bloginfo( 'description' ) ) : ?>
		<h4 class="site-description text-muted"><?php bloginfo( 'description' ); ?></h4>
		<?php endif; ?>

	</header><!-- #masthead .site-header -->
