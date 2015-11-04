
	<?php if ( has_post_thumbnail( $post->ID ) ) { ?>
		<div class="wrap-thumbnail">
		<?php
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
			echo '<a href="' . esc_url( $large_image_url[0] ) . '" class="" title="' . the_title_attribute( 'echo=0' ) . '" >';
			the_post_thumbnail( 'thumbnail' ); /* thumbnail, medium, large, full, thumb-100, thumb-200, thumb-400, array(100,100) */
			echo '</a>';
		?>
		</div>
	<?php } ?>
