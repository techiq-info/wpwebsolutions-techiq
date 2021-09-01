<?php

/* --------------------------------------------------------- */
/* !Return a re-formatted id - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_id') ) {
function apex_settings_id( $id ) {
	
	$id = preg_replace( '%\[%', '_', $id );
	$id = preg_replace( '%\]\[%', '_', $id );
	$id = preg_replace( '%\]%', '', $id );
	
	return $id;
}
}


/* --------------------------------------------------------- */
/* !Number - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_number') ) {
function apex_settings_number( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$width = isset($args['width']) ? intval($args['width']) : '80';
		$before = isset($args['before']) ? $args['before'].' ' : '';
		$after = isset($args['after']) ? ' '.$args['after'] : '';
		
		echo '<div id="'.$id.'">';
			echo '<label>'.$before.'<input type="number" name="'.$name.'" value="'.$value.'" style="width:'.$width.'px" />'.$after.'</label>';
		echo '</div>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Select - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_select') ) {
function apex_settings_select( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$options = isset($args['options']) ? $args['options'] : '';
		
		echo '<div id="'.$id.'">';
			echo '<select name="'.$name.'">';
				if( is_array($options) && count($options) > 0 ) {
					foreach( $options as $i=>$option ) {
						echo '<option value="'.$i.'" '.selected($i, $value, false).'>'.$option.'</option>';
					}
				}
			echo '</select>';
		echo '</div>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Title or tag - 1.0.10 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_title_tag') ) {
function apex_settings_title_tag( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$text_name = isset($args['text_name']) ? $args['text_name'] : '';
		$text_value = isset($args['text_value']) ? $args['text_value'] : '';
		$default = isset($args['default']) ? true : false;
		
		echo '<div id="'.$id.'">';
			if( $text_name != '' ) {
				echo '<input type="text" name="'.$text_name.'" value="'.htmlentities($text_value).'" size="40" style="margin-right:10px;" />';
			}
			echo '<select name="'.$name.'">';
				if( $default ) {
					echo '<option value="default" '.selected('default', $value, false).'>'.__('Default display', 'apex').'</option>';
				}
				echo '<option value="show" '.selected('show', $value, false).'>'.__('Show', 'apex').'</option>';
				echo '<option value="hide" '.selected('hide', $value, false).'>'.__('Hide', 'apex').'</option>';
			echo '</select>';
		echo '</div>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Post order selects - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_post_order') ) {
function apex_settings_post_order( $args=array() ) {

	if( isset($args['name']) && isset($args['order_name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$order_name = $args['order_name'];
		$order_value = isset($args['order_value']) ? $args['order_value'] : '';
		
		echo '<div id="'.$id.'">';
			echo '<select name="'.$name.'">';
				echo '<option value="ID" '.selected('ID', $value, false).'>'.__('ID', 'apex').'</option>';
				echo '<option value="author" '.selected('author', $value, false).'>'.__('Author', 'apex').'</option>';
				echo '<option value="title" '.selected('title', $value, false).'>'.__('Title', 'apex').'</option>';
				echo '<option value="name" '.selected('name', $value, false).'>'.__('Name', 'apex').'</option>';
				echo '<option value="date" '.selected('date', $value, false).'>'.__('Date', 'apex').'</option>';
				echo '<option value="modified" '.selected('modified', $value, false).'>'.__('Modified', 'apex').'</option>';
				echo '<option value="parent" '.selected('parent', $value, false).'>'.__('Parent', 'apex').'</option>';
				echo '<option value="rand" '.selected('rand', $value, false).'>'.__('Random', 'apex').'</option>';
				echo '<option value="comment_count" '.selected('comment_count', $value, false).'>'.__('Comment Count', 'apex').'</option>';
				echo '<option value="menu_order" '.selected('menu_order', $value, false).'>'.__('Menu Order', 'apex').'</option>';
			echo '</select>';
			echo '<select name="'.$order_name.'">';
				echo '<option value="ASC" '.selected('ASC', $order_value, false).'>'.__('Ascending', 'apex').'</option>';
				echo '<option value="DESC" '.selected('DESC', $order_value, false).'>'.__('Descending', 'apex').'</option>';
			echo '</select>';
		echo '</div>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Textarea - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_textarea') ) {
function apex_settings_textarea( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$cols = isset($args['cols']) ? $args['cols'] : 60;
		$rows = isset($args['rows']) ? $args['rows'] : 4;
		
		echo '<div id="'.$id.'">';
			echo '<textarea name="'.$name.'" cols="'.$cols.'" rows="'.$rows.'">'.$value.'</textarea>';
		echo '</div>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Text - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_text') ) {
function apex_settings_text( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$width = isset($args['width']) ? ' style="width:'.$args['width'].';"' : '';
		$before = isset($args['before']) ? $args['before'].' ' : '';
		$after = isset($args['after']) ? ' '.$args['after'] : '';
		
		echo '<div id="'.$id.'">';
			echo '<label>'.$before.'<input type="text" name="'.$name.'" value="'.$value.'"'.$width.' />'.$after.'</label>';
		echo '</div>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Icon - 1.0.7 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_icon') ) {
function apex_settings_icon( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		
		echo '<div id="'.$id.'">';
			echo '<a class="apex-page-icon mtphr-shortcodes-modal-link" href="#apex-page-icons-modal"><i class="'.$value.'"></i></a>';
			echo '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
		echo '</div>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Codemirror - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_codemirror') ) {
function apex_settings_codemirror( $args=array() ) {

	if( isset($args['name']) && isset($args['modes']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$cols = isset($args['cols']) ? $args['cols'] : 60;
		$rows = isset($args['rows']) ? $args['rows'] : 4;		
		$modes = isset($args['modes']) ? $args['modes'] : '';
		
		$mode_classes = 'apex-codemirror';
		if( is_array($modes) && count($modes) > 0 ) {
			foreach( $modes as $i=>$mode ) {
				$mode_classes .= ' apex-codemirror-'.$mode;
			}
		}
		
		echo '<div id="'.$id.'">';
			echo '<div class="'.$mode_classes.'">';
				echo '<textarea name="'.$name.'" cols="'.$cols.'" rows="'.$rows.'">'.$value.'</textarea>';
			echo '</div>';		
		echo '</div>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Checkbox - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_checkbox') ) {
function apex_settings_checkbox( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$label = isset($args['label']) ? $args['label'] : '';
		
		echo '<div id="'.$id.'">';
			echo '<label><input type="checkbox" name="'.$name.'" value="on" '.checked('on', $value, false).' /> '.$label.'</label>';
		echo '</div>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Radio buttons - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_radio_buttons') ) {
function apex_settings_radio_buttons( $args=array() ) {

	if( isset($args['name']) && isset($args['options']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$options = isset($args['options']) ? $args['options'] : '';
		
		echo '<div id="'.$id.'">';
			if( is_array($options) && count($options) > 0 ) {
				foreach( $options as $i=>$option ) {
					echo '<label style="margin-right:20px;"><input type="radio" name="'.$name.'" value="'.$i.'" '.checked($i, $value, false).' /> '.$option.'</label>';
				}
			}
		echo '</div>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Menu select - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_menu_select') ) {
function apex_settings_menu_select( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$default = isset($args['default']) ? true : false;
		
		$menus = get_terms( 'nav_menu' );
		echo '<select name="'.$name.'">';
			if( $default ) {
				echo '<option value="default" '.selected( 'default', $value, false ).'>'.__('Use default', 'apex').'</option>';
			}
			echo '<option value="none" '.selected( 'none', $value, false ).'>'.__('None', 'apex').'</option>';
			if( is_array($menus) && count($menus) > 0 ) {
				foreach( $menus as $i=>$menu ) {
					echo '<option value="'.$menu->slug.'" '.selected( $menu->slug, $value, false ).'>'.$menu->name.'</option>';
				}
			}
		echo '</select>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Extra sections select - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_extra_sections_select') ) {
function apex_settings_extra_sections_select( $args=array() ) {

	if( isset($args['name']) && isset($args['location_name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$default = isset($args['default']) ? true : false;
		
		$location_name = isset($args['location_name']) ? $args['location_name'] : '';
		$location_value = isset($args['location_value']) ? $args['location_value'] : '';

		$menus = get_terms( 'nav_menu' );
		echo '<table id="'.$id.'" class="apex-extra-content-settings">';
			echo '<tr>';
				echo '<td>';
				
					echo '<select name="'.$name.'">';
						if( $default ) {
							echo '<option value="default" '.selected( 'default', $value, false ).'>'.__('Use default', 'apex').'</option>';
						}
						echo '<option value="none" '.selected( 'none', $value, false ).'>'.__('None', 'apex').'</option>';
						if( is_array($menus) && count($menus) > 0 ) {
							foreach( $menus as $i=>$menu ) {
								echo '<option value="'.$menu->slug.'" '.selected( $menu->slug, $value, false ).'>'.$menu->name.'</option>';
							}
						}
					echo '</select>';
					
				echo '</td>';
				echo '<td>';
					
					if( $default ) {
						echo '<label><input type="radio" name="'.$location_name.'" value="default" '.checked('default', $location_value, false).' /> '.__('Use default setting', 'apex').'</label>';
					}
					echo '<label><input type="radio" name="'.$location_name.'" value="below" '.checked('below', $location_value, false).' /> '.__('Below', 'apex').'</label>';
					echo '<label><input type="radio" name="'.$location_name.'" value="inside" '.checked('inside', $location_value, false).' /> '.__('Inside', 'apex').'</label>';
		
				echo '</td>';
			echo '</tr>';
		echo '</table>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Widget area select - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_widget_area_select') ) {
function apex_settings_widget_area_select( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$default = isset($args['default']) ? true : false;
		
		$sidebars = $GLOBALS['wp_registered_sidebars'];
		echo '<select name="'.$name.'">';
			if( $default ) {
				echo '<option value="default">'.__('Use default', 'apex').'</option>';
			}
			if( is_array($sidebars) && count($sidebars) > 0 ) {
				foreach( $sidebars as $slug=>$sidebar ) {
					echo '<option value="'.$slug.'" '.selected( $slug, $value, false ).'>'.$sidebar['name'].'</option>';
				}
			}
		echo '</select>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Single image - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_image') ) {
function apex_settings_image( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		
		echo '<div id="'.$id.'">';
			echo '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
			if( $value != '' ) {
				apex_render_single_image( $value );
				echo '<a href="#" class="button apex-single-image-upload" style="display:none;">'.__('Add Image', 'apex').'</a>';
			} else {
				echo '<a href="#" class="button apex-single-image-upload">'.__('Add Image', 'apex').'</a>';
			}
		echo '</div>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Render a single image - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_render_single_image') ) {
function apex_render_single_image( $id, $title = true ) {

	$img = get_post( $id );
	echo '<span class="apex-single-image">';
		echo wp_get_attachment_image( $id, array( 300, 80 ) );
		if( $title ) {
			echo '<span class="apex-single-image-title">'.$img->post_title.'</span>';
		}
		echo '<a href="#" class="apex-delete"><i class="apex-icon-minus-filled"></i></a>';
	echo '</span>';

}
}


/* --------------------------------------------------------- */
/* !Background image - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_background_image') ) {
function apex_settings_background_image( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$pattern_name = isset($args['pattern_name']) ? $args['pattern_name'] : '';
		$pattern_value = isset($args['pattern_value']) ? $args['pattern_value'] : '';
		$default = isset($args['default']) ? true : false;
		
		echo '<div id="'.$id.'">';
			echo '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
			if( $value != '' ) {
				apex_render_single_image( $value );
				echo '<a href="#" class="button apex-single-image-upload" style="display:none;">'.__('Add Image', 'apex').'</a>';
			} else {
				echo '<a href="#" class="button apex-single-image-upload">'.__('Add Image', 'apex').'</a>';
			}
			echo '<select style="margin-left:10px;" name="'.$pattern_name.'">';
				if( $default ) {
					echo '<option value="default" '.selected('default', $pattern_value, false).'>'.__('Default image display', 'apex').'</option>';
				}
				echo '<option value="full-width" '.selected('full-width', $pattern_value, false).'>'.__('Display full width', 'apex').'</option>';
				echo '<option value="pattern" '.selected('pattern', $pattern_value, false).'>'.__('Display as pattern', 'apex').'</option>';
			echo '</select>';
		echo '</div>';

	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Parallax - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_parallax') ) {
function apex_settings_parallax( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$default = isset($args['default']) ? true : false;
		if( $default ) {
			$value = (isset($args['value']) && $args['value'] != '') ? $args['value'] : '';
		} else {
			$value = (isset($args['value']) && $args['value'] != '') ? $args['value'] : 6;
		}
		$default_checked = ($value != '') ? 'checked="checked"' : '';
		
		echo '<table id="'.$id.'">';
			echo '<tr>';
				echo '<td class="apex-ui-slider-label-td">';
					if( $default ) {
						echo '<label><input type="checkbox" name="'.$name.'" value="'.$value.'" '.$default_checked.' />'.__('Override default opacity', 'apex').'</label>';
					} else {
						echo '<label>'.__('Parallax amount', 'apex').'</label>';
						echo '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
					}
				echo '</td>';
				echo '<td class="apex-ui-slider-td">';
					echo '<div class="apex-parallax-slider"></div>';
				echo '</td>';
				echo '<td class="apex-ui-slider-value-td">';
					echo '<span>'.$value.'</span>';
				echo '</td>';
			echo '</tr>';
		echo '</table>';
		
	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Color picker & opacity - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_minicolors') ) {
function apex_settings_minicolors( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		
		$opacity_name = isset($args['opacity_name']) ? $args['opacity_name'] : '';
		$default = isset($args['default']) ? true : false;
		if( $default ) {
			$opacity_value = (isset($args['opacity_value']) && $args['opacity_value'] != '' ) ? $args['opacity_value'] : '';
		} else {
			$opacity_value = (isset($args['opacity_value']) && $args['opacity_value'] != '' ) ? $args['opacity_value'] : 100;
		}
		$default_checked = ($opacity_value != '') ? 'checked="checked"' : '';
		
		echo '<table id="'.$id.'" class="apex-minicolors-table">';
			echo '<tr>';
				echo '<td class="apex-minicolors-td">';
					echo '<div class="apex-minicolors">';
						echo '<input type="text" size="24" name="'.$name.'" value="'.$value.'" />';
					echo '</div>';
				echo '</td>';
				if( $opacity_name != '' ) {
					echo '<td class="apex-ui-slider-label-td">';
						if( $default ) {
							echo '<label><input type="checkbox" name="'.$opacity_name.'" value="'.$opacity_value.'" '.$default_checked.' />'.__('Override default opacity', 'apex').'</label>';
						} else {
							echo '<label>'.__('Opacity', 'apex').'</label>';
							echo '<input type="hidden" name="'.$opacity_name.'" value="'.$opacity_value.'" />';
						}
					echo '</td>';
					echo '<td class="apex-ui-slider-td">';
						echo '<div class="apex-opacity-slider"></div>';
					echo '</td>';
					echo '<td class="apex-ui-slider-value-td">';
						echo '<span>'.$opacity_value.'%</span>';
					echo '</td>';
				}
			echo '</tr>';
		echo '</table>';
		
	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Text color picker grid - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_text_colors') ) {
function apex_settings_text_colors( $args=array() ) {

	if( isset($args['name']) || isset($args['highlight_name']) || isset($args['highlight_offset_name']) ) {
		
		$name = isset($args['name']) ? $args['name'] : '';
		$value = isset($args['value']) ? $args['value'] : '';
		
		$highlight_name = isset($args['highlight_name']) ? $args['highlight_name'] : '';
		$highlight_value = isset($args['highlight_value']) ? $args['highlight_value'] : '';
		
		$highlight_offset_name = isset($args['highlight_offset_name']) ? $args['highlight_offset_name'] : '';
		$highlight_offset_value = isset($args['highlight_offset_value']) ? $args['highlight_offset_value'] : '';
		
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		
		echo '<table id="'.$id.'" class="apex-text-colors-table">';
			echo '<tr>';
				if( $name != '' ) {
					echo '<th><small>'.__('Text color', 'apex').'</small></th>';
				}
				if( $highlight_name != '' ) {
					echo '<th><small>'.__('Highlight color', 'apex').'</small></th>';
				}
				if( $highlight_offset_name != '' ) {
					echo '<th><small>'.__('Highlight offset color', 'apex').'</small></th>';
				}
			echo '</tr>';
			echo '<tr>';
				if( $name != '' ) {
					echo '<td class="apex-minicolors-td">';
						echo '<div class="apex-minicolors">';
							echo '<input type="text" size="24" name="'.$name.'" value="'.$value.'" />';
						echo '</div>';
					echo '</td>';
				}
				if( $highlight_name != '' ) {
					echo '<td class="apex-minicolors-td">';
						echo '<div class="apex-minicolors">';
							echo '<input type="text" size="24" name="'.$highlight_name.'" value="'.$highlight_value.'" />';
						echo '</div>';
					echo '</td>';
				}
				if( $highlight_offset_name != '' ) {
					echo '<td class="apex-minicolors-td">';
						echo '<div class="apex-minicolors">';
							echo '<input type="text" size="24" name="'.$highlight_offset_name.'" value="'.$highlight_offset_value.'" />';
						echo '</div>';
					echo '</td>';
				}
			echo '</tr>';
		echo '</table>';
		
	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !WOW Animations - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_wow_animations') ) {
function apex_settings_wow_animations( $args=array() ) {

	if( isset($args['name']) || isset($args['content_name']) || isset($args['sidebar_name']) ) {
		
		$name = isset($args['name']) ? $args['name'] : '';
		$value = isset($args['value']) ? $args['value'] : '';
		
		$content_name = isset($args['content_name']) ? $args['content_name'] : '';
		$content_value = isset($args['content_value']) ? $args['content_value'] : '';
		
		$default = isset($args['default']) ? true : false;
		
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		
		echo '<table id="'.$id.'" class="apex-wow-animations-table">';
			echo '<tr>';
				echo '<th class="apex-wow-animations-heading"><small>'.__('Element', 'apex').'</small></th>';
				echo '<th><small>'.__('Animation', 'apex').'</small></th>';
				echo '<th><small>'.__('Delay', 'apex').'</small></th>';
			echo '</tr>';
			
			if( $name != '' ) {
				$enabled = isset($value['enabled']) ? $value['enabled'] : '';
				$delay = isset($value['delay']) ? $value['delay'] : '';
				$animation = isset($value['animation']) ? $value['animation'] : '';
				echo '<tr>';
					echo '<th class="apex-wow-animations-heading">';
						echo __('Header', 'apex');
					echo '</th>';
					echo '<td>';
						echo apex_animate_select($name.'[animation]', $animation, $default);
					echo '</td>';
					echo '<td>';
						echo '<label><input type="text" size="3" name="'.$name.'[delay]" value="'.$delay.'" /> '.__('seconds', 'apex').'</label>';
					echo '</td>';
				echo '</tr>';
			}
			if( $content_name != '' ) {
				$enabled = isset($content_value['enabled']) ? $content_value['enabled'] : '';
				$delay = isset($content_value['delay']) ? $content_value['delay'] : '';
				$animation = isset($content_value['animation']) ? $content_value['animation'] : '';
				echo '<tr>';
					echo '<th class="apex-wow-animations-heading">';
						echo __('Content', 'apex');
					echo '</th>';
					echo '<td>';
						echo apex_animate_select($content_name.'[animation]', $animation, $default);
					echo '</td>';
					echo '<td>';
						echo '<label><input type="text" size="3" name="'.$content_name.'[delay]" value="'.$delay.'" /> '.__('seconds', 'apex').'</label>';
					echo '</td>';
				echo '</tr>';
			}
			
		echo '</table>';
		
	} else {
		echo __('Missing required data', 'apex');
	}
}
}

if( !function_exists('apex_animate_select') ) {
function apex_animate_select( $name, $value, $default=false ) {

	$options = array(
		'Attention Seekers' => array(
			'bounce',
			'flash',
			'pulse',
			'rubberBand',
			'shake',
			'swing',
			'tada',
			'wobble'
		),
		'Bouncing Entrances' => array(
			'bounceIn',
			'bounceInDown',
			'bounceInLeft',
			'bounceInRight',
			'bounceInUp'
		),	
		'Bouncing Exits' => array(
			'bounceOut',
			'bounceOutDown',
			'bounceOutLeft',
			'bounceOutRight',
			'bounceOutUp'
		),	
		'Fading Entrances' => array(
			'fadeIn',
			'fadeInDown',
			'fadeInDownBig',
			'fadeInLeft',
			'fadeInLeftBig',
			'fadeInRight',
			'fadeInRightBig',
			'fadeInUp',
			'fadeInUpBig'
		),
		'Fading Exits' => array(
			'fadeOut',
			'fadeOutDown',
			'fadeOutDownBig',
			'fadeOutLeft',
			'fadeOutLeftBig',
			'fadeOutRight',
			'fadeOutRightBig',
			'fadeOutUp',
			'fadeOutUpBig'
		),
		'Flippers' => array(
			'flip',
			'flipInX',
			'flipInY',
			'flipOutX',
			'flipOutY'
		),	
		'Lightspeed' => array(
			'lightSpeedIn',
			'lightSpeedOut'
		),
		'Rotating Entrances' => array(
			'rotateIn',
			'rotateInDownLeft',
			'rotateInDownRight',
			'rotateInUpLeft',
			'rotateInUpRight'
		),
		'Rotating Exits' => array(
			'rotateOut',
			'rotateOutDownLeft',
			'rotateOutDownRight',
			'rotateOutUpLeft',
			'rotateOutUpRight'
		),	
		'Specials' => array(
			'hinge',
			'rollIn',
			'rollOut'
		),
		'Zoom Entrances' => array(
			'zoomIn',
			'zoomInDown',
			'zoomInLeft',
			'zoomInRight',
			'zoomInUp'
		),
		'Zoom Exits' => array(
			'zoomOut',
			'zoomOutDown',
			'zoomOutLeft',
			'zoomOutRight',
			'zoomOutUp'
		)
	);
	
	$html = '';
	$html .= '<select name="'.$name.'">';
		if( $default ) {
			$html .= '<option value="" '.selected('', $value, false).'>'.__('Use Default Value', 'apex').'</option>';
		}
		$html .= '<option value="none" '.selected('none', $value, false).'>'.__('None', 'apex').'</option>';
		if( is_array($options) && count($options) > 0 ) {
			foreach( $options as $label=>$group ) {
				$html .= '<optgroup label="'.$label.'">';
					if( is_array($group) && count($group) > 0 ) {
						foreach( $group as $i=>$option ) {
							$html .= '<option value="'.$option.'" '.selected($option, $value, false).'>'.$option.'</option>';
						}
					}
				$html .= '</optgroup>';
			}
		}
	$html .= '</select>';
	
	return $html;
}
}


/* --------------------------------------------------------- */
/* !Background options - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_background_options') ) {
function apex_settings_background_options( $args=array() ) {

	if( isset($args['color']) || isset($args['image']) || isset($args['parallax']) || isset($args['overlay']) ) {
		
		$display = 'block';
		
		if( isset($args['default']) && is_array($args['default']) ) {
			
			if( $args['default']['value'] == 'default' ) {
				$display = 'none';
			}
		
			$args['default']['options'] = array(
				'default' => __('Use default settings', 'apex'),
				'override' => __('Override default settings', 'apex')
			);
			apex_settings_radio_buttons( $args['default'] );
		}
		
		echo '<table class="apex-bg-options" style="display:'.$display.';">';

			if( isset($args['color']) && is_array($args['color']) ) {
				echo '<tr>';
					echo '<th><small>'.__('Background color', 'apex').'</small></th>';
				echo '</tr>';
				echo '<tr>';
					echo '<td style="padding-bottom:10px;">';
						apex_settings_minicolors( $args['color'] );
					echo '</td>';
				echo '</tr>';
			}
			
			if( isset($args['image']) && is_array($args['image']) ) {
				echo '<tr>';
					echo '<th><small>'.__('Background image', 'apex').'</small></th>';
				echo '</tr>';
				echo '<tr>';
					echo '<td style="padding-bottom:10px;">';
						apex_settings_background_image( $args['image'] );
					echo '</td>';
				echo '</tr>';
			}
			
			if( isset($args['parallax']) && is_array($args['parallax']) ) {
				echo '<tr>';
					echo '<th><small>'.__('Background image parallax', 'apex').'</small></th>';
				echo '</tr>';
				echo '<tr>';
					echo '<td style="padding-bottom:10px;">';
						apex_settings_parallax( $args['parallax'] );
					echo '</td>';
				echo '</tr>';
			}
			
			if( isset($args['overlay']) && is_array($args['overlay']) ) {
				echo '<tr>';
					echo '<th><small>'.__('Background overlay', 'apex').'</small></th>';
				echo '</tr>';
				echo '<tr>';
					echo '<td>';
						apex_settings_pattern_select( $args['overlay'] );
					echo '</td>';
				echo '</tr>';
			}
			
		echo '</table>';
		
	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Layout - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_layout') ) {
function apex_settings_layout( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$default = isset($args['default']) ? true : false;
		
		echo '<div id="'.$id.'">';
			echo '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
			echo '<div class="apex-image-select clearfix">';
				if( $default ) {
					echo '<a '.apex_img_selected('default', $value, false).' href="#default"><img src="'.APEX_URL.'/assets/images/admin/default.png" /><small>'.__('Use default', 'apex').'</small></a>';
				}
				echo '<a '.apex_img_selected('full-width', $value, false).' href="#full-width"><img src="'.APEX_URL.'/assets/images/admin/full-width.png" /><small>'.__('Full width', 'apex').'</small></a>';
				echo '<a '.apex_img_selected('sidebar-right', $value, false).' href="#sidebar-right"><img src="'.APEX_URL.'/assets/images/admin/sidebar-right.png" /><small>'.__('Sidebar right', 'apex').'</small></a>';
				echo '<a '.apex_img_selected('sidebar-left', $value, false).' href="#sidebar-left"><img src="'.APEX_URL.'/assets/images/admin/sidebar-left.png" /><small>'.__('Sidebar left', 'apex').'</small></a>';
			echo '</div>';
		echo '</div>';
		
	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Sidebar - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_sidebar') ) {
function apex_settings_sidebar( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$pull_name = isset($args['pull_name']) ? $args['pull_name'] : '';
		$pull_value = isset($args['pull_value']) ? $args['pull_value'] : '';
		$default = isset($args['default']) ? true : false;
		
		echo '<div id="'.$id.'">';
			echo '<select name="'.$name.'">';
				if( $default ) {
					echo '<option value="default" '.selected('default', $value, false).'>'.__('Use default width', 'apex').'</option>';
				}
				echo '<option value="s1" '.selected('s1', $value, false ).'>'.__('Span 1', 'apex').'</option>';
				echo '<option value="s2" '.selected('s2', $value, false ).'>'.__('Span 2', 'apex').'</option>';
				echo '<option value="s3" '.selected('s3', $value, false ).'>'.__('Span 3', 'apex').'</option>';
				echo '<option value="s4" '.selected('s4', $value, false ).'>'.__('Span 4', 'apex').'</option>';
				echo '<option value="s5" '.selected('s5', $value, false ).'>'.__('Span 5', 'apex').'</option>';
				echo '<option value="s6" '.selected('s6', $value, false ).'>'.__('Span 6', 'apex').'</option>';
			echo '</select>';
			echo '<select name="'.$pull_name.'">';
				if( $default ) {
					echo '<option value="default" '.selected('default', $pull_value, false).'>'.__('Use default mobile positioning', 'apex').'</option>';
				}
				echo '<option value="no" '.selected('no', $pull_value, false).'>'.__('Do not reposition sidebar on mobile', 'apex').'</option>';
				echo '<option value="below" '.selected('below', $pull_value, false).'>'.__('Force sidebar below content on mobile', 'apex').'</option>';
				echo '<option value="above" '.selected('above', $pull_value, false).'>'.__('Force sidebar above content on mobile', 'apex').'</option>';
			echo '</select>';
		echo '</div>';
		
	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Overlay pattern - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_pattern_select') ) {
function apex_settings_pattern_select( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$default = isset($args['default']) ? true : false;
		
		$opacity_name = isset($args['opacity_name']) ? $args['opacity_name'] : '';
		$opacity_default = isset($args['opacity_default']) ? true : false;
		if( $opacity_default ) {
			$opacity_value = (isset($args['opacity_value']) && $args['opacity_value'] != '' ) ? $args['opacity_value'] : '';
		} else {
			$opacity_value = (isset($args['opacity_value']) && $args['opacity_value'] != '' ) ? $args['opacity_value'] : 100;
		}
		$default_checked = ($opacity_value != '') ? 'checked="checked"' : '';
		
		echo '<div id="'.$id.'">';
			echo '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
			echo '<div class="apex-image-select apex-pattern-select clearfix">';
				if( $default ) {
					echo '<a '.apex_img_selected('default', $value, false).' href="#default"><span style="background-color:#f5f5f5;font-family:Arial Black, Arial, sans-serif;font-size:15px;font-weight:bold;color:#d54e21;">X</span></a>';
				}
				echo '<a '.apex_img_selected('none', $value, false).' href="#none"><span style="background-color:#f5f5f5;"></span></a>';
				$overlays = array(
					APEX_URL.'/assets/images/overlays/01.png',
					APEX_URL.'/assets/images/overlays/02.png',
					APEX_URL.'/assets/images/overlays/03.png',
					APEX_URL.'/assets/images/overlays/04.png',
					APEX_URL.'/assets/images/overlays/05.png',
					APEX_URL.'/assets/images/overlays/06.png',
					APEX_URL.'/assets/images/overlays/07.png',
					APEX_URL.'/assets/images/overlays/08.png',
					APEX_URL.'/assets/images/overlays/09.png',
					APEX_URL.'/assets/images/overlays/10.png',
					APEX_URL.'/assets/images/overlays/11.png',
					APEX_URL.'/assets/images/overlays/12.png',
					APEX_URL.'/assets/images/overlays/13.png',
					APEX_URL.'/assets/images/overlays/14.png',
					APEX_URL.'/assets/images/overlays/15.png',
					APEX_URL.'/assets/images/overlays/16.png',
					APEX_URL.'/assets/images/overlays/17.png',
					APEX_URL.'/assets/images/overlays/18.png',
					APEX_URL.'/assets/images/overlays/19.png',
					APEX_URL.'/assets/images/overlays/20.png',
					APEX_URL.'/assets/images/overlays/21.png',
					APEX_URL.'/assets/images/overlays/22.png',
					APEX_URL.'/assets/images/overlays/23.png',
					APEX_URL.'/assets/images/overlays/24.png',
					APEX_URL.'/assets/images/overlays/25.png',
					APEX_URL.'/assets/images/overlays/26.png',
					APEX_URL.'/assets/images/overlays/27.png',
					APEX_URL.'/assets/images/overlays/28.png',
					APEX_URL.'/assets/images/overlays/29.png',
					APEX_URL.'/assets/images/overlays/30.png'
				);
				foreach( $overlays as $overlay ) {
					echo '<a '.apex_img_selected($overlay, $value, false).' href="#'.$overlay.'"><span style="background-image:url('.$overlay.');"></span></a>';
				}
			echo '</div>';
			
			if( $opacity_name != '' ) {
				echo '<table>';
					echo '<tr>';
						echo '<td class="apex-ui-slider-label-td">';
							if( $opacity_default ) {
								echo '<label><input type="checkbox" name="'.$opacity_name.'" value="'.$opacity_value.'" '.$default_checked.' />'.__('Override default opacity', 'apex').'</label>';
							} else {
								echo '<label>'.__('Overlay opacity', 'apex').'</label>';
								echo '<input type="hidden" name="'.$opacity_name.'" value="'.$opacity_value.'" />';
							}
						echo '</td>';
						echo '<td class="apex-ui-slider-td">';
							echo '<div class="apex-opacity-slider"></div>';
						echo '</td>';
						echo '<td class="apex-ui-slider-value-td">';
							echo '<span>'.$opacity_value.'%</span>';
						echo '</td>';
					echo '</tr>';
				echo '</table>';
			}
		echo '</div>';
		
	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Hero rotators setup - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_hero_rotators') ) {
function apex_settings_hero_rotators( $args=array() ) {

	if( isset($args['name']) && isset($args['bg_name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$bg_name = isset($args['bg_name']) ? $args['bg_name'] : '';
		$bg_value = isset($args['bg_value']) ? $args['bg_value'] : '';
		$default = isset($args['default']) ? true : false;
		
		// Get all the rotating news tickers
		$tickers = false;
		$args = array(
			'posts_per_page' => -1,
			'orderby' => 'name',
			'order' => 'ASC',
			'post_type' => 'ditty_news_ticker'
		);

		echo '<table id="'.$id.'" class="apex-settings-hero-rotators">';
			echo '<tr>';
				echo '<th style="padding-right: 10px;"><small>'.__('Text rotator', 'apex').'</small></th>';
				echo '<th><small>'.__('Background rotator', 'apex').'</small></th>';
			echo '</tr>';
			echo '<tr>';
				echo '<td style="padding-right: 10px;">';
					$meta_query = array(
						array(
							'key' => '_mtphr_dnt_mode',
							'value' => 'rotate'
						),
						array(
							'key' => '_mtphr_dnt_type',
							'value' => 'default'
						)
					);
					$args['meta_query'] = $meta_query;
					$tickers = get_posts( $args );
					if( count($tickers) > 0 ) {
						echo '<select name="'.$name.'">';
							if( $default ) {
								echo '<option value="default" '.selected('default', $value, false).'>'.__('Use Default Setting', 'apex').'</option>';
							}
							echo '<option value="none" '.selected('none', $value, false).'>'.__('No Rotator', 'apex').'</option>';
							foreach( $tickers as $ticker ) {
								echo '<option value="'.$ticker->ID.'" '.selected($ticker->ID, $value, false).'>'.$ticker->post_title.'</option>';
							}	
						echo '</select>';
					} else {
						echo __('Please create a rotating default ticker', 'apex');
					}
				echo '</td>';
				echo '<td style="padding-right: 10px;">';
					$meta_query = array(
						array(
							'key' => '_mtphr_dnt_mode',
							'value' => 'rotate'
						),
						array(
							'key' => '_mtphr_dnt_type',
							'value' => 'image'
						)
					);
					$args['meta_query'] = $meta_query;
					$tickers = get_posts( $args );
					if( count($tickers) > 0 ) {
						echo '<select name="'.$bg_name.'">';
							if( $default ) {
								echo '<option value="default" '.selected('default', $bg_value, false).'>'.__('Use Default Setting', 'apex').'</option>';
							}
							echo '<option value="none" '.selected('none', $bg_value, false).'>'.__('No Rotator', 'apex').'</option>';
							foreach( $tickers as $ticker ) {
								echo '<option value="'.$ticker->ID.'" '.selected($ticker->ID, $bg_value, false).'>'.$ticker->post_title.'</option>';
							}	
						echo '</select>';
						
					} else {
						echo __('Please create a rotating image ticker', 'apex');
					}
				echo '</td>';
			echo '</tr>';
		echo '</table>';
		
	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Social links - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_social_links') ) {
function apex_settings_social_links( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$target_name = isset($args['target_name']) ? $args['target_name'] : '';
		$target_value = isset($args['target_value']) ? $args['target_value'] : '';
		
		echo '<div id="'.$id.'">';
			if( function_exists('metaphor_widgets_social_setup') ) {
				if( $target_name != '' ) {
					echo '<div class="metaphor-widgets-social-icon-container">';
						echo metaphor_widgets_social_target( $target_name, $target_value );
					echo '</div>';
				}
				echo metaphor_widgets_social_setup( $name, $value );
			} else {
				$url = site_url() .'/wp-admin/plugin-install.php?tab=plugin-information&plugin=mtphr-widgets&TB_iframe=true&width=640&height=500';
				printf(__('<a class="thickbox" href="%s"><strong>Metaphor Widgets</strong></a> must be installed & activated to setup Social Sites in the footer.','apex'), $url);
			}
		echo '</div>';
		
	} else {
		echo __('Missing required data', 'apex');
	}
}
}


/* --------------------------------------------------------- */
/* !Social links - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_list') ) {
function apex_settings_list( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$button = isset($args['button']) ? $args['button'] : '';
		$fields = isset($args['fields']) ? $args['fields'] : '';
		$label = isset($args['label']) ? $args['label'] : '';
		$placeholders = isset($args['placeholders']) ? $args['placeholders'] : '';
		
		echo '<div id="'.$id.'">';
		
			if( $button != '' ) {
				echo '<a class="apex-list-add-new button" href="#">'.$button.'</a>';
			}

			echo '<table class="apex-list">';
				echo '<tr>';
					echo '<th class="apex-list-handle"></th>';
					if( is_array($fields) && count($fields) > 0 ) {
						foreach( $fields as $i=>$field ) {
							echo '<th>'.$field.'</th>';
						}
					} elseif( $label != '' ) {
						echo '<th>'.$label.'</th>';
					}
					echo '<th class="apex-list-delete"></th>';
					echo '<th class="apex-list-add"></th>';
				echo '</tr>';
				
				$counter = 0;
				if( is_array($value) && count($value) > 0 ) {
					foreach( $value as $i=>$val ) {
						apex_render_list_item( $name, $fields, $value, $counter, $placeholders );
						$counter++;
					}
				} else {
					apex_render_list_item( $name, $fields, false, false, $placeholders );
				}
			echo '</table>';
			
		echo '</div>';
		
	} else {
		echo __('Missing required data', 'apex');
	}
}
}

if( !function_exists('apex_render_list_item') ) {
function apex_render_list_item( $name, $fields=false, $value=false, $pos=0, $placeholders=array() ) {
	
	echo '<tr class="apex-list-item">';
		echo '<td class="apex-list-handle"><a href="#"><i class="apex-icon-down-up-scale-1"></i></a></td>';
		
		if( is_array($fields) && count($fields) > 0 ) {
			$counter = 0;
			foreach( $fields as $i=>$field ) {
				echo '<td>';
					$val = isset($value[$pos][$i]) ? $value[$pos][$i] : '';
					$placeholder = isset($placeholders[$counter]) ? $placeholders[$counter] : '';
					echo '<input type="text" name="'.$name.'['.$pos.']['.$i.']" data-name="'.$name.'" data-key="'.$i.'" value="'.$val.'" />';
					$counter++;
				echo '</td>';
			}
		} else {
			$val = isset($value[$pos]) ? $value[$pos] : '';
			$placeholder = isset($placeholders[0]) ? $placeholders[0] : '';
			echo '<td>';
				echo '<input type="text" name="'.$name.'[]" value="'.$val.'" placeholder="'.$placeholder.'" />';
			echo '</td>';
		}

		echo '<td class="apex-list-delete"><a href="#"><i class="apex-icon-minus-filled"></i></a></td>';
		echo '<td class="apex-list-add"><a href="#"><i class="apex-icon-plus-filled"></i></a></td>';
	echo '</tr>';
	
}
}


/* --------------------------------------------------------- */
/* !Display content section checkboxes - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_content_sections' ) ) {
function apex_settings_content_sections( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$id = isset($args['id']) ? $args['id'] : apex_settings_id($name);
		$value = isset($args['value']) ? $args['value'] : '';
		$custom = isset($args['custom']) ? true : false;

		$post_types = get_apex_posttype_labels( false, $custom );
		
		// Add a hidden value to ensure proper saving
		echo '<input type="hidden" name="'.$name.'_visible" value="on" />';
	
		// Remove the default setting from the array, but add it as a hidden value
		if( isset($post_types['default']) ) {
			unset($post_types['default']);
			echo '<input type="hidden" name="'.$name.'[default]" value="on" />';
		}
		
		if( is_array($post_types) && count($post_types) > 0 ) {
			foreach( $post_types as $i=>$pt ) {
				if( isset($value[$i]) ) {
					echo '<label><input type="checkbox" name="'.$name.'['.$i.']" value="on" checked="checked" /> '.$pt['name'].'</label><br/>';
				} else {
					echo '<label><input type="checkbox" name="'.$name.'['.$i.']" value="on" /> '.$pt['name'].'</label><br/>';
				}
			}
		}
	
	} else {
		echo __('Missing required data', 'apex');
	}
}
}
