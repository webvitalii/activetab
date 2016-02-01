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

	$output['code_head'] = trim($input['code_head']);
	$output['code_footer'] = trim($input['code_footer']);

	return $output;
}


function activetab_section_callback() { // Anti-spam Pro settings description
	echo '';
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
		
		<h2><span class="dashicons dashicons-shield"></span> Activetab Theme Settings</h2>
		
		<form method="post" action="options.php">
			<?php settings_fields('activetab_settings_group'); ?>
			<div class="antispampro-group-automatic">
				<?php do_settings_sections('activetab_general_page'); ?>
			</div>
			<?php submit_button(); ?>
		</form>
	
	</div><!-- .wrap -->
	<?php
}