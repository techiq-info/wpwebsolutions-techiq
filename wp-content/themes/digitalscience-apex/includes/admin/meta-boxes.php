<?php

/* --------------------------------------------------------- */
/* !Add the page settings metabox - 1.1.1 */
/* --------------------------------------------------------- */

function apex_page_settings_metabox() {

	// Get all public post types
	$post_types = get_apex_posttype_labels();
	foreach( $post_types as $i=>$pt ) {
		add_meta_box( 'apex_page_settings_metabox', __('Apex Page Settings', 'apex'), 'apex_page_settings_render_metabox', $i, 'normal', 'high' );
	}

}
add_action( 'add_meta_boxes', 'apex_page_settings_metabox' );



/* --------------------------------------------------------- */
/* !Render the page settings metabox - 1.1.1 */
/* --------------------------------------------------------- */

function apex_page_settings_render_metabox() {

	global $post;
	
	$general_settings = apex_general_settings();	
	$single_setting_sections = $general_settings['single_setting_sections'];
	$post_type = get_post_type();
	
	if( isset($single_setting_sections[$post_type]) ) {
		
		$page_settings = get_post_meta( $post->ID, '_apex_page_settings', true );
	
		$layout = isset( $page_settings['layout'] ) ? $page_settings['layout'] : 'default';
		$content_width = isset( $page_settings['content_width'] ) ? $page_settings['content_width'] : 'default';
		$sidebar = isset( $page_settings['sidebar'] ) ? $page_settings['sidebar'] : 'default';
		$sidebar_pull = isset( $page_settings['sidebar_pull'] ) ? $page_settings['sidebar_pull'] : 'default';
		
		// Elements	
		$autohide_nav = isset( $page_settings['autohide_nav'] ) ? $page_settings['autohide_nav'] : 'default';
		$animate_header = isset( $page_settings['animate_header'] ) ? $page_settings['animate_header'] : 'default';
		$animate_content = isset( $page_settings['animate_content'] ) ? $page_settings['animate_content'] : 'default';
		$page_top = ( isset($page_settings['page_top']) && $page_settings['page_top'] != '' ) ? $page_settings['page_top'] : 'default';
		$title = isset( $page_settings['title'] ) ? $page_settings['title'] : '';
		$title_display = isset( $page_settings['title_display'] ) ? $page_settings['title_display'] : '';
		$tagline = isset( $page_settings['tagline'] ) ? $page_settings['tagline'] : '';
		$tagline_display = isset( $page_settings['tagline_display'] ) ? $page_settings['tagline_display'] : '';
		
		$extra_sections = isset( $page_settings['extra_sections'] ) ? $page_settings['extra_sections'] : 'default';
		$extra_sections_inner = isset( $page_settings['extra_sections_inner'] ) ? $page_settings['extra_sections_inner'] : 'default';
		$widget_area = isset( $page_settings['widget_area'] ) ? $page_settings['widget_area'] : 'default';
		
		// Content styles
		$style = isset( $page_settings['style'] ) ? $page_settings['style'] : 'default';
		$highlight = isset( $page_settings['highlight'] ) ? $page_settings['highlight'] : '';
	
		$content_bg = isset( $page_settings['content_bg'] ) ? $page_settings['content_bg'] : array();
		$content_bg_default = isset( $content_bg['default'] ) ? $content_bg['default'] : 'default';
		$content_bg_color = isset( $content_bg['color'] ) ? $content_bg['color'] : '';
		$content_bg_color_opacity = isset( $content_bg['color_opacity'] ) ? $content_bg['color_opacity'] : '';
		$content_bg_image = isset( $content_bg['image'] ) ? $content_bg['image'] : '';
		$content_bg_image_pattern = isset( $content_bg['image_pattern'] ) ? $content_bg['image_pattern'] : 'full-width';
		$content_bg_parallax = isset( $content_bg['parallax'] ) ? $content_bg['parallax'] : '';
		$content_bg_overlay = isset( $content_bg['overlay'] ) ? $content_bg['overlay'] : 'default';
		$content_bg_overlay_opacity = isset( $content_bg['overlay_opacity'] ) ? $content_bg['overlay_opacity'] : '';
		
		// Header styles
		$header_style = isset( $page_settings['header_style'] ) ? $page_settings['header_style'] : 'default';
		$header_highlight = isset( $page_settings['header_highlight'] ) ? $page_settings['header_highlight'] : '';
	
		$header_bg = isset( $page_settings['header_bg'] ) ? $page_settings['header_bg'] : array();
		$header_bg_default = isset( $header_bg['default'] ) ? $header_bg['default'] : 'default';
		$header_bg_color = isset( $header_bg['color'] ) ? $header_bg['color'] : '';
		$header_bg_color_opacity = isset( $header_bg['color_opacity'] ) ? $header_bg['color_opacity'] : '';
		$header_bg_image = isset( $header_bg['image'] ) ? $header_bg['image'] : '';
		$header_bg_image_pattern = isset( $header_bg['image_pattern'] ) ? $header_bg['image_pattern'] : 'full-width';
		$header_bg_parallax = isset( $header_bg['parallax'] ) ? $header_bg['parallax'] : '';
		$header_bg_overlay = isset( $header_bg['overlay'] ) ? $header_bg['overlay'] : 'default';
		$header_bg_overlay_opacity = isset( $header_bg['overlay_opacity'] ) ? $header_bg['overlay_opacity'] : '';
		
		// Hero settings
		$hero_logo = isset( $page_settings['hero_logo'] ) ? $page_settings['hero_logo'] : '';
		$hero_menu = isset( $page_settings['hero_menu'] ) ? $page_settings['hero_menu'] : 'default';
		$hero_rotator = isset( $page_settings['hero_rotator'] ) ? $page_settings['hero_rotator'] : '';
		$hero_bg_rotator = isset( $page_settings['hero_bg_rotator'] ) ? $page_settings['hero_bg_rotator'] : '';
		
		$hero_style = isset( $page_settings['hero_style'] ) ? $page_settings['hero_style'] : 'default';
		$hero_highlight = isset( $page_settings['hero_highlight'] ) ? $page_settings['hero_highlight'] : '';
	
		$hero_bg = isset( $page_settings['hero_bg'] ) ? $page_settings['hero_bg'] : array();
		$hero_bg_default = isset( $hero_bg['default'] ) ? $hero_bg['default'] : 'default';
		$hero_bg_color = isset( $hero_bg['color'] ) ? $hero_bg['color'] : '';
		$hero_bg_color_opacity = isset( $hero_bg['color_opacity'] ) ? $hero_bg['color_opacity'] : '';
		$hero_bg_image = isset( $hero_bg['image'] ) ? $hero_bg['image'] : '';
		$hero_bg_image_pattern = isset( $hero_bg['image_pattern'] ) ? $hero_bg['image_pattern'] : 'full-width';
		$hero_bg_parallax = isset( $hero_bg['parallax'] ) ? $hero_bg['parallax'] : '';
		$hero_bg_overlay = isset( $hero_bg['overlay'] ) ? $hero_bg['overlay'] : 'default';
		$hero_bg_overlay_opacity = isset( $hero_bg['overlay_opacity'] ) ? $hero_bg['overlay_opacity'] : '';
	}

	echo '<input type="hidden" name="apex_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

	echo '<div id="apex-page-tabs">';
  	echo '<ul>';
  		do_action('apex_page_settings_tabs_before');
  		if( apex_admin_post_type() == 'page' && apex_is_page_template('pgtemp-posts.php') ) {
  			echo '<li class="nav-tab"><a href="#apex-page-tabs-0">'.__('Post Archive Settings', 'apex').'</a></li>';
  			
  		} elseif( apex_admin_post_type() == 'page' && apex_is_page_template('pgtemp-galleries.php') ) {
  			echo '<li class="nav-tab"><a href="#apex-page-tabs-0">'.__('Gallery Archive Settings', 'apex').'</a></li>';
  			
  		} elseif( apex_admin_post_type() == 'page' &&  apex_is_page_template('pgtemp-members.php') ) {
  			echo '<li class="nav-tab"><a href="#apex-page-tabs-0">'.__('Member Archive Settings', 'apex').'</a></li>';
  			
  		} elseif( get_post_format() == 'gallery' ) {
  			echo '<li class="nav-tab"><a href="#apex-page-tabs-0">'.__('Post Gallery Settings', 'apex').'</a></li>';
  		
  		} elseif( get_post_format() == 'video' ) {
  			echo '<li class="nav-tab"><a href="#apex-page-tabs-0">'.__('Post Video Settings', 'apex').'</a></li>';
  		
  		} 
  		
  		if( isset($single_setting_sections[$post_type]) ) {
  			echo '<li class="nav-tab"><a href="#apex-page-tabs-1">'.__('Layout', 'apex').'</a></li>';
				echo '<li class="nav-tab"><a href="#apex-page-tabs-2">'.__('Elements', 'apex').'</a></li>';
	    	echo '<li class="nav-tab"><a href="#apex-page-tabs-3">'.__('Content Style', 'apex').'</a></li>';
	    	echo '<li class="nav-tab"><a href="#apex-page-tabs-4">'.__('Header Style', 'apex').'</a></li>';
	    	echo '<li class="nav-tab"><a href="#apex-page-tabs-5">'.__('Hero Settings', 'apex').'</a></li>';
    	}
    	
			do_action('apex_page_settings_tabs_after');
		echo '</ul>';

		do_action('apex_page_settings_content_before');

		if( apex_admin_post_type() == 'page' && apex_is_page_template('pgtemp-posts.php') ) {
			apex_post_archive_settings_render_metabox();
			
		} elseif( apex_admin_post_type() == 'page' && apex_is_page_template('pgtemp-galleries.php') ) {
			apex_gallery_archive_settings_render_metabox();
			
		} elseif( apex_admin_post_type() == 'page' && apex_is_page_template('pgtemp-members.php') ) {
			apex_member_archive_settings_render_metabox();
			
		} elseif( get_post_format() == 'gallery' ) {
			apex_post_gallery_settings_render_metabox();
			
		} elseif( get_post_format() == 'video' ) {
			apex_post_video_settings_render_metabox();
			
		}

		/* --------------------------------------------------------- */
		/* !Layout - 1.1.1 */
		/* --------------------------------------------------------- */
		
		if( isset($single_setting_sections[$post_type]) ) {
				
			echo '<div id="apex-page-tabs-1" class="apex-page-tabs-page">';
				echo '<table class="apex-table">';
				
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Content width', 'apex').'</label>';
							echo '<small>'.__('Choose how to display content for the page', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
						
							$args = array(
								'name' => '_apex_page_settings[content_width]',
								'value' => $content_width,
								'options' => array(
									'default' => __('Use default setting', 'apex'),
									'normal' => __('Normal', 'apex'),
									'condensed' => __('Condensed', 'apex'),
									'wide' => __('Wide', 'apex')
								)
							);
							apex_settings_radio_buttons( $args );
	
						echo '</td>';
					echo '</tr>';
	
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Page layout', 'apex').'</label>';
							echo '<small>'.__('Set a custom layout for the page', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
						
							$args = array(
								'name' => '_apex_page_settings[layout]',
								'value' => $layout,
								'default' => true
							);
							apex_settings_layout( $args );
	
						echo '</td>';
					echo '</tr>';
	
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Sidebar', 'apex').'</label>';
							echo '<small>'.__('Adjust the sidebar for the page', 'apex').'</small>';
						echo '</td>';
						echo '<td style="width:1px;">';
						
							$args = array(
								'name' => '_apex_page_settings[sidebar]',
								'value' => $sidebar,
								'pull_name' => '_apex_page_settings[sidebar_pull]',
								'pull_value' => $sidebar_pull,
								'default' => true
							);
							apex_settings_sidebar( $args );
	
						echo '</td>';
					echo '</tr>';
	
				echo '</table>';
			echo '</div>';
	
			
			/* --------------------------------------------------------- */
			/* !Elements - 1.1.0 */
			/* --------------------------------------------------------- */
	
			echo '<div id="apex-page-tabs-2" class="apex-page-tabs-page">';
				echo '<table class="apex-table">';
	
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Page title', 'apex').'</label>';
							echo '<small>'.__('Override the default page title', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
						
							$args = array(
								'name' => '_apex_page_settings[title_display]',
								'value' => $title_display,
								'text_name' => '_apex_page_settings[title]',
								'text_value' => $title,
								'default' => true
							);
							apex_settings_title_tag( $args );
	
						echo '</td>';
					echo '</tr>';
	
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Page tagline', 'apex').'</label>';
							echo '<small>'.__('Add a custom tagline for the page', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
						
							$args = array(
								'name' => '_apex_page_settings[tagline_display]',
								'value' => $tagline_display,
								'text_name' => '_apex_page_settings[tagline]',
								'text_value' => $tagline,
								'default' => true
							);
							apex_settings_title_tag( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Content animations', 'apex').'</label>';
							echo '<small>'.__('Fade in content for the page', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
	
							$args = array(
								'name' => '_apex_page_settings[animate_header]',
								'value' => $animate_header,
								'content_name' => '_apex_page_settings[animate_content]',
								'content_value' => $animate_content,
								'default' => true
							);
							apex_settings_wow_animations( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Auto-hide navigation', 'apex').'</label>';
							echo '<small>'.__('Set the navigation display', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
						
							$args = array(
								'name' => '_apex_page_settings[autohide_nav]',
								'value' => $autohide_nav,
								'options' => array(
									'default' => __('Use default setting', 'apex'),
									'0' => __('No', 'apex'),
									'1' => __('Yes', 'apex')
								)
							);
							apex_settings_radio_buttons( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Page top', 'apex').'</label>';
							echo '<small>'.__('Choose the element to display at the top of the page', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
						
							$args = array(
								'name' => '_apex_page_settings[page_top]',
								'value' => $page_top,
								'options' => array(
									'default' => __('Use default setting', 'apex'),
									'header' => __('Header', 'apex'),
									'hero' => __('Hero', 'apex'),
									'none' => __('None', 'apex')
								)
							);
							apex_settings_radio_buttons( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Extra content - inner', 'apex').'</label>';
							echo '<small>'.__('Choose extra content you want to display within this page\'s main content wrapper', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
						
							$args = array(
								'name' => '_apex_page_settings[extra_sections_inner]',
								'value' => $extra_sections_inner,
								'default' => true
							);
							apex_settings_menu_select( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Extra content - outer', 'apex').'</label>';
							echo '<small>'.__('Choose extra content you want to display below this page\'s main content wrapper', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
						
							$args = array(
								'name' => '_apex_page_settings[extra_sections]',
								'value' => $extra_sections,
								'default' => true
							);
							apex_settings_menu_select( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Widget area', 'apex').'</label>';
							echo '<small>'.__('Select the widget area to display in the sidebar', 'apex').'</small>';
						echo '</td>';
						echo '<td style="width:1px;">';
						
							$args = array(
								'name' => '_apex_page_settings[widget_area]',
								'value' => $widget_area,
								'default' => true
							);
							apex_settings_widget_area_select( $args );
	
						echo '</td>';
					echo '</tr>';
	
				echo '</table>';
			echo '</div>';
			
			
			/* --------------------------------------------------------- */
			/* !Content Styles - 1.1.0 */
			/* --------------------------------------------------------- */
	
			echo '<div id="apex-page-tabs-3" class="apex-page-tabs-page">';
				echo '<table class="apex-table">';
	
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Content style', 'apex').'</label>';
							echo '<small>'.__('Set the initial color style of the page', 'apex').'</small>';
						echo '</td>';
						echo '<td style="width:1px;">';
						
							$args = array(
								'name' => '_apex_page_settings[style]',
								'value' => $style,
								'options' => array(
									'default' => __('Use default setting', 'apex'),
									'light' => __('Light', 'apex'),
									'dark' => __('Dark', 'apex')
								)
							);
							apex_settings_radio_buttons( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Content colors', 'apex').'</label>';
							echo '<small>'.__('Set custom colors for the page content', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
							
							$args = array(
								'highlight_name' => '_apex_page_settings[highlight]',
								'highlight_value' => $highlight
							);
							apex_settings_text_colors( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Content background', 'apex').'</label>';
							echo '<small>'.__('Set options for the page content background', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
						
							$args = array(
								'default' => array(
									'name' => '_apex_page_settings[content_bg][default]',
									'value' => $content_bg_default,
								),
								'color' => array(
									'name' => '_apex_page_settings[content_bg][color]',
									'value' => $content_bg_color,
									'opacity_name' => '_apex_page_settings[content_bg][color_opacity]',
									'opacity_value' => $content_bg_color_opacity
								),
								'image' => array(
									'name' => '_apex_page_settings[content_bg][image]',
									'value' => $content_bg_image,
									'pattern_name' => '_apex_page_settings[content_bg][image_pattern]',
									'pattern_value' => $content_bg_image_pattern
								),
								'parallax' => array(
									'name' => '_apex_page_settings[content_bg][parallax]',
									'value' => $content_bg_parallax
								),
								'overlay' => array(
									'name' => '_apex_page_settings[content_bg][overlay]',
									'value' => $content_bg_overlay,
									'default' => true,
									'opacity_name' => '_apex_page_settings[content_bg][overlay_opacity]',
									'opacity_value' => $content_bg_overlay_opacity
								)
							);
							apex_settings_background_options( $args );
	
						echo '</td>';
					echo '</tr>';
	
				echo '</table>';
			echo '</div>';
			
			
			/* --------------------------------------------------------- */
			/* !Header Styles - 1.0.0 */
			/* --------------------------------------------------------- */
	
			echo '<div id="apex-page-tabs-4" class="apex-page-tabs-page">';
				echo '<table class="apex-table">';
	
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Header style', 'apex').'</label>';
							echo '<small>'.__('Set the initial color style of the page header', 'apex').'</small>';
						echo '</td>';
						echo '<td style="width:1px;">';
						
							$args = array(
								'name' => '_apex_page_settings[header_style]',
								'value' => $header_style,
								'options' => array(
									'default' => __('Use default setting', 'apex'),
									'light' => __('Light', 'apex'),
									'dark' => __('Dark', 'apex')
								)
							);
							apex_settings_radio_buttons( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Header colors', 'apex').'</label>';
							echo '<small>'.__('Set custom colors for the page header', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
							
							$args = array(
								'highlight_name' => '_apex_page_settings[header_highlight]',
								'highlight_value' => $header_highlight
							);
							apex_settings_text_colors( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Header background', 'apex').'</label>';
							echo '<small>'.__('Set options for the page header background', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
						
							$args = array(
								'default' => array(
									'name' => '_apex_page_settings[header_bg][default]',
									'value' => $header_bg_default,
								),
								'color' => array(
									'name' => '_apex_page_settings[header_bg][color]',
									'value' => $header_bg_color,
									'opacity_name' => '_apex_page_settings[content_bg][color_opacity]',
									'opacity_value' => $header_bg_color_opacity
								),
								'image' => array(
									'name' => '_apex_page_settings[header_bg][image]',
									'value' => $header_bg_image,
									'pattern_name' => '_apex_page_settings[content_bg][image_pattern]',
									'pattern_value' => $header_bg_image_pattern
								),
								'parallax' => array(
									'name' => '_apex_page_settings[header_bg][parallax]',
									'value' => $header_bg_parallax
								),
								'overlay' => array(
									'name' => '_apex_page_settings[header_bg][overlay]',
									'value' => $header_bg_overlay,
									'default' => true,
									'opacity_name' => '_apex_page_settings[header_bg][overlay_opacity]',
									'opacity_value' => $header_bg_overlay_opacity
								)
							);
							apex_settings_background_options( $args );
	
						echo '</td>';
					echo '</tr>';
	
				echo '</table>';
			echo '</div>';
			
			/* --------------------------------------------------------- */
			/* !Hero Settings - 1.0.0 */
			/* --------------------------------------------------------- */
	
			echo '<div id="apex-page-tabs-5" class="apex-page-tabs-page">';
				echo '<table class="apex-table">';
	
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Hero logo', 'apex').'</label>';
							echo '<small>'.__('Set a custom logo for the hero element', 'apex').'</small>';
						echo '</td>';
						echo '<td style="width:1px;">';
						
							$args = array(
								'name' => '_apex_page_settings[hero_logo]',
								'value' => $hero_logo
							);
							apex_settings_image( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Hero menu', 'apex').'</label>';
							echo '<small>'.__('Choose a custom menu to display', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
							$args = array(
								'name' => '_apex_page_settings[hero_menu]',
								'value' => $hero_menu,
								'default' => true
							);
							apex_settings_menu_select( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Hero rotator', 'apex').'</label>';
							echo '<small>'.__('Setup custom rotators to display', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
						
							$args = array(
								'name' => '_apex_page_settings[hero_rotator]',
								'value' => $hero_rotator,
								'bg_name' => '_apex_page_settings[hero_bg_rotator]',
								'bg_value' => $hero_bg_rotator,
								'default' => true
							);
							apex_settings_hero_rotators( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Hero style', 'apex').'</label>';
							echo '<small>'.__('Set the initial color style of the hero element', 'apex').'</small>';
						echo '</td>';
						echo '<td style="width:1px;">';
						
							$args = array(
								'name' => '_apex_page_settings[hero_style]',
								'value' => $hero_style,
								'options' => array(
									'default' => __('Use default setting', 'apex'),
									'light' => __('Light', 'apex'),
									'dark' => __('Dark', 'apex')
								)
							);
							apex_settings_radio_buttons( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Hero colors', 'apex').'</label>';
							echo '<small>'.__('Set custom colors for the hero element', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
							
							$args = array(
								'highlight_name' => '_apex_page_settings[hero_highlight]',
								'highlight_value' => $hero_highlight
							);
							apex_settings_text_colors( $args );
	
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td class="apex-label">';
							echo '<label>'.__('Hero background', 'apex').'</label>';
							echo '<small>'.__('Set options for the hero element background', 'apex').'</small>';
						echo '</td>';
						echo '<td>';
						
							$args = array(
								'default' => array(
									'name' => '_apex_page_settings[hero_bg][default]',
									'value' => $hero_bg_default,
								),
								'color' => array(
									'name' => '_apex_page_settings[hero_bg][color]',
									'value' => $hero_bg_color,
									'opacity_name' => '_apex_page_settings[content_bg][color_opacity]',
									'opacity_value' => $hero_bg_color_opacity
								),
								'image' => array(
									'name' => '_apex_page_settings[hero_bg][image]',
									'value' => $hero_bg_image,
									'pattern_name' => '_apex_page_settings[hero_bg][image_pattern]',
									'pattern_value' => $hero_bg_image_pattern
								),
								'parallax' => array(
									'name' => '_apex_page_settings[hero_bg][parallax]',
									'value' => $hero_bg_parallax
								),
								'overlay' => array(
									'name' => '_apex_page_settings[hero_bg][overlay]',
									'value' => $hero_bg_overlay,
									'default' => true,
									'opacity_name' => '_apex_page_settings[hero_bg][overlay_opacity]',
									'opacity_value' => $hero_bg_overlay_opacity
								)
							);
							apex_settings_background_options( $args );
	
						echo '</td>';
					echo '</tr>';
	
				echo '</table>';
			echo '</div>';
		}

		do_action('apex_page_settings_content_after');

	echo '</div>';
}


/* --------------------------------------------------------- */
/* !Render the posts archive settings metabox - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_post_archive_settings_render_metabox') ) {
function apex_post_archive_settings_render_metabox() {

	global $post;
	$settings = get_post_meta( $post->ID, '_apex_post_archive_settings', true );

	$orderby = isset( $settings['orderby'] ) ? $settings['orderby'] : 'date';
	$order = isset( $settings['order'] ) ? $settings['order'] : 'DESC';
	$category_operator = isset( $settings['category_operator'] ) ? $settings['category_operator'] : '';
	$categories = isset( $settings['categories'] ) ? $settings['categories'] : array();
	$tag_operator = isset( $settings['tag_operator'] ) ? $settings['tag_operator'] : '';
	$tags = isset( $settings['tags'] ) ? $settings['tags'] : array();

	echo '<div id="apex-page-tabs-0" class="apex-page-tabs-page">';
		echo '<table class="apex-table">';

			echo '<tr>';
				echo '<td class="apex-label">';
					echo '<label>'.__('Post order', 'apex').'</label>';
					echo '<small>'.__('Set the display order of the posts', 'apex').'</small>';
				echo '</td>';
				echo '<td>';
					$args = array(
						'name' => '_apex_post_archive_settings[orderby]',
						'value' => $orderby,
						'order_name' => '_apex_post_archive_settings[order]',
						'order_value' => $order
					);
					apex_settings_post_order( $args );
				echo '</td>';
			echo '</tr>';

			$terms = get_terms( 'category' );
			if( is_array($terms) && count($terms) > 0 ) {
				echo '<tr>';
					echo '<td class="apex-label">';
						echo '<label>'.__('Category filter', 'apex').'</label>';
						echo '<small>'.__('Filter the archive by specific categories', 'apex').'</small>';
					echo '</td>';
					echo '<td>';
						echo '<label class="apex-taxonomy-filter"><select name="_apex_post_archive_settings[category_operator]">';
							echo '<option value="">'.__('Do not filter posts by categories', 'apex').'</option>';
							echo '<option value="IN" '.selected('IN', $category_operator, false).'>'.__('Show posts with any of the selected categories', 'apex').'</option>';
							echo '<option value="NOT IN" '.selected('NOT IN', $category_operator, false).'>'.__('Hide posts with any of the selected categories', 'apex').'</option>';
							echo '<option value="AND" '.selected('AND', $category_operator, false).'>'.__('Show posts with all of the selected categories', 'apex').'</option>';
						echo '</select></label>';
						echo '<div class="apex-taxonomy-filter-options">';
							foreach( $terms as $term ) {
								$checked = ( isset($categories[$term->slug]) ) ? 'checked="checked"' : '';
								echo '<label class="apex-checkbox"><input type="checkbox" name="_apex_post_archive_settings[categories]['.$term->slug.']" value="'.$term->term_id.'" '.$checked.' /> '.$term->name.'</label>';
							}
						echo '</div>';
					echo '</td>';
				echo '</tr>';
			}

			$terms = get_terms( 'post_tag' );
			if( is_array($terms) && count($terms) > 0 ) {
				echo '<tr>';
					echo '<td class="apex-label">';
						echo '<label>'.__('Tag filter', 'apex').'</label>';
						echo '<small>'.__('Filter the archive by specific tags', 'apex').'</small>';
					echo '</td>';
					echo '<td>';
						echo '<label class="apex-taxonomy-filter"><select name="_apex_post_archive_settings[tag_operator]">';
							echo '<option value="">'.__('Do not filter posts by tags', 'apex').'</option>';
							echo '<option value="IN" '.selected('IN', $tag_operator, false).'>'.__('Show posts with any of the selected tags', 'apex').'</option>';
							echo '<option value="NOT IN" '.selected('NOT IN', $tag_operator, false).'>'.__('Hide posts with any of the selected tags', 'apex').'</option>';
							echo '<option value="AND" '.selected('AND', $tag_operator, false).'>'.__('Show posts with all of the selected tags', 'apex').'</option>';
						echo '</select></label>';
						echo '<div class="apex-taxonomy-filter-options">';
							foreach( $terms as $term ) {
								$checked = ( isset($tags[$term->slug]) ) ? 'checked="checked"' : '';
								echo '<label class="apex-checkbox"><input type="checkbox" name="_apex_post_archive_settings[tags]['.$term->slug.']" value="'.$term->term_id.'" '.$checked.' /> '.$term->name.'</label>';
							}
						echo '</div>';
					echo '</td>';
				echo '</tr>';
			}

		echo '</table>';
	echo '</div>';
}
}

/* --------------------------------------------------------- */
/* !Render the gallery archive settings metabox - 1.0.9 */
/* --------------------------------------------------------- */

if( !function_exists('apex_gallery_archive_settings_render_metabox') ) {
function apex_gallery_archive_settings_render_metabox() {

	global $post;
	$settings = get_post_meta( $post->ID, '_apex_gallery_archive_settings', true );

	$orderby = isset( $settings['orderby'] ) ? $settings['orderby'] : 'date';
	$order = isset( $settings['order'] ) ? $settings['order'] : 'DESC';
	$limit = isset( $settings['limit'] ) ? $settings['limit'] : 6;
	$single_link = ( isset($settings['single_link']) && $settings['single_link'] == 'on' ) ? $settings['single_link'] : '';
	$taxonomy_filter = isset( $settings['taxonomy_filter'] ) ? $settings['taxonomy_filter'] : '';
	$category_operator = isset( $settings['category_operator'] ) ? $settings['category_operator'] : '';
	$categories = isset( $settings['categories'] ) ? $settings['categories'] : array();
	$tag_operator = isset( $settings['tag_operator'] ) ? $settings['tag_operator'] : '';
	$tags = isset( $settings['tags'] ) ? $settings['tags'] : array();

	echo '<div id="apex-page-tabs-0" class="apex-page-tabs-page">';
		echo '<table class="apex-table">';

			echo '<tr>';
				echo '<td class="apex-label">';
					echo '<label>'.__('Post order', 'apex').'</label>';
					echo '<small>'.__('Set the display order of the posts', 'apex').'</small>';
				echo '</td>';
				echo '<td>';
					$args = array(
						'name' => '_apex_gallery_archive_settings[orderby]',
						'value' => $orderby,
						'order_name' => '_apex_gallery_archive_settings[order]',
						'order_value' => $order
					);
					apex_settings_post_order( $args );
				echo '</td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td class="apex-label">';
					echo '<label>'.__('Post limit', 'apex').'</label>';
					echo '<small>'.__('Limit the number of posts to display on page load', 'apex').'</small>';
				echo '</td>';
				echo '<td>';
					echo '<input type="number" name="_apex_gallery_archive_settings[limit]" value="'.$limit.'" />';
					echo '<span> '.__('posts', 'apex').'</span>';
				echo '</td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td class="apex-label">';
					echo '<label>'.__('Direct link', 'apex').'</label>';
					echo '<small>'.__('Choose to link directly to the gallery\'s single page', 'apex').'</small>';
				echo '</td>';
				echo '<td>';
					$args = array(
						'name' => '_apex_gallery_archive_settings[single_link]',
						'value' => $single_link,
						'label' => __('Link thumbnails directly to single page', 'apex')
					);
					apex_settings_checkbox( $args );
				echo '</td>';
			echo '</tr>';

			echo '<tr>';
				echo '<td class="apex-label">';
					echo '<label>'.__('Filter buttons', 'apex').'</label>';
					echo '<small>'.__('Display buttons to dynamically filter posts', 'apex').'</small>';
				echo '</td>';
				echo '<td>';
					$args = array(
						'name' => '_apex_gallery_archive_settings[taxonomy_filter]',
						'value' => $taxonomy_filter,
						'options' => array(
							'' => __('None', 'apex'),
							'mtphr_gallery_category' => __('Categories', 'apex'),
							'mtphr_gallery_tag' => __('Tags', 'apex')
						)
					);
					apex_settings_radio_buttons( $args );
				echo '</td>';
			echo '</tr>';

			$terms = get_terms( 'mtphr_gallery_category' );
			if( is_array($terms) && count($terms) > 0 ) {
				echo '<tr>';
					echo '<td class="apex-label">';
						echo '<label>'.__('Category filter', 'apex').'</label>';
						echo '<small>'.__('Filter the archive by specific categories', 'apex').'</small>';
					echo '</td>';
					echo '<td>';
						echo '<label class="apex-taxonomy-filter"><select name="_apex_gallery_archive_settings[category_operator]">';
							echo '<option value="">'.__('Do not filter posts by categories', 'apex').'</option>';
							echo '<option value="IN" '.selected('IN', $category_operator, false).'>'.__('Show posts with any of the selected categories', 'apex').'</option>';
							echo '<option value="NOT IN" '.selected('NOT IN', $category_operator, false).'>'.__('Hide posts with any of the selected categories', 'apex').'</option>';
							echo '<option value="AND" '.selected('AND', $category_operator, false).'>'.__('Show posts with all of the selected categories', 'apex').'</option>';
						echo '</select></label>';
						echo '<div class="apex-taxonomy-filter-options">';
							foreach( $terms as $term ) {
								$checked = ( isset($categories[$term->slug]) ) ? 'checked="checked"' : '';
								echo '<label class="apex-checkbox"><input type="checkbox" name="_apex_gallery_archive_settings[categories]['.$term->slug.']" value="'.$term->term_id.'" '.$checked.' /> '.$term->name.'</label>';
							}
						echo '</div>';
					echo '</td>';
				echo '</tr>';
			}

			$terms = get_terms( 'mtphr_gallery_tag' );
			if( is_array($terms) && count($terms) > 0 ) {
				echo '<tr>';
					echo '<td class="apex-label">';
						echo '<label>'.__('Tag filter', 'apex').'</label>';
						echo '<small>'.__('Filter the archive by specific tags', 'apex').'</small>';
					echo '</td>';
					echo '<td>';
						echo '<label class="apex-taxonomy-filter"><select name="_apex_gallery_archive_settings[tag_operator]">';
							echo '<option value="">'.__('Do not filter posts by tags', 'apex').'</option>';
							echo '<option value="IN" '.selected('IN', $tag_operator, false).'>'.__('Show posts with any of the selected tags', 'apex').'</option>';
							echo '<option value="NOT IN" '.selected('NOT IN', $tag_operator, false).'>'.__('Hide posts with any of the selected tags', 'apex').'</option>';
							echo '<option value="AND" '.selected('AND', $tag_operator, false).'>'.__('Show posts with all of the selected tags', 'apex').'</option>';
						echo '</select></label>';
						echo '<div class="apex-taxonomy-filter-options">';
							foreach( $terms as $term ) {
								$checked = ( isset($tags[$term->slug]) ) ? 'checked="checked"' : '';
								echo '<label class="apex-checkbox"><input type="checkbox" name="_apex_gallery_archive_settings[tags]['.$term->slug.']" value="'.$term->term_id.'" '.$checked.' /> '.$term->name.'</label>';
							}
						echo '</div>';
					echo '</td>';
				echo '</tr>';
			}

		echo '</table>';
	echo '</div>';
}
}

/* --------------------------------------------------------- */
/* !Render the member archive settings metabox - 1.1.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_member_archive_settings_render_metabox') ) {
function apex_member_archive_settings_render_metabox() {

	global $post;
	$settings = get_post_meta( $post->ID, '_apex_member_archive_settings', true );
	
	$disable_social = ( isset($settings['disable_social']) && $settings['disable_social'] == 'on' ) ? $settings['disable_social'] : '';
	$excerpt_length = isset( $settings['excerpt_length'] ) ? $settings['excerpt_length'] : 140;
	$excerpt_more = isset( $settings['excerpt_more'] ) ? $settings['excerpt_more'] : '&hellip;<br/>{'.__('Read more', 'apex').'}';
	$orderby = isset( $settings['orderby'] ) ? $settings['orderby'] : 'date';
	$order = isset( $settings['order'] ) ? $settings['order'] : 'DESC';
	$category_operator = isset( $settings['category_operator'] ) ? $settings['category_operator'] : '';
	$categories = isset( $settings['categories'] ) ? $settings['categories'] : array();

	echo '<div id="apex-page-tabs-0" class="apex-page-tabs-page">';
		echo '<table class="apex-table">';

			echo '<tr>';
				echo '<td class="apex-label">';
					echo '<label>'.__('Disable social links', 'apex').'</label>';
					echo '<small>'.__('Link thumbnail directly to single post', 'apex').'</small>';
				echo '</td>';
				echo '<td>';
					$args = array(
						'name' => '_apex_member_archive_settings[disable_social]',
						'value' => $disable_social,
						'label' => __('Disable social links on hover', 'apex')
					);
					apex_settings_checkbox( $args );
				echo '</td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td class="apex-label">';
					echo '<label>'.__('Excerpt length', 'apex').'</label>';
					echo '<small>'.__('Set the excerpt length', 'apex').'</small>';
				echo '</td>';
				echo '<td>';
					$args = array(
						'name' => '_apex_member_archive_settings[excerpt_length]',
						'value' => $excerpt_length
					);
					apex_settings_number( $args );
				echo '</td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td class="apex-label">';
					echo '<label>'.__('Excerpt more', 'apex').'</label>';
					echo '<small>'.__('Set the excerpt more text. Use curly brackets to create a link to the single post.', 'apex').'</small>';
				echo '</td>';
				echo '<td>';
					$args = array(
						'name' => '_apex_member_archive_settings[excerpt_more]',
						'value' => $excerpt_more
					);
					apex_settings_text( $args );
				echo '</td>';
			echo '</tr>';
			
			echo '<tr>';
				echo '<td class="apex-label">';
					echo '<label>'.__('Post order', 'apex').'</label>';
					echo '<small>'.__('Set the display order of the posts', 'apex').'</small>';
				echo '</td>';
				echo '<td>';
					$args = array(
						'name' => '_apex_member_archive_settings[orderby]',
						'value' => $orderby,
						'order_name' => '_apex_member_archive_settings[order]',
						'order_value' => $order
					);
					apex_settings_post_order( $args );
				echo '</td>';
			echo '</tr>';

			$terms = get_terms( 'mtphr_member_category' );
			if( is_array($terms) && count($terms) > 0 ) {
				echo '<tr>';
					echo '<td class="apex-label">';
						echo '<label>'.__('Category filter', 'apex').'</label>';
						echo '<small>'.__('Filter the archive by specific categories', 'apex').'</small>';
					echo '</td>';
					echo '<td>';
						echo '<label class="apex-taxonomy-filter"><select name="_apex_member_archive_settings[category_operator]">';
							echo '<option value="">'.__('Do not filter posts by categories', 'apex').'</option>';
							echo '<option value="IN" '.selected('IN', $category_operator, false).'>'.__('Show posts with any of the selected categories', 'apex').'</option>';
							echo '<option value="NOT IN" '.selected('NOT IN', $category_operator, false).'>'.__('Hide posts with any of the selected categories', 'apex').'</option>';
							echo '<option value="AND" '.selected('AND', $category_operator, false).'>'.__('Show posts with all of the selected categories', 'apex').'</option>';
						echo '</select></label>';
						echo '<div class="apex-taxonomy-filter-options">';
							foreach( $terms as $term ) {
								$checked = ( isset($categories[$term->slug]) ) ? 'checked="checked"' : '';
								echo '<label class="apex-checkbox"><input type="checkbox" name="_apex_member_archive_settings[categories]['.$term->slug.']" value="'.$term->term_id.'" '.$checked.' /> '.$term->name.'</label>';
							}
						echo '</div>';
					echo '</td>';
				echo '</tr>';
			}

		echo '</table>';
	echo '</div>';
}
}


/* --------------------------------------------------------- */
/* !Render the post gallery settings metabox - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_post_gallery_settings_render_metabox') ) {
function apex_post_gallery_settings_render_metabox() {

	global $post;

	echo '<div id="apex-page-tabs-0" class="apex-page-tabs-page">';
		
		if( function_exists('mtphr_galleries_resources_metabox') ) {
			$args = array(
				'limit_types' => array(
					'image'
				)
			);
			
			mtphr_galleries_resources_metabox( '_mtphr_gallery_resources', $args );
			echo '<div style="margin-top:10px;">';
				mtphr_galleries_settings_metabox();
			echo '</div>';
			

		} else {
			
			echo '<div class="error"><p>';
				$url = site_url().'/wp-admin/plugin-install.php?tab=plugin-information&plugin=mtphr-galleries&TB_iframe=true&width=640&height=500';
				printf(__('<a class="thickbox" href="%s"><strong>Metaphor Galleries</strong></a> must be installed & activated to setup <strong>post gallery images</strong>.','apex'), $url);
			echo '</p></div>';
			printf(__('<a class="thickbox" href="%s"><strong>Metaphor Galleries</strong></a> must be installed & activated to setup <strong>post gallery images</strong>.','apex'), $url);
		}
			
	echo '</div>';
}
}


/* --------------------------------------------------------- */
/* !Render the post video settings metabox - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_post_video_settings_render_metabox') ) {
function apex_post_video_settings_render_metabox() {

	global $post;

	echo '<div id="apex-page-tabs-0" class="apex-page-tabs-page">';
		
		if( function_exists('mtphr_galleries_resources_metabox') ) {
			$args = array(
				'limit_types' => array(
					'video',
					'youtube',
					'vimeo',
				),
				'single_resource' => true
			);
			
			mtphr_galleries_resources_metabox( '_mtphr_gallery_resources', $args );	

		} else {
			
			echo '<div class="error"><p>';
				$url = site_url().'/wp-admin/plugin-install.php?tab=plugin-information&plugin=mtphr-galleries&TB_iframe=true&width=640&height=500';
				printf(__('<a class="thickbox" href="%s"><strong>Metaphor Galleries</strong></a> must be installed & activated to setup <strong>post gallery images</strong>.','apex'), $url);
			echo '</p></div>';
			printf(__('<a class="thickbox" href="%s"><strong>Metaphor Galleries</strong></a> must be installed & activated to setup <strong>post gallery images</strong>.','apex'), $url);
		}
			
	echo '</div>';
}
}



/* --------------------------------------------------------- */
/* !Save the custom meta - 1.1.0 */
/* --------------------------------------------------------- */

function apex_metabox_save( $post_id ) {

	global $post;

	// verify nonce
	if (!isset($_POST['apex_nonce']) || !wp_verify_nonce($_POST['apex_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']) ) return $post_id;

	// don't save if only a revision
	if ( isset($post->post_type) && $post->post_type == 'revision' ) return $post_id;

	// check permissions
	if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	// Sanitize and save the page settings
	if( isset($_POST['_apex_page_settings']) ) {
		$settings = $_POST['_apex_page_settings'];

		$sanitized_settings = array();
		
		// Layout
		$sanitized_settings['layout'] = isset( $settings['layout'] ) ? $settings['layout'] : '';
		$sanitized_settings['content_width'] = isset( $settings['content_width'] ) ? $settings['content_width'] : '';
		$sanitized_settings['sidebar'] = isset( $settings['sidebar'] ) ? $settings['sidebar'] : '';
		$sanitized_settings['sidebar_pull'] = isset( $settings['sidebar_pull'] ) ? $settings['sidebar_pull'] : '';

		// Elements
		$sanitized_settings['autohide_nav'] = isset( $settings['autohide_nav'] ) ? $settings['autohide_nav'] : '';
		$sanitized_settings['page_top'] = isset( $settings['page_top'] ) ? $settings['page_top'] : '';
		$sanitized_settings['title'] = isset( $settings['title'] ) ? convert_chars(wptexturize($settings['title'])) : '';
		$sanitized_settings['title_display'] = isset( $settings['title_display'] ) ? $settings['title_display'] : '';
		$sanitized_settings['tagline'] = isset( $settings['tagline'] ) ? convert_chars(wptexturize($settings['tagline'])) : '';
		$sanitized_settings['tagline_display'] = isset( $settings['tagline_display'] ) ? $settings['tagline_display'] : '';
		$sanitized_settings['widget_area'] = isset( $settings['widget_area'] ) ? $settings['widget_area'] : '';
		$sanitized_settings['extra_sections'] = isset( $settings['extra_sections'] ) ? $settings['extra_sections'] : '';
		$sanitized_settings['extra_sections_inner'] = isset( $settings['extra_sections_inner'] ) ? $settings['extra_sections_inner'] : '';
		if( isset($settings['animate_header']) ) {
			$sanitized_settings['animate_header']['animation'] = $settings['animate_header']['animation'];
			$sanitized_settings['animate_header']['delay'] = isset($settings['animate_header']['delay']) ? sanitize_text_field($settings['animate_header']['delay']) : '';
		}
		if( isset($settings['animate_content']) ) {
			$sanitized_settings['animate_content']['animation'] = $settings['animate_content']['animation'];
			$sanitized_settings['animate_content']['delay'] = isset($settings['animate_content']['delay']) ? sanitize_text_field($settings['animate_content']['delay']) : '';
		}
		
		// Content styles
		$sanitized_settings['style'] = isset( $settings['style'] ) ? $settings['style'] : '';
		$sanitized_settings['highlight'] = isset( $settings['highlight'] ) ? sanitize_text_field($settings['highlight']) : '';;
		$sanitized_settings['content_bg'] = isset( $settings['content_bg'] ) ? $settings['content_bg'] : '';
			
		// Header styles
		$sanitized_settings['header_style'] = isset( $settings['header_style'] ) ? $settings['header_style'] : '';
		$sanitized_settings['header_highlight'] = isset( $settings['header_highlight'] ) ? sanitize_text_field($settings['header_highlight']) : '';
		$sanitized_settings['header_bg'] = isset( $settings['header_bg'] ) ? $settings['header_bg'] : '';
		
		// Hero settings
		$sanitized_settings['hero_logo'] = isset( $settings['hero_logo'] ) ? $settings['hero_logo'] : '';
		$sanitized_settings['hero_menu'] = isset( $settings['hero_menu'] ) ? $settings['hero_menu'] : '';
		$sanitized_settings['hero_rotator'] = isset( $settings['hero_rotator'] ) ? $settings['hero_rotator'] : '';
		$sanitized_settings['hero_bg_rotator'] = isset( $settings['hero_bg_rotator'] ) ? $settings['hero_bg_rotator'] : '';
		$sanitized_settings['hero_style'] = isset( $settings['hero_style'] ) ? $settings['hero_style'] : '';
		$sanitized_settings['hero_highlight'] = isset( $settings['hero_highlight'] ) ? sanitize_text_field($settings['hero_highlight']) : '';
		$sanitized_settings['hero_bg'] = isset( $settings['hero_bg'] ) ? $settings['hero_bg'] : '';

		update_post_meta( $post_id, '_apex_page_settings', $sanitized_settings );
	}
	
	// Sanitize and save the post archive settings
	if( isset($_POST['_apex_post_archive_settings']) ) {
		$settings = $_POST['_apex_post_archive_settings'];

		$sanitized_settings = array();
		$sanitized_settings['orderby'] = isset( $settings['orderby'] ) ? $settings['orderby'] : '';
		$sanitized_settings['order'] = isset( $settings['order'] ) ? $settings['order'] : '';
		$sanitized_settings['category_operator'] = isset( $settings['category_operator'] ) ? $settings['category_operator'] : '';
		$sanitized_settings['categories'] = isset( $settings['categories'] ) ? $settings['categories'] : array();
		$sanitized_settings['tag_operator'] = isset( $settings['tag_operator'] ) ? $settings['tag_operator'] : '';
		$sanitized_settings['tags'] = isset( $settings['tags'] ) ? $settings['tags'] : array();

		update_post_meta( $post_id, '_apex_post_archive_settings', $sanitized_settings );
	}

	// Sanitize and save the gallery archive settings
	if( isset($_POST['_apex_gallery_archive_settings']) ) {
		$settings = $_POST['_apex_gallery_archive_settings'];

		$sanitized_settings = array();
		$sanitized_settings['orderby'] = isset( $settings['orderby'] ) ? $settings['orderby'] : '';
		$sanitized_settings['order'] = isset( $settings['order'] ) ? $settings['order'] : '';
		$sanitized_settings['limit'] = isset( $settings['limit'] ) ? intval($settings['limit']) : '';
		$sanitized_settings['single_link'] = ( isset($settings['single_link']) && $settings['single_link'] == 'on' ) ? $settings['single_link'] : '';
		$sanitized_settings['taxonomy_filter'] = isset( $settings['taxonomy_filter'] ) ? $settings['taxonomy_filter'] : '';
		$sanitized_settings['category_operator'] = isset( $settings['category_operator'] ) ? $settings['category_operator'] : '';
		$sanitized_settings['categories'] = isset( $settings['categories'] ) ? $settings['categories'] : array();
		$sanitized_settings['tag_operator'] = isset( $settings['tag_operator'] ) ? $settings['tag_operator'] : '';
		$sanitized_settings['tags'] = isset( $settings['tags'] ) ? $settings['tags'] : array();
		
		update_post_meta( $post_id, '_apex_gallery_archive_settings', $sanitized_settings );
	}

	// Sanitize and save the member archive settings
	if( isset($_POST['_apex_member_archive_settings']) ) {
		$settings = $_POST['_apex_member_archive_settings'];

		$sanitized_settings = array();
		$sanitized_settings['disable_social'] = ( isset($settings['disable_social']) && $settings['disable_social'] == 'on' ) ? $settings['disable_social'] : '';
		$sanitized_settings['excerpt_length'] = isset( $settings['excerpt_length'] ) ? intval($settings['excerpt_length']) : '';
		$sanitized_settings['excerpt_more'] = isset( $settings['excerpt_more'] ) ? sanitize_text_field($settings['excerpt_more']) : '';
		$sanitized_settings['orderby'] = isset( $settings['orderby'] ) ? $settings['orderby'] : '';
		$sanitized_settings['order'] = isset( $settings['order'] ) ? $settings['order'] : '';
		$sanitized_settings['category_operator'] = isset( $settings['category_operator'] ) ? $settings['category_operator'] : '';
		$sanitized_settings['categories'] = isset( $settings['categories'] ) ? $settings['categories'] : array();

		update_post_meta( $post_id, '_apex_member_archive_settings', $sanitized_settings );
	}

	// Sanitize and save the faq archive settings
	if( isset($_POST['_apex_faq_archive_settings']) ) {
		$settings = $_POST['_apex_faq_archive_settings'];

		$sanitized_settings = array();
		$sanitized_settings['orderby'] = isset( $settings['orderby'] ) ? $settings['orderby'] : '';
		$sanitized_settings['order'] = isset( $settings['order'] ) ? $settings['order'] : '';
		$sanitized_settings['categories'] = isset( $settings['categories'] ) ? $settings['categories'] : array();

		update_post_meta( $post_id, '_apex_faq_archive_settings', $sanitized_settings );
	}
	
	// Save the post gallery data
	if( function_exists('mtphr_galleries_resources_save') ) {
		mtphr_galleries_resources_save( $post_id );
		mtphr_galleries_settings_save( $post_id );
	}
}
add_action( 'save_post', 'apex_metabox_save' );



