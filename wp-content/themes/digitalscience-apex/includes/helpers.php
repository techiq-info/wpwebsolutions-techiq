<?php


/* --------------------------------------------------------- */
/* !Return alll public post types & labels - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('get_apex_posttype_labels') ) {
function get_apex_posttype_labels( $args=array(), $custom=false ) {

	$defaults = array();
	$args = wp_parse_args( $args, $defaults );

	$pt_array = array();
	$post_types = get_post_types( $args, 'objects' );
	if( is_array($post_types) && count($post_types) > 0 ) {
		foreach( $post_types as $i=>$pt ) {
			$pt_array[$i] = array(
				'name' => $pt->labels->name,
				'singular_name' => $pt->labels->singular_name
			);
		}
	}
	
	// Remove the nav menu items & revisions
	unset($pt_array['nav_menu_item']);
	unset($pt_array['revisions']);
	
	// Add in the additional non-posttypes
	if( $custom ){
	
		$default = array(
			'name' => __('Default', 'apex'),
			'singular_name' => __('Default', 'apex')
		);
		
		$pt_array = array('default' => $default) + $pt_array;
		
		$pt_array['blog'] = array(
			'name' => __('Blog', 'apex'),
			'singular_name' => __('Blog', 'apex')
		);
		$pt_array['taxonomy'] = array(
			'name' => __('Taxonomies', 'apex'),
			'singular_name' => __('Taxonomies', 'apex')
		);
		$pt_array['archive'] = array(
			'name' => __('Archives', 'apex'),
			'singular_name' => __('Archive', 'apex')
		);
		$pt_array['search'] = array(
			'name' => __('Search', 'apex'),
			'singular_name' => __('Search', 'apex')
		);
		$pt_array['error'] = array(
			'name' => __('Error', 'apex'),
			'singular_name' => __('Error', 'apex')
		);
	}
	
	return  $pt_array;	
}
}


/* --------------------------------------------------------- */
/* !Return the current page type - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_page_type') )  {
function apex_page_type() {
	
	global $apex_type;
	
	$page_type = '';
	
	if( $apex_type == 'page' ) {	
		if( is_search() ) {
			$page_type = 'search';
		} elseif( is_404() ) {
			$page_type = 'error';
		} elseif( is_home() ) {
			$page_type = 'blog';
		} elseif( is_date() ) {
			$page_type = 'archive';
		} elseif( is_category() || is_tag() || is_tax() ) {
			$page_type = 'taxonomy';
		}
	}

	if( $page_type == '' && get_post() ) {
		$page_type = get_post_type();
	}

	return $page_type;
}
}


/* --------------------------------------------------------- */
/* !Get the global setting sections - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_global_setting_sections') ) {
function apex_global_setting_sections() {

	global $apex_general_settings;
	return $apex_general_settings['global_setting_sections'];	
}
}


/* --------------------------------------------------------- */
/* !Get the single setting sections - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_single_setting_sections') ) {
function apex_single_setting_sections() {

	global $apex_general_settings;
	return $apex_general_settings['single_setting_sections'];	
}
}


/* --------------------------------------------------------- */
/* !Get a global setting - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_global_setting') ) {
function apex_global_setting( $setting, $post_type=false ) {
	
	global $apex_current_page_type, $apex_content_settings;
	$post_type = $post_type ? $post_type : $apex_current_page_type;
	$global_setting_sections = apex_global_setting_sections();
	
	if( isset($global_setting_sections[$post_type]) ) {
		if( isset($apex_content_settings[$post_type.'_'.$setting]) ) {
			return $apex_content_settings[$post_type.'_'.$setting];
		}
	} else {
		if( isset($apex_content_settings['default_'.$setting]) ) {
			return $apex_content_settings['default_'.$setting];
		}
	}
}
}


/* --------------------------------------------------------- */
/* !Return the single settings */
/* --------------------------------------------------------- */

if( !function_exists('apex_single_setting') ) {
function apex_single_setting( $post_id=false, $post_type=false ) {

	global $apex_current_page_type;
	$post_type = $post_type ? $post_type : $apex_current_page_type;
	$single_setting_sections = apex_single_setting_sections();
	
	if( ($post_id || get_post()) && isset($single_setting_sections[$post_type]) ) {
		$post_id = $post_id ? $post_id : get_the_id();
		return get_post_meta( $post_id, '_apex_page_settings', true );	
	}
}
}


/* --------------------------------------------------------- */
/* !Convert hex to rgb - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_hex2rgb') ) {
function apex_hex2rgb( $hex ) {
   
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   
   return $rgb; // returns an array with the rgb values
}
}


/* --------------------------------------------------------- */
/* !Return the apex hero class - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_hero_class') ) {
function apex_hero_class( $class='' ) {

	// Separates classes with a single space, collates classes for ditty ticker element
	echo 'class="'.join( ' ', get_apex_hero_class($class) ).'"';
}
}

if( !function_exists('get_apex_hero_class') ) {
function get_apex_hero_class( $class='' ) {

	$classes = array();
	
	$classes[] = 'apex-hero';
	
	$settings = apex_section_settings();
	$classes[] = 'apex-style-'.$settings['hero_style'];

	if ( !empty( $class ) ) {
		if ( !is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	return apply_filters( 'apex_header_class', $classes, $class );
}
}


/* --------------------------------------------------------- */
/* !Return the apex header class - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_header_class') ) {
function apex_header_class( $class='' ) {

	// Separates classes with a single space, collates classes for ditty ticker element
	echo 'class="'.join( ' ', get_apex_header_class($class) ).'"';
}
}

if( !function_exists('get_apex_header_class') ) {
function get_apex_header_class( $class='' ) {

	$classes = array();

	$classes[] = 'apex-header';
	$classes[] = 'apex-section';
	
	$settings = apex_section_settings();
	$classes[] = 'apex-style-'.$settings['header_style'];

	if ( !empty( $class ) ) {
		if ( !is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	return apply_filters( 'apex_header_class', $classes, $class );
}
}


/* --------------------------------------------------------- */
/* !Return the apex section header class - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_section_header_class') ) {
function apex_section_header_class( $class='' ) {

	// Separates classes with a single space, collates classes for ditty ticker element
	echo 'class="'.join( ' ', get_apex_section_header_class($class) ).'"';
}
}

if( !function_exists('get_apex_section_header_class') ) {
function get_apex_section_header_class( $class='' ) {

	$classes = array();

	$classes[] = 'section-header';
	
	$settings = apex_section_settings();
	if( isset($settings['animate_header']['animation']) && $settings['animate_header']['animation'] != 'none' ) {
		$classes[] = 'wow';
		$classes[] = $settings['animate_header']['animation'];
	}

	if ( !empty( $class ) ) {
		if ( !is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	return apply_filters( 'apex_section_header_class', $classes, $class );
}
}


/* --------------------------------------------------------- */
/* !Return the apex section ID - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_section_id') ) {
function apex_section_id() {
	
	global $post, $apex_general_settings;	
	echo 'id="'.$apex_general_settings['section_id_prefix'].$post->post_type.'-'.$post->ID.'"';
}
}


/* --------------------------------------------------------- */
/* !Return the apex section class - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_section_class') ) {
function apex_section_class( $class='' ) {

	// Separates classes with a single space, collates classes for ditty ticker element
	echo 'class="'.join( ' ', get_apex_section_class($class) ).'"';
}
}

if( !function_exists('get_apex_section_class') ) {
function get_apex_section_class( $class='' ) {

	global $apex_current_page_type;

	$classes = array();

	$classes[] = 'apex-section';
	$classes[] = 'apex-section-'.$apex_current_page_type;
	
	$settings = apex_section_settings();
	$classes[] = 'apex-layout-'.$settings['layout'];
	$classes[] = 'apex-width-'.$settings['content_width'];
	$classes[] = 'apex-style-'.$settings['style'];
	
	$sidebar = ( $settings['sidebar_pull'] == 'no' ) ? 'default' : $settings['sidebar_pull'];
	$classes[] = 'apex-mobile-sidebar-'.$sidebar;
	
	if( is_page() && get_page_template() ) {
		$template = sanitize_html_class( str_replace('.', '-', basename(get_page_template())) );
		if( $template != 'page-php' ) {
			$classes[] = 'apex-template-'.$template;
		}
	}
	
	if( get_post_format() ) {
		$classes[] = 'apex-post-format-'.get_post_format();
	}

	if ( !empty( $class ) ) {
		if ( !is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	return apply_filters( 'apex_section_class', $classes, $class );
}
}


/* --------------------------------------------------------- */
/* !Return the apex article class - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_content_class') ) {
function apex_content_class( $class='' ) {

	// Separates classes with a single space, collates classes for ditty ticker element
	echo 'class="'.join( ' ', get_apex_content_class($class) ).'"';
}
}

if( !function_exists('get_apex_content_class') ) {
function get_apex_content_class( $class='' ) {

	global $apex_current_page_type;

	$classes = array();
	
	$settings = apex_section_settings();
	if( isset($settings['animate_content']['animation']) && $settings['animate_content']['animation'] != '' ) {
		$classes[] = 'wow';
		$classes[] = $settings['animate_content']['animation'];
	}

	if ( !empty( $class ) ) {
		if ( !is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	return apply_filters( 'apex_content_class', $classes, $class );
}
}


/* --------------------------------------------------------- */
/* !Return the parallax attribute - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_parallax_attribute') ) {
function apex_parallax_attribute( $area='content_bg' ) {

	$settings = apex_section_settings();
	$bg = isset( $settings[$area] ) ? $settings[$area] : array();
	$bg_image = isset( $bg['image'] ) ? $bg['image'] : '';
	$bg_parallax = isset( $bg['parallax'] ) ? $bg['parallax'] : '';

	if( $bg_image != '' ) {
		$parallax = ( $bg_parallax != '' ) ? 'data-mtphr-parallax-speed="'.$bg_parallax.'"' : '';
		echo $parallax;
	}
}
}


/* --------------------------------------------------------- */
/* !Return the wow attributes - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_wow_attributes') ) {
function apex_wow_attributes( $area='content', $echo=true ) {
	
	$attributes = array();
	
	$settings = apex_section_settings();
	if( isset($settings['animate_content']['delay']) && $settings['animate_content']['delay'] != '' ) {
		$attributes[] = 'data-wow-delay="'.$settings['animate_content']['delay'].'"';
	}
	
	if( count($attributes) > 0 ) {
		if( $echo ) {
			echo join( ' ', $attributes );
		} else {
			return join( ' ', $attributes );
		}
	}
}
}



/* --------------------------------------------------------- */
/* !Return the width of the primary content - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_primary_class') ) {
function apex_primary_class( $class='' ) {

	global $apex_general_settings;
	
	// Get the settings
	$settings = apex_section_settings();
	
	$classes = array();
	
	// Set the column class
	if( isset($settings['layout']) && $settings['layout'] == 'full-width' ) {
		$classes[] = 'col-sm-12';
		
		if( $settings['content_width'] == 'condensed' ) {
			$classes[] = 'col-md-10';
			$classes[] = 'col-md-offset-1';
		}
		
	} else {
		$sidebar = apex_sidebar_settings();
		
		$span = intval( $sidebar['span'] );
		$classes[] = 'col-sm-'.intval(12-$span);
		if( $sidebar['pull'] == 'below' && $settings['layout'] == 'sidebar-left' ) {
			$classes[] = 'col-sm-push-'.$span;
		}
		if( $sidebar['pull'] == 'above' && $settings['layout'] == 'sidebar-right' ) {
			$classes[] = 'col-sm-pull-'.$span;
		}
		
		if( $settings['content_width'] == 'condensed' ) {
			$classes[] = 'col-md-'.intval(10-($span-1));
			if( $settings['layout'] == 'sidebar-right' ) {
				$classes[] = 'col-md-offset-1';
			}
			if( $sidebar['pull'] == 'below' && $settings['layout'] == 'sidebar-left' ) {
				$classes[] = 'col-md-push-'.$span;
			}
			if( $sidebar['pull'] == 'above' && $settings['layout'] == 'sidebar-right' ) {
				$classes[] = 'col-md-pull-'.($span-1);
			}
		}
	}
	
	// Add additional classes
	if( !empty($class) ) {
		if( !is_array($class) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );
	return 'class="'.join( ' ', $classes ).'"';
}
}



/* --------------------------------------------------------- */
/* !Return the width of the sidebar - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_sidebar_class') ) {
function apex_sidebar_class( $class='' ) {

	global $apex_general_settings;

	// Get the settings
	$settings = apex_section_settings();
	
	$classes = array();

	$sidebar = apex_sidebar_settings();
	$span = intval( $sidebar['span'] );
	$classes[] = 'col-sm-'.$span;
	if( $sidebar['pull'] == 'below' && $settings['layout'] == 'sidebar-left' ) {
		$classes[] = 'col-sm-pull-'.intval(12-$span);
	}
	if( $sidebar['pull'] == 'above' && $settings['layout'] == 'sidebar-right' ) {
		$classes[] = 'col-sm-push-'.intval(12-$span);
	}
	
	if( $settings['content_width'] == 'condensed' ) {
		$span = $span-1;
		$classes[] = 'col-md-'.$span;
		if( $settings['layout'] == 'sidebar-left' ) {
			$classes[] = 'col-md-offset-1';
		}
		if( $sidebar['pull'] == 'below' && $settings['layout'] == 'sidebar-left' ) {
			$classes[] = 'col-md-pull-'.intval(10-$span);
		}
		if( $sidebar['pull'] == 'above' && $settings['layout'] == 'sidebar-right' ) {
			$classes[] = 'col-md-push-'.intval(11-$span);
		}
	}
	
	// Add additional classes
	if( !empty($class) ) {
		if( !is_array($class) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );
	return 'class="'.join( ' ', $classes ).'"';
}
}



/* --------------------------------------------------------- */
/* !Return the sidebar settings - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_sidebar_settings') ) {
function apex_sidebar_settings() {

	// Get the settings
	$settings = apex_section_settings();

	$span = intval( substr($settings['sidebar'], 1) );

	$sidebar_settings = array(
		'span' => $span,
		'pull' => $settings['sidebar_pull']
	);
	return $sidebar_settings;
}
}



/* --------------------------------------------------------- */
/* !Return a Quote format image - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_quote_thumbnail') ) {
function apex_quote_thumbnail( $post_id=false ) {

	$post_id = $post_id ? $post_id : get_the_id();
	
	if( $thumb = get_the_post_thumbnail( $post_id, 'apex-thumb' ) ) {
		return $thumb;
	} else {
		return '<i class="apex-icon-quotes"></i>';
	}
}
}




/* --------------------------------------------------------- */
/* !Return a filtered taxonomy - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_get_filtered_terms') ) {
function apex_get_filtered_terms( $taxonomies, $args=false, $post_type=false, $tax_query=array(), $return_posts=false ) {

  $terms = get_terms( $taxonomies, $args );

  if( $post_type ) {

    $filtered_terms = array();

    if( is_array($terms) && count($terms) > 0 ) {
      foreach( $terms as $term ) {

        $tax_query_mod = $tax_query;
        $tax_query_mod[] = array(
          'taxonomy' => $term->taxonomy,
          'field' => 'slug',
          'terms' => $term->slug
        );

        $args = array(
          'post_type' => $post_type,
          'tax_query' => $tax_query_mod
        );

        $posts = get_posts( $args );

        if( is_array($posts) && count($posts) > 0 ) {

          if( $return_posts ) {
            $term->posts = $posts;
          }
          $filtered_terms[] = $term;
        }
      }
    }

    return $filtered_terms;
  }

  return $terms;
}
}



/* --------------------------------------------------------- */
/* !Return the metaphor gallery query - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_gallery_tax_query') ) {
function apex_gallery_tax_query( $atts ) {
	
	// Setup taxonomy queries
	$taxonomy_query = array();
	
	$operator = isset($atts['category_operator']) ? $atts['category_operator'] : '';
	if( $operator != '' && isset($atts['categories']) ) {	
		$taxonomy_query[] = array(
			'taxonomy' => 'mtphr_gallery_category',
			'terms' => array_values( $atts['categories'] ),
			'operator' => $operator
		);
	}
	
	$operator = isset($atts['tag_operator']) ? $atts['tag_operator'] : '';
	if( $operator != '' && isset($atts['tags']) ) {	
		$taxonomy_query[] = array(
			'taxonomy' => 'mtphr_gallery_tag',
			'terms' => array_values( $atts['tags'] ),
			'operator' => $operator
		);
	}

	return $taxonomy_query;
}
}






/* --------------------------------------------------------- */
/* !Member widgets setup - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_member_widgets_setup') ) {
function apex_member_widgets_setup() {
	
	if( is_admin() ) {
		
		$notification = '';
		
		$sidebars_widgets = get_option('sidebars_widgets');
		if( isset($sidebars_widgets['primary-widget-area-team']) ) {
		
			$contact = '';
			$social = '';
			$twitter = '';
			
			foreach( $sidebars_widgets['primary-widget-area-team'] as $widget ) {
				switch( trim(substr($widget, 0, strrpos($widget, '-'))) ) {
					case 'mtphr-contact':
						$contact = $widget;
						break;
					case 'mtphr-social':
						$social = $widget;
						break;
					case 'mtphr-twitter':
						$twitter = $widget;
						break;
				}
			}
			
			// Loop through the member posts
			$args = array(
				'posts_per_page' => -1,
				'post_type' => 'mtphr_member'
			);
			$posts = get_posts( $args );
			foreach( $posts as $post ) {	
				if( $contact != '' ) {
					update_post_meta( $post->ID, '_mtphr_members_contact_override', array($contact=>1) );
				}
				if( $social != '' ) {
					update_post_meta( $post->ID, '_mtphr_members_social_override', array($social=>1) );
				}
				if( $twitter != '' ) {
					update_post_meta( $post->ID, '_mtphr_members_twitter_override', array($twitter=>1) );
				}
			}
		}
	}
}
}



/* --------------------------------------------------------- */
/* !Display the font scripts - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_typography_scripts') ) {
function apex_typography_scripts() {

	$typography = apex_typography_settings();
	$fonts = array();
	$css = '';
	foreach( $typography as $type ) {

		if( isset($type['enabled']) && $type['enabled'] ) {

			// Add the font
			$font = $type['font_family'];
			$font = preg_replace('%\'%', '', $font);
			if( !in_array($font, $fonts) ) {
				$fonts[] = $font;
			}

			// Add to the css
			$css .= $type['element'].'{';
			$css .= 'font-family:'.$font.';';
			$css .= 'font-weight:'.$type['font_weight'].';';
			$css .= 'font-style:'.$type['font_style'].';';
			$css .= 'color:'.$type['color'].';';
			$css .= 'font-size:'.$type['size_px'].'px;';
			$css .= 'line-height:'.$type['height_px'].'px;';
			$css .= '}';
		}
	}

	$num_fonts = count($fonts);
	if( $num_fonts > 0 ) {
		echo '<script>WebFont.load({google:{families:[';
		foreach( $fonts as $i => $f ) {
			echo '\''.$f.'\'';
			if( $i < ($num_fonts-1) ) {
				echo ',';
			}
		}
		echo ']}});</script>';
	}
	if( $css != '' ) {
		echo '<style id="apex-typography-styles">'.$css.'</style>';
	}
}
}



/* --------------------------------------------------------- */
/* !CSS element string - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_css_elements') ) {
function apex_css_elements( $elements ) {

	$element_string = '';
	
	if( is_array($elements) && count($elements) > 0 ) {
		foreach( $elements as $i=>$element ) {
			$element_string .= $element.',';
		}
		$element_string = substr( $element_string, 0, -1 );
	}
	
	return $element_string;
}
}


/* --------------------------------------------------------- */
/* !CSS color helper - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_css_color') ) {
function apex_css_color( $elements, $color, $important=false ) {

	$style = '';
	$important = $important ? ' !important' : '';
	$els = apex_css_elements( $elements );
	
	if( $els != '' ) {
		$style .= $els.'{color:'.$color.$important.';}';
	}
	
	return $style;
}
}


/* --------------------------------------------------------- */
/* !CSS border color helper - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_css_border_color') ) {
function apex_css_border_color( $elements, $color, $opacity='', $important=false, $override=false ) {
	
	$style = '';
	$important = $important ? ' !important' : '';
	$attribute = $override ? $override : 'border-color';
	$els = apex_css_elements( $elements );
	
	if( $els != '' ) {
		$style .= $els.'{'.$attribute.':'.$color.$important.';}';
		
		if( $opacity != '' && intval($opacity) < 100 ) {
			$rgb = apex_hex2rgb( $color );
			$opacity = $opacity/100;
			$style .= $els.'{'.$attribute.':rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].','.$opacity.');}';
		}
	}

	return $style;
}
}


/* --------------------------------------------------------- */
/* !CSS background color helper - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_css_background_color') ) {
function apex_css_background_color( $elements, $color, $opacity='' ) {
	
	$style = '';
	$els = apex_css_elements( $elements );
	
	if( $els != '' ) {
		$style .= $els.'{background-color:'.$color.';}';
		
		if( $opacity != '' && intval($opacity) < 100 ) {
			$rgb = apex_hex2rgb( $color );
			$opacity = $opacity/100;
			$style .= $els.'{background-color:rgba('.$rgb[0].','.$rgb[1].','.$rgb[2].','.$opacity.');}';
		}
	}

	return $style;
}
}


/* --------------------------------------------------------- */
/* !CSS background image helper - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_css_background_image') ) {
function apex_css_background_image( $elements, $id, $pattern='' ) {
	
	$style = '';
	$els = apex_css_elements( $elements );
	
	if( $els != '' ) {
		if( $image = wp_get_attachment_image_src($id, 'apex-background') ) {
			$style .= $els.'{background-image:url('.$image[0].');';
			if( $pattern != '' && $pattern != 'full-width' ) {
				$style .= 'background-repeat:repeat;background-size:auto;}';
			}
			$style .= '}';
		}
	}

	return $style;
}
}


/* --------------------------------------------------------- */
/* !CSS overlay helper - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_css_overlay') ) {
function apex_css_overlay( $elements, $url, $opacity='' ) {
	
	$style = '';
	$els = apex_css_elements( $elements );
	
	if( $els != '' && $url != '' && $url != 'default' && $url != 'none' ) {
		$style .= $els.'{background-image:url('.$url.');}';
		
		if( $opacity != '' ) {
			$opacity = (intval($opacity) < 100) ? $opacity : 100;
			$opacity_alt = $opacity/100;
			$style .= $els.'{filter:alpha(opacity='.$opacity.');-moz-opacity:'.$opacity_alt.';-khtml-opacity:'.$opacity_alt.';opacity:'.$opacity_alt.';}';
		}
	}

	return $style;
}
}

