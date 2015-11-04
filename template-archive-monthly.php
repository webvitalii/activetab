<?php
/*
Template Name: Archive (monthly)
*/

?><?php get_header(); ?>

<?php get_template_part( 'template-part', 'wrap-before' ); ?>

	<?php while ( have_posts() ) : the_post(); // the loop ?>

		<?php get_template_part( 'content', 'page' ); ?>

		<article class="hentry">
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly', 'show_post_count' => 1 ) ); ?>
			</ul>
		</article>

		<?php comments_template( '', true ); ?>

	<?php endwhile; // end of the loop ?>

<?php get_template_part( 'template-part', 'wrap-after' ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>