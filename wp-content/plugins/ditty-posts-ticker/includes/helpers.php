<?php

/* --------------------------------------------------------- */
/* !Return the posts ticker class - 1.0.13 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_posts_class') ) {
function mtphr_dnt_posts_class( $class='' ) {

	// Separates classes with a single space, collates classes for ditty ticker element
	return 'class="'.join( ' ', get_mtphr_dnt_posts_class($class) ).'"';
}
}

if( !function_exists('get_mtphr_dnt_posts_class') ) {
function get_mtphr_dnt_posts_class( $class='' ) {

	$classes = array();
	
	$post_id = get_the_id();
	$post_type = get_post_type();

	$classes[] = 'mtphr-dnt-post';
	$classes[] = 'mtphr-dnt-post-'.$post_id;
	$classes[] = 'mtphr-dnt-post-type-'.$post_type;
	if( $format = get_post_format() ) {
		$classes[] = 'mtphr-dnt-post-format-'.$format;
	}
	
	$taxonomies = get_object_taxonomies( $post_type );
	if( is_array($taxonomies) && count($taxonomies) > 0 ) {
		foreach( $taxonomies as $i=>$tax ) {
			$terms = wp_get_object_terms( $post_id, $tax, array('fields'=>'slugs') );
			if( is_array($terms) && count($terms) > 0 ) {
				foreach( $terms as $i=>$term ) {
					$classes[] = 'mtphr-dnt-post-'.$tax.'-'.$term;
				}
			}
		}
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

	return apply_filters( 'mtphr_dnt_posts_class', $classes, $class );
}
}


/* --------------------------------------------------------- */
/* !Parse query value into array - 2.0.3 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_parse_query_val') ) {
function mtphr_dnt_parse_query_val( $parameter, $value ) {
	
	switch( $parameter ) {
		case 'author__in':
		case 'author__in':
		case 'author__not_in':
		case 'category__and':
		case 'category__in':
		case 'category__not_in':
		case 'tag__and':
		case 'tag__in':
		case 'tag__not_in':
		case 'tag_slug__and':
		case 'tag_slug__in':
		case 'post_parent__in':
		case 'post_parent__not_in':
		case 'post__in':
		case 'post__not_in':
		case 'post_name__in':
			$updated_value = array_map( 'trim', explode(',', $value) );
			break;
			
		case 'post_type':
		case 'post_status':
			$arr = array_map( 'trim', explode(',', $value) );
			$updated_value = (count($arr) > 1) ? $arr : $value;
			break;
			
		case 'meta_value_num':
			$updated_value = floatval($value);
			break;
			
		case 'has_password':
			$updated_value = (strtolower($value) == 'true') ? true : false;
			break;
			
		default:
			$updated_value = $value;
			break;
	}
	
	return $updated_value;
}
}
