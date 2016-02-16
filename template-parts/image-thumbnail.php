
	<?php if ( has_post_thumbnail( $post->ID ) ) { ?>
		<div class="image-thumbnail">
		<?php
			echo '<a href="' . esc_url( get_permalink() ) . '" class="" title="' . the_title_attribute( 'echo=0' ) . '" >';
			the_post_thumbnail( 'thumbnail' ); // thumbnail, medium, large, full, array(100,100)
			echo '</a>';
		?>
		</div>
	<?php } ?>
