<?php
/*
Template Name: Archive
*/

?><?php get_header(); ?>

<?php get_template_part( 'template-part', 'wrap-before' ); ?>

	<?php while ( have_posts() ) : the_post(); // the loop ?>

		<?php get_template_part( 'content', 'page' ); ?>


		<article class="hentry">
			<h3><?php _e( 'Archives', 'activetab' ); ?></h3>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly', 'show_post_count' => 1 ) ); ?>
			</ul>
		</article>


		<article class="hentry">
			<h3><?php _e( 'Categories', 'activetab' ); ?></h3>
			<ul>
				<?php wp_list_categories( array( 'title_li' => '', 'show_count' => 1, 'hide_empty' => 1 ) ); ?>
			</ul>
		</article>


		<article class="hentry">
			<h3><?php _e( 'Tags', 'activetab' ); ?></h3>
			<?php wp_tag_cloud( array( 'number' => '0' /*'orderby' => 'count', 'order' => 'DESC'*/ ) ); ?>
		</article>


		<?php comments_template( '', true ); ?>

	<?php endwhile; // end of the loop ?>

<?php get_template_part( 'template-part', 'wrap-after' ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>