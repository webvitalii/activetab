<?php get_header(); ?>


<?php get_template_part( 'template-part', 'wrap-before' ); ?>

				<?php if (have_posts()) : ?>

					<header class="entry-header page-header">
						<h1 class="entry-title">
							<?php
							if ( is_category() ) {
								printf( __( 'Category: %s', 'activetab' ), '<span>' . single_cat_title( '', false ) . '</span>' );
								echo '<a href="'.get_category_feed_link( get_query_var( 'cat' ) ).'" class="rss-feed-link" title="'.esc_attr( __( 'Category RSS feed', 'activetab' ) ).'"><i class="dashicons dashicons-rss"></i></a>';

							} elseif ( is_tag() ) {
								printf( __( 'Tag: %s', 'activetab' ), '<span>' . single_tag_title( '', false ) . '</span>' );
								echo '<a href="'.get_tag_feed_link( get_query_var( 'tag_id' ) ).'" class="rss-feed-link" title="'.esc_attr( __( 'Tag RSS feed', 'activetab' ) ).'"><i class="dashicons dashicons-rss"></i></a>';

							} elseif ( is_author() ) {
								/* Queue the first post, that way we know what author we're dealing with (if that is the case). */
								the_post();
								printf( __( 'Author: %s', 'activetab' ), '<span class="vcard">' . get_the_author() . '</span>' );
								/* Since we called the_post() above, we need to rewind the loop back to the beginning that way we can run the loop properly, in full. */
								rewind_posts();
								echo '<a href="'.get_author_feed_link( get_the_author_meta( 'ID' ) ).'" class="rss-feed-link" title="'.esc_attr( __( 'Author RSS feed', 'activetab' ) ).'"><i class="dashicons dashicons-rss"></i></a>';

							} elseif ( is_day() ) {
								printf( __( 'Day: %s', 'activetab' ), '<span>' . get_the_date() . '</span>' );

							} elseif ( is_month() ) {
								printf( __( 'Month: %s', 'activetab' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

							} elseif ( is_year() ) {
								printf( __( 'Year: %s', 'activetab' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

							} else {
								_e( 'Archives', 'activetab' );

							}
							?>
						</h1>

						<?php
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