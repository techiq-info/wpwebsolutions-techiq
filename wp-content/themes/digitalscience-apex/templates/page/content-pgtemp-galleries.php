<div class="entry-content clearfix">
	
	<?php the_content(); ?>
	
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
	<!-- !Start gallery -->
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
	
	<?php
	$post_id = get_the_id();
	$atts = get_post_meta( $post_id, '_apex_gallery_archive_settings', true );
	?>
	
  <div class="mtphr-gallery clearfix">
  
  	<div class="mtphr-gallery-rotator"></div>
  	
  	<?php
  	
		if( $atts['taxonomy_filter'] ) {
    	
    	// Get filtered terms
    	$terms = apex_get_filtered_terms( $atts['taxonomy_filter'], false, 'mtphr_gallery', apex_gallery_tax_query($atts) );
    	
			if( is_array($terms) && count($terms) > 0 ) {
				echo '<div class="mtphr-gallery-filter clearfix">';
					echo '<a class="btn active" href="#" data-filter="*">'.__('All Projects', 'apex').'</a>';
					foreach( $terms as $i=>$term ) {
						echo '<a class="btn" href="#" data-filter="'.$term->slug.'">'.$term->name.'</a>';
					}
				echo '</div>';
			}
  	}
  	?>

    <div class="mtphr-gallery-content clearfix" data-limit="<?php echo $atts['limit']; ?>">
      
      <div class="grid-sizer"></div>
    	
    	<?php get_template_part( 'templates/elements/mtphr', 'gallery-blocks' ); ?>

    </div>
    
    <?php
    // Add the load more button, if necessary
    global $post_count;
    if( $post_count >= $atts['limit'] ) {
	    echo '<div class="mtphr-gallery-loadmore">';
	      echo '<a class="btn" href="#" data-postid="'.$post_id.'" data-postcount="'.$post_count.'">'.__('Load More', 'apex').'</a>';
	    echo '</div>';
    }
    ?>
    
  </div>
  
  <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
	<!-- !End gallery -->
	<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

</div>