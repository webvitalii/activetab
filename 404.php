<?php get_header(); ?>

<?php get_sidebar( 'before-content' ); ?>

<?php get_template_part( 'template-parts/wrap', 'before' ); ?>

					<article class="post error-404 page-not-found">
						<header class="entry-header page-header">
							<h1 class="entry-title"><?php _e( 'Page not found. Error 404', 'activetab' ); ?></h1>
						</header><!-- .entry-header -->


						<div class="entry-content">
							<div class="alert alert-danger">
								<?php _e( 'The URL you requested could not be found.', 'activetab' ); ?>
							</div>

							<?php get_search_form(); ?>

						</div><!-- .entry-content -->
					</article><!-- .post -->

<?php get_template_part( 'template-parts/wrap', 'after' ); ?>

<?php get_sidebar( 'after-content' ); ?>

<?php get_footer(); ?>