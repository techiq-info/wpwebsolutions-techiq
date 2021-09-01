<?php

/* --------------------------------------------------------- */
/* !Render the image data metabox - 2.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_image_render_metabox') ) {
function mtphr_dnt_image_render_metabox() {

	global $post;
	
	/* --------------------------------------------------------- */
	/* !Organize the values - 2.0.1 */
	/* --------------------------------------------------------- */
		
	$defaults = array(
		'images' => '',
		'titles' => '',
		'descriptions' => '',
		'links' => '',
		'data_hover' => '',
		'data_display' => 'bottom',
		'size' => ''
	);
	
	$defaults = apply_filters( 'mtphr_dnt_image_defaults', $defaults );
	
	$options = get_post_meta( $post->ID, '_mtphr_dnt_image_options', true );
	
	$values = array(
		'images' => get_post_meta( $post->ID, '_mtphr_dnt_image_ticks', true ),
		'titles' => isset( $options['titles'] ) ? $options['titles'] : '',
		'descriptions' => isset( $options['descriptions'] ) ? $options['descriptions'] : '',
		'links' => isset( $options['links'] ) ? $options['links'] : '',
		'data_hover' => isset( $options['data_hover'] ) ? $options['data_hover'] : '',
		'data_display' => isset( $options['data_display'] ) ? $options['data_display'] : '',
		'size' => isset( $options['size'] ) ? $options['size'] : ''
	);
	foreach( $values as $i=>$value ) {
		if( $value == '' ) {
			unset($values[$i]);
		}
	}

	$values = wp_parse_args( $values, $defaults );	
	
	// Update the data display value
	$values['data_display'] = mtphr_dnt_image_update_data_display( $values['data_display'] );


	/* --------------------------------------------------------- */
	/* !Create the metabox & fields - 2.0.1 */
	/* --------------------------------------------------------- */
	
	echo '<input type="hidden" name="mtphr_dnt_image_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	
	$fields = array(

		/* !Image settings - 2.0.0 */
		'image_settings' => array(
			'heading' => __('Image settings', 'ditty-image-ticker'),
			'description' => __('Select the elements you would like to use', 'ditty-image-ticker'),
			'type' => 'container',
			'id' => 'mtphr-dnt-image-settings',
			'append' => array(
				
				/* !Data display - 2.0.0 */
				'size' => array(
					'heading' => __('Image size', 'ditty-image-ticker'),
					'type' => 'select',
					'name' => '_mtphr_dnt_image_options[size]',
					'value' => $values['size'],
					'options' => mtphr_dnt_image_get_image_sizes()
				),
				
				/* !Links - 2.0.0 */
				'links' => array(
					'heading' => __('Image links', 'ditty-image-ticker'),
					'type' => 'checkbox',
					'name' => '_mtphr_dnt_image_options[links]',
					'value' => $values['links'],
					'label' => __('Enable links', 'ditty-image-ticker')
				),
				
				/* !Titles - 2.0.0 */
				'titles' => array(
					'heading' => __('Image titles', 'ditty-image-ticker'),
					'type' => 'checkbox',
					'name' => '_mtphr_dnt_image_options[titles]',
					'value' => $values['titles'],
					'label' => __('Enable titles', 'ditty-image-ticker')
				),
				
				/* !Descriptions - 2.0.0 */
				'descriptions' => array(
					'heading' => __('Image descriptions', 'ditty-image-ticker'),
					'type' => 'checkbox',
					'name' => '_mtphr_dnt_image_options[descriptions]',
					'value' => $values['descriptions'],
					'label' => __('Enable descriptions', 'ditty-image-ticker')
				),
				
				/* !Data display - 2.0.0 */
				'data_display' => array(
					'heading' => __('Caption position', 'ditty-image-ticker'),
					'type' => 'select',
					'name' => '_mtphr_dnt_image_options[data_display]',
					'value' => $values['data_display'],
					'options' => array(
						'above' => __('Above image', 'ditty-image-ticker'),
						'below' => __('Below image', 'ditty-image-ticker'),
						'top' => __('Top of image (overlay)', 'ditty-image-ticker'),
						'bottom' => __('Bottom of image (overlay)', 'ditty-image-ticker')
					)
				),
				
				/* !Data hover - 1.0.0 */
				'data_hover' => array(
					'heading' => __('Caption display', 'ditty-image-ticker'),
					'type' => 'checkbox',
					'name' => '_mtphr_dnt_image_options[data_hover]',
					'label' => __('Show only on hover', 'ditty-image-ticker'),
					'value' => $values['data_hover'],
				),

			)
		),
		
		/* !Images - 2.0.0 */
		'images' => array(
			'heading' => __('Images', 'ditty-image-ticker'),
			'description' => __('Add an unlimited number of images to display', 'ditty-image-ticker'),
			'help' => __('Use the \'+\' and \'x\' buttons on the right to add and delete images. Drag and drop the arrows on the left to re-order your feeds.', 'ditty-image-ticker'),
			'type' => 'list',
			'name' => '_mtphr_dnt_image_ticks',
			'value' => $values['images'],
			'fields' => array(
				
				/* !Image - 2.0.0 */
				'image' => array(
					'heading' => __('Image', 'ditty-image-ticker'),
					'type' => 'data_image'
				),
				
				/* !Title - 2.0.0 */
				'title' => array(
					'heading' => __('Title', 'ditty-image-ticker'),
					'type' => 'text'
				),
				
				/* !Description - 2.0.0 */
				'description' => array(
					'heading' => __('Description', 'ditty-image-ticker'),
					'type' => 'textarea'
				),
				
				/* !Link - 2.0.0 */
				'link' => array(
					'heading' => __('Link', 'ditty-image-ticker'),
					'type' => 'text'
				),
				
				/* !Target - 2.0.0 */
				'target' => array(
					'heading' => __('Link target', 'ditty-image-ticker'),
					'type' => 'select',
					'options' => array(
						'_self' => '_self',
						'_blank' => '_blank'
					)
				),
				
				/* !NoFollow - 2.0.0 */
				'nofollow' => array(
					'heading' => __('No Follow', 'ditty-image-ticker'),
					'help' => __('Add "nofollow" attribute to the link', 'ditty-image-ticker'),
					'type' => 'checkbox',
					'label' => __('Add "nofollow"', 'ditty-image-ticker')
				),
			)
		),

	);
	
	$fields = apply_filters( 'mtphr_dnt_image_fields', $fields, $values );
	
	mtphr_dnt_metabox( 'mtphr-dnt-image-metabox', $fields );
}
}
add_action( 'mtphr_dnt_type_metaboxes', 'mtphr_dnt_image_render_metabox' );





/* --------------------------------------------------------- */
/* !Save the custom meta - 2.0.1 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_metabox_save( $post_id ) {

	global $post;

	// verify nonce
	if (!isset($_POST['mtphr_dnt_image_nonce']) || !wp_verify_nonce($_POST['mtphr_dnt_image_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if ( (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || ( defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']) ) return $post_id;

	// don't save if only a revision
	if ( isset($post->post_type) && $post->post_type == 'revision' ) return $post_id;

	// check permissions
	if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	// Check javascript errors
	$admin_javascript = isset($_POST['_mtphr_dnt_admin_javascript']) ? $_POST['_mtphr_dnt_admin_javascript'] : 'error';

	// Save the options
	if( isset($_POST['_mtphr_dnt_image_options']) ) {
		update_post_meta( $post_id, '_mtphr_dnt_image_options', $_POST['_mtphr_dnt_image_options'] );
	}

	// Delete the old ticks, save the new ticks
	if( isset($_POST['_mtphr_dnt_image_ticks']) ) {
		$sanitized_ticks = array();
		foreach( $_POST['_mtphr_dnt_image_ticks'] as $i=>$tick ) {
			if( isset($tick['image']) && $tick['image'] != '' ) {
				$sanitized_ticks[] = array(
					'image' => isset($tick['image']) ? $tick['image'] : '',
					'title' => isset($tick['title']) ? sanitize_text_field($tick['title']) : '',
					'description' => isset($tick['description']) ? wp_kses_post($tick['description']) : '',
					'link' => isset($tick['link']) ? sanitize_text_field($tick['link']) : '',
					'target' => isset($tick['target']) ? $tick['target'] : '',
					'nofollow' => isset($tick['nofollow']) ? $tick['nofollow'] : '',
				);
			}
		}
		
		if( $admin_javascript == 'ok' ) {
			update_post_meta( $post_id, '_mtphr_dnt_image_ticks', $sanitized_ticks );
		}
	}
}
add_action( 'save_post', 'mtphr_dnt_image_metabox_save' );




