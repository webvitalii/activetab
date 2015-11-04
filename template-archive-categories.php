<?php
/*
Template Name: Archive (categories)
*/

?><?php get_header(); ?>

<?php get_template_part( 'template-part', 'wrap-before' ); ?>

	<?php while ( have_posts() ) : the_post(); // the loop ?>

		<?php get_template_part( 'content', 'page' ); ?>

		<article class="hentry">
			<ul>
				<?php wp_list_categories( array( 'title_li' => '', 'show_count' => 1, 'hide_empty' => 1 ) ); ?>
			</ul>
		</article>

		<?php comments_template( '', true ); ?>

	<?php endwhile; // end of the loop ?>

<?php get_template_part( 'template-part', 'wrap-after' ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>