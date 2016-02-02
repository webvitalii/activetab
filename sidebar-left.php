
				<div class="col-sm-3">
					<div class="widget-area widget-area-left" role="complementary">

						<?php if ( ! dynamic_sidebar( 'sidebar_left' ) ) : // sidebar widgetized area ?>
							<?php
								// show something if there is no widgets in main sidebar
							?>


							<aside class="widget widget_search">
								<?php get_search_form(); ?>
							</aside>


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
							<aside class="widget widget_popular_entries">
								<h4 class="widget-title"><?php _e( 'Popular posts', 'activetab' ); ?></h4>
								<ul>
									<?php
									foreach( $popular_posts as $popular_post ) : setup_postdata( $popular_post );
										echo '<li><a href="' . esc_url( get_page_link( $popular_post->ID ) ) . '">' . $popular_post->post_title . '</a></li>';
									endforeach; ?>
								</ul>
							</aside>
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
							<aside class="widget widget_recent_entries">
								<h4 class="widget-title"><?php _e( 'Recent posts', 'activetab' ); ?></h4>
								<ul>
									<?php
									foreach( $recent_posts as $recent_post ) : setup_postdata( $recent_post );
										echo '<li><a href="' . esc_url( get_page_link( $recent_post->ID ) ) . '">' . $recent_post->post_title . '</a></li>';
									endforeach; ?>
								</ul>
							</aside>
							<?php endif; ?>


							<aside class="widget widget_categories">
								<h4 class="widget-title"><?php _e( 'Categories', 'activetab' ); ?></h4>
								<ul>
									<?php
									$cat_args = array(
										'show_option_all' => '',
										'orderby' => 'name',
										'order' => 'ASC',
										'style' => 'list',
										'show_count' => 1,
										'hide_empty' => 1,
										'use_desc_for_title' => 1,
										'child_of' => 0,
										'hierarchical' => 1,
										'title_li' => '',
										'number' => null,
										'depth' => 0,
									);
									wp_list_categories( $cat_args ); // http://codex.wordpress.org/Template_Tags/wp_list_categories
									?>
								</ul>
							</aside>


							<aside class="widget widget_meta">
								<h4 class="widget-title"><?php _e( 'Meta', 'activetab' ); ?></h4>
								<ul>
									<?php wp_register(); ?>
									<li><?php wp_loginout(); ?></li>
								</ul>
							</aside>


						<?php endif; // end of the sidebar widgetized area ?>

					</div><!-- .widget-area .widget-area-left -->
				</div><!-- .col-sm-3 -->
