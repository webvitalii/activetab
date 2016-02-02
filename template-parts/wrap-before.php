<?php
// global $wp_query;
// $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
$col_class = 'col-sm-8';
if( is_page_template ( 'template-full-width-no-sidebar.php' ) ){ // show wide column if sidebar is removed
	$col_class = 'col-sm-12 full-width-wrap';
}
?>
			<div class="<?php echo $col_class; ?> clearfix">



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

			

				<div id="primary" class="content-area">
					<div id="content" class="site-content" role="main">

