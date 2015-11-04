

</div> <!-- /#main /.site-main -->

</div> <!-- /.row -->


<footer id="colophon" class="site-footer clearfix" role="contentinfo">

	<div class="row">

		<div class="col-sm-8">
			<div class="site-footer-left">

				<?php if ( ! dynamic_sidebar( 'footer' ) ) : // the footer widgetized area ?>
					<!-- no widgets in footer -->
				<?php endif; // end of the footer widgetized area ?>

			</div> <!-- /.site-footer-left -->
		</div> <!-- /.col-sm-8 -->

		<div class="col-sm-4">
			<div class="site-footer-right text-right">

				<?php if ( is_home() || is_front_page() ) : // show credit links only on homepage
					// it is completely optional, but if you like the theme I would appreciate it if you keep the credit link at the bottom ?>
					<?php _e( 'Powered by', 'activetab' ); ?>
					<a href="http://wordpress.org/" title="<?php _e( 'WordPress CMS', 'activetab' ); ?>" alt="<?php echo esc_attr( __( 'WordPress', 'activetab' ) ); ?>"><i class="dashicons dashicons-wordpress"></i></a>
					<?php _e( '&', 'activetab' ); ?>
					<a href="http://web-profile.com.ua/wordpress/themes/activetab/" title="<?php _e( 'activetab theme', 'activetab' ); ?>"><?php _e( 'activetab', 'activetab' ); ?></a>
				<?php endif; ?>

				<a href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>" class="rss-feed-link" title="<?php echo esc_attr( __( 'Posts RSS feed', 'activetab' ) ); ?>"><i class="dashicons dashicons-rss"></i></a>
				<a href="<?php echo esc_url( get_bloginfo( 'comments_rss2_url' ) ); ?>" class="rss-feed-link" title="<?php echo esc_attr( __( 'Comments RSS feed', 'activetab' ) ); ?>"><i class="dashicons dashicons-rss"></i></a>

			</div> <!-- /.site-footer-right -->
		</div> <!-- /.col-sm-4 -->

	</div> <!-- /.row -->


</footer> <!-- /#colophon /.site-footer -->

</div> <!-- /.col-sm-12 -->
</div> <!-- /.row -->
</div> <!-- /.site-wrapper -->
</div> <!-- /.container -->

</div> <!-- /#page /.hfeed -->

<?php wp_footer(); // wp_footer() should be just before the closing </body> tag, or many plugins will be broken  ?>

</body>

</html>