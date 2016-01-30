<?php

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	$options = array();

	$options[] = array(
		'name' => __( 'Design', 'activetab' ),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Logo', 'activetab' ),
		//'desc' => __( '', 'activetab' ),
		'id' => 'logo_url',
		'type' => 'upload'
	);


	return $options;
}