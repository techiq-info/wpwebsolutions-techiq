<?php

/* --------------------------------------------------------- */
/* !Add the ticker type button - 2.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_type( $types ) {
	$types['image'] = array(
		'button' => __('Image', 'ditty-image-ticker'),
		'metabox_id' => 'mtphr-dnt-image-metabox',
		'icon' => 'dashicons dashicons-format-image'
	);
	return $types;
}
add_filter( 'mtphr_dnt_types', 'mtphr_dnt_image_type' );



/* --------------------------------------------------------- */
/* !Add image sizes - 1.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_create_image_sizes() {

	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'ditty-image-thumb', 150, 150, true );
	}
}
add_action( 'plugins_loaded', 'mtphr_dnt_image_create_image_sizes' );



/* --------------------------------------------------------- */
/* !Get image sizes - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_image_get_image_sizes') ) {
function mtphr_dnt_image_get_image_sizes() {

	// Loop through custom image sizes
	global $_wp_additional_image_sizes;

	$thumb_sizes = array();
	$thumb_sizes['thumbnail'] = __('Thumbnail Size', 'ditty-image-ticker');
	$thumb_sizes['medium'] = __('Medium Size', 'ditty-image-ticker');
	$thumb_sizes['large'] = __('Large Size', 'ditty-image-ticker');
	$thumb_sizes['full'] = __('Full Size', 'ditty-image-ticker');

	if( is_array($_wp_additional_image_sizes) ) {
		$temp_thumb_sizes = array();
		foreach( $_wp_additional_image_sizes as $name => $s ) {
			$temp_dimensions = $s['width'].' x '.$s['height'];
			$dimensions = $s['width'].' x '.$s['height'];
			if( $s['crop'] == 1 ) {
				$temp_dimensions .= ' cropped';
				$dimensions .= ' cropped';
			}
			//$dimensions .= ' ('.$name.')';
			if( !in_array($temp_dimensions, $temp_thumb_sizes) ) {
				$temp_thumb_sizes[$name] = $temp_dimensions;
				$thumb_sizes[$name] = $dimensions;
			}
		}
	}

	return $thumb_sizes;
}
}



/* --------------------------------------------------------- */
/* !Modify the ticks - 2.0.1 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_ticks( $ticks, $id, $meta_data ) {

	if( $meta_data['_mtphr_dnt_type'] == 'image' ) {

		$ticks = mtphr_dnt_get_image_ticks( $id );
		$new_ticks = array();

		if( is_array($ticks) ) {
			foreach ( $ticks as $item ) {
				if( class_exists('MTPHR_DNT_Image') ) { 
					$new_ticks[] = mtphr_dnt_image_tick( $item, $meta_data );
				}
			}
		}

		// Return the new ticks
		return $new_ticks;
	}

	return $ticks;
}
add_filter( 'mtphr_dnt_tick_array', 'mtphr_dnt_image_ticks', 10, 3 );



/* --------------------------------------------------------- */
/* !Get the image ticks - 2.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_get_image_ticks') ) {
function mtphr_dnt_get_image_ticks( $id ) {
	return get_post_meta( $id, '_mtphr_dnt_image_ticks', true );
}
}



/* --------------------------------------------------------- */
/* !Render a single image tick - 2.0.2 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_image_tick') ) {
function mtphr_dnt_image_tick( $item, $meta_data ) {
	
	$options = $meta_data['_mtphr_dnt_image_options'];
	$title = $item['title'];
	$show_titles = isset( $options['titles'] ) ? true : false;
	$description = $item['description'];
	$show_descriptions = isset( $options['descriptions'] ) ? true : false;
	$links = isset( $options['links'] ) ? true : false;
	$size = isset( $options['size'] ) ? $options['size'] : 'thumbnail';
	$data_display = mtphr_dnt_image_update_data_display( $options['data_display'] );
	$data_hover = ( isset($options['data_hover']) && $options['data_hover'] == 'on' ) ? true : false;
	
	//$tick = '';
	$image = wp_get_attachment_image_src( $item['image'], $size );

	// Generate the caption
	$caption = '';
	if( $show_titles && $title != '' ) {
		$caption .= '<span class="mtphr-dnt-image-title">'.$title.'</span>';
	}
	if( $show_descriptions && $description != '' ) {
		$caption .= '<span class="mtphr-dnt-image-description">'.$description.'</span>';
	}

	$image = new MTPHR_DNT_Image( $image[0], $image[1], $image[2] );
	if( $links && $item['link'] != '' ) {
		$image->set_link( $item['link'], $item['target'], $item['nofollow']);
	}
	if( $caption != '' ) {
		$image->set_caption( $caption );
		$image->set_caption_position( $data_display );
		$image->set_caption_hover( $data_hover );
	}
	if( $meta_data['_mtphr_dnt_mode'] == 'scroll' ) {
		if( $meta_data['_mtphr_dnt_scroll_width'] == '' || $meta_data['_mtphr_dnt_scroll_width'] == 0 ) {
			$image->enable_static_dimensions();
		}
	}

	return apply_filters( 'mtphr_dnt_image_tick', $image->render(), get_the_id(), $meta_data );
}
}


/* --------------------------------------------------------- */
/* !Update data_display - 2.0.1 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_update_data_display( $display = '' ) {
	// Update the data display value
	if( $display == 'over' ) {
		$display = 'bottom';
	}
	if( $display == 'out' ) {
		$display = 'below';
	}	
	
	return $display;
}



