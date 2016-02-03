<?php

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
	exit;
}


function activetab_default_settings() {
	$settings = array(
		'max_width' => 1200,
		'layout' => 'content-sidebar',
		'excerpt_or_content_in_list' => 'excerpt',
		'code_head' => '',
		'code_footer' => ''
	);
	return $settings;
}


function activetab_get_settings() {
	$activetab_settings = (array) get_option('activetab_settings');
	$default_settings = activetab_default_settings();
	$activetab_settings = array_merge($default_settings, $activetab_settings); // use default settings if custom settings are empty
	return $activetab_settings;
}
