<?php
// global $wp_query;
// $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
$col_class = 'col-sm-8';
if( is_page_template ( 'template-full-width-no-sidebar.php' ) ){ // show wide column if sidebar is removed
	$col_class = 'col-sm-12 full-width-wrap';
}
?>
			<div class="<?php echo $col_class; ?> clearfix">

				<?php get_template_part( 'template-part', 'logo-title-description' ); ?>

				<div id="primary" class="content-area">
					<div id="content" class="site-content" role="main">

