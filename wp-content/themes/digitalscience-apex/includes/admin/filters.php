<?php

/* --------------------------------------------------------- */
/* !Update the menu custom meta - 1.1.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_update_nav_menu_item') ) {
function apex_update_nav_menu_item( $menu_id, $menu_item_db_id, $args ) {

  if( isset($_REQUEST['menu-item-icon']) && is_array($_REQUEST['menu-item-icon']) ) {
	  $icon_value = $_REQUEST['menu-item-icon'][$menu_item_db_id];
	  update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_value );
  }
  
  if( isset($_REQUEST['menu-item-disable-link']) && is_array($_REQUEST['menu-item-disable-link']) ) {
	  $disable_link_value = $_REQUEST['menu-item-disable-link'][$menu_item_db_id];
	  update_post_meta( $menu_item_db_id, '_menu_item_disable_link', $disable_link_value );
  }
  
  if( isset($_REQUEST['menu-item-hide-section']) && is_array($_REQUEST['menu-item-hide-section']) ) {
	  $hidden_value = $_REQUEST['menu-item-hide-section'][$menu_item_db_id];
	  update_post_meta( $menu_item_db_id, '_menu_item_hide_section', $hidden_value );
  }

  if( isset($_REQUEST['menu-item-hashtag-link']) && is_array($_REQUEST['menu-item-hashtag-link']) ) {
	  if( isset($_REQUEST['menu-item-hashtag-link'][$menu_item_db_id]) ) {
		  $hashtag_link_value = $_REQUEST['menu-item-hashtag-link'][$menu_item_db_id];
		  update_post_meta( $menu_item_db_id, '_menu_item_hashtag_link', $hashtag_link_value );
	  }
  } 
}
}
add_action( 'wp_update_nav_menu_item', 'apex_update_nav_menu_item', 10, 3 );



/* --------------------------------------------------------- */
/* !Use a custom walker for the edit menus - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_edit_nav_menu_walker') ) {
function apex_edit_nav_menu_walker( $walker, $menu_id ) {

	return 'Apex_Walker_Nav_Menu_Edit';

}
}
add_filter( 'wp_edit_nav_menu_walker', 'apex_edit_nav_menu_walker', 10, 2 );



/* --------------------------------------------------------- */
/* !Add styles & buttons to the visual editor - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_wysiwyg_styles') ) {
function apex_wysiwyg_styles( $settings ) {
	
	// Create array of new styles
	$new_styles = array(
		array(
			'title'	=> __( 'Custom Styles', 'apex' ),
			'items'	=> array(
				array(
					'title' => '.light',
					'selector' => 'h1, h2, h3, h4, h5, h6',
					'classes'	=> 'light'
				),
				array(
					'title' => '.btn',
					'selector' => 'a',
					'classes'	=> 'btn'
				),
				array(
					'title' => '.apex-readmore',
					'selector' => 'a',
					'classes'	=> 'apex-readmore'
				),
				array(
					'title' => '.data-scroll',
					'selector' => 'a',
					'classes'	=> 'data-scroll'
				),
				array(
					'title' => '.content-title',
					'selector' => 'h1, h2, h3, h4, h5, h6',
					'classes'	=> 'content-title'
				),
				array(
					'title' => '.large',
					'selector' => 'p',
					'classes'	=> 'large'
				),
				array(
					'title' => '.medium',
					'selector' => 'p',
					'classes'	=> 'medium'
				),
				array(
					'title' => '.mobile-align-center',
					'selector' => 'h1, h2, h3, h4, h5, h6, p, ul, ol',
					'classes' => 'mobile-align-center'
				),
				array(
					'title' => '.apex-position-section-bottom',
					'selector' => 'img',
					'classes'	=> 'apex-position-section-bottom'
				)
			),
		),
		array(
			'title'	=> __( 'Custom Margins', 'apex' ),
			'items'	=> array(
				array(
					'title' => '.no-margin',
					'selector' => 'h1, h2, h3, h4, h5, h6, p, ul, ol',
					'classes'	=> 'no-margin'
				),
				array(
					'title' => '.small-margin',
					'selector' => 'h1, h2, h3, h4, h5, h6, p, ul, ol',
					'classes'	=> 'small-margin'
				),
				array(
					'title' => '.medium-margin',
					'selector' => 'h1, h2, h3, h4, h5, h6, p, ul, ol',
					'classes'	=> 'medium-margin'
				),
			),
		),
	);

	// Merge old & new styles
	$settings['style_formats_merge'] = true;

	// Add new styles
	$settings['style_formats'] = json_encode( $new_styles );

	// Return New Settings
	return $settings;
}
}
add_filter( 'tiny_mce_before_init', 'apex_wysiwyg_styles' );

if( !function_exists('apex_wysiwyg_buttons') ) {
function apex_wysiwyg_buttons( $buttons ) {
  $buttons[] = 'hr';
  $buttons[] = 'wp_page';
  $buttons[] = 'styleselect';
  return $buttons;
}
}
add_filter( 'mce_buttons', 'apex_wysiwyg_buttons' );


/* --------------------------------------------------------- */
/* !Add Apex icons to Metaphor Shortcodes list - 1.0.7 */
/* --------------------------------------------------------- */

if( !function_exists('apex_add_shortcode_icons') ) {
function apex_add_shortcode_icons( $icon_groups ) {

	$data = get_option( 'apex_icons', array() );
	
	if( !empty($data) ) {
		$icon_groups[$data['prefix']] = array(
			'title' => __('Apex', 'apex'),
			'classes' => $data['classes']
		);
	}
	
	return $icon_groups;
}
}
add_filter( 'mtphr_shortcodes_fontastic_icons', 'apex_add_shortcode_icons' );



/* --------------------------------------------------------- */
/* !Process a settings import from a json file */
/* --------------------------------------------------------- */

if( !function_exists('apex_process_settings_import') ) {
function apex_process_settings_import() {

	if( empty($_POST['apex_action']) || !isset($_POST['apex-import-settings']) )
		return;

	if( ! wp_verify_nonce( $_POST['apex_import_nonce'], 'apex_import_nonce' ) )
		return;

	if( ! current_user_can( 'manage_options' ) )
		return;
		
	$filename_parts = explode( '.', $_FILES['import_settings_file']['name'] );
	$extension = end( $filename_parts );

	if( $extension != 'json' ) {
		wp_die( __( 'Please upload a valid .json file', 'apex' ) );
	}
	
	$import_file = $_FILES['import_settings_file']['tmp_name'];

	if( empty( $import_file ) ) {
		wp_die( __( 'Please upload a file to import', 'apex' ) );
	}

	// Retrieve the settings from the file and convert the json object to an array.
	$settings = (array) json_decode( file_get_contents( $import_file ), true );
	if( is_array($settings) && count($settings) > 0 ) {
		foreach( $settings as $i=>$s ) {
			if( is_array($s) ) {
				update_option( $i, $s );
			}
		}
	}

	wp_safe_redirect( admin_url( 'themes.php?page=apex&tab=import' ) ); exit;

}
}
add_action( 'admin_init', 'apex_process_settings_import' );



/* --------------------------------------------------------- */
/* !Process a settings export that generates a .json file */
/* --------------------------------------------------------- */

if( !function_exists('apex_process_settings_export') ) {
function apex_process_settings_export() {

	if( empty($_POST['apex_action']) || !isset($_POST['apex-export-settings']) )
		return;

	if( ! wp_verify_nonce( $_POST['apex_export_nonce'], 'apex_export_nonce' ) )
		return;

	if( ! current_user_can( 'manage_options' ) )
		return;

	$settings = array(
		'apex_general_settings' => get_option( 'apex_general_settings' ),
		'apex_content_settings' => get_option( 'apex_content_settings' ),
		'apex_typography_settings' => get_option( 'apex_typography_settings' )
	);

	ignore_user_abort( true );

	nocache_headers();
	header( 'Content-Type: application/json; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=apex-settings-export-' . date( 'm-d-Y' ) . '.json' );
	header( "Expires: 0" );

	echo json_encode( $settings );
	exit;
}
}
add_action( 'admin_init', 'apex_process_settings_export' );



/* --------------------------------------------------------- */
/* !Process a widgets import from a json file */
/* --------------------------------------------------------- */

if( !function_exists('apex_process_widgets_import') ) {
function apex_process_widgets_import() {

	if( empty($_POST['apex_action']) || !isset($_POST['apex-import-widgets']) )
		return;

	if( ! wp_verify_nonce( $_POST['apex_import_nonce'], 'apex_import_nonce' ) )
		return;

	if( ! current_user_can( 'manage_options' ) )
		return;
		
	$filename_parts = explode( '.', $_FILES['import_widgets_file']['name'] );
	$extension = end( $filename_parts );

	if( $extension != 'json' ) {
		wp_die( __( 'Please upload a valid .json file', 'apex' ) );
	}

	$import_file = $_FILES['import_widgets_file']['tmp_name'];

	if( empty( $import_file ) ) {
		wp_die( __( 'Please upload a file to import', 'apex' ) );
	}

	// Retrieve the settings from the file and convert the json object to an array.
	$json_data = (array) json_decode( file_get_contents( $import_file ), true );
	
	$sidebars_widgets = get_option('sidebars_widgets');
	$options = array();		
	
	if( is_array($json_data) && count($json_data) > 0 ) {
		foreach( $json_data as $slug=>$data ) {
			
			if( array_key_exists($slug, $sidebars_widgets) ) {
			
				$widgets = $json_data[$slug];
				
				$widget_ids = array();
				if( is_array($widgets) && count($widgets) > 0 ) {
					foreach( $widgets as $i=>$widget ) {
						
						$widget_name = $widget['widget'];	
													
						if( !isset($options[$widget_name]) ) {
							$options[$widget_name] = get_option($widget_name, array());
							if( isset($options[$widget_name]['_multiwidget']) ) {
								unset($options[$widget_name]['_multiwidget']);
							}	
						}
						$count = count($options[$widget_name]);
											
						$type = explode('widget_', $widget_name);
						$widget_ids[] = $type[1].'-'.$count;
						$options[$widget_name][] = $widget['data'];
						
					}
				}

				$sidebars_widgets[$slug] = array_merge( $sidebars_widgets[$slug], $widget_ids );
			}
		}
		
		
		if( is_array($options) && count($options) > 0 ) {
			foreach( $options as $option=>$data ) {
				update_option($option, $data);	
			}
		}
		
		update_option('sidebars_widgets', $sidebars_widgets);
	}

	wp_safe_redirect( admin_url( 'themes.php?page=apex&tab=import' ) ); exit;

}
}
add_action( 'admin_init', 'apex_process_widgets_import' );


/* --------------------------------------------------------- */
/* !Process a widgets export that generates a .json file */
/* --------------------------------------------------------- */

if( !function_exists('apex_process_widgets_export') ) {
function apex_process_widgets_export() {

	if( empty($_POST['apex_action']) || !isset($_POST['apex-export-widgets']) )
		return;

	if( ! wp_verify_nonce( $_POST['apex_export_nonce'], 'apex_export_nonce' ) )
		return;

	if( ! current_user_can( 'manage_options' ) )
		return;

	global $wp_registered_sidebars, $wp_registered_widgets;

	$widgets = wp_get_sidebars_widgets();

	$all_sidebars_data = array();
	
	$option = get_option('widget_mtphr-social');

	if( is_array($wp_registered_sidebars) && count($wp_registered_sidebars) > 0 ) {
		foreach( $wp_registered_sidebars as $i=>$registered_sidebar ) {
			
			$sidebar_data = array();		
			$widget_ids = $widgets[$registered_sidebar['id']];

			if( is_array($widget_ids) && count($widget_ids) > 0 ) {
				foreach( $widget_ids as $id ) {		 
					$option_name = $wp_registered_widgets[$id]['callback'][0]->option_name;
					$key = $wp_registered_widgets[$id]['params'][0]['number'];
					$widget_data = get_option($option_name);
					$sidebar_data[] = array(
						'widget' => $option_name,
						'data' => $widget_data[$key]
					);
				}
			}
			
			$all_sidebars_data[$i] = $sidebar_data;
		}
	}

	ignore_user_abort( true );

	nocache_headers();
	header( 'Content-Type: application/json; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=apex-widgets-export-' . date( 'm-d-Y' ) . '.json' );
	header( "Expires: 0" );

	echo json_encode( $all_sidebars_data );
	exit;
}
}
add_action( 'admin_init', 'apex_process_widgets_export' );
