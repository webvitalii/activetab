
	<?php if ( has_post_thumbnail( $post->ID ) ) { ?>
		<div class="image-full">
		<?php
			$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			echo '<a href="' . esc_url( $image_url[0] ) . '" class="" title="' . the_title_attribute( 'echo=0' ) . '" target="_blank">';
			the_post_thumbnail( 'full' ); // thumbnail, medium, large, full, array(100,100)
			echo '</a>';
		?>
		</div>
	<?php } ?>
