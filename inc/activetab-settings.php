<?php
/*
Activetab settings code
Powered by WordPress Settings API - http://codex.wordpress.org/Settings_API
*/

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
	exit;
}


function activetab_menu() { // add menu item
	add_theme_page('Activetab Settings', 'Activetab Settings', 'manage_options', 'activetab', 'activetab_settings');
}
add_action('admin_menu', 'activetab_menu');



function activetab_admin_init() {
	register_setting('activetab_settings_group', 'activetab_settings', 'activetab_settings_validate');

	add_settings_section('activetab_settings_general_section', '', 'activetab_section_callback', 'activetab_general_page');
	
	add_settings_field('max_width', 'Maximum width of the website', 'activetab_field_max_width_callback', 'activetab_general_page', 'activetab_settings_general_section');
	add_settings_field('layout', 'Layout', 'activetab_field_layout_callback', 'activetab_general_page', 'activetab_settings_general_section');
	add_settings_field('excerpt_or_content_in_list', 'Show excerpt or content in the list', 'activetab_field_excerpt_or_content_callback', 'activetab_general_page', 'activetab_settings_general_section');
	add_settings_field('code_head', 'Code head', 'activetab_field_code_head_callback', 'activetab_general_page', 'activetab_settings_general_section');
	add_settings_field('code_footer', 'Code footer', 'activetab_field_code_footer_callback', 'activetab_general_page', 'activetab_settings_general_section');
	
}
add_action('admin_init', 'activetab_admin_init');


function activetab_settings_init() { // set default settings
	global $activetab_settings;
	$activetab_settings = activetab_get_settings();
	update_option('activetab_settings', $activetab_settings);
}
add_action('admin_init', 'activetab_settings_init');


function activetab_settings_validate($input) {
	$default_settings = activetab_get_settings();
	
	$output['max_width'] = trim($input['max_width']);
	$output['layout'] = trim($input['layout']);
	$output['excerpt_or_content_in_list'] = trim($input['excerpt_or_content_in_list']);
	$output['code_head'] = trim($input['code_head']);
	$output['code_footer'] = trim($input['code_footer']);

	return $output;
}


function activetab_section_callback() { // Activetab settings description
	echo '';
}


function activetab_field_max_width_callback() {
	$settings = activetab_get_settings();
	$default_settings = activetab_default_settings();
	echo '<input type="number" name="activetab_settings[max_width]" class="regular-text" value="'.$settings['max_width'].'" required="required" />';
	echo '<p class="description">Default: '.$default_settings['max_width'].'</p>';
}


function activetab_field_layout_callback() {
	$settings = activetab_get_settings();
	$default_settings = activetab_default_settings();
	
	$options = array(
		'content-sidebar' => 'content / sidebar-right',
		'sidebar-content' => 'sidebar-left / content',
		'content' => 'content (full width, no sidebars)',
		'content-sidebar-sidebar' => 'content / sidebar-left / sidebar-right',
		'sidebar-content-sidebar' => 'sidebar-left / content / sidebar-right',
		'sidebar-sidebar-content' => 'sidebar-left / sidebar-right / content'
	);
	
	foreach ( $options as $key => $value ):
		$checked = '';
		if ( $settings['layout'] == $key ) {
			$checked = ' checked="checked"';
		}
		echo '<p><label><input type="radio" name="activetab_settings[layout]" value="'.$key.'"  '.$checked.'> '.$value.'<label></p>'."\n";
	endforeach;
	echo '<p class="description">General layout settings.</p>';
}


function activetab_field_excerpt_or_content_callback() {
	$settings = activetab_get_settings();
	$default_settings = activetab_default_settings();
	
	$options = array(
		'excerpt' => 'Excerpt',
		'content' => 'Content'
	);
	
	foreach ( $options as $key => $value ):
		$checked = '';
		if ( $settings['excerpt_or_content_in_list'] == $key ) {
			$checked = ' checked="checked"';
		}
		echo '<p><label><input type="radio" name="activetab_settings[excerpt_or_content_in_list]" value="'.$key.'"  '.$checked.'> '.$value.'<label></p>'."\n";
	endforeach;
	echo '<p class="description"></p>';
}


function activetab_field_code_head_callback() {
	$settings = activetab_get_settings();
	$default_settings = activetab_default_settings();
	echo '<textarea name="activetab_settings[code_head]" class="large-text" style="width: 25em; height: 100px;">'.$settings['code_head'].'</textarea>';
	echo '<p class="description">Code will be added to head section via wp_head() function.</p>';
}


function activetab_field_code_footer_callback() {
	$settings = activetab_get_settings();
	$default_settings = activetab_default_settings();
	echo '<textarea name="activetab_settings[code_footer]" class="large-text" style="width: 25em; height: 100px;">'.$settings['code_footer'].'</textarea>';
	echo '<p class="description">Code will be added to footer section via wp_footer() function.</p>';
}


function activetab_settings() {
	
	?>
	<div class="wrap">
		
		<h2><span class="dashicons dashicons-admin-generic" style="position: relative; top: 4px;"></span> Activetab Theme Settings</h2>
		
		<form method="post" action="options.php">
			<?php settings_fields('activetab_settings_group'); ?>
			<div class="activetab-group-general">
				<?php do_settings_sections('activetab_general_page'); ?>
			</div>
			<?php submit_button(); ?>
		</form>
	
	</div><!-- .wrap -->
	<?php
}