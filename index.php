<?php get_header(); ?>


<?php get_template_part( 'template-part', 'wrap-before' ); ?>

				<?php if (have_posts()) : ?>

					<?php echo activetab_nav(); ?>

					<?php while ( have_posts() ) : the_post(); // the loop ?>

						<?php get_template_part( 'content' ); ?>

						<?php comments_template( '', true ); ?>

					<?php endwhile; // end of the loop ?>

					<?php echo activetab_nav( 'bottom' ); ?>

				<?php else : ?>

					<article class="post no-results not-found">
						<header class="entry-header page-header">
							<h1 class="entry-title"><?php _e( 'No posts to display', 'activetab' ); ?></h1>
						</header><!-- /.entry-header -->

						<div class="entry-content">
							<?php get_search_form(); ?>
						</div><!-- /.entry-content -->
					</article><!-- /#post-0 -->

				<?php endif; ?>

<?php get_template_part( 'template-part', 'wrap-after' ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>