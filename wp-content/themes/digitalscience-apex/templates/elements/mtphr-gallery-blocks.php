<?php
global $postid, $added_ids, $post_count;

// Configure the post id & offset
$postid = !empty($postid) ? $postid : get_the_id();
$added_ids = !empty($added_ids) ? $added_ids : array();

// Get the settings
$atts = get_post_meta( $postid, '_apex_gallery_archive_settings', true );
$single_link = ( isset($atts['single_link']) && $atts['single_link'] == 'on' ) ? $atts['single_link'] : '';

// Setup the query args
$query_args = array(
	'post_type'=> 'mtphr_gallery',
	'orderby' => $atts['orderby'],
	'order' => $atts['order'],
	'posts_per_page' => -1,
	'post__not_in' => $added_ids
);

// Add the taxonomy query, if there are any
$taxonomy_query = apex_gallery_tax_query( $atts );
if( count($taxonomy_query) > 0 ) {
	$query_args['tax_query'] = $taxonomy_query;
}

// Save the original query & create a new one
global $wp_query;
$original_query = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
$wp_query->query( $query_args );

$html = '';

// Store the number of found posts
$post_count = $wp_query->found_posts;

if( $wp_query->have_posts() ) : while( $wp_query->have_posts() ) : $wp_query->the_post();

  // Start gallery block
  $block_class = 'mtphr-gallery-block apex-format-gallery';
  if( $single_link == 'on' || 1 == 1 ) {
	  $block_class .= ' link-to-single';
  }
  
  $wrapper_class = 'mtphr-gallery-block-wrapper';
  if( $atts['taxonomy_filter'] ) {		
		$post_terms = wp_get_post_terms( get_the_id(), $atts['taxonomy_filter'], array('fields' => 'slugs') );			
		if( $post_terms && !is_wp_error($post_terms) ) {	
			foreach( $post_terms as $term ) {
				$wrapper_class .= ' '.$term;
			}					
		}
	}
	?>
  <div class="<?php echo $wrapper_class; ?>" data-portfolio-link="<?php echo get_permalink(get_the_id()) ?> ">
  	
		  <div class="<?php echo $block_class; ?>" data-postid="<?php echo get_the_id(); ?>">
	  		<?php //echo apex_gallery_post_block( false, false, $atts ); ?>
	  		
			<?php
			$terms = ( get_the_terms( get_the_id(), 'mtphr_gallery_category' ) );
			// print_r($terms);						
			if( $terms && !is_wp_error($terms) ) {
				
				$term_links = array();
				$terms_html = '';
				foreach( $terms as $term ) {
					$term_links[] = $term->name;
				}					
				$term_list = join( ', ', $term_links );
				
				$terms_html .= $term_list;
			}

			$get_image_1 = get_field('image_1');
			if(!empty($get_image_1)){
				$image_1_id = get_field('image_1');
			 	$image_1_url = wp_get_attachment_image_url($image_1_id, 'home_gallery_image_1');
			}else{
			 	$image_1_url = get_stylesheet_directory_uri() . '/assets/images/dummy_images/dummy_1.jpg';
			 }

			$get_image_2 = get_field('image_2');
			if(!empty($get_image_2)){
				$image_2_id = get_field('image_2');
				$image_2_url = wp_get_attachment_image_url($image_2_id, 'home_gallery_image_2');
			}else{
				$image_2_url = get_stylesheet_directory_uri() . '/assets/images/dummy_images/dummy2.png';
			}

			?>
		

		 	<div class="block">
				<a href="<?php echo get_the_permalink(); ?>">
				  <img src="<?php echo $image_2_url;  ?>" data-speed="-1" class="img-parallax">
				  <div class="block_header">
					 <h2><?php echo get_the_title(); ?></h2>
					 <p><?php echo $terms_html; ?></p>
			
					 <div class="header_img">
					 	<img src="<?php echo $image_1_url;  ?>">
					 </div>
				  </div>
				</a>
			
			</div>
			

		  </div>
	
  </div>
  <!-- End gallery block -->

<?php
endwhile;
else :
endif;

$wp_query = null;
$wp_query = $original_query;
wp_reset_postdata();

// Reset the globals
$postid = null;