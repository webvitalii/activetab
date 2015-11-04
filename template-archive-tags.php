<?php
/*
Template Name: Archive (tags)
*/

?><?php get_header(); ?>

<?php get_template_part( 'template-part', 'wrap-before' ); ?>

	<?php while ( have_posts() ) : the_post(); // the loop ?>

		<?php get_template_part( 'content', 'page' ); ?>

		<article class="hentry">
			<?php wp_tag_cloud( array( 'number' => '0' /*'orderby' => 'count', 'order' => 'DESC'*/ ) ); ?>
		</article>

		<?php comments_template( '', true ); ?>

	<?php endwhile; // end of the loop ?>

<?php get_template_part( 'template-part', 'wrap-after' ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>