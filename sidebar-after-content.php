<?php

$settings = activetab_get_settings();

if( $settings['layout'] == 'content-sidebar-sidebar' ) {
	get_sidebar( 'left' );
}

if( $settings['layout'] == 'content-sidebar' || $settings['layout'] == 'content-sidebar-sidebar' || $settings['layout'] == 'sidebar-content-sidebar' ) {
	get_sidebar( 'right' );
}

?>