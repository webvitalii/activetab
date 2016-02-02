<?php

$settings = activetab_get_settings();

if( $settings['layout'] == 'sidebar-content' || $settings['layout'] == 'sidebar-content-sidebar' || $settings['layout'] == 'sidebar-sidebar-content' ) {
	get_sidebar( 'left' );
}

if( $settings['layout'] == 'sidebar-sidebar-content' ) {
	get_sidebar( 'right' );
}

?>