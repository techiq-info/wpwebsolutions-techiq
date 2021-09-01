<?php

/* --------------------------------------------------------- */
/* !Setup the global settings variables - 1.0.0 */
/* --------------------------------------------------------- */

function apex_initialize() {

	if( !is_admin() ) {
	
		global $apex_type, $apex_page_type, $apex_current_page_type, $apex_extra_sections, $apex_extra_sections_inner, $apex_general_settings, $apex_content_settings, $apex_all_section_settings;
		
		$apex_type = 'page';
		
		// Get all the settings
		$apex_general_settings = apex_general_settings();
		$apex_content_settings = apex_content_settings();
		
		// If this is a post
		$is_single = false;
		$apex_page_type = apex_page_type();

		if( is_singular() ) {
			$is_single = true;
			$id = get_the_id();
		} else {
			$id = $apex_page_type;
		}
		
		$apex_extra_sections = apex_get_extra_sections( $is_single, $id, 'extra_sections' );
		$apex_extra_sections_inner = apex_get_extra_sections( $is_single, $id, 'extra_sections_inner' );
		$apex_section_ids = apex_get_section_ids( $is_single, $id, $apex_extra_sections, $apex_extra_sections_inner );
		$apex_all_section_settings = get_apex_section_settings( $apex_section_ids );
	}
}
add_action( 'wp', 'apex_initialize' );


/* --------------------------------------------------------- */
/* !Get the extra content sections - 1.1.8 */
/* --------------------------------------------------------- */

if( !function_exists('apex_get_extra_sections') ) {
function apex_get_extra_sections( $is_single, $id, $field ) {

	global $apex_general_settings;

	$sections = array();
	
	if( $is_single ) {
		
		$extra_sections = 'default';
		$post_type = get_post_type( $id );
		
		if( $ps = apex_single_setting($id, $post_type) ) {
			$extra_sections = isset( $ps[$field] ) ? $ps[$field] : 'default';
		}	
		if( $extra_sections == 'default' ) {
			$extra_sections = apex_global_setting( $field, $post_type );
		}
	} else {
		$extra_sections = apex_global_setting( $field, $id );
	}
	
	// Get the outer extra section items
	if( $extra_sections != '' ) {
		$menu_items = wp_get_nav_menu_items( $extra_sections );
		if( is_array($menu_items) && count($menu_items) > 0 ) {

			foreach( $menu_items as $i=>$item ) {
				if( $item->object != 'custom' && $item->hide_section != true ) {
					if( $item->type == 'post_type' ) {
						if( get_post_status($item->object_id) == 'publish' || current_user_can('read_private_posts') ) {
							$sections[] = $item;
						}
					} else {
						$sections[] = $item;
					}
				}
			}
			
			return $sections;
		}
	}	
}
}


/* --------------------------------------------------------- */
/* !Get all the section ids - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_get_section_ids') ) {
function apex_get_section_ids( $is_single, $id, $sections=false, $sections_inner=false ) {
	
	$section_ids = array( $id );
	
	if( is_array($sections) && count($sections) > 0 ) {
		foreach( $sections as $i=>$section ) {
			$section_ids[] = $section->object_id;
		}
	}
	
	if( is_array($sections_inner) && count($sections_inner) > 0 ) {
		foreach( $sections_inner as $i=>$section ) {
			$section_ids[] = $section->object_id;
		}
	}
	
	return $section_ids;
}
}



/* --------------------------------------------------------- */
/* !Setup a single apex section settings */
/* --------------------------------------------------------- */

if( !function_exists('apex_section_settings') ) {
function apex_section_settings( $init=false ) {

	global $apex_section_settings;
	
	if( $init || empty($apex_section_settings) ) {
	
		global $apex_current_page_type, $apex_all_section_settings;
		
		$apex_current_page_type = apex_page_type();

		switch( $apex_current_page_type ) {
			case 'blog':
			case 'archive':
			case 'taxonomy':
			case 'search':
			case 'error':
				$apex_section_settings = $apex_all_section_settings[$apex_current_page_type];
				break;
				
			default:
				$apex_section_settings = $apex_all_section_settings[$apex_current_page_type.'-'.get_the_id()];
				break;
		}
	}

	return $apex_section_settings;
}
}


/* --------------------------------------------------------- */
/* !Generate the section settings - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('get_apex_section_settings') ) {
function get_apex_section_settings( $section_ids ) {

	global $apex_general_settings, $apex_content_settings;
	
	$global_setting_sections = $apex_general_settings['global_setting_sections'];
	$single_setting_sections = $apex_general_settings['single_setting_sections'];
	$items = apex_content_settings_items();	
	$data = array();
	
	// Loop through the pages and setup the blocks
	if( is_array($section_ids) && count($section_ids) > 0 ) {
		foreach( $section_ids as $i=>$post_id ) {
		
			$posttype = get_post_type($post_id);
			$defaults = array();	
			
			if( is_array($items) && count($items) > 0 ) {
				foreach( $items as $item=>$default ) {
					if( isset($global_setting_sections[$posttype]) || isset($global_setting_sections[$post_id]) ) {
						$defaults[$item] = ($posttype != '' ) ? $apex_content_settings[$posttype.'_'.$item] : $apex_content_settings[$post_id.'_'.$item];
					} else {
						$defaults[$item] = $apex_content_settings['default_'.$item];
					}
				}
			}
			
			if( $posttype != '' ) {
				if( isset($single_setting_sections[$posttype]) ) {
					$settings = wp_parse_args( apex_section_element_settings($post_id), $defaults );
					$data[$posttype.'-'.$post_id] = $settings;
				} else {
					$data[$posttype.'-'.$post_id] = $defaults;
				}
			} else {
				$data[$post_id] = $defaults;
			}
		}
	}
	
	return $data;
}
}



/* --------------------------------------------------------- */
/* !Get the page settings - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_section_element_settings') ) {
function apex_section_element_settings( $post_id ) {

	$ps = get_post_meta( $post_id, '_apex_page_settings', true );

	$settings = array();
	$items = apex_content_settings_items();
	
	$settings['title'] = get_the_title( $post_id );
	if( is_array($items) && count($items) > 0 ) {
		foreach( $items as $item=>$default ) {
			if( $item =='animate_header' || $item=='animate_content' ) {
				if( isset($ps[$item]) && $ps[$item]['animation'] != '' && $ps[$item]['animation'] != 'default' ) {
					$settings[$item] = $ps[$item];
				}
			} elseif( $item =='content_bg' || $item=='header_bg' || $item=='hero_bg' ) {
				if( isset($ps[$item]) && $ps[$item]['default'] != 'default' ) {
					$settings[$item] = $ps[$item];
				}
			} else {
				if( isset($ps[$item]) && $ps[$item] != '' && $ps[$item] != 'default' ) {
					$settings[$item] = $ps[$item];
				}
			}
		}
	}

	return $settings;
}
}

