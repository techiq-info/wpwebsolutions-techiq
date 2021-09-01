<?php

/* --------------------------------------------------------- */
/* !Return the post type in the admin - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_admin_post_type') ) {
function apex_admin_post_type() {

	if( isset($_GET['post']) ) {
		return get_post_type($_GET['post']);
	} elseif( isset($_GET['post_type']) ) {
		return $_GET['post_type'];
	} elseif( isset($_POST['post_type']) ) {
		return $_POST['post_type'];
	}
  return null;
}
}



/* --------------------------------------------------------- */
/* !Check for a specific page template in the admin - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_is_page_template') ) {
function apex_is_page_template( $template ) {

	if( isset($_GET['post']) ) {
		$post_id = $_GET['post'];
	} elseif( isset($_POST['post_ID']) ) {
		$post_id = $_POST['post_ID'];
	} else {
		return false;
	}

	$template_file = get_post_meta( $post_id, '_wp_page_template', true );
  if ( $template_file == $template ) {
    return true;
  }
  return false;
}
}



/* --------------------------------------------------------- */
/* !Return an image select selected - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_img_selected') ) {
function apex_img_selected( $val1, $val2, $echo=true ) {

	if( $val1 == $val2 ) {
		$output = ' class="active"';
		if( $echo ) {
			echo $output;
		} else {
			return $output;
		}
	}
}
}



/* --------------------------------------------------------- */
/* !Import widgets from file - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_import_widgets') ) {
function apex_import_widgets() {
	
	if( is_admin() ) {
	
		// Get the import file
		$import_file = APEX_DIR.'/assets/sample-content/widgets.json';
		if( file_exists($import_file) ) {
	
			$json_data = file_get_contents( $import_file );
			$json_data = json_decode( $json_data, true );

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
								echo $count."<br/>";	
													
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
		}
	}
}
}
//add_action( 'admin_init', 'apex_import_widgets' );



/* --------------------------------------------------------- */
/* !Remove all existing widgets - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_remove_widgets') ) {
function apex_remove_widgets() {

	if( is_admin() ) {
		
		// Clear the sidebars
		$widgets = get_option('sidebars_widgets');
		$empty_sidebars = array();
		foreach( $widgets as $i=>$widget ) {
			$empty_sidebars[$i] = array();
		}
		update_option('sidebars_widgets', $empty_sidebars);
		
		// Reset all widget instances
		global $wp_registered_widgets;
		foreach( $wp_registered_widgets as $i=>$widget ) {
			$widget_name = trim( substr($i, 0, strrpos($i, '-')) );
			if( $widget = get_option('widget_'.$widget_name) ) {
				delete_option('widget_'.$widget_name);
			}
		}
	}
}
}
//add_action( 'admin_init', 'apex_remove_widgets' );