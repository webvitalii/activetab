<?php
/*
Activetab settings code
Powered by WordPress Settings API - http://codex.wordpress.org/Settings_API
*/

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
	exit;
}


function activetab_menu() { // add menu item
	//add_theme_page(__( 'Activetab Settings', 'activetab' ), __( 'Activetab Settings', 'activetab' ), 'manage_options', 'activetab', 'activetab_settings');
	add_menu_page( __( 'Activetab Settings', 'activetab' ), __( 'Activetab Settings', 'activetab' ), 
		'manage_options', 'activetab', 'activetab_settings', 'dashicons-layout', 45 );
}
add_action('admin_menu', 'activetab_menu');



function activetab_admin_init() {
	register_setting('activetab_settings_group', 'activetab_settings', 'activetab_settings_validate');

	add_settings_section('activetab_settings_general_section', '', 'activetab_section_callback', 'activetab_general_page');
	
	add_settings_field('max_width', __( 'Maximum width of the website', 'activetab' ), 'activetab_field_max_width_callback', 'activetab_general_page', 'activetab_settings_general_section');
	add_settings_field('layout', __( 'Layout', 'activetab' ), 'activetab_field_layout_callback', 'activetab_general_page', 'activetab_settings_general_section');
	add_settings_field('logo_url', __( 'Logo', 'activetab' ), 'activetab_field_logo_callback', 'activetab_general_page', 'activetab_settings_general_section');
	add_settings_field('excerpt_or_content_in_list', __( 'Show excerpt or content in the list', 'activetab' ), 'activetab_field_excerpt_or_content_callback', 'activetab_general_page', 'activetab_settings_general_section');
	add_settings_field('code_head', __( 'Head code', 'activetab' ), 'activetab_field_code_head_callback', 'activetab_general_page', 'activetab_settings_general_section');
	add_settings_field('code_footer', __( 'Footer code', 'activetab' ), 'activetab_field_code_footer_callback', 'activetab_general_page', 'activetab_settings_general_section');
	
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
	$output['logo_url'] = trim($input['logo_url']);
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
	echo '<p class="description">';
	printf( __( 'Default: %s', 'activetab' ), $default_settings['max_width'] );
	echo '</p>';
}


function activetab_field_layout_callback() {
	$settings = activetab_get_settings();
	$default_settings = activetab_default_settings();
	
	$options = array(
		'content-sidebar' => __( 'content / sidebar-right', 'activetab' ),
		'sidebar-content' => __( 'sidebar-left / content', 'activetab' ),
		'content' => __( 'content (full width, no sidebars)', 'activetab' ),
		'content-sidebar-sidebar' => __( 'content / sidebar-left / sidebar-right', 'activetab' ),
		'sidebar-content-sidebar' => __( 'sidebar-left / content / sidebar-right', 'activetab' ),
		'sidebar-sidebar-content' => __( 'sidebar-left / sidebar-right / content', 'activetab' )
	);
	
	foreach ( $options as $key => $value ):
		$checked = '';
		if ( $settings['layout'] == $key ) {
			$checked = ' checked="checked"';
		}
		echo '<p><label><input type="radio" name="activetab_settings[layout]" value="'.$key.'"  '.$checked.'> '.$value.'<label></p>'."\n";
	endforeach;
	echo '<p class="description">'.__( 'General layout settings', 'activetab' ).'</p>';
}


function activetab_field_logo_callback() {
	$settings = activetab_get_settings();
	$default_settings = activetab_default_settings();
	echo '<input type="text" name="activetab_settings[logo_url]" class="regular-text js-media-input" value="'.$settings['logo_url'].'" />';
	echo '<a href="#" class="button button-small js-media-choose">'.__( 'Choose image', 'activetab' ).'</a>';
	
	if( !empty( $settings['logo_url'] ) ) {
		echo '<img src="'.$settings['logo_url'].'" />';
	}
	
	?>
	
	<script>
	jQuery(function($){ // document.ready and noConflict mode
		var custom_media_uploader;
		$( '.js-media-choose' ).click( function( event ) {
			event.preventDefault();
			custom_media_uploader = wp.media.frames.file_frame = wp.media( {
				title: '<?php _e( 'Choose image', 'activetab' ); ?>',
				button: {
					text: '<?php _e( 'Choose image', 'activetab' ); ?>' 
				},
				multiple: false
			});
			custom_media_uploader.on( 'select', function() {
				var attachment = custom_media_uploader.state().get( 'selection' ).first().toJSON();
				$( '.js-media-input' ).val( attachment.url );
			});
			custom_media_uploader.open();
		});
	});
	</script>

	<?php
	
	echo '<p class="description"></p>';
}


function activetab_field_excerpt_or_content_callback() {
	$settings = activetab_get_settings();
	$default_settings = activetab_default_settings();
	
	$options = array(
		'excerpt' => __( 'Excerpt', 'activetab' ),
		'content' => __( 'Full content', 'activetab' )
	);
	
	foreach ( $options as $key => $value ):
		$checked = '';
		if ( $settings['excerpt_or_content_in_list'] == $key ) {
			$checked = ' checked="checked"';
		}
		echo '<p><label><input type="radio" name="activetab_settings[excerpt_or_content_in_list]" value="'.$key.'"  '.$checked.'> '.$value.'<label></p>'."\n";
	endforeach;
	echo '<p class="description">'.__( 'Show excerpt or full content in the list of posts', 'activetab' ).'</p>';
}


function activetab_field_code_head_callback() {
	$settings = activetab_get_settings();
	$default_settings = activetab_default_settings();
	echo '<textarea name="activetab_settings[code_head]" class="large-text" style="width: 25em; height: 100px;">'.$settings['code_head'].'</textarea>';
	echo '<p class="description">'.__( 'Code will be added to head section just before closing [head] tag', 'activetab' ).'</p>';
}


function activetab_field_code_footer_callback() {
	$settings = activetab_get_settings();
	$default_settings = activetab_default_settings();
	echo '<textarea name="activetab_settings[code_footer]" class="large-text" style="width: 25em; height: 100px;">'.$settings['code_footer'].'</textarea>';
	echo '<p class="description">'.__( 'Code will be added to body section just before closing [body] tag', 'activetab' ).'</p>';
}


function activetab_settings() {
	
	?>
	<div class="wrap">
		
		<h2><span class="dashicons dashicons-admin-generic" style="position: relative; top: 4px;"></span> 
			<?php echo __( 'Activetab Settings', 'activetab' ); ?></h2>
		
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