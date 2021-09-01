<?php

/* --------------------------------------------------------- */
/* !Modify the ticker ticks - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_posts_ticks( $ticks, $id, $meta_data ) {
	
	// Create a global for the metadata
	global $mtphr_dnt_posts_meta_data;
	$mtphr_dnt_posts_meta_data = $meta_data;
	$mtphr_dnt_posts_meta_data['_mtphr_dnt_id'] = $id;

	// Extract the meta
	extract( $mtphr_dnt_posts_meta_data );

	$type = $_mtphr_dnt_type;

	if( $type == 'posts' ) {

		// Create a new ticks array
		$new_ticks = array();

		// Set the query args
		$args = array(
			'posts_per_page' => intval($_mtphr_dnt_posts_limit),
			'post_type'=> $_mtphr_dnt_posts_type,
			'orderby' => $_mtphr_dnt_posts_orderby,
			'order' => $_mtphr_dnt_posts_order
		);

		$meta_key = ( isset($_mtphr_dnt_posts_orderby_meta_key) ) ? sanitize_text_field($_mtphr_dnt_posts_orderby_meta_key) : false;
		if( $meta_key ) {
			$args['meta_key'] = $meta_key;
		}
		
		// Create a taxonomies array
		$taxonomies = array();
		
		// Create a meta_query array
		$meta_query = array();
		
		// Filter by post format
		if( $_mtphr_dnt_posts_type == 'post' && isset($_mtphr_dnt_posts_format) && $_mtphr_dnt_posts_format != '' ) {

			$post_format = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array( 'post-format-'.$_mtphr_dnt_posts_format )
			);
			
			$taxonomies[] = $post_format;
		}

		if( isset($_mtphr_dnt_posts_advanced_args_toggle) ) {
			if( $_mtphr_dnt_posts_advanced_args_toggle ) {

				// Add advanced args
				if( is_array($_mtphr_dnt_posts_query_args) ) {
					foreach( $_mtphr_dnt_posts_query_args as $arg ) {
						$parameter = sanitize_text_field($arg['parameter']);
						$value = sanitize_text_field($arg['value']);
						if( $parameter && $value ) {
							$args[$parameter] = mtphr_dnt_parse_query_val( $parameter, $value );
						}
					}
				}

				// Add taxonomy args
				if( is_array($_mtphr_dnt_posts_tax_query_args) ) {

					if( count($_mtphr_dnt_posts_tax_query_args) > 1 ) {
						$taxonomies['relation'] = $_mtphr_dnt_posts_tax_query_relation;
					}

					foreach( $_mtphr_dnt_posts_tax_query_args as $arg ) {
						$tax = array();
						if( sanitize_text_field($arg['taxonomy']) ) {
							$tax['taxonomy'] = sanitize_text_field($arg['taxonomy']);
							$tax['field'] = $arg['field'];
							$tax['terms'] = explode( ',', sanitize_text_field($arg['terms']) );
							$tax['children'] = false;
							if( isset($arg['children']) ) {
								$tax['children'] = $arg['children'];
							}
							$tax['operator'] = $arg['operator'];

							// Add the taxonomy
							$taxonomies[] = $tax;
						}
					}
				}

				// Add meta query args
				if( isset($_mtphr_dnt_posts_meta_query_args) && is_array($_mtphr_dnt_posts_meta_query_args) ) {

					if( count($_mtphr_dnt_posts_meta_query_args) > 1 ) {
						$meta_query['relation'] = $_mtphr_dnt_posts_meta_query_relation;
					}

					foreach( $_mtphr_dnt_posts_meta_query_args as $arg ) {
						$meta = array();
						if( sanitize_text_field($arg['key']) ) {
							
							$value = explode( ',', sanitize_text_field($arg['value']) );
							$value = (count($value) == 1) ? $value[0] : $value;
							
							// Add the taxonomy
							$meta_query[] = array(
								'key' => sanitize_text_field($arg['key']),
								'value' => $value,
								'compare' => $arg['compare'],
								'type' => $arg['type']
							);
							
						}
					}
				}
				
			}
		}
		
		// Add the taxonomies to the args
		if( count($taxonomies) > 0 ) {
			$args['tax_query'] = $taxonomies;
		}
		
		// Add the meta_query to the args
		if( count($meta_query) > 0 ) {
			$args['meta_query'] = $meta_query;
		}

		if($_mtphr_dnt_posts_type=='attachment') {
			$args['post_status'] = 'null';
			$args['post_mime_type'] = 'image/jpeg,image/gif,image/jpg,image/png';
		}

		// Create a new wp_query
		$mtph_dnt_query = new WP_Query( apply_filters('mtphr_dnt_posts_query_args', $args, $mtphr_dnt_posts_meta_data) );

		if ( $mtph_dnt_query->have_posts() ) : while ( $mtph_dnt_query->have_posts() ) : $mtph_dnt_query->the_post();
			
			ob_start();
			mtphr_dnt_posts_get_template_part( 'post', get_post_type() );
			$tick = ob_get_clean();

			$tick = apply_filters( 'mtphr_dnt_posts_tick', $tick, $id, get_the_id(), $mtphr_dnt_posts_meta_data );
			$new_ticks[] = $tick;

		endwhile;
		
		wp_reset_postdata();
		
		else :
		endif;

		// Return the new ticks
		return $new_ticks;
	}

	return $ticks;
}
add_filter( 'mtphr_dnt_tick_array', 'mtphr_dnt_posts_ticks', 10, 3 );




