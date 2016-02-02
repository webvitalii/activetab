<?php get_header(); ?>

<?php get_template_part( 'template-parts/wrap', 'before' ); ?>

	<?php woocommerce_content(); ?>

<?php get_template_part( 'template-parts/wrap', 'after' ); ?>

<?php get_sidebar( 'after-content' ); ?>

<?php get_footer(); ?>