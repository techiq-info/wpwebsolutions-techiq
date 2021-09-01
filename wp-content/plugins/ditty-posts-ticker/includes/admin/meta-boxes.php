<?php
	

/* --------------------------------------------------------- */
/* !Render the posts data metabox - 2.1.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_posts_render_metabox') ) {
function mtphr_dnt_posts_render_metabox() {

	global $post;
	
	/* --------------------------------------------------------- */
	/* !Organize the values - 2.1.0 */
	/* --------------------------------------------------------- */
	
	$defaults = array(
		'type' => '',
		'format' => '',
		'limit' => -1,
		'orderby' => 'date',
		'orderby_meta_key' => '',
		'order' => 'DESC',
		'title_link' => '',
		'date_format' => get_option('date_format'),
		'thumb_dimensions' => '',
		'thumb_link' => '',
		'excerpt_length' => 40,
		'excerpt_more' => '&hellip;{'.__('Read more', 'ditty-posts-ticker').'}',
		'excerpt_link' => '',
		'display_order' => mtphr_dnt_posts_arrangement_field_defaults(),
		'advanced_args_toggle' => '',
		'query_args' => '',
		'tax_query_args' => '',
		'tax_query_relation' => 'AND',
		'meta_query_args' => '',
		'meta_query_relation' => 'AND',
		'custom_fields' => ''
	);

	$defaults = apply_filters( 'mtphr_dnt_posts_defaults', $defaults );
		
	$values = array(
		'type' => get_post_meta( $post->ID, '_mtphr_dnt_posts_type', true ),
		'format' => get_post_meta( $post->ID, '_mtphr_dnt_posts_format', true ),
		'limit' => get_post_meta( $post->ID, '_mtphr_dnt_posts_limit', true ),
		'orderby' => get_post_meta( $post->ID, '_mtphr_dnt_posts_orderby', true ),
		'orderby_meta_key' => get_post_meta( $post->ID, '_mtphr_dnt_posts_orderby_meta_key', true ),
		'order' => get_post_meta( $post->ID, '_mtphr_dnt_posts_order', true ),
		'title_link' => get_post_meta( $post->ID, '_mtphr_dnt_posts_title_link', true ),
		'date_format' => get_post_meta( $post->ID, '_mtphr_dnt_posts_date_format', true ),
		'thumb_dimensions' => get_post_meta( $post->ID, '_mtphr_dnt_posts_thumb_dimensions', true ),
		'thumb_link' => get_post_meta( $post->ID, '_mtphr_dnt_posts_thumb_link', true ),
		'excerpt_length' => get_post_meta( $post->ID, '_mtphr_dnt_posts_excerpt_length', true ),
		'excerpt_more' => get_post_meta( $post->ID, '_mtphr_dnt_posts_excerpt_more', true ),
		'excerpt_link' => get_post_meta( $post->ID, '_mtphr_dnt_posts_excerpt_link', true ),
		'display_order' => get_post_meta( $post->ID, '_mtphr_dnt_posts_display_order', true ),
		'advanced_args_toggle' => get_post_meta( $post->ID, '_mtphr_dnt_posts_advanced_args_toggle', true ),
		'query_args' => get_post_meta( $post->ID, '_mtphr_dnt_posts_query_args', true ),
		'tax_query_args' => get_post_meta( $post->ID, '_mtphr_dnt_posts_tax_query_args', true ),
		'tax_query_relation' => get_post_meta( $post->ID, '_mtphr_dnt_posts_tax_query_relation', true ),
		'meta_query_args' => get_post_meta( $post->ID, '_mtphr_dnt_posts_meta_query_args', true ),
		'meta_query_relation' => get_post_meta( $post->ID, '_mtphr_dnt_posts_meta_query_relation', true ),
		'custom_fields' => get_post_meta( $post->ID, '_mtphr_dnt_posts_custom_fields', true ),
	);
	foreach( $values as $i=>$value ) {
		if( $value == '' ) {
			unset($values[$i]);
		}
	}
	
	$values = wp_parse_args( $values, $defaults );
	
	/* --------------------------------------------------------- */
	/* !Create the metabox & fields - 2.0.1 */
	/* --------------------------------------------------------- */
	
	echo '<input type="hidden" name="mtphr_dnt_posts_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	
	$link_wp_query = '<a href="https://codex.wordpress.org/Class_Reference/WP_Query#Parameters" target="_blank">WP_Query</a>';
	
	$fields = array(
		
		/* !Post type - 2.0.0 */
		'basic_query_settings' => array(
			'heading' => __('Basic query settings', 'ditty-posts-ticker'),
			'description' => __('Set the basic query data for your posts ticker', 'ditty-posts-ticker'),
			'type' => 'container',
			'id' => 'mtphr-dnt-posts-query-settings',
			'append' => array(
				
				/* !Post type - 2.0.0 */
				'type' => array(
					'heading' => __('Post type', 'ditty-posts-ticker'),
					'type' => 'select',
					'name' => '_mtphr_dnt_posts_type',
					'value' => $values['type'],
					'options' => mtphr_dnt_posts_types()
				),
				
				/* !Post format - 2.0.0 */
				'format' => array(
					'heading' => __('Post format', 'ditty-posts-ticker'),
					'type' => 'select',
					'name' => '_mtphr_dnt_posts_format',
					'value' => $values['format'],
					'options' => mtphr_dnt_posts_formats()
				),
				
				'limit' => array(
					'heading' => __('Post limit', 'ditty-posts-ticker'),
					'help' => __('The number of posts to display. Set the value to \'-1\' to show all posts.', 'ditty-posts-ticker'),
					'type' => 'number',
					'name' => '_mtphr_dnt_posts_limit',
					'value' => $values['limit']
				),
				
				/* !Orderby - 2.0.0 */
				'orderby' => array(
					'heading' => __('Orderby', 'ditty-posts-ticker'),
					'type' => 'select',
					'name' => '_mtphr_dnt_posts_orderby',
					'value' => $values['orderby'],
					'options' => mtphr_dnt_posts_orderby()
				),
				
				/* !Meta key - 2.0.0 */
				'orderby_meta_key' => array(
					'heading' => __('Meta key', 'ditty-posts-ticker'),
					'type' => 'text',
					'name' => '_mtphr_dnt_posts_orderby_meta_key',
					'value' => $values['orderby_meta_key'],
					'options' => mtphr_dnt_posts_orderby()
				),
				
				/* !Meta key - 2.0.0 */
				'order' => array(
					'heading' => __('Order', 'ditty-posts-ticker'),
					'type' => 'radio_buttons',
					'name' => '_mtphr_dnt_posts_order',
					'value' => $values['order'],
					'options' => array(
						'ASC' => __('Ascending', 'ditty-posts-ticker'),
						'DESC' => __('Descending', 'ditty-posts-ticker')
					)
				),
				
				'advanced_args_toggle' => array(
					'heading' => __('Advanced settings', 'ditty-posts-ticker'),
					'help' => __('Set advanced query options', 'ditty-posts-ticker'),
					'type' => 'checkbox',
					'name' => '_mtphr_dnt_posts_advanced_args_toggle',
					'value' => $values['advanced_args_toggle'],
					'label' => __('Enable advanced query args', 'ditty-posts-ticker'),
				)
			
			)
		),
		
		/* !Advanced query settings - 2.0.0 */
		'advanced_query_settings' => array(
			'heading' => __('Advanced query settings', 'ditty-posts-ticker'),
			'description' => sprintf(__('Set advanced query data for your posts ticker. Please view the WordPress Codex for more information on %s options.', 'ditty-posts-ticker'), $link_wp_query),
			'type' => 'container',
			'id' => 'mtphr-dnt-posts-advanced-query-settings',
			'append' => array(
				
				/* !Query args - 2.0.0 */
				'query_args' => array(
					'heading' => __('Query args', 'ditty-posts-ticker'),
					'description' => __('Add non-taxomony query args for advanced post queries', 'ditty-posts-ticker'),
					'type' => 'list',
					'name' => '_mtphr_dnt_posts_query_args',
					'value' => $values['query_args'],
					'fields' => array(
						
						/* !Parameter - 2.0.0 */
						'parameter' => array(
							'heading' => __('Parameter', 'ditty-posts-ticker'),
							'help' => __('Choose the parameter.', 'ditty-posts-ticker'),
							'type' => 'select',
							'options' => mtphr_dnt_query_params()
						),
						
						/* !Value - 2.0.0 */
						'value' => array(
							'heading' => __('Value', 'ditty-posts-ticker'),
							'help' => __('Use commas to split values into an array.', 'ditty-posts-ticker'),
							'type' => 'text',
							'placeholder' => __('Set the value', 'ditty-posts-ticker')
						),
						
					)
				),
				
				/* !Taxonomy args - 2.0.0 */
				'tax_query_args' => array(
					'heading' => __('Taxonomy args', 'ditty-posts-ticker'),
					'description' => __('Add taxonomy query args for advanced post queries', 'ditty-posts-ticker'),
					'type' => 'list',
					'name' => '_mtphr_dnt_posts_tax_query_args',
					'value' => $values['tax_query_args'],
					'fields' => array(
						
						/* !Taxonomy - 2.0.0 */
						'taxonomy' => array(
							'heading' => __('Taxonomy', 'ditty-posts-ticker'),
							'help' => __('Add the taxonomy you wish to use.', 'ditty-posts-ticker'),
							'type' => 'text',
							'placeholder' => __('Taxonomy ', 'ditty-posts-ticker')
						),

						/* !Terms - 2.0.0 */
						'terms' => array(
							'heading' => __('Terms', 'ditty-posts-ticker'),
							'help' => __('Add the terms to filter the query by.', 'ditty-posts-ticker'),
							'type' => 'text',
							'placeholder' => __('Add the terms', 'ditty-posts-ticker')
						),
						
						/* !Field - 2.0.0 */
						'field' => array(
							'heading' => __('Field', 'ditty-posts-ticker'),
							'help' => __('Select the taxonomy term by the specified value.', 'ditty-posts-ticker'),
							'type' => 'select',
							'options' => array(
								'id' => __('ID', 'ditty-posts-ticker'),
								'slug' => __('Slug', 'ditty-posts-ticker')
							)
						),

						/* !Operator - 2.0.0 */
						'operator' => array(
							'heading' => __('Operator', 'ditty-posts-ticker'),
							'help' => __('Select the operator to test.', 'ditty-posts-ticker'),
							'type' => 'select',
							'options' => array(
								'IN' => __('In', 'ditty-posts-ticker'),
								'NOT IN' => __('Not In', 'ditty-posts-ticker'),
								'AND' => __('And', 'ditty-posts-ticker')
							)
						),
						
						/* !Children - 2.0.0 */
						'children' => array(
							'heading' => __('Children', 'ditty-posts-ticker'),
							'help' => __('Select whether or not to include children for hierarchical taxonomies.', 'ditty-posts-ticker'),
							'type' => 'checkbox',
							'label' => __('Include children', 'ditty-posts-ticker')
						),
						
					)
				),
				
				/* !Taxonomy relation - 2.0.0 */
				'tax_query_relation' => array(
					'heading' => __('Taxonomy query relation', 'ditty-posts-ticker'),
					'help' => __('Choose the relationship between multiple taxonomy arguments.', 'ditty-posts-ticker'),
					'type' => 'radio_buttons',
					'name' => '_mtphr_dnt_posts_tax_query_relation',
					'value' => $values['tax_query_relation'],
					'options' => array(
						'AND' => __('And', 'ditty-posts-ticker'),
						'OR' => __('Or', 'ditty-posts-ticker')
					)
				),
				
				/* !Meta query args - 2.1.0 */
				'meta_query_args' => array(
					'heading' => __('Meta query args', 'ditty-posts-ticker'),
					'description' => __('Add meta query args for advanced post queries', 'ditty-posts-ticker'),
					'type' => 'list',
					'name' => '_mtphr_dnt_posts_meta_query_args',
					'value' => $values['meta_query_args'],
					'fields' => array(
						
						/* !Key - 2.1.0 */
						'key' => array(
							'heading' => __('Key', 'ditty-posts-ticker'),
							'help' => __('Custom field key.', 'ditty-posts-ticker'),
							'type' => 'text',
							'placeholder' => __('Custom field key ', 'ditty-posts-ticker')
						),

						/* !Value - 2.0.0 */
						'value' => array(
							'heading' => __('Value', 'ditty-posts-ticker'),
							'help' => __('Use commas to split values into an array. It can be an array only when compare is \'IN\', \'NOT IN\', \'BETWEEN\', or \'NOT BETWEEN\'. You don\'t have to specify a value when using the \'EXISTS\' or \'NOT EXISTS\' comparisons', 'ditty-posts-ticker'),
							'type' => 'text',
							'placeholder' => __('Custom field value', 'ditty-posts-ticker')
						),
						
						/* !Compare - 2.0.0 */
						'compare' => array(
							'heading' => __('Compare', 'ditty-posts-ticker'),
							'help' => __('Select the operator to test.', 'ditty-posts-ticker'),
							'type' => 'select',
							'options' => array(
								'=' => __('Equal To', 'ditty-posts-ticker'),
								'!=' => __('Not Equal To', 'ditty-posts-ticker'),
								'>' => __('Greater Than', 'ditty-posts-ticker'),
								'>=' => __('Greater Than or Equal To', 'ditty-posts-ticker'),
								'<' => __('Less Than', 'ditty-posts-ticker'),
								'<=' => __('Less THan or Equal To', 'ditty-posts-ticker'),
								'LIKE' => __('Like', 'ditty-posts-ticker'),
								'NOT LIKE' => __('Not Like', 'ditty-posts-ticker'),
								'IN' => __('In', 'ditty-posts-ticker'),
								'NOT IN' => __('Not In', 'ditty-posts-ticker'),
								'BETWEEN' => __('Between', 'ditty-posts-ticker'),
								'NOT BETWEEN' => __('Not Between', 'ditty-posts-ticker'),
								'EXISTS' => __('Exists', 'ditty-posts-ticker'),
								'NOT EXISTS' => __('Not Exists', 'ditty-posts-ticker'),
							)
						),

						/* !Type - 2.0.0 */
						'type' => array(
							'heading' => __('Type', 'ditty-posts-ticker'),
							'help' => __('Select the custom field type. The \'type\' DATE works with the \'compare\' value BETWEEN only if the date is stored at the format YYYY-MM-DD and tested with this format.', 'ditty-posts-ticker'),
							'type' => 'select',
							'options' => array(
								'CHAR' => __('Character', 'ditty-posts-ticker'),
								'NUMERIC' => __('Numeric', 'ditty-posts-ticker'),
								'BINARY' => __('Binary', 'ditty-posts-ticker'),
								'DATE' => __('Date', 'ditty-posts-ticker'),
								'DATETIME' => __('Date Time', 'ditty-posts-ticker'),
								'TIME' => __('Time', 'ditty-posts-ticker'),
								'DECIMAL' => __('Decimal', 'ditty-posts-ticker'),
								'SIGNED' => __('Signed', 'ditty-posts-ticker'),
								'UNSIGNED' => __('Unsigned', 'ditty-posts-ticker')
							)
						),

					)
				),
				
				/* !Meta query relation - 2.1.0 */
				'meta_query_relation' => array(
					'heading' => __('Meta query relation', 'ditty-posts-ticker'),
					'help' => __('Choose the relationship between multiple meta query arguments.', 'ditty-posts-ticker'),
					'type' => 'radio_buttons',
					'name' => '_mtphr_dnt_posts_meta_query_relation',
					'value' => $values['meta_query_relation'],
					'options' => array(
						'AND' => __('And', 'ditty-posts-ticker'),
						'OR' => __('Or', 'ditty-posts-ticker')
					)
				),
	
			)
		),
		
		/* !Post arrangement - 2.0.0 */
		'arrangement' => array(
			'heading' => __('Post item arrangement', 'ditty-posts-ticker'),
			'description' => __('Enable specific post assets and set the order', 'ditty-posts-ticker'),
			'type' => 'sort',
			'optional_fields' => true,
			'name' => '_mtphr_dnt_posts_display_order',
			'value' => $values['display_order'],
			'items' => mtphr_dnt_posts_arrangement_fields( $values )
		),
		
		/* !Custom fields - 2.0.0 */
		'custom_fields' => array(
			'heading' => __('Custom fields', 'ditty-posts-ticker'),
			'description' => __('Set custom fields to add to the <strong>Post item arrangement</strong> section.', 'ditty-posts-ticker'),
			'type' => 'list',
			'name' => '_mtphr_dnt_posts_custom_fields',
			'value' => $values['custom_fields'],
			'fields' => array(
				
				/* !Value - 2.0.0 */
				'value' => array(
					'heading' => __('Custom Field', 'ditty-posts-ticker'),
					'help' => __('The name of your custom field.', 'ditty-posts-ticker'),
					'type' => 'text',
					'placeholder' => __('custom_field_name', 'ditty-posts-ticker')
				),
				
				/* !Element - 2.0.0 */
				'element' => array(
					'heading' => __('HTML Element', 'ditty-posts-ticker'),
					'help' => __('Wrap your custom field data in an html wrapper.', 'ditty-posts-ticker'),
					'type' => 'select',
					'options' => array(
						'div' => 'div',
						'p' => 'p',
						'span' => 'span',
						'h1' => 'h1',
						'h2' => 'h2',
						'h3' => 'h3',
						'h4' => 'h4',
						'h5' => 'h5',
						'h6' => 'h6'
					)
				),
				
				/* !Links - 2.0.0 */
				'links' => array(
					'heading' => __('Links', 'ditty-posts-ticker'),
					'help' => __('Convert any urls within the custom field into links.', 'ditty-posts-ticker'),
					'type' => 'checkbox',
					'label' => __('Convert links', 'ditty-posts-ticker')
				),
				
				/* !Link target - 2.0.0 */
				'link_new' => array(
					'heading' => __('Link Target', 'ditty-posts-ticker'),
					'help' => __('Open links in a new tab or window.', 'ditty-posts-ticker'),
					'type' => 'checkbox',
					'label' => __('New tab', 'ditty-posts-ticker')
				),
			)
		),
		
	);
	
	$fields = apply_filters( 'mtphr_dnt_posts_fields', $fields, $values );
	
	mtphr_dnt_metabox( 'mtphr-dnt-posts-metabox', $fields );

			
			if( !current_theme_supports('ditty_posts_ticker_templates') ) {
			}

}
}
add_action( 'mtphr_dnt_type_metaboxes', 'mtphr_dnt_posts_render_metabox' );




/* --------------------------------------------------------- */
/* !Save the custom meta - 2.0.1 */
/* --------------------------------------------------------- */

function mtphr_dnt_posts_metabox_save( $post_id ) {

	global $post;

	// verify nonce
	if (!isset($_POST['mtphr_dnt_posts_nonce']) || !wp_verify_nonce($_POST['mtphr_dnt_posts_nonce'], basename(__FILE__))) {
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
	
	// Update the type & mode
	if( isset($_POST['_mtphr_dnt_posts_type']) ) {
		$type = isset($_POST['_mtphr_dnt_posts_type']) ? $_POST['_mtphr_dnt_posts_type'] : '';
		$format = isset($_POST['_mtphr_dnt_posts_format']) ? $_POST['_mtphr_dnt_posts_format'] : '';
		$limit = isset($_POST['_mtphr_dnt_posts_limit']) ? intval($_POST['_mtphr_dnt_posts_limit']) : -1;
		$orderby = isset($_POST['_mtphr_dnt_posts_orderby']) ? $_POST['_mtphr_dnt_posts_orderby'] : '';
		$orderby_meta = isset($_POST['_mtphr_dnt_posts_orderby_meta_key']) ? sanitize_text_field($_POST['_mtphr_dnt_posts_orderby_meta_key']) : '';
		$order = isset($_POST['_mtphr_dnt_posts_order']) ? $_POST['_mtphr_dnt_posts_order'] : '';
		$display_order = isset($_POST['_mtphr_dnt_posts_display_order']) ? $_POST['_mtphr_dnt_posts_display_order'] : '';
		$title_link = isset($_POST['_mtphr_dnt_posts_title_link']) ? $_POST['_mtphr_dnt_posts_title_link'] : '';
		$date_format = isset($_POST['_mtphr_dnt_posts_date_format']) ? sanitize_text_field($_POST['_mtphr_dnt_posts_date_format']) : '';	
		$thumb_dimensions = isset($_POST['_mtphr_dnt_posts_thumb_dimensions']) ? $_POST['_mtphr_dnt_posts_thumb_dimensions'] : '';
		$thumb_link = isset($_POST['_mtphr_dnt_posts_thumb_link']) ? $_POST['_mtphr_dnt_posts_thumb_link'] : '';
		$excerpt_length = isset($_POST['_mtphr_dnt_posts_excerpt_length']) ? intval($_POST['_mtphr_dnt_posts_excerpt_length']) : '';
		$excerpt_more = isset($_POST['_mtphr_dnt_posts_excerpt_more']) ? wp_kses_post($_POST['_mtphr_dnt_posts_excerpt_more']) : '';
		$excerpt_link = isset($_POST['_mtphr_dnt_posts_excerpt_link']) ? $_POST['_mtphr_dnt_posts_excerpt_link'] : '';
		$advanced = isset($_POST['_mtphr_dnt_posts_advanced_args_toggle']) ? $_POST['_mtphr_dnt_posts_advanced_args_toggle'] : '';
		$query_args = isset($_POST['_mtphr_dnt_posts_query_args']) ? $_POST['_mtphr_dnt_posts_query_args'] : '';
		$sanitized_query_args = array();
		if( is_array($query_args) && count($query_args) > 0 ) {
			foreach( $query_args as $i=>$data ) {
				$sanitized_query_args[] = array(
					'parameter' => isset($data['parameter']) ? sanitize_text_field($data['parameter']) : '',
					'value' => isset($data['value']) ? sanitize_text_field($data['value']) : '',
					'split' => isset($data['split']) ? $data['split'] : ''
				);
			}
		}
		
		// Tax query
		$taxonomy_args = isset($_POST['_mtphr_dnt_posts_tax_query_args']) ? $_POST['_mtphr_dnt_posts_tax_query_args'] : '';
		$sanitized_taxonomy_args = array();
		if( is_array($taxonomy_args) && count($taxonomy_args) > 0 ) {
			foreach( $taxonomy_args as $i=>$data ) {
				$sanitized_taxonomy_args[] = array(
					'taxonomy' => isset($data['taxonomy']) ? sanitize_text_field($data['taxonomy']) : '',
					'field' => isset($data['field']) ? $data['field'] : '',
					'terms' => isset($data['terms']) ? sanitize_text_field($data['terms']) : '',
					'children' => isset($data['children']) ? $data['children'] : '',
					'operator' => isset($data['operator']) ? $data['operator'] : ''
				);
			}
		}
		
		$taxonomy_relation = isset($_POST['_mtphr_dnt_posts_tax_query_relation']) ? $_POST['_mtphr_dnt_posts_tax_query_relation'] : '';
		
		// Meta query
		$meta_args = isset($_POST['_mtphr_dnt_posts_meta_query_args']) ? $_POST['_mtphr_dnt_posts_meta_query_args'] : '';
		$sanitized_meta_args = array();
		if( is_array($meta_args) && count($meta_args) > 0 ) {
			foreach( $meta_args as $i=>$data ) {
				$sanitized_meta_args[] = array(
					'key' => isset($data['key']) ? sanitize_text_field($data['key']) : '',
					'value' => isset($data['value']) ? sanitize_text_field($data['value']) : '',
					'compare' => isset($data['compare']) ? $data['compare'] : '',
					'type' => isset($data['type']) ? $data['type'] : '',
				);
			}
		}
		
		$meta_relation = isset($_POST['_mtphr_dnt_posts_meta_query_relation']) ? $_POST['_mtphr_dnt_posts_meta_query_relation'] : '';
		
		// Sanitize custom fields and add to the display order
		$custom_fields = isset($_POST['_mtphr_dnt_posts_custom_fields']) ? $_POST['_mtphr_dnt_posts_custom_fields'] : '';
		$sanitized_custom_fields = array();
		$custom_field_keys = array();
		if( is_array($custom_fields) && count($custom_fields) > 0 ) {
			foreach( $custom_fields as $i=>$data ) {
				
				$cf = isset($data['value']) ? sanitize_html_class($data['value']) : '';
				if( $cf != '' ) {
					$sanitized_custom_fields[$cf] = array(
						'value' => $cf,
						'element' => isset($data['element']) ? $data['element'] : 'div',
						'links' => isset($data['links']) ? $data['links'] : '',
						'link_new' => isset($data['link_new']) ? $data['link_new'] : ''
					);
					$custom_field_keys[] = $cf;
					if( !array_key_exists($cf, $display_order) ) {
						$display_order[$cf] = 'off';
					}
				}
			}
		}

		// Remove deleted custom fields from the display order
		$sanitized_display_order = array();
		$default_display_order = mtphr_dnt_posts_arrangement_field_defaults();
		if( is_array($display_order) && count($display_order) > 0 ) {
			foreach( $display_order as $i=>$data ) {
				if( array_key_exists($i, $default_display_order) || in_array($i, $custom_field_keys) ) {
					$sanitized_display_order[$i] = $data;
				}
			}
		}
		
		// Ensure default fields are available
		if( is_array($default_display_order) && count($default_display_order) > 0 ) {
			foreach( $default_display_order as $i=>$data ) {
				if( !array_key_exists($i, $sanitized_display_order) ) {
					$sanitized_display_order[$i] = $data;
				}
			}
		}
		
		update_post_meta( $post_id, '_mtphr_dnt_posts_type', $type );
		update_post_meta( $post_id, '_mtphr_dnt_posts_format', $format );
		update_post_meta( $post_id, '_mtphr_dnt_posts_limit', $limit );
		update_post_meta( $post_id, '_mtphr_dnt_posts_orderby', $orderby );
		update_post_meta( $post_id, '_mtphr_dnt_posts_orderby_meta_key', $orderby_meta );
		update_post_meta( $post_id, '_mtphr_dnt_posts_order', $order );
		update_post_meta( $post_id, '_mtphr_dnt_posts_display_order', $sanitized_display_order );
		update_post_meta( $post_id, '_mtphr_dnt_posts_title_link', $title_link );
		update_post_meta( $post_id, '_mtphr_dnt_posts_date_format', $date_format );
		update_post_meta( $post_id, '_mtphr_dnt_posts_thumb_dimensions', $thumb_dimensions );
		update_post_meta( $post_id, '_mtphr_dnt_posts_thumb_link', $thumb_link );
		update_post_meta( $post_id, '_mtphr_dnt_posts_excerpt_length', $excerpt_length );
		update_post_meta( $post_id, '_mtphr_dnt_posts_excerpt_more', $excerpt_more );
		update_post_meta( $post_id, '_mtphr_dnt_posts_excerpt_link', $excerpt_link );
		update_post_meta( $post_id, '_mtphr_dnt_posts_advanced_args_toggle', $advanced );
		if( $admin_javascript == 'ok' ) {
			update_post_meta( $post_id, '_mtphr_dnt_posts_query_args', $sanitized_query_args );
			update_post_meta( $post_id, '_mtphr_dnt_posts_tax_query_args', $sanitized_taxonomy_args );
			update_post_meta( $post_id, '_mtphr_dnt_posts_meta_query_args', $sanitized_meta_args );
			update_post_meta( $post_id, '_mtphr_dnt_posts_custom_fields', $sanitized_custom_fields );
		}
		update_post_meta( $post_id, '_mtphr_dnt_posts_tax_query_relation', $taxonomy_relation );
		update_post_meta( $post_id, '_mtphr_dnt_posts_meta_query_relation', $meta_relation );
	}
}
add_action( 'save_post', 'mtphr_dnt_posts_metabox_save' );
