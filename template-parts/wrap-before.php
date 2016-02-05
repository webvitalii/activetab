<?php
// global $wp_query;
// $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

$col_class = 'col-sm-6';

$settings = activetab_get_settings();

$logo_url = $settings['logo_url'];

if( $settings['layout'] == 'sidebar-content' || $settings['layout'] == 'content-sidebar' ) {
	$col_class = 'col-sm-9';
}

if( $settings['layout'] == 'content' ) {
	$col_class = 'col-sm-12';
}

if( is_page_template ( 'template-full-width-no-sidebar.php' ) ){ // show wide column if sidebar is removed
	$col_class = 'col-sm-12 full-width-wrap';
}
?>
			<div class="<?php echo $col_class; ?> clearfix">



<?php
$title_desc = esc_attr( get_bloginfo( 'name', 'display' ) );
if ( get_bloginfo( 'description' ) ) { // add desc to title attr
	$title_desc .= ' | '.esc_attr( get_bloginfo( 'description', 'display' ) );
}
 
if ( activetab_is_homepage() ) {
	$link_before = '';
	$link_after = '';
} else {
	$link_before = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . $title_desc . '">';
	$link_after = '</a>';
}
?>

				<header class="site-header clearfix" role="banner">

					<?php if ( ! empty( $logo_url ) ) : ?>
					<div class="site-logo">
						<?php echo $link_before; ?><img src="<?php echo $logo_url; ?>" alt="<?php echo $title_desc; ?>"><?php echo $link_after; ?>
					</div><!-- .site-logo -->
					<?php endif; ?>
				
					<h3 class="site-title"><?php echo $link_before; ?><?php bloginfo( 'name' ); ?><?php echo $link_after; ?></h3>

					<?php if ( get_bloginfo( 'description' ) ) : ?>
					<h4 class="site-description text-muted"><?php bloginfo( 'description' ); ?></h4>
					<?php endif; ?>

				</header><!-- .site-header -->

			

				<div id="primary" class="content-area">
					<div id="content" class="site-content" role="main">

