<div class="entry-content">
	
	<?php the_content(); ?>
	
	<?php
	if( function_exists('mtphr_post_slider_display') ) {
	
		$atts = get_post_meta( get_the_id(), '_apex_member_archive_settings', true );
		$atts['type'] = 'mtphr_member';
		$atts['title'] = '';
		
		$tax_query = '';
		
		// Add category taxonomies
		$operator = isset($atts['category_operator']) ? $atts['category_operator'] : '';
		if( $operator != '' && isset($atts['categories']) ) {	
			$tax_query .= 'mtphr_member_category';
			$tax_query .= '|'.implode(',', $atts['categories']);
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

</div>