
<?php
$logo_url = of_get_option( 'logo_url', '' );
$show_site_title = of_get_option( 'show_site_title', '1' );
$show_site_description = of_get_option( 'show_site_description', '1' );

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

if ( ! empty( $logo_url ) || ! empty( $show_site_title ) || ! empty( $show_site_description ) ) : ?>
	<header id="masthead" class="site-header clearfix" role="banner">
		<div class="site-logo-title clearfix">
			<?php if ( ! empty( $logo_url ) ) : ?>
				<div class="site-logo">
					<?php echo $link_before; ?><img src="<?php echo $logo_url; ?>" alt="<?php echo $title_desc; ?>"><?php echo $link_after; ?>
				</div> <!-- /.site-logo -->
			<?php endif; ?>

			<div class="site-title-description">
			<?php if ( ! empty( $show_site_title ) ) : ?>
				<h3 class="site-title"><?php echo $link_before; ?><?php bloginfo( 'name' ); ?><?php echo $link_after; ?></h3>
			<?php endif; ?>

			<?php if ( ! empty( $show_site_description ) ) : ?>
				<?php if ( get_bloginfo( 'description' ) ) : ?>
				<h4 class="site-description muted"><?php bloginfo( 'description' ); ?></h4>
				<?php endif; ?>
			<?php endif; ?>
			</div> <!-- /.site-title-description -->

		</div> <!-- /.site-logo-title -->
	</header> <!-- /#masthead /.site-header -->
<?php endif; ?>
