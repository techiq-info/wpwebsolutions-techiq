<?php
	
/* --------------------------------------------------------- */
/* !Data image - 2.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_field_data_image') ) {
function mtphr_dnt_field_data_image( $args=array() ) {

	if( isset($args['name']) ) {
		
		$name = $args['name'];
		$class = mtphr_dnt_field_class( $args );
		$value = isset($args['value']) ? $args['value'] : '';
				
		echo '<div class="'.$class.'">';
			echo mtphr_dnt_subheading( $args );
			echo '<input type="hidden" name="'.$name.'" value="'.$value.'" '.mtphr_dnt_field_atts($args).' />';
			echo '<div class="mtphr-dnt-data-image-preview">';
				if( $value != '' ) {
					echo wp_get_attachment_image( $value, 'thumbnail' );
					echo '<a href="#" class="mtphr-dnt-data-image-upload"><i class="dashicons dashicons-no"></i></a>';
				} else {
					echo '<a href="#" class="mtphr-dnt-data-image-upload"><i class="dashicons dashicons-plus"></i></a>';
				}
			echo '</div>';
		echo '</div>';
		
		mtphr_dnt_field_append( $args );

	} else {
		echo __('Missing required data', 'ditty-news-ticker');
	}
}
}


/* --------------------------------------------------------- */
/* !Data image render - 2.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_render_fields( $data=false, $i=0 ) {

	$image = isset( $data['image'] ) ? $data['image'] : '';
	$title = isset( $data['title'] ) ? sanitize_text_field($data['title']) : '';
	$description = isset( $data['description'] ) ? wp_kses_post($data['description']) : '';
	$link = isset( $data['link'] ) ? esc_url($data['link']) : '';
	$target = isset( $data['target'] ) ? $data['target'] : '';
	$nofollow = isset( $data['nofollow'] ) ? $data['nofollow'] : '';

	$thumb = wp_get_attachment_image( $image, 'ditty-image-thumb' );

	echo '<tr class="mtphr-dnt-list-item">';
    echo '<td class="mtphr-dnt-list-handle"><span></span></td>';
    echo '<td class="mtphr-dnt-image-list-image">';
    	echo '<input type="hidden" name="_mtphr_dnt_image_ticks['.$i.'][image]" field="image" value="'.$image.'">';
			echo $thumb;
    echo '</td>';
	  echo '<td class="mtphr-dnt-image-list-data">';
	  	echo '<table>';
	  		echo '<tr>';
	  			echo '<td class="mtphr-dnt-image-title mtphr-dnt-image-list-wide">';
						echo '<label>'.__('Title', 'ditty-image-ticker').'</label><br/>';
						echo '<input type="text" name="_mtphr_dnt_image_ticks['.$i.'][title]" field="title" value="'.$title.'">';
					echo '</td>';
					echo '<td class="mtphr-dnt-image-list-narrow mtphr-dnt-image-link">';
						echo '<label>'.__('Link', 'ditty-image-ticker').'</label><br/>';
						echo '<input type="text" name="_mtphr_dnt_image_ticks['.$i.'][link]" field="link" value="'.$link.'">';
					echo '</td>';
	  		echo '</tr>';
	  		echo '<tr>';
					echo '<td>';
						echo '<label>'.__('Description', 'ditty-image-ticker').'</label><br/>';
						echo '<textarea name="_mtphr_dnt_image_ticks['.$i.'][description]" field="description">'.$description.'</textarea>';
					echo '</td>';
					echo '<td class="mtphr-dnt-image-target">';
						echo '<label>'.__('Target', 'ditty-image-ticker').'</label><br/>';
						echo '<select name="_mtphr_dnt_image_ticks['.$i.'][target]" field="target">';
							echo '<option value="_self" '.selected('_self', $target, false).'>_self</option>';
							echo '<option value="_blank" '.selected('_blank', $target, false).'>_blank</option>';
						echo '</select>';
						echo '<label><input type="checkbox" name="_mtphr_dnt_image_ticks['.$i.'][nofollow]" field="nofollow" value="on" '.checked('on', $nofollow, false).'> '.__('nofollow', 'ditty-image-ticker').'</label>';
					echo '</td>';
				echo '</tr>';
			echo '</table>';
		echo '</td>';
		echo '<td class="mtphr-dnt-list-delete"><a href="#"></a></td>';
		echo '<td class="mtphr-dnt-list-add"><a href="#"></a></td>';
	echo '</tr>';
}