<?php



/* --------------------------------------------------------- */
/* !General settings - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_general_settings') ) {
function apex_general_settings() {
	
	$settings = get_option( 'apex_general_settings', array() );
	$settings = apex_translate_settings( $settings );
	
	$defaults = array(
		'logo' => false,
		'favicon' => false,
		'section_id_prefix' => 'apex-',
		'archive_display' => 'excerpt',
		'archive_navigation' => '',
		'color' => '',
		'custom_color' => '',
		'navigation_style' => 'light',
		'navigation_highlight' => '',
		'footer_style' => 'dark',
		'footer_highlight' => '',
		'copyright' => __( 'Copyright &copy; 2014 APEX. All Rights Reserved.<br/>Theme design by <a href="http://themeforest.net/user/digitalscience" target="_blank">digitalscience</a> & <a href="http://themeforest.net/user/JoeMC" target="_blank">Metaphor Creations</a>', 'apex' ),
		'error' => '<h3>'.__( 'Whoops! You seem to be lost.', 'apex' ).'</h3><p>Go ahead and search the site if you\'re looking for something in particular.</p>',
		'scripts' => '',
		'css' => '',
		'widget_areas' => array(),
		'social_target' => '_blank',
		'social_links' => array(),
		'global_setting_sections' => array('default'=>'on'),
		'single_setting_sections' => array()
	);
	
	return wp_parse_args( $settings, $defaults );
}
}


/* --------------------------------------------------------- */
/* !Element settings - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_content_settings_items') ) {
function apex_content_settings_items() {
	
	$items = array(
		'layout' => 'full-width',
		'content_width' => 'normal',
		'sidebar' => 's3',
		'sidebar_pull' => 'no',
		'autohide_nav' => 1,
		'animate_header' => array(),
		'animate_content' => array(),
		'page_top' => 'header',
		'title' => '',
		'title_display' => 'show',
		'tagline' => '',
		'tagline_display' => 'show',
		'widget_area' => 'primary-widget-area',
		'extra_sections' => '',
		'extra_sections_inner' => '',
		'extra_sections_location' => 'below',
		'style' => 'light',
		'highlight' => '',
		'content_bg' => '',
		'header_style' => 'dark',
		'header_highlight' => '',
		'header_bg' => '',
		'hero_logo' => '',
		'hero_menu' => '',
		'hero_rotator' => '',
		'hero_bg_rotator' => '',
		'hero_style' => 'dark',
		'hero_highlight' => '',
		'hero_bg' => '',
	);
	
	return $items;
}
}
if( !function_exists('apex_content_settings') ) {
function apex_content_settings() {
	
	$settings = get_option( 'apex_content_settings', array() );
	$settings = apex_translate_settings( $settings );
	
	$items = apex_content_settings_items();
	$post_types = get_apex_posttype_labels( false, true );
	$defaults = array();
	
	foreach( $post_types as $i => $pt ) {
		
		if( is_array($items) && count($items) > 0 ) {
			foreach( $items as $item=>$default ) {
				$defaults[$i.'_'.$item] = $default;
			}
		}
	}
	
	return wp_parse_args( $settings, $defaults );
}
}



/* --------------------------------------------------------- */
/* !Font settings - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_typography_settings') ) {
function apex_typography_settings() {
	
	$settings = get_option( 'apex_typography_settings', array() );
	return wp_parse_args( $settings, apex_typography_settings_defaults() );
}
}

if( !function_exists('apex_typography_settings_defaults') ) {
function apex_typography_settings_defaults() {
	
	$defaults = array(
		'body' => array(
			'element' => 'body',
			'enabled' => false,
			'size_px' => 15,
			'height_px' => 24,
			'font_family' => 'Lato',
			'font_weight' => '300',
			'font_style' => 'normal',
			'color' => '#666666',
			'preview' => __('Grumpy wizards make toxic brew for the evil Queen and Jack.', 'apex')
		),
		'h1' => array(
			'element' => 'h1',
			'enabled' => false,
			'size_px' => 44,
			'height_px' => 44,
			'font_family' => 'Lato',
			'font_weight' => 'normal',
			'font_style' => 'normal',
			'color' => '#666666',
			'preview' => __('Grumpy wizards make toxic brew for the evil Queen and Jack.', 'apex')
		),
		'h2' => array(
			'element' => 'h2',
			'enabled' => false,
			'size_px' => 24,
			'height_px' => 24,
			'font_family' => 'Lato',
			'font_weight' => 'normal',
			'font_style' => 'normal',
			'color' => '#666666',
			'preview' => __('Grumpy wizards make toxic brew for the evil Queen and Jack.', 'apex')
		),
		'h3' => array(
			'element' => 'h3',
			'enabled' => false,
			'size_px' => 18,
			'height_px' => 22,
			'font_family' => 'Lato',
			'font_weight' => 'normal',
			'font_style' => 'normal',
			'color' => '#666666',
			'preview' => __('Grumpy wizards make toxic brew for the evil Queen and Jack.', 'apex')
		),
		'h4' => array(
			'element' => 'h4',
			'enabled' => false,
			'size_px' => 14,
			'height_px' => 22,
			'font_family' => 'Lato',
			'font_weight' => 'normal',
			'font_style' => 'normal',
			'color' => '#666666',
			'preview' => __('Grumpy wizards make toxic brew for the evil Queen and Jack.', 'apex')
		),
		'h5' => array(
			'element' => 'h5',
			'enabled' => false,
			'size_px' => 14,
			'height_px' => 22,
			'font_family' => 'Lato',
			'font_weight' => 'normal',
			'font_style' => 'normal',
			'color' => '#666666',
			'preview' => __('Grumpy wizards make toxic brew for the evil Queen and Jack.', 'apex')
		),
		'h6' => array(
			'element' => 'h6',
			'enabled' => false,
			'size_px' => 14,
			'height_px' => 22,
			'font_family' => 'Lato',
			'font_weight' => 'normal',
			'font_style' => 'normal',
			'color' => '#666666',
			'preview' => __('Grumpy wizards make toxic brew for the evil Queen and Jack.', 'apex')
		),
		'section_title' => array(
			'element' => '.section-title',
			'enabled' => false,
			'size_px' => 32,
			'height_px' => 48,
			'font_family' => 'Lato',
			'font_weight' => 'normal',
			'font_style' => 'normal',
			'color' => '#666666',
			'preview' => __('Grumpy wizards make toxic brew for the evil Queen and Jack.', 'apex')
		),
		'section_tagline' => array(
			'element' => '.section-tagline',
			'enabled' => false,
			'size_px' => 18,
			'height_px' => 18,
			'font_family' => 'Lato',
			'font_weight' => '300',
			'font_style' => 'italic',
			'color' => '#666666',
			'preview' => __('Grumpy wizards make toxic brew for the evil Queen and Jack.', 'apex')
		)
	);
	
	return $defaults;
}
}

