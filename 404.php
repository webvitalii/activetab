<?php get_header(); ?>

<?php get_template_part( 'template-part', 'wrap-before' ); ?>

					<article class="post error-404 page-not-found">
						<header class="entry-header page-header">
							<h1 class="entry-title"><?php _e( 'Page not found. Error 404', 'activetab' ); ?></h1>
						</header><!-- /.entry-header -->


						<div class="entry-content">
							<div class="alert alert-danger">
								<?php _e( 'The URL you requested could not be found.', 'activetab' ); ?>
							</div>

							<?php get_search_form(); ?>


							<?php
							$args = array( // 3 most popular posts ordered by comment count
								'numberposts' => 3,
								'post_status' => 'publish',
								'post_type' => 'post',
								'orderby' => 'comment_count',
								'order' => 'desc'
							);
							$popular_posts = get_posts( $args );
							if( ! empty( $popular_posts ) ) : // show only if we have posts
							?>
							<h3><?php _e( 'Popular posts', 'activetab' ); ?></h3>
							<ul>
								<?php
								foreach( $popular_posts as $popular_post ) : setup_postdata( $popular_post );
									echo '<li><a href="' . esc_url( get_page_link( $popular_post->ID ) ) . '">' . $popular_post->post_title . '</a></li>';
								endforeach; ?>
							</ul>
							<?php endif; ?>


							<?php
							$args = array( // 3 most recent posts ordered by publish date
								'numberposts' => 3,
								'post_status' => 'publish',
								'post_type' => 'post',
								'orderby' => 'post_date',
								'order' => 'desc'
							);
							$recent_posts = get_posts( $args );
							if( ! empty( $recent_posts ) ) : // show only if we have posts
							?>
							<h3><?php _e( 'Recent posts', 'activetab' ); ?></h3>
							<ul>
								<?php
								foreach( $recent_posts as $recent_post ) : setup_postdata( $recent_post );
									echo '<li><a href="' . esc_url( get_page_link( $recent_post->ID ) ) . '">' . $recent_post->post_title . '</a></li>';
								endforeach; ?>
							</ul>
							<?php endif; ?>


						</div><!-- /.entry-content -->
					</article><!-- /#post-0 -->

<?php get_template_part( 'template-part', 'wrap-after' ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>