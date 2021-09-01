<?php

/* --------------------------------------------------------- */
/* !Settings setup - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_general_settings_setup') ) {
function apex_general_settings_setup() {

	$settings = apex_general_settings();


	/* --------------------------------------------------------- */
	/* !Add the setting sections - 1.0.0 */
	/* --------------------------------------------------------- */

	$sub = isset( $_GET['sub'] ) ? $_GET['sub'] : 'all';

	if( $sub == 'general' || $sub == 'all' ) {
		add_settings_section( 'apex_general_settings_section', __( 'General settings', 'apex' ).'<input type="submit" class="button button-primary" value="'.__('Save Changes', 'apex').'">', false, 'apex_general_settings' );
	}
	if( $sub == 'style' || $sub == 'all' ) {
		add_settings_section( 'apex_style_settings_section', __( 'Style settings', 'apex' ).'<input type="submit" class="button button-primary" value="'.__('Save Changes', 'apex').'">', false, 'apex_general_settings' );
	}
	if( $sub == 'social' || $sub == 'all' ) {
		add_settings_section( 'apex_social_settings_section', __( 'Social settings', 'apex' ).'<input type="submit" class="button button-primary" value="'.__('Save Changes', 'apex').'">', false, 'apex_general_settings' );
	}
	if( $sub == 'widgets' || $sub == 'all' ) {
		add_settings_section( 'apex_widget_areas_section', __( 'Widget areas', 'apex' ).'<input type="submit" class="button button-primary" value="'.__('Save Changes', 'apex').'">', false, 'apex_general_settings' );
	}
	if( $sub == 'content' || $sub == 'all' ) {
		add_settings_section( 'apex_content_settings_section', __( 'Content setting sections', 'apex' ).'<input type="submit" class="button button-primary" value="'.__('Save Changes', 'apex').'">', false, 'apex_general_settings' );
	}


	/* --------------------------------------------------------- */
	/* !Add the general settings - 1.1.12 */
	/* --------------------------------------------------------- */

	/* Logo */
	add_settings_field(
		'apex_general_settings_logo',
		apex_settings_label( __( 'Logo', 'apex' ), __('Upload a custom logo', 'apex') ),
		'apex_settings_image',
		'apex_general_settings',
		'apex_general_settings_section',
		array(
			'name' => 'apex_general_settings[logo]',
			'value' => $settings['logo']
		)
	);

	/* Favicon */
	add_settings_field(
		'apex_general_settings_favicon',
		apex_settings_label( __( 'Favicon', 'apex' ), __('Upload a custom favicon', 'apex') ),
		'apex_settings_image',
		'apex_general_settings',
		'apex_general_settings_section',
		array(
			'name' => 'apex_general_settings[favicon]',
			'value' => $settings['favicon']
		)
	);
	
	/* Section ID Prefix */
	add_settings_field(
		'apex_general_settings_section_id_prefix',
		apex_settings_label( __( 'Page ID Prefix', 'apex' ), __('Add a custom prefix for your section ID\'s', 'apex') ),
		'apex_settings_text',
		'apex_general_settings',
		'apex_general_settings_section',
		array(
			'name' => 'apex_general_settings[section_id_prefix]',
			'value' => $settings['section_id_prefix'],
			'before' => '#'
		)
	);

	/* Archive navigation */
	add_settings_field(
		'apex_general_settings_archive_navigation',
		apex_settings_label( __( 'Archive navigation', 'apex' ), __('Select to paginate archive pages', 'apex') ),
		'apex_settings_checkbox',
		'apex_general_settings',
		'apex_general_settings_section',
		array(
			'name' => 'apex_general_settings[archive_navigation]',
			'value' => $settings['archive_navigation'],
			'label' => __('Use pagination', 'apex')
		)
	);
	
	/* Color */
	add_settings_field(
		'apex_general_settings_color',
		apex_settings_label( __( 'Theme color', 'apex' ), __('Set the global theme color for the site', 'apex') ),
		'apex_settings_select',
		'apex_general_settings',
		'apex_style_settings_section',
		array(
			'name' => 'apex_general_settings[color]',
			'value' => $settings['color'],
			'options' => array(
				'' => __('Blue', 'apex'),
				'a8cd4f' => __('Lime', 'apex'),
				'e9744b' => __('Orange', 'apex'),
				'f2ac26' => __('Yellow', 'apex'),
				'2ec1a3' => __('Teal', 'apex'),
				'd65570' => __('Pink', 'apex')
			)
		)
	);
	
	/* Custom theme color */
	add_settings_field(
		'apex_general_settings_custom color',
		apex_settings_label( __( 'Custom theme color', 'apex' ), __('Set custom global theme color for the site', 'apex') ),
		'apex_settings_text_colors',
		'apex_general_settings',
		'apex_style_settings_section',
		array(
			'highlight_name' => 'apex_general_settings[custom_color]',
			'highlight_value' => $settings['custom_color']
		)
	);
	
	/* Navigation style */
	add_settings_field(
		'apex_general_settings_navigation_style',
		apex_settings_label( __( 'Navigation style', 'apex' ), __('Set the color scheme of the navigation bar', 'apex') ),
		'apex_settings_radio_buttons',
		'apex_general_settings',
		'apex_style_settings_section',
		array(
			'name' => 'apex_general_settings[navigation_style]',
			'value' => $settings['navigation_style'],
			'options' => array(
				'light' => __('Light', 'apex'),
				'dark' => __('Dark', 'apex')
			)
		)
	);
	
	/* Navigation colors */
	add_settings_field(
		'apex_general_settings_navigation_colors',
		apex_settings_label( __( 'Navigation colors', 'apex' ), __('Set custom colors for the navigation bar', 'apex') ),
		'apex_settings_text_colors',
		'apex_general_settings',
		'apex_style_settings_section',
		array(
			'highlight_name' => 'apex_general_settings[navigation_highlight]',
			'highlight_value' => $settings['navigation_highlight']
		)
	);
	
	/* Footer style */
	add_settings_field(
		'apex_general_settings_footer_style',
		apex_settings_label( __( 'Footer style', 'apex' ), __('Set the color scheme of the footer', 'apex') ),
		'apex_settings_radio_buttons',
		'apex_general_settings',
		'apex_style_settings_section',
		array(
			'name' => 'apex_general_settings[footer_style]',
			'value' => $settings['footer_style'],
			'options' => array(
				'light' => __('Light', 'apex'),
				'dark' => __('Dark', 'apex')
			)
		)
	);
	
	/* Footer colors */
	add_settings_field(
		'apex_general_settings_footer_colors',
		apex_settings_label( __( 'Footer colors', 'apex' ), __('Set custom colors for the footer', 'apex') ),
		'apex_settings_text_colors',
		'apex_general_settings',
		'apex_style_settings_section',
		array(
			'highlight_name' => 'apex_general_settings[footer_highlight]',
			'highlight_value' => $settings['footer_highlight']
		)
	);

	/* Copyright */
	add_settings_field(
		'apex_general_settings_copyright',
		apex_settings_label( __( 'Copyright', 'apex' ), __('Text to display on the left side of the footer', 'apex') ),
		'apex_settings_textarea',
		'apex_general_settings',
		'apex_general_settings_section',
		array(
			'name' => 'apex_general_settings[copyright]',
			'value' => htmlentities($settings['copyright'])
		)
	);

	/* Error */
	add_settings_field(
		'apex_general_settings_error',
		apex_settings_label( __( '404 content', 'apex' ), __('Text to display on 404 error pages', 'apex') ),
		'apex_settings_textarea',
		'apex_general_settings',
		'apex_general_settings_section',
		array(
			'name' => 'apex_general_settings[error]',
			'value' => $settings['error']
		)
	);
	
	/* CSS */
	add_settings_field(
		'apex_general_settings_css',
		apex_settings_label( __( 'Additional CSS', 'apex' ), __('Add custom CSS styles to the site', 'apex') ),
		'apex_settings_codemirror',
		'apex_general_settings',
		'apex_general_settings_section',
		array(
			'name' => 'apex_general_settings[css]',
			'value' => $settings['css'],
			'modes' => array( 'css' )
		)
	);

	/* Scripts */
	add_settings_field(
		'apex_general_settings_scripts',
		apex_settings_label( __( 'Additional javascript', 'apex' ), __('Add additional scripts to the footer of your site', 'apex') ),
		'apex_settings_codemirror',
		'apex_general_settings',
		'apex_general_settings_section',
		array(
			'name' => 'apex_general_settings[scripts]',
			'value' => $settings['scripts'],
			'modes' => array( 'js' )
		)
	);
	
	/* Widget Areas */
	add_settings_field(
		'apex_general_settings_widget_areas',
		apex_settings_label( __( 'Widget areas', 'apex' ), __('Add additional widget areas to replace the primary widget area', 'apex') ),
		'apex_settings_list',
		'apex_general_settings',
		'apex_widget_areas_section',
		array(
			'name' => 'apex_general_settings[widget_areas]',
			'value' => $settings['widget_areas'],
			'placeholders' => array(
				__('Add new widget name here', 'apex')
			)
		)
	);

	/* Social links */
	add_settings_field(
		'apex_social_settings_links',
		apex_settings_label( __( 'Social links', 'apex' ), __('Select the social sites to display in the footer', 'apex') ),
		'apex_settings_social_links',
		'apex_general_settings',
		'apex_social_settings_section',
		array(
			'name' => 'apex_general_settings[social_links]',
			'value' => $settings['social_links'],
			'target_name' => 'apex_general_settings[social_target]',
			'target_value' => $settings['social_target'],
		)
	);
	
	/* Global setting sections */
	add_settings_field(
		'apex_global_setting_sections',
		apex_settings_label( __( 'Global content sections', 'apex' ), __('Enable global content settings to the selected page/post types', 'apex') ),
		'apex_settings_content_sections',
		'apex_general_settings',
		'apex_content_settings_section',
		array(
			'name' => 'apex_general_settings[global_setting_sections]',
			'value' => $settings['global_setting_sections'],
			'custom' => true
		)
	);
	
	/* Single setting sections */
	add_settings_field(
		'apex_single_setting_sections',
		apex_settings_label( __( 'Single post content sections', 'apex' ), __('Enable content setting metaboxes on the selected post type edit pages', 'apex') ),
		'apex_settings_content_sections',
		'apex_general_settings',
		'apex_content_settings_section',
		array(
			'name' => 'apex_general_settings[single_setting_sections]',
			'value' => $settings['single_setting_sections']
		)
	);


	/* --------------------------------------------------------- */
	/* !Register the settings - 1.0.0 */
	/* --------------------------------------------------------- */

	if( false == get_option('apex_general_settings') ) {
		add_option( 'apex_general_settings' );
	}
	register_setting( 'apex_general_settings', 'apex_general_settings', 'apex_general_settings_sanitize' );
}
}



/* --------------------------------------------------------- */
/* !Sanitize the setting fields - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_general_settings_sanitize') ) {
function apex_general_settings_sanitize( $fields ) {

	// Create an array for WPML to translate
	$wpml = array();

	// General settings
	if( isset($fields['logo']) ) {	
		$fields['logo'] = isset( $fields['logo'] ) ? sanitize_text_field($fields['logo']) : '';
		$fields['favicon'] = isset( $fields['favicon'] ) ? sanitize_text_field($fields['favicon']) : '';
		$fields['section_id_prefix'] = isset( $fields['section_id_prefix'] ) ? sanitize_text_field($fields['section_id_prefix']) : '';
		$fields['copyright'] = $wpml['copyright'] = isset( $fields['copyright'] ) ? wp_kses_post($fields['copyright']) : '';
		$fields['error'] = $wpml['error'] = isset( $fields['error'] ) ? wp_kses_post($fields['error']) : '';
		$fields['archive_navigation'] = ( isset($fields['archive_navigation']) && $fields['archive_navigation'] == 'on' ) ? $fields['archive_navigation'] : '';	
		$fields['css'] = isset( $fields['css'] ) ? wp_kses_post($fields['css']) : '';
		
		$allowed_html = array(
			'script' => array(
				'type' => array(),
				'src' => array(),
				'language' => array()
			)
		);
		$fields['scripts'] = isset( $fields['scripts'] ) ? wp_kses($fields['scripts'], $allowed_html) : '';
	}
	
	// Widget areas
	if( isset($fields['widget_areas']) && (is_array($fields['widget_areas']) && count($fields['widget_areas']) > 0) ) {
		$sanitized_widget_areas = array();
		foreach( $fields['widget_areas'] as $i=>$name ) {
			if( $name != '' ) {
				$sanitized_widget_areas[] = sanitize_text_field($name);
			}
		}
		$fields['widget_areas'] = $sanitized_widget_areas;
	}

	// Social settings
	if( isset($fields['social_target']) ) {
	
		if( isset($fields['social_links']) ) {
			foreach( $fields['social_links'] as $i=>$link ) {
				if( is_array($link) && isset($link['url']) ) {
					$fields['social_links'][$i] = esc_url($link['url']);
				} else {
					$fields['social_links'][$i] = ( $link != '' && !is_array($link) ) ? esc_url($link) : '';
				}
			}
		} else {
			$fields['social_links'] = '';
		}
	}
	
	// Setting sections
	if( isset($fields['single_setting_sections_visible']) ) {
		$fields['global_setting_sections'] = isset( $fields['global_setting_sections'] ) ? $fields['global_setting_sections'] : '';
		$fields['single_setting_sections'] = isset( $fields['single_setting_sections'] ) ? $fields['single_setting_sections'] : '';
	}
	
	// Register translatable fields
	apex_register_translate_settings( $wpml );

	return wp_parse_args( $fields, get_option('apex_general_settings', array()) );
}
}





