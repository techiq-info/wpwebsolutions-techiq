<div class="entry-content 11111111">

	<?php the_content(); ?>
	
	<?php
	if( function_exists('mtphr_post_slider_display') ) {
	
		$atts = get_post_meta( get_the_id(), '_apex_post_archive_settings', true );
		$atts['title'] = '';
		$atts['title'] = '';		
		
		$tax_query = '';
		
		// Add category taxonomies
		$operator = isset($atts['category_operator']) ? $atts['category_operator'] : '';
		if( $operator != '' && isset($atts['categories']) ) {	
			$tax_query .= 'category';
			$tax_query .= '|'.implode(',', $atts['categories']);
			$tax_query .= '|'.$operator;
			$tax_query .= '|term_id';
			
			// Add the separator if both categories and tags
			if( $atts['tag_operator'] != '' && isset($atts['tags']) ) {
				$tax_query .= '%%';
			}
		}
		
		// Add tag taxonomies
		$operator = isset($atts['tag_operator']) ? $atts['tag_operator'] : '';
		if( $operator != '' && isset($atts['tags']) ) {
			$tax_query .= 'post_tag';
			$tax_query .= '|'.implode(',', $atts['tags']);
			$tax_query .= '|'.$operator;
			$tax_query .= '|term_id';
		}

		if( $tax_query != '' ) {
			$atts['tax_query'] = $tax_query;
		}
		
		// Display the slider
		echo mtphr_post_slider_display( $atts );
	}
	?>
		
</div><!-- .apex-blog-archive -->