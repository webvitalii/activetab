<?php get_header(); ?>

<?php get_template_part( 'template-parts/wrap', 'before' ); ?>

	<?php while ( have_posts() ) : the_post(); // the loop ?>

		<?php get_template_part( 'content', 'page' ); ?>

		<?php comments_template( '', true ); ?>

	<?php endwhile; // end of the loop ?>

<?php get_template_part( 'template-parts/wrap', 'after' ); ?>

<?php get_sidebar( 'after-content' ); ?>

<?php get_footer(); ?>