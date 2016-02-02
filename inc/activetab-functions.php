<?php

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
	exit;
}


function activetab_default_settings() {
	$settings = array(
		'layout' => 'content-sidebar',
		'max_width' => 1200,
		'code_head' => '',
		'code_footer' => ''
	);
	return $settings;
}


function activetab_get_settings() {
	$activetab_settings = (array) get_option('activetab_settings');
	$default_settings = activetab_default_settings();
	$activetab_settings = array_merge($default_settings, $activetab_settings); // set empty options with default values
	return $activetab_settings;
}
