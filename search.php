<?php get_header(); ?>

<?php get_sidebar( 'before-content' ); ?>

<?php get_template_part( 'template-parts/wrap', 'before' ); ?>


		<?php if ( have_posts() ) : ?>

		<header class="entry-header page-header">
			<h1 class="entry-title">
				<?php _e( 'Search results for:', 'activetab' ); ?>
				<?php echo get_search_query(); ?>
			</h1>

			<?php get_search_form(); ?>

		</header><!-- .entry-header .page-header -->

		<?php echo activetab_nav(); ?>

			<?php while ( have_posts() ) : the_post(); // the loop ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

		<?php echo activetab_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/nothing', 'found' ); ?>

		<?php endif; ?>


<?php get_template_part( 'template-parts/wrap', 'after' ); ?>

<?php get_sidebar( 'after-content' ); ?>

<?php get_footer(); ?>
