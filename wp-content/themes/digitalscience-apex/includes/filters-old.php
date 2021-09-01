<?php

/* --------------------------------------------------------- */
/* !Set the excerpt more & length - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_excerpt_length') ) {
function apex_excerpt_length( $length ) {
	return 60;
}
}
add_filter( 'excerpt_length', 'apex_excerpt_length', 999 );

if( !function_exists('apex_excerpt_more') ) {
function apex_excerpt_more( $more ) {
	return ' &hellip;';
}
}
add_filter( 'excerpt_more', 'apex_excerpt_more' );


/* --------------------------------------------------------- */
/* !Add extra data to nav menu items - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_setup_nav_menu_item') ) {
function apex_setup_nav_menu_item( $menu_item ) {

	$menu_icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
	if( $menu_icon == '' && isset($menu_item->object_id) && $menu_item->object_id != '' ) {
		$menu_icon = get_post_meta( $menu_item->object_id, '_apex_page_icon', true );
	}
	$menu_item->icon = ( $menu_icon != '' ) ? $menu_icon : 'apex-icon-gear-1';

	$menu_item->disable_link = get_post_meta( $menu_item->ID, '_menu_item_disable_link', true );
	$menu_item->hide_section = get_post_meta( $menu_item->ID, '_menu_item_hide_section', true );
	$menu_item->hashtag_link = get_post_meta( $menu_item->ID, '_menu_item_hashtag_link', true );
		
	return $menu_item;
}
}
add_filter( 'wp_setup_nav_menu_item', 'apex_setup_nav_menu_item' );


/* --------------------------------------------------------- */
/* !Add custom walker to all nav menus - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_custom_menu_walker') ) {
function apex_custom_menu_walker( $args ) {

	if( !$args['walker'] ) {
		return array_merge( $args, array(
		  'walker' => new Apex_Menu_Walker()
		));
	}
	
	return $args;
}
}
add_filter( 'wp_nav_menu_args', 'apex_custom_menu_walker', 1 );


/* --------------------------------------------------------- */
/* !Add custom walker to category widget - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_widget_categories_args') ) {
function apex_widget_categories_args( $args ) {

	$args['walker'] = new Apex_Walker_Category();

	return $args;
}
}
add_filter( 'widget_categories_args', 'apex_widget_categories_args' );


/* --------------------------------------------------------- */
/* !Modify the archives widget link - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_archives_link') ) {
function apex_archives_link( $link_html ) {
	
	$link_split = explode('</a>', $link_html);
	if( count($link_split) > 1 ) {	
		if (strpos($link_split[1],'(') !== false) { 
		  $count = str_replace(array( '(', ')', '&nbsp;' ), '', $link_split[1]);
		  $link_html = $link_split[0].'<span class="count">'.trim($count).'</span></a>';
		}
	}
	
	return $link_html;
}
}
add_filter( 'get_archives_link', 'apex_archives_link' );


/* --------------------------------------------------------- */
/* !Modify the gallery widget count - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_galleries_category_widget_count') ) {
function mtphr_galleries_category_widget_count( $html, $count ) {
	return '<span class="count">'.$count.'</span>';
}
}
add_filter( 'mtphr_galleries_category_widget_count', 'mtphr_galleries_category_widget_count', 10, 2 );



/* --------------------------------------------------------- */
/* !Add additional args for the grid shortcode - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_grid_default_args') ) {
function apex_grid_default_args( $defaults ) {
	
	$defaults['wow_duration'] = '';
	$defaults['wow_delay'] = '';
	$defaults['wow_offset'] = '';
	$defaults['wow_iteration'] = '';
	return $defaults;
}
}
add_filter( 'mtphr_grid_default_args', 'apex_grid_default_args' );


/* --------------------------------------------------------- */
/* !Modify the grid block display */
/* --------------------------------------------------------- */

if( !function_exists('apex_grid_block') ) {
function apex_grid_block( $html, $content, $classes, $args ) {

	$html = '<div class="'.join( ' ', $classes ).'"';
	
	if( $args['wow_duration'] != '' ) {
		$html .= ' data-wow-duration="'.$args['wow_duration'].'"';
	}
	if( $args['wow_delay'] != '' ) {
		$html .= ' data-wow-delay="'.$args['wow_delay'].'"';
	}
	if( $args['wow_offset'] != '' ) {
		$html .= ' data-wow-offset="'.$args['wow_offset'].'"';
	}
	if( $args['wow_iteration'] != '' ) {
		$html .= ' data-wow-iteration="'.$args['wow_iteration'].'"';
	}
	
	$html .= '>'.$content.'</div>';
	
	return $html;
}
}
add_filter( 'mtphr_grid_block', 'apex_grid_block', 10, 4 );



/* --------------------------------------------------------- */
/* !Add a type settings for metaphor icons - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_icon_default_args') ) {
function apex_icon_default_args( $defaults ) {
	
	$defaults['type'] = '';	
	return $defaults;
}
}
add_filter( 'mtphr_icon_default_args', 'apex_icon_default_args' );


/* --------------------------------------------------------- */
/* !Modify the metaphor icon display - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_icon_display') ) {
function apex_icon_display( $html, $args ) {
	extract( $args );
	
	if( $id != '' ) {
		
		$html = '';
		
		$class = ( $class != '' ) ? ' '.sanitize_html_class( $class ) : '';
		$link_class = ( $link_class != '' ) ? ' '.sanitize_html_class( $link_class ) : '';
		$link_style = ( $link_style != '' ) ? ' style="'.sanitize_text_field($link_style).'"' : '';
		$title_class = ( $title_class != '' ) ? ' '.sanitize_html_class( $title_class ) : '';
		$title_style = ( $title_style != '' ) ? ' style="'.sanitize_text_field($title_style).'"' : '';
		$icon_class = sanitize_html_class( $prefix.'-'.$id );
		
		if( $type == 'round' ) {

			if( $link != '' ) {
				$html .= '<a href="'.esc_url($link).'" class="apex-icon-round'.$link_class.'"'.$link_style.' target="'.sanitize_text_field($target).'">';
			} else {
				$html .= '<span class="apex-icon-round">';
			}
				$html .= '<span class="apex-icon'.$class.'">';
					$html .= '<i class="'.$icon_class.'"></i>';
				$html .= '</span>';
				if( $title != '' ) {
					$html .= '<span class="apex-icon-title'.$title_class.'"'.$title_style.'>'.$title.'</span>';
				}
			if( $link != '' ) {
				$html .= '</a>';
			} else {
				$html .= '</span>';
			}
			
		} else {
			
			if( $link != '' ) {
				$html .= '<a href="'.esc_url($link).'" class="apex-icon'.$link_class.'"'.$link_style.' target="'.sanitize_text_field($target).'">';
			} else {
				$html .= '<span class="apex-icon'.$class.'">';
			}
  			$html .= '<i class="'.$icon_class.'"></i>';
  			if( $title != '' ) {
					$html .= '<span class="apex-icon-title'.$title_class.'"'.$title_style.'>'.$title.'</span>';
				}
			if( $link != '' ) {
				$html .= '</a>';
			} else {
				$html .= '</span>';
			}
			
		}
	}
	
	return $html;	
}
}
add_filter( 'mtphr_icon_display', 'apex_icon_display', 10, 2 );

/* --------------------------------------------------------- */
/* !Modify the tabbed posts widget - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_tabbed_posts_item') ) {
function apex_tabbed_posts_item( $item, $excerpt_length ) {

	$item = '<table class="entry-post-data">';
		$item .= '<tr>';
			$item .= '<td class="entry-icon">';
				$item .= apex_get_post_format_icon();
			$item .= '</td>';
			$item .= '<td>';
				$item .= '<h2 class="entry-title">';
	      	$item .= '<a href="'.get_permalink().'">'.get_the_title().'</a>';
	    	$item .= '</h2>';
	      $item .= '<span class="entry-meta">'.get_the_time( get_option('date_format') ).'</span>';
	      if( $excerpt_length > 0 ) {
					$item .= mtphr_widgets_post_excerpt( $excerpt_length );
				}
			$item .= '</td>';
		$item .= '</tr>';
	$item .= '</table>';

	return $item;
}
}
add_filter( 'mtphr_tabbed_posts_item', 'apex_tabbed_posts_item', 10, 2 );


	
/* --------------------------------------------------------- */
/* !Set the responsiveness of mtphr plugins - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_plugins_responsive_grid') ) {
function apex_plugins_responsive_grid( $responsive ) {
	return true;
}
}
add_filter( 'mtphr_shortcodes_responsive_grid', 'apex_plugins_responsive_grid' );
add_filter( 'mtphr_members_responsive_grid', 'apex_plugins_responsive_grid' );
add_filter( 'mtphr_galleries_responsive_grid', 'apex_plugins_responsive_grid' );



/* --------------------------------------------------------- */
/* !Breadcrumb filter - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_breadcrumb_single_link_with_sep') ) {
function apex_breadcrumb_single_link_with_sep( $output, $link ) {
	return preg_replace('%&raquo;%', '<span class="apex-breadcrumb-sep"></span>', $output);
}
}
add_filter( 'wpseo_breadcrumb_single_link_with_sep', 'apex_breadcrumb_single_link_with_sep', 10, 2 );




/* --------------------------------------------------------- */
/* !Modify the defaults for post sliders & blocks - 1.1.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_post_block_default_args') ) {
function apex_post_block_default_args( $defaults, $post_type ) {

	if( $post_type == 'post' ) {
		$defaults['excerpt_length'] = 140;
		$defaults['excerpt_more'] = '&hellip;<br/>{'.__('Learn more', 'apex').'}';
	
	} elseif( $post_type == 'mtphr_gallery' ) {
		$defaults['excerpt_length'] = 0;
	
	} elseif( $post_type == 'mtphr_member' ) {
		$defaults['excerpt_length'] = 140;
		$defaults['excerpt_more'] = '&hellip;<br/>{'.__('Read more', 'apex').'}';
		$defaults['disable_social'] = '';
	}
	return $defaults;
}
}
add_filter( 'mtphr_post_block_default_args', 'apex_post_block_default_args', 10, 2 );
add_filter( 'mtphr_post_slider_default_args', 'apex_post_block_default_args', 10, 2 );
add_filter( 'mtphr_post_gallery_default_args', 'apex_post_block_default_args', 10, 2 );


/* --------------------------------------------------------- */
/* !Modify the post slider prev button - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_post_slider_prev') ) {
function apex_post_slider_prev() {
	return '<a class="mtphr-post-slider-prev disabled" href="#"><i class="apex-icon-arrow-left-1"></i></a>';
}
}
add_filter( 'mtphr_post_slider_prev', 'apex_post_slider_prev' );

/* --------------------------------------------------------- */
/* !Modify the post slider next button - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_post_slider_next') ) {
function apex_post_slider_next() {
	return '<a class="mtphr-post-slider-next" href="#"><i class="apex-icon-arrow-right-1"></i></a>';
}
}
add_filter( 'mtphr_post_slider_next', 'apex_post_slider_next' );

/* --------------------------------------------------------- */
/* !Modify the post slider excerpt more link class - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_post_slider_excerpt_more_link') ) {
function apex_post_slider_excerpt_more_link( $link, $permalink, $text ) {
	return '<a class="apex-readmore" href="'.$permalink.'">'.$text.'</a>';
}
}
add_filter( 'mtphr_post_slider_excerpt_more_link', 'apex_post_slider_excerpt_more_link', 10, 3 );



/* --------------------------------------------------------- */
/* !Modify the post post blocks - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_post_post_block') ) {
function apex_post_post_block( $html, $excerpt, $args, $permalink=false ) {
	
	global $post;
	
	$permalink = $permalink ? $permalink : get_permalink();
	
	$html = '';
	
	$html .= '<div class="entry-header">';
			
		$html .= '<div class="entry-featured-archive">';
			$html .= get_the_post_thumbnail( get_the_id(), 'apex-featured-archive' );
			$html .= '<span class="entry-featured-overlay">';
				$html .= '<span class="entry-featured-icons-container">';
					$html .= '<span class="entry-featured-icons entry-featured-icons-1 clearfix">';
						$html .= '<a href="'.$permalink.'" title="'.sprintf( esc_attr__( 'Permalink to %s', 'apex' ), the_title_attribute( 'echo=0' ) ).'" rel="bookmark"><i class="apex-icon-zoom"></i></a>';
					$html .= '</span>';
				$html .= '</span>';
			$html .= '</span>';
			$html .= '<span class="entry-featured-data clearfix">';
				$html .= '<span class="entry-date">'.get_the_time( get_option('date_format') ).'</span>';
				if( $post->comment_status=='open' || get_comments_number() > 0 ) {
					$html .= '<span class="entry-comments">';
					 $html .= get_comments_number();
					 $html .= '<span class="entry-comments-arrow"></span>';
					$html .= '</span>';
				}
			$html .= '</span>';
		$html .= '</div>';
			
		$html .= '<table class="entry-post-data">';
    	$html .= '<tr>';
				$html .= '<td class="entry-icon">';
        	$html .= apex_get_post_format_icon();
        $html .= '</td>';
        $html .= '<td>';
        	$html .= '<h2 class="entry-title">';
          	$html .= '<a href="'.get_permalink().'">'.get_the_title().'</a>';
          $html .= '</h2>';
          $html .= '<span class="entry-meta">'.__('By', 'apex').' '.get_the_author_link().'</span>';
        $html .= '</td>';
      $html .= '</tr>';
    $html .= '</table>';
		
	$html .= '</div>';
	
	$html .= '<div class="entry-excerpt">';
		$html .= $excerpt;
	$html .= '</div>';

	return $html;
}
}
add_filter( 'mtphr_post_post_block', 'apex_post_post_block', 10, 3 );
add_filter( 'mtphr_post_post_slider_block', 'apex_post_post_block', 10, 4 );



/* --------------------------------------------------------- */
/* !Modify the member post blocks - 1.1.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_member_post_block') ) {
function apex_member_post_block( $block, $excerpt, $args, $permalink=false ) {

	global $post;
	
	$permalink = $permalink ? $permalink : get_permalink();
	$title = get_post_meta( get_the_id(), '_mtphr_members_title', true );
	$social = function_exists('metaphor_widgets_social_setup') ? get_post_meta( get_the_id(), '_mtphr_members_social', true ) : false;
	$new_tab = get_post_meta( get_the_id(), '_mtphr_members_social_new_tab', true );
	$target = isset($new_tab) ? 'target="_blank"' : '';	
	$disable_social = ( $args['disable_social'] == 'on' ) ? true : false;
	$has_social = ( (is_array($social) && count($social) > 0) && !$disable_social ) ? ' has-social' : '';
	
	$html = '';
	
	$html .= '<div class="entry-header">';
			
		$html .= $disable_social ? '<a href="'.$permalink.'" class="entry-featured-archive'.$has_social.'">' : '<div class="entry-featured-archive'.$has_social.'">';
			$html .= get_the_post_thumbnail( get_the_id(), 'apex-featured-archive' );
			if( $has_social != '' ) {
				$html .= '<span class="entry-featured-overlay">';
					$html .= '<span class="entry-featured-icons-container">';
						$html .= '<span class="entry-featured-icons entry-featured-icons-'.count($social).' clearfix">';
							foreach( $social as $i=>$site ) {
								$html .= '<a href="'.$site.'" '.$target.'><i class="metaphor-widgets-ico-'.$i.'"></i></a>';
							}
						$html .= '</span>';
					$html .= '</span>';
				$html .= '</span>';
			}
			$html .= '<span class="entry-featured-data clearfix">';
				$html .= '<span class="entry-title">'.get_the_title().'</span>';
				if( $title != '' ) {
					$html .= '<span class="entry-data">'.$title.'</span>';
				}
				if( $has_social != '' ) {
					$html .= '<a class="entry-featured-overlay-toggle" href="#">+</a>';
				}
			$html .= '</span>';
		$html .= $disable_social ? '</a>' : '</div>';
		
	$html .= '</div>';
	
	$html .= '<div class="entry-excerpt">';
		$html .= $excerpt;
	$html .= '</div>';

	return $html;
}
}
add_filter( 'mtphr_mtphr_member_post_block', 'apex_member_post_block', 10, 3 );
add_filter( 'mtphr_mtphr_member_post_slider_block', 'apex_member_post_block', 10, 4 );


/* --------------------------------------------------------- */
/* !Modify the gallery post blocks - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_post_gallery_rotator') ) {
function apex_post_gallery_rotator() {
	echo '<div class="mtphr-gallery-rotator"></div>';
}
}
add_action( 'mtphr_post_gallery_top', 'apex_post_gallery_rotator' );


/* --------------------------------------------------------- */
/* !Add custom gallery navigation - 1.1.10 */
/* --------------------------------------------------------- */

if( !function_exists('apex_gallery_slider_top') ) {
function apex_gallery_slider_top( $post_id, $meta_data ) {
	
	// Extract the metadata array into variables
	extract( $meta_data );
	
	$settings = mtphr_galleries_settings();
	$directional_nav = ($settings['global_slider_settings'] == 'on') ? ( $settings['slider_directional_nav'] == 'on' ) : (isset($_mtphr_gallery_slider_directional_nav) && $_mtphr_gallery_slider_directional_nav);
	
	if( $directional_nav ) {
		$html = '<div class="mtphr-gallery-header">';
			$html .= '<a href="#" class="mtphr-gallery-nav-prev" rel="nofollow"><i class="apex-icon-arrow-left-1"></i></a>';
			if( !is_single() && get_post_format() != 'gallery' ) {
				$html .= '<a href="#" class="mtphr-gallery-close" rel="nofollow"><i class="apex-icon-close-1"></i></a>';
			}
			$html .= '<a href="#" class="mtphr-gallery-nav-next" rel="nofollow"><i class="apex-icon-arrow-right-1"></i></a>';
		$html .= '</div>';
		echo $html;
	}
}
}
add_action( 'mtphr_gallery_slider_top', 'apex_gallery_slider_top', 15, 2 );
remove_action( 'mtphr_gallery_wrapper', 'mtphr_gallery_add_directional_nav', 15, 2 );


/* --------------------------------------------------------- */
/* !Set the gallery thumbnail size - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_galleries_thumbnail_size') ) {
function apex_galleries_thumbnail_size( $size ) {
	return 'apex-featured-archive';
}
}
add_filter( 'mtphr_galleries_thumbnail_size', 'apex_galleries_thumbnail_size' );


/* --------------------------------------------------------- */
/* !Set the gallery resource size - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_galleries_resource_size') ) {
function apex_galleries_resource_size( $size ) {
	return 'apex-featured';
}
}
add_filter( 'mtphr_galleries_resource_size', 'apex_galleries_resource_size' );


/* --------------------------------------------------------- */
/* !Modify the gallery navigation buttons - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_gallery_navigation') ) {
function apex_gallery_navigation( $link, $i, $post_id ) {
	$link = '<a href="'.$i.'" rel="nofollow"><i class="apex-icon-circle"></i><i class="apex-icon-circle-blank"></i></a>';
	return $link;
}
}
add_filter( 'mtphr_gallery_navigation', 'apex_gallery_navigation', 10, 3 );


/* --------------------------------------------------------- */
/* !Modify the gallery post block - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_gallery_post_block') ) {
function apex_gallery_post_block( $block, $excerpt, $args, $permalink=false ) {
	
	$permalink = $permalink ? $permalink : get_permalink();
	
	$html = '';
	
	$html .= '<div class="entry-header">';
			
		$html .= '<div class="entry-featured-archive">';
			$html .= get_mtphr_gallery_thumbnail( get_the_id() );
			$html .= '<span class="entry-featured-overlay">';
				
				$html .= '<span class="entry-featured-icons-container">';
					$html .= '<span class="entry-featured-icons entry-featured-icons-1 clearfix">';
						$html .= '<a href="'.$permalink.'" title="'.sprintf( esc_attr__( 'Permalink to %s', 'apex' ), the_title_attribute( 'echo=0' ) ).'" rel="bookmark"><i class="apex-icon-zoom"></i></a>';
					$html .= '</span>';
				$html .= '</span>';
					
			$html .= '</span>';
			$html .= '<span class="entry-featured-data clearfix">';
				$html .= '<span class="entry-title">'.get_the_title().'</span>';

				$terms = ( isset($args['taxonomy_filter']) && $args['taxonomy_filter'] != '' ) ? get_the_terms( get_the_id(), $args['taxonomy_filter'] ) : get_the_terms( get_the_id(), 'mtphr_gallery_category' );						
				if( $terms && !is_wp_error($terms) ) {
					
					$term_links = array();
					foreach( $terms as $term ) {
						$term_links[] = $term->name;
					}					
					$term_list = join( ', ', $term_links );
					
					$html .= '<span class="entry-data">';
						$html .= $term_list;
					$html .= '</span>';
				} 
	
			$html .= '</span>';
		$html .= '</div>';
		
	$html .= '</div>';
	
	if( isset($args['excerpt_length']) && $args['excerpt_length'] > 0 ) {
		$html .= '<div class="entry-excerpt">';
			$html .= $excerpt;
		$html .= '</div>';
	}

	return $html;
}
}
add_filter( 'mtphr_mtphr_gallery_post_block', 'apex_gallery_post_block', 10, 3 );
add_filter( 'mtphr_mtphr_gallery_post_slider_block', 'apex_gallery_post_block', 10, 4 );



/* --------------------------------------------------------- */
/* !Modify the gallery archive navigation - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_galleries_archive_navigation') ) {
function apex_galleries_archive_navigation( $nav ) {

	global $apex_general_settings;

	ob_start();
	if( isset($apex_general_settings['archive_navigation']['paginate'] ) ) {
		apex_post_archive_pagination();
	} else {
		apex_post_archive_navigation();
	}

	// Return the output
	return ob_get_clean();
}
}
add_action( 'mtphr_galleries_archive_navigation', 'apex_galleries_archive_navigation' );




/* --------------------------------------------------------- */
/* !Ditty News Ticker filters & functions */
/* --------------------------------------------------------- */

	/* --------------------------------------------------------- */
	/* !Modify the control nav for rotating ticks - 1.0,0 */
	/* --------------------------------------------------------- */
	
	if( !function_exists('apex_dnt_direction_nav') ) {
	function apex_dnt_direction_nav( $id, $meta_data, $total ) {
	
		// Extract the metadata array into variables
		extract( $meta_data );
	
		// Add the control nav
		if( ($total > 1) && $_mtphr_dnt_mode == 'rotate' ) {
	
			// Add the directional nav
			if( isset($_mtphr_dnt_rotate_directional_nav) ) {
				if( $_mtphr_dnt_rotate_directional_nav ) {
	
					$hide = '';
					if( isset($_mtphr_dnt_rotate_directional_nav_hide) && $_mtphr_dnt_rotate_directional_nav_hide ) {
						$hide = ' mtphr-dnt-nav-hide';
					}
					echo '<div class="mtphr-rotator-footer">';
						echo '<a class="mtphr-dnt-nav mtphr-dnt-nav-prev'.$hide.'" href="#" rel="nofollow"><i class="apex-icon-arrow-left-1"></i></a>';
						echo '<a class="mtphr-dnt-nav mtphr-dnt-nav-next'.$hide.'" href="#" rel="nofollow"><i class="apex-icon-arrow-right-1"></i></a>';
					echo '</div>';
				}
			}
		}
	}
	}
	remove_action( 'mtphr_dnt_contents_after', 'mtphr_dnt_direction_nav', 10, 3 );
	add_action( 'mtphr_dnt_contents_after', 'apex_dnt_direction_nav', 10, 3 );


	/* --------------------------------------------------------- */
	/* !Modify the control nav - 1.0.0 */
	/* --------------------------------------------------------- */
	
	if( !function_exists('apex_dnt_control_nav') ) {
	function apex_dnt_control_nav() {
		return '<i class="apex-icon-circle"></i><i class="apex-icon-circle-blank"></i>';
	}
	}
	add_filter( 'mtphr_dnt_control_nav', 'apex_dnt_control_nav' );
	
	
	/* --------------------------------------------------------- */
	/* !Modify images ticks for the hero bg - 1.1.0 */
	/* --------------------------------------------------------- */
	
	if( !function_exists('apex_dnt_image_ticks') ) {
	function apex_dnt_image_ticks( $ticks, $id, $meta_data ) {

		if( function_exists('mtphr_dnt_get_image_ticks') && $meta_data['_mtphr_dnt_type'] == 'image' ) {
	
			$ticks = mtphr_dnt_get_image_ticks( $id );
			$new_ticks = array();
			
			global $apex_type;
			$settings = apex_section_settings();
			
			if( $apex_type == 'page' && $settings['hero_bg_rotator'] == $id ) {
			
				$bg = isset( $settings['hero_bg'] ) ? $settings['hero_bg'] : array();
				$bg_parallax = isset( $bg['parallax'] ) ? $bg['parallax'] : '';
				$parallax = ( $bg_parallax != '' ) ? 'data-mtphr-parallax-speed="'.$bg_parallax.'"' : '';
			
				if( is_array($ticks) ) {
					foreach ( $ticks as $item ) {
						$image = wp_get_attachment_image_src( $item['image'], 'apex-background' );
						$new_ticks[] = '<div class="mtphr-rotator-resource" style="background-image:url('.$image[0].');" '.$parallax.'></div>';
					}
				}
				
			} else {
	
				if( is_array($ticks) ) {
					foreach ( $ticks as $item ) {
						$new_ticks[] = mtphr_dnt_image_tick( $item, $meta_data );
					}
				}
			}
	
			// Return the new ticks
			return $new_ticks;
		}
	
		return $ticks;
	}
	}
	remove_filter( 'mtphr_dnt_tick_array', 'mtphr_dnt_image_ticks', 10, 3 );
	add_filter( 'mtphr_dnt_tick_array', 'apex_dnt_image_ticks', 10, 3 );

	
	/* --------------------------------------------------------- */
	/* !Modify the post thumbnail for Quotes - 1.0.0 */
	/* --------------------------------------------------------- */
	
	if( !function_exists('apex_dnt_posts_thumb') ) {
	function apex_dnt_posts_thumb( $image, $id, $meta_data ) {
	
		if( $meta_data['_mtphr_dnt_posts_type'] == 'post' && get_post_format() == 'quote' ) {
			return '<span class="apex-dnt-posts-quote-thumb">'.apex_quote_thumbnail().'</span>';
		}
		return $image;
	}
	}
	add_filter( 'mtphr_dnt_posts_thumb', 'apex_dnt_posts_thumb', 10, 3 );



