<?php

/* --------------------------------------------------------- */
/* !Settings setup - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_content_settings_setup') ) {
function apex_content_settings_setup() {
	
	// Get the sections the user has selected to display
	$general_settings = apex_general_settings();	
	$global_setting_sections = $general_settings['global_setting_sections'];
	
	$settings = apex_content_settings();	
	$post_types = get_apex_posttype_labels( false, true );
	$post_types = array_intersect_key( $post_types, $global_setting_sections );

	/* --------------------------------------------------------- */
	/* !Add the setting sections - 1.0.0 */
	/* --------------------------------------------------------- */
	
	reset( $post_types );
	$sub = isset( $_GET['sub'] ) ? $_GET['sub'] : key( $post_types );

	foreach( $post_types as $i => $pt ) {
	
		if( $sub == $i || $sub == 'all'  ) {
			
			add_settings_section( 'apex_content_settings_'.$i.'_layout_section', $pt['singular_name'].' '.__( 'Layouts', 'apex' ).'<input type="submit" class="button button-primary" value="'.__('Save Changes', 'apex').'">', false, 'apex_content_settings' );
			
			add_settings_section( 'apex_content_settings_'.$i.'_elements_section', $pt['singular_name'].' '.__( 'Elements', 'apex' ).'<input type="submit" class="button button-primary" value="'.__('Save Changes', 'apex').'">', false, 'apex_content_settings' );
			
			add_settings_section( 'apex_content_settings_'.$i.'_content_section', $pt['singular_name'].' '.__( 'Content Styles', 'apex' ).'<input type="submit" class="button button-primary" value="'.__('Save Changes', 'apex').'">', false, 'apex_content_settings' );
			
			add_settings_section( 'apex_content_settings_'.$i.'_header_section', $pt['singular_name'].' '.__( 'Header Styles', 'apex' ).'<input type="submit" class="button button-primary" value="'.__('Save Changes', 'apex').'">', false, 'apex_content_settings' );
			
			add_settings_section( 'apex_content_settings_'.$i.'_hero_section', $pt['singular_name'].' '.__( 'Hero Settings', 'apex' ).'<input type="submit" class="button button-primary" value="'.__('Save Changes', 'apex').'">', false, 'apex_content_settings' );
		}
	}


	/* --------------------------------------------------------- */
	/* !Add the settings - 1.0.0 */
	/* --------------------------------------------------------- */

	// Create a fields for each public post types
	foreach( $post_types as $i => $pt ) {
	
		/* Layout */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_layout',
			apex_settings_label( __( 'Page layout', 'apex' ), sprintf(__('Set a custom layout for %s', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_layout',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_layout_section',
			array(
				'name' => 'apex_content_settings['.$i.'_layout]',
				'value' => $settings[$i.'_layout']
			)
		);
	
		/* Content Width */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_content_width',
			apex_settings_label( __( 'Content width', 'apex' ), sprintf(__('Choose how to display content for %s', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_radio_buttons',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_layout_section',
			array(
				'name' => 'apex_content_settings['.$i.'_content_width]',
				'value' => $settings[$i.'_content_width'],
				'options' => array(
					'normal' => __('Normal', 'apex'),
					'condensed' => __('Condensed', 'apex'),
					'wide' => __('Wide', 'apex')
				)
			)
		);
		
		/* Sidebar */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_sidebar',
			apex_settings_label( __( 'Sidebar', 'apex' ), sprintf(__('Adjust the sidebar for %s', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_sidebar',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_layout_section',
			array(
				'name' => 'apex_content_settings['.$i.'_sidebar]',
				'value' => $settings[$i.'_sidebar'],
				'pull_name' => 'apex_content_settings['.$i.'_sidebar_pull]',
				'pull_value' => $settings[$i.'_sidebar_pull']
			)
		);
		
		/* Autohide nav */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_autohide_nav',
			apex_settings_label( __( 'Auto-hide navigation', 'apex' ), sprintf(__('Set the default navigation display for %s', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_radio_buttons',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_elements_section',
			array(
				'name' => 'apex_content_settings['.$i.'_autohide_nav]',
				'value' => $settings[$i.'_autohide_nav'],
				'options' => array(
					'0' => __('No', 'apex'),
					'1' => __('Yes', 'apex')
				)
			)
		);
		
		/* Autohide nav */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_wow_animations',
			apex_settings_label( __( 'Content animations', 'apex' ), sprintf(__('Fade in content for %s', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_wow_animations',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_elements_section',
			array(
				'name' => 'apex_content_settings['.$i.'_animate_header]',
				'value' => $settings[$i.'_animate_header'],
				'content_name' => 'apex_content_settings['.$i.'_animate_content]',
				'content_value' => $settings[$i.'_animate_content'],
			)
		);
		
		/* Page top */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_page_top',
			apex_settings_label( __( 'Page top', 'apex' ), sprintf(__('Choose the element to display at the top of %s', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_radio_buttons',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_elements_section',
			array(
				'name' => 'apex_content_settings['.$i.'_page_top]',
				'value' => $settings[$i.'_page_top'],
				'options' => array(
					'header' => __('Header', 'apex'),
					'hero' => __('Hero', 'apex'),
					'none' => __('None', 'apex')
				)
			)
		);
	
		/* Titles */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_titles',
			apex_settings_label( __( 'Titles', 'apex' ), sprintf(__('Set the default page title for %s', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_title_tag',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_elements_section',
			array(
				'name' => 'apex_content_settings['.$i.'_title_display]',
				'value' => $settings[$i.'_title_display'],
				'text_name' => 'apex_content_settings['.$i.'_title]',
				'text_value' => $settings[$i.'_title']
			)
		);

		/* Taglines */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_taglines',
			apex_settings_label( __( 'Taglines', 'apex' ), sprintf(__('Set the default page tagline for %s', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_title_tag',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_elements_section',
			array(
				'name' => 'apex_content_settings['.$i.'_tagline_display]',
				'value' => $settings[$i.'_tagline_display'],
				'text_name' => 'apex_content_settings['.$i.'_tagline]',
				'text_value' => $settings[$i.'_tagline']
			)
		);
		
		/* Extra sections - inner */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_extra_sections_inner',
			apex_settings_label( __( 'Extra content - inner', 'apex' ), sprintf(__('Choose extra content you want to display within this page\'s main content wrapper for %s', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_menu_select',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_elements_section',
			array(
				'name' => 'apex_content_settings['.$i.'_extra_sections_inner]',
				'value' => $settings[$i.'_extra_sections_inner']
			)
		);
		
		/* Extra sections - outer */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_extra_sections',
			apex_settings_label( __( 'Extra content - outer', 'apex' ), sprintf(__('Choose extra content you want to display below this page\'s main content wrapper for %s', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_menu_select',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_elements_section',
			array(
				'name' => 'apex_content_settings['.$i.'_extra_sections]',
				'value' => $settings[$i.'_extra_sections']
			)
		);
		
		/* Widget area */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_widget_area',
			apex_settings_label( __( 'Widget area', 'apex' ), sprintf(__('Select the widget area to display in the sidebar for %s', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_widget_area_select',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_elements_section',
			array(
				'name' => 'apex_content_settings['.$i.'_widget_area]',
				'value' => $settings[$i.'_widget_area']
			)
		);
		
		/* Content style */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_style',
			apex_settings_label( __( 'Content style', 'apex' ), sprintf(__('Set the initial color style for %s', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_radio_buttons',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_content_section',
			array(
				'name' => 'apex_content_settings['.$i.'_style]',
				'value' => $settings[$i.'_style'],
				'options' => array(
					'light' => __('Light', 'apex'),
					'dark' => __('Dark', 'apex')
				)
			)
		);
		
		/* Content colors */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_colors',
			apex_settings_label( __( 'Content colors', 'apex' ), sprintf(__('Set custom colors for %s content', 'apex'), strtolower($pt['singular_name'])) ),
			'apex_settings_text_colors',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_content_section',
			array(
				'highlight_name' => 'apex_content_settings['.$i.'_highlight]',
				'highlight_value' => $settings[$i.'_highlight']
			)
		);
		
		/* Content background */
		$content_bg = isset( $settings[$i.'_content_bg'] ) ? $settings[$i.'_content_bg'] : array();
		$content_bg_color = isset( $content_bg['color'] ) ? $content_bg['color'] : '';
		$content_bg_color_opacity = isset( $content_bg['color_opacity'] ) ? $content_bg['color_opacity'] : '';
		$content_bg_image = isset( $content_bg['image'] ) ? $content_bg['image'] : '';
		$content_bg_image_pattern = isset( $content_bg['image_pattern'] ) ? $content_bg['image_pattern'] : 'full-width';
		$content_bg_parallax = isset( $content_bg['parallax'] ) ? $content_bg['parallax'] : '6';
		$content_bg_overlay = isset( $content_bg['overlay'] ) ? $content_bg['overlay'] : 'none';
		$content_bg_overlay_opacity = isset( $content_bg['overlay_opacity'] ) ? $content_bg['overlay_opacity'] : '';
	
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_content_bg',
			apex_settings_label( __( 'Content background', 'apex' ), sprintf(__('Set options for the %s content background', 'apex'), strtolower($pt['singular_name'])) ),
			'apex_settings_background_options',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_content_section',
			array(
				'color' => array(
					'name' => 'apex_content_settings['.$i.'_content_bg][color]',
					'value' => $content_bg_color,
					'opacity_name' => 'apex_content_settings['.$i.'_content_bg][color_opacity]',
					'opacity_value' => $content_bg_color_opacity
				),
				'image' => array(
					'name' => 'apex_content_settings['.$i.'_content_bg][image]',
					'value' => $content_bg_image,
					'pattern_name' => 'apex_content_settings['.$i.'_content_bg][image_pattern]',
					'pattern_value' => $content_bg_image_pattern
				),
				'parallax' => array(
					'name' => 'apex_content_settings['.$i.'_content_bg][parallax]',
					'value' => $content_bg_parallax
				),
				'overlay' => array(
					'name' => 'apex_content_settings['.$i.'_content_bg][overlay]',
					'value' => $content_bg_overlay,
					'opacity_name' => 'apex_content_settings['.$i.'_content_bg][overlay_opacity]',
					'opacity_value' => $content_bg_overlay_opacity
				)
			)
		);
		
		/* Header style */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_header_style',
			apex_settings_label( __( 'Header style', 'apex' ), sprintf(__('Set the initial color style for %s headers', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_radio_buttons',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_header_section',
			array(
				'name' => 'apex_content_settings['.$i.'_header_style]',
				'value' => $settings[$i.'_header_style'],
				'options' => array(
					'light' => __('Light', 'apex'),
					'dark' => __('Dark', 'apex')
				)
			)
		);
		
		/* Header colors */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_header_colors',
			apex_settings_label( __( 'Header colors', 'apex' ), sprintf(__('Set custom colors for %s headers', 'apex'), strtolower($pt['singular_name'])) ),
			'apex_settings_text_colors',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_header_section',
			array(
				'highlight_name' => 'apex_content_settings['.$i.'_header_highlight]',
				'highlight_value' => $settings[$i.'_header_highlight']
			)
		);
		
		/* Header background */
		$header_bg = isset( $settings[$i.'_header_bg'] ) ? $settings[$i.'_header_bg'] : array();
		$header_bg_color = isset( $header_bg['color'] ) ? $header_bg['color'] : '';
		$header_bg_color_opacity = isset( $header_bg['color_opacity'] ) ? $header_bg['color_opacity'] : '';
		$header_bg_image = isset( $header_bg['image'] ) ? $header_bg['image'] : '';
		$header_bg_image_pattern = isset( $header_bg['image_pattern'] ) ? $header_bg['image_pattern'] : 'full-width';
		$header_bg_parallax = isset( $header_bg['parallax'] ) ? $header_bg['parallax'] : '6';
		$header_bg_overlay = isset( $header_bg['overlay'] ) ? $header_bg['overlay'] : 'none';
		$header_bg_overlay_opacity = isset( $header_bg['overlay_opacity'] ) ? $header_bg['overlay_opacity'] : '';
	
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_header_bg',
			apex_settings_label( __( 'Header background', 'apex' ), sprintf(__('Set options for the %s header backgrounds', 'apex'), strtolower($pt['singular_name'])) ),
			'apex_settings_background_options',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_header_section',
			array(
				'color' => array(
					'name' => 'apex_content_settings['.$i.'_header_bg][color]',
					'value' => $header_bg_color,
					'opacity_name' => 'apex_content_settings['.$i.'_header_bg][color_opacity]',
					'opacity_value' => $header_bg_color_opacity
				),
				'image' => array(
					'name' => 'apex_content_settings['.$i.'_header_bg][image]',
					'value' => $header_bg_image,
					'pattern_name' => 'apex_content_settings['.$i.'_header_bg][image_pattern]',
					'pattern_value' => $header_bg_image_pattern
				),
				'parallax' => array(
					'name' => 'apex_content_settings['.$i.'_header_bg][parallax]',
					'value' => $header_bg_parallax
				),
				'overlay' => array(
					'name' => 'apex_content_settings['.$i.'_header_bg][overlay]',
					'value' => $header_bg_overlay,
					'opacity_name' => 'apex_content_settings['.$i.'_header_bg][overlay_opacity]',
					'opacity_value' => $header_bg_overlay_opacity
				)
			)
		);
		
		/* Hero logo */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_hero_logo',
			apex_settings_label( __( 'Hero logo', 'apex' ), sprintf(__('Set a custom logo for %s hero elements', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_image',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_hero_section',
			array(
				'name' => 'apex_content_settings['.$i.'_hero_logo]',
				'value' => $settings[$i.'_hero_logo']
			)
		);
		
		/* Hero menu */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_hero_menu',
			apex_settings_label( __( 'Hero menu', 'apex' ), sprintf(__('Choose a custom menu to display for %s hero elements', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_menu_select',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_hero_section',
			array(
				'name' => 'apex_content_settings['.$i.'_hero_menu]',
				'value' => $settings[$i.'_hero_menu']
			)
		);
		
		/* Hero rotator */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_hero_rotator',
			apex_settings_label( __( 'Hero rotators', 'apex' ), sprintf(__('Setup custom rotators to display for %s hero elements', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_hero_rotators',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_hero_section',
			array(
				'name' => 'apex_content_settings['.$i.'_hero_rotator]',
				'value' => $settings[$i.'_hero_rotator'],
				'bg_name' => 'apex_content_settings['.$i.'_hero_bg_rotator]',
				'bg_value' => $settings[$i.'_hero_bg_rotator']
			)
		);
		
		/* Hero style */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_hero_style',
			apex_settings_label( __( 'Hero style', 'apex' ), sprintf(__('Set the initial color style for %s hero elements', 'apex'), strtolower($pt['name'])) ),
			'apex_settings_radio_buttons',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_hero_section',
			array(
				'name' => 'apex_content_settings['.$i.'_hero_style]',
				'value' => $settings[$i.'_hero_style'],
				'options' => array(
					'light' => __('Light', 'apex'),
					'dark' => __('Dark', 'apex')
				)
			)
		);
		
		/* Hero colors */
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_hero_colors',
			apex_settings_label( __( 'Hero colors', 'apex' ), sprintf(__('Set custom colors for %s hero elements', 'apex'), strtolower($pt['singular_name'])) ),
			'apex_settings_text_colors',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_hero_section',
			array(
				'highlight_name' => 'apex_content_settings['.$i.'_hero_highlight]',
				'highlight_value' => $settings[$i.'_hero_highlight']
			)
		);
		
		/* Hero background */
		$hero_bg = isset( $settings[$i.'_hero_bg'] ) ? $settings[$i.'_hero_bg'] : array();
		$hero_bg_color = isset( $hero_bg['color'] ) ? $hero_bg['color'] : '';
		$hero_bg_color_opacity = isset( $hero_bg['color_opacity'] ) ? $hero_bg['color_opacity'] : '';
		$hero_bg_image = isset( $hero_bg['image'] ) ? $hero_bg['image'] : '';
		$hero_bg_image_pattern = isset( $hero_bg['image_pattern'] ) ? $hero_bg['image_pattern'] : 'full-width';
		$hero_bg_parallax = isset( $hero_bg['parallax'] ) ? $hero_bg['parallax'] : '6';
		$hero_bg_overlay = isset( $hero_bg['overlay'] ) ? $hero_bg['overlay'] : 'none';
		$hero_bg_overlay_opacity = isset( $hero_bg['overlay_opacity'] ) ? $hero_bg['overlay_opacity'] : '';
	
		add_settings_field(
			'apex_content_settings_'.$pt['singular_name'].'_hero_bg',
			apex_settings_label( __( 'Hero background', 'apex' ), sprintf(__('Set options for the %s hero element backgrounds', 'apex'), strtolower($pt['singular_name'])) ),
			'apex_settings_background_options',
			'apex_content_settings',
			'apex_content_settings_'.$i.'_hero_section',
			array(
				'color' => array(
					'name' => 'apex_content_settings['.$i.'_hero_bg][color]',
					'value' => $hero_bg_color,
					'opacity_name' => 'apex_content_settings['.$i.'_hero_bg][color_opacity]',
					'opacity_value' => $hero_bg_color_opacity
				),
				'image' => array(
					'name' => 'apex_content_settings['.$i.'_hero_bg][image]',
					'value' => $hero_bg_image,
					'pattern_name' => 'apex_content_settings['.$i.'_hero_bg][image_pattern]',
					'pattern_value' => $hero_bg_image_pattern
				),
				'parallax' => array(
					'name' => 'apex_content_settings['.$i.'_hero_bg][parallax]',
					'value' => $hero_bg_parallax
				),
				'overlay' => array(
					'name' => 'apex_content_settings['.$i.'_hero_bg][overlay]',
					'value' => $hero_bg_overlay,
					'opacity_name' => 'apex_content_settings['.$i.'_hero_bg][overlay_opacity]',
					'opacity_value' => $hero_bg_overlay_opacity
				)
			)
		);
		
	}


	/* --------------------------------------------------------- */
	/* !Register the settings - 1.0.0 */
	/* --------------------------------------------------------- */

	if( false == get_option('apex_content_settings') ) {
		add_option( 'apex_content_settings' );
	}
	register_setting( 'apex_content_settings', 'apex_content_settings', 'apex_content_settings_sanitize' );
}
}



/* --------------------------------------------------------- */
/* !Sanitize the setting fields - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_content_settings_sanitize') ) {
function apex_content_settings_sanitize( $fields ) {
	
	// Create an array for WPML to translate
	$wpml = array();

	$post_types = get_apex_posttype_labels( false, true );	
	
	foreach( $post_types as $i => $pt ) {
		if( isset($fields[$i.'_layout']) ) {
		
			$fields[$i.'_title'] = $wpml[$i.'_title'] = isset( $fields[$i.'_title'] ) ? convert_chars(wptexturize($fields[$i.'_title'])) : '';	
			$fields[$i.'_tagline'] = $wpml[$i.'_tagline'] = isset( $fields[$i.'_tagline'] ) ? convert_chars(wptexturize($fields[$i.'_tagline'])) : '';
			
			$fields[$i.'_text_color'] = isset( $fields[$i.'_text_color'] ) ? sanitize_text_field($fields[$i.'_text_color']) : '';
			$fields[$i.'_highlight'] = isset( $fields[$i.'_highlight'] ) ? sanitize_text_field($fields[$i.'_highlight']) : '';
			$fields[$i.'_content_bg']['color'] = isset( $fields[$i.'_content_bg']['color'] ) ? sanitize_text_field($fields[$i.'_content_bg']['color']) : '';
			
			$fields[$i.'_header_text_color'] = isset( $fields[$i.'_header_text_color'] ) ? sanitize_text_field($fields[$i.'_header_text_color']) : '';
			$fields[$i.'_header_highlight'] = isset( $fields[$i.'_header_highlight'] ) ? sanitize_text_field($fields[$i.'_header_highlight']) : '';
			$fields[$i.'_header_bg']['color'] = isset( $fields[$i.'_header_bg']['color'] ) ? sanitize_text_field($fields[$i.'_header_bg']['color']) : '';
			
			$fields[$i.'_hero_text_color'] = isset( $fields[$i.'_hero_text_color'] ) ? sanitize_text_field($fields[$i.'_hero_text_color']) : '';
			$fields[$i.'_hero_highlight'] = isset( $fields[$i.'_hero_highlight'] ) ? sanitize_text_field($fields[$i.'_hero_highlight']) : '';
			$fields[$i.'_hero_bg']['color'] = isset( $fields[$i.'_hero_bg']['color'] ) ? sanitize_text_field($fields[$i.'_hero_bg']['color']) : '';
			
			$fields[$i.'_animate_header']['delay'] = isset( $fields[$i.'_animate_header']['delay'] ) ? sanitize_text_field($fields[$i.'_animate_header']['delay']) : '';
			$fields[$i.'_animate_content']['delay'] = isset( $fields[$i.'_animate_content']['delay'] ) ? sanitize_text_field($fields[$i.'_animate_content']['delay']) : '';
		}
	}
	
	// Register translatable fields
	apex_register_translate_settings( $wpml );
	
	// Return the sanitzied fields
	return wp_parse_args( $fields, get_option('apex_content_settings', array()) );
}
}


