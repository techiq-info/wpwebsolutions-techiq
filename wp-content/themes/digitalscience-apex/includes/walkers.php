<?php

/* --------------------------------------------------------- */
/* !Create a custom walker for the main menu - 1.0.11 */
/* --------------------------------------------------------- */

class Apex_Icon_Menu_Walker extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		//$output .= "\n$indent<ul class=\"sub-menu\"><span class=\"sub-menu-arrow\"></span>\n";
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	
		/* --------------------------------------------------------- */
		/* !Only display menu items that are not hidden - 1.0.0 */
		/* --------------------------------------------------------- */
	
		if( $item->disable_link != 'true' ) {
			
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
			$class_names = $value = '';
	
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
	
			/**
			 * Filter the CSS class(es) applied to a menu item's <li>.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	
			/**
			 * Filter the ID applied to a menu item's <li>.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
	
			$output .= $indent . '<li' . $id . $value . $class_names .'>';
	
			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
			
			// Add an internal id attribute
			if( $item->object != 'custom' && $item->hashtag_link != '' ) {
				
				$link = '';
				$scroll = '';
				
				if( get_post() && (get_the_id() != $item->hashtag_link) ) {
					$link = get_permalink($item->hashtag_link);
					$scroll = 'data-scroll="true"';
				} else {
					$atts['data-scroll'] = 'true';
				}

				if( $item->object_id == get_the_id() ) {
					$link = '#top';
				} else {
					global $apex_general_settings;
					$link = $link.'#'.$apex_general_settings['section_id_prefix'].$item->object.'-'.$item->object_id;
				}
				$atts['href'] = $link;
			}
	
			/**
			 * Filter the HTML attributes applied to a menu item's <a>.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
	
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
	
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			
			// Get the page icon to render
			if( $item->menu_item_parent == 0 ) {
				$page_icon = $item->icon;	
			} else {
				$page_icon = 'apex-icon-circle';
			}
			
			if( $depth == 1 ) {
				$sub_arrow = '<span class="sub-menu-arrow"></span>';
			} else {
				$sub_arrow = '';
			}
			
			/** This filter is documented in wp-includes/post-template.php */
			$item_output .= $args->link_before . $sub_arrow . '<i class="'.$page_icon.'"></i>' . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
	
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
	
		/* --------------------------------------------------------- */
		/* !Only display menu items that are not hidden - 1.0.7 */
		/* --------------------------------------------------------- */
	
		if( $item->disable_link != 'true' ) {
			$output .= "</li>\n";
		}
	}
}


/* --------------------------------------------------------- */
/* !Create a custom walker for all other menus - 1.0.11 */
/* --------------------------------------------------------- */

class Apex_Menu_Walker extends Walker_Nav_Menu {
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	
		/* --------------------------------------------------------- */
		/* !Only display menu items that are not hidden - 1.0.0 */
		/* --------------------------------------------------------- */
	
		if( $item->disable_link != 'true' ) {
			
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
			$class_names = $value = '';
	
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
	
			/**
			 * Filter the CSS class(es) applied to a menu item's <li>.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	
			/**
			 * Filter the ID applied to a menu item's <li>.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
	
			$output .= $indent . '<li' . $id . $value . $class_names .'>';
	
			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
			
			// Add an internal id attribute
			if( $item->object != 'custom' && $item->hashtag_link != '' ) {
				
				$link = '';
				$scroll = '';
				
				if( get_post() && (get_the_id() != $item->hashtag_link) ) {
					$link = get_permalink($item->hashtag_link);
					$scroll = 'data-scroll="true"';
				} else {
					$atts['data-scroll'] = 'true';
				}

				if( $item->object_id == get_the_id() ) {
					$link = '#top';
				} else {
					global $apex_general_settings;
					$link = $link.'#'.$apex_general_settings['section_id_prefix'].$item->object.'-'.$item->object_id;
				}
				$atts['href'] = $link;
			}
	
			/**
			 * Filter the HTML attributes applied to a menu item's <a>.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
	
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
	
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			
			/** This filter is documented in wp-includes/post-template.php */
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
	
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
	
		/* --------------------------------------------------------- */
		/* !Only display menu items that are not hidden - 1.0.7 */
		/* --------------------------------------------------------- */
	
		if( $item->disable_link != 'true' ) {
			$output .= "</li>\n";
		}
	}
}


/* --------------------------------------------------------- */
/* !Create a custom walker for categories - 1.0.0 */
/* --------------------------------------------------------- */

class Apex_Walker_Category extends Walker {
	/**
	 * What the class handles.
	 *
	 * @see Walker::$tree_type
	 * @since 2.1.0
	 * @var string
	 */
	var $tree_type = 'category';

	/**
	 * Database fields to use.
	 *
	 * @see Walker::$db_fields
	 * @since 2.1.0
	 * @todo Decouple this
	 * @var array
	 */
	var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 2.1.0
	 *
	 * @param string $output   Passed by reference. Used to append additional content.
	 * @param object $category Category data object.
	 * @param int    $depth    Depth of category in reference to parents. Default 0.
	 * @param array  $args     An array of arguments. @see wp_list_categories()
	 * @param int    $id       ID of the current category.
	 */
	function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		extract($args);

		$cat_name = esc_attr( $category->name );

		/** This filter is documented in wp-includes/category-template.php */
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );

		$link = '<a href="' . esc_url( get_term_link($category) ) . '" ';
		if ( $use_desc_for_title == 0 || empty($category->description) ) {
			$link .= 'title="' . esc_attr( sprintf(__( 'View all posts filed under %s', 'apex' ), $cat_name) ) . '"';
		} else {
			/**
			 * Filter the category description for display.
			 *
			 * @since 1.2.0
			 *
			 * @param string $description Category description.
			 * @param object $category    Category object.
			 */
			$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
		}

		$link .= '>';
		$link .= $cat_name;
		
		if ( !empty($show_count) )
			$link .= ' <span class="count">'.number_format_i18n( $category->count ).'</span>';
			
		$link .= '</a>';

		if ( !empty($feed_image) || !empty($feed) ) {
			$link .= ' ';

			if ( empty($feed_image) )
				$link .= '(';

			$link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $feed_type ) ) . '"';

			if ( empty($feed) ) {
				$alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s', 'apex' ), $cat_name ) . '"';
			} else {
				$title = ' title="' . $feed . '"';
				$alt = ' alt="' . $feed . '"';
				$name = $feed;
				$link .= $title;
			}

			$link .= '>';

			if ( empty($feed_image) )
				$link .= $name;
			else
				$link .= "<img src='$feed_image'$alt$title" . ' />';

			$link .= '</a>';

			if ( empty($feed_image) )
				$link .= ')';
		}

		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";
			$class = 'cat-item cat-item-' . $category->term_id;
			if ( !empty($current_category) ) {
				$_current_category = get_term( $current_category, $category->taxonomy );
				if ( $category->term_id == $current_category )
					$class .=  ' current-cat';
				elseif ( $category->term_id == $_current_category->parent )
					$class .=  ' current-cat-parent';
			}
			$output .=  ' class="' . $class . '"';
			$output .= ">$link\n";
		} else {
			$output .= "\t$link<br />\n";
		}
	}
}