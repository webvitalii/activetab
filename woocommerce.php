<?php get_header(); ?>

<?php get_template_part( 'template-part', 'wrap-before' ); ?>

	<?php woocommerce_content(); ?>

<?php get_template_part( 'template-part', 'wrap-after' ); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>