<?php get_header(); ?>

<?php get_template_part( 'template-part', 'wrap-before' ); ?>



					<?php while ( have_posts() ) : the_post(); // the loop ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<header class="entry-header page-header">
									<h1 class="entry-title"><?php the_title(); ?></h1>

									<?php echo activetab_post_meta(); ?>

									<div class="entry-meta">
										<?php
										$metadata = wp_get_attachment_metadata();
										printf( __( '<a href="%1$s">%2$s &times; %3$s</a> in <a href="%4$s" title="Return to %5$s">%6$s</a>', 'activetab' ),
											wp_get_attachment_url(),
											$metadata['width'],
											$metadata['height'],
											get_permalink( $post->post_parent ),
											esc_attr( get_the_title( $post->post_parent ) ),
											get_the_title( $post->post_parent )
										);
										?>
									</div><!-- /.entry-meta -->

								</header><!-- /.entry-header -->

								<div class="entry-content">

									<div class="entry-attachment">
										<div class="attachment">
											<?php
											/**
											 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
											 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
											 */
											$attachments = array_values( get_children( array(
												'post_parent'    => $post->post_parent,
												'post_status'    => 'inherit',
												'post_type'      => 'attachment',
												'post_mime_type' => 'image',
												'order'          => 'ASC',
												'orderby'        => 'menu_order ID'
											) ) );
											foreach ( $attachments as $k => $attachment ) {
												if ( $attachment->ID == $post->ID )
													break;
											}
											$k++;
											// If there is more than 1 attachment in a gallery
											if ( count( $attachments ) > 1 ) {
												if ( isset( $attachments[ $k ] ) )
													// get the URL of the next image attachment
													$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
												else
													// or get the URL of the first image attachment
													$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
											} else {
												// or, if there's only 1 image, get the URL of the image
												$next_attachment_url = wp_get_attachment_url();
											}
											?>

											<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php
												echo wp_get_attachment_image( $post->ID, array( 1200, 1200 ) );
												?></a>
										</div><!-- /.attachment -->

										<?php if ( ! empty( $post->post_excerpt ) ) : ?>
											<div class="entry-caption">
												<?php the_excerpt(); ?>
											</div><!-- /.entry-caption -->
										<?php endif; ?>
									</div><!-- /.entry-attachment -->

									<?php the_content(); ?>
									<?php wp_link_pages( array( 'before' => '<div class="wp_link_pages clearfix"><span class="wp_link_pages-item-empty">' . __( 'Pages:', 'activetab' ).'</span>', 'after' => '</div>', 'link_before' => '<span class="wp_link_pages-item">', 'link_after' => '</span>', 'pagelink' => '%' ) ); ?>

								</div><!-- /.entry-content -->


							</article><!-- /#post-<?php the_ID(); ?> -->


					<?php endwhile; // end of the loop ?>


<?php get_template_part( 'template-part', 'wrap-after' ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>