
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

	<header class="entry-header page-header">

		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php echo activetab_post_meta(); ?>
	</header> <!-- /.entry-header -->

	<?php get_template_part( 'template-part', 'thumbnail-single' ); ?>

	<section class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="wp_link_pages clearfix"><span class="wp_link_pages-item-empty">' . __( 'Pages:', 'activetab' ).'</span>', 'after' => '</div>', 'link_before' => '<span class="wp_link_pages-item">', 'link_after' => '</span>', 'pagelink' => '%' ) ); ?>
	</section> <!-- /.entry-content -->

</article> <!-- /#post-<?php the_ID(); ?> -->
