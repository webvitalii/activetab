<?php get_header(); ?>


<?php get_template_part( 'template-part', 'wrap-before' ); ?>

				<?php if (have_posts()) : ?>

					<header class="entry-header page-header">
						<h1 class="entry-title"><?php
							echo get_the_archive_title();
							echo activetab_rss_button();
						?></h1>

						<?php
						// todo: replace with: echo get_the_archive_description();
						$term_description = term_description();
						if ( ! empty( $term_description ) ) { // show an optional term description
							echo '<div class="taxonomy-description">' . $term_description . '</div>';
						}
						?>

					</header> <!-- /.entry-header /.page-header -->


					<?php echo activetab_nav(); ?>

					<?php while ( have_posts() ) : the_post(); // the loop ?>

						<?php get_template_part( 'content', 'list' ); ?>

					<?php endwhile; // end of the loop ?>

					<?php echo activetab_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'template-part', 'nothing-found' ); ?>

				<?php endif; ?>

<?php get_template_part( 'template-part', 'wrap-after' ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>