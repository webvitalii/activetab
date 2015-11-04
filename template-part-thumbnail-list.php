
	<?php if ( has_post_thumbnail( $post->ID ) ) { ?>
		<div class="wrap-thumbnail">
		<?php
			echo '<a href="' . esc_url( get_permalink() ) . '" class="" title="' . the_title_attribute( 'echo=0' ) . '" >';
			the_post_thumbnail( 'thumbnail' ); /* thumbnail, medium, large, full, thumb-100, thumb-200, thumb-400, array(100,100) */
			echo '</a>';
		?>
		</div>
	<?php } ?>
