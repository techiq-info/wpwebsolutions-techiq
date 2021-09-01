<?php


/* --------------------------------------------------------- */
/* !Render the default type metabox - 2.0.1 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_render_metabox') ) {
function mtphr_dnt_twitter_render_metabox() {

	global $post;
	
	/* --------------------------------------------------------- */
	/* !Organize the values - 2.0.1 */
	/* --------------------------------------------------------- */
	
	$defaults = array(
		'handles' => false,
		'limit' => 10,
		'retweets' => '',
		'replies' => '',
		'disbursement' => '',
		'direct_link' => '',
		'display_order' => mtphr_dnt_twitter_arrangement_field_defaults(),
		'avatar_dimensions' => 40,
		'avatar_left' => '',
		'avatar_link' => '',
		'avatar_display' => 'inline',
		'name_handle' => '',
		'name_link' => '',
		'name_display' => 'inline',
		'text_display' => 'block',
		'image_display' => 'block',
		'image_size' => 'medium',
		'image_link' => '',
		'video_display' => 'block',
		'video_size' => 'medium',
		'time_format' => '{time} '.__('ago', 'ditty-twitter-ticker'),
		'time_display' => '',
		'reply' => '',
		'retweet' => '',
		'favorite' => '',
		'links_display' => 'inline'
	);
	
	$defaults = apply_filters( 'mtphr_dnt_twitter_defaults', $defaults );
	
	$links = get_post_meta( $post->ID, '_mtphr_dnt_twitter_links', true );
	$reply = ( isset($links['reply']) && $links['reply'] != '' ) ? $links['reply'] : $defaults['reply'];
	$retweet = ( isset($links['retweet']) && $links['retweet'] != '' ) ? $links['retweet'] : $defaults['retweet'];
	$favorite = ( isset($links['favorite']) && $links['favorite'] != '' ) ? $links['favorite'] : $defaults['favorite'];

	$values = array(
		'handles' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_handles', true ),
		'limit' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_limit', true ),
		'retweets' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_hide_retweets', true ),
		'replies' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_hide_replies', true ),
		'disbursement' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_disbursement', true ),
		'direct_link' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_direct_link', true ),
		'display_order' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_display_order', true ),
		'avatar_dimensions' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_avatar_dimensions', true ),
		'avatar_left' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_avatar_left', true ),
		'avatar_link' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_avatar_link', true ),
		'avatar_display' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_avatar_display', true ),
		'name_handle' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_handle', true ),
		'name_link' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_name_link', true ),
		'name_display' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_name_display', true ),
		'text_display' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_text_display', true ),
		'image_display' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_image_display', true ),
		'image_size' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_image_size', true ),
		'image_link' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_image_link', true ),
		'video_size' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_video_size', true ),
		'time_format' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_time_format', true ),
		'time_display' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_time_display', true ),
		'reply' => $reply,
		'retweet' => $retweet,
		'favorite' => $favorite,
		'links_display' => get_post_meta( $post->ID, '_mtphr_dnt_twitter_links_display', true )
	);
	foreach( $values as $i=>$value ) {
		if( $value == '' ) {
			unset($values[$i]);
		}
	}
	
	$values = wp_parse_args( $values, $defaults );
	
	// Set the default handle
	if( !is_array($values['handles']) ) {
		$settings = mtphr_dnt_twitter_settings();
		$values['handles'] = array( array(
			'handle' => $settings['username'],
			'type' => 'user_timeline'
		));
	}
	
	// Add to the display order - 2.0.1
	$values['display_order']['image'] = (isset($values['display_order']['image']) && $values['display_order']['image'] != '') ? $values['display_order']['image'] : $defaults['display_order']['image'];
	$values['display_order']['video'] = (isset($values['display_order']['video']) && $values['display_order']['video'] != '') ? $values['display_order']['video'] : $defaults['display_order']['video'];
		
	
	
	/* --------------------------------------------------------- */
	/* !Create the metabox & fields - 2.0.0 */
	/* --------------------------------------------------------- */
	
	echo '<input type="hidden" name="mtphr_dnt_twitter_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	
	$fields = array(
		
		/* !Handles - 2.0.0 */
		'handles' => array(
			'heading' => __('Handles', 'ditty-twitter-ticker'),
			'description' => __('Add an unlimited number of Twitter handles to your ticker', 'ditty-twitter-ticker'),
			'help' => __('Use the \'+\' and \'x\' buttons on the right to add and delete handles. Drag and drop the arrows on the left to re-order your handles.', 'ditty-twitter-ticker'),
			'type' => 'list',
			'name' => '_mtphr_dnt_twitter_handles',
			'value' => $values['handles'],
			'fields' => array(
				
				/* !Handle - 2.0.0 */
				'handle' => array(
					'heading' => __('Handle', 'ditty-twitter-ticker'),
					'help' => __('Add the Twitter handle. Make sure the handle type you have selected in the drop down is correct.', 'ditty-twitter-ticker'),
					'type' => 'text',
					'placeholder' => __('Add Twitter handle here...')
				),
				
				/* !Handle type - 2.0.0 */
				'type' => array(
					'heading' => __('Type', 'ditty-twitter-ticker'),
					'help' => __('Select the type of feed the handle relates to.', 'ditty-twitter-ticker'),
					'type' => 'select',
					'options' => array(
						'' => __('Select a Handle Type', 'ditty-twitter-ticker'),
						'user_timeline' => __('User timeline', 'ditty-twitter-ticker'),
						'search' => __('Keyword search', 'ditty-twitter-ticker'),
						'list' => __('List (of registered user)', 'ditty-twitter-ticker'),
						'mentions_timeline' => __('Mentions (of registered user)', 'ditty-twitter-ticker'),
						'home_timeline' => __('Home timeline (of registered user)', 'ditty-twitter-ticker'),
						'retweets_of_me' => __('Retweets (of registered user)', 'ditty-twitter-ticker'),
					)
				)
			)
		),
		
		/* !Feed options - 2.0.0 */
		'feed_options' => array(
			'heading' => __('Feed options', 'ditty-twitter-ticker'),
			'description' => __('Limit the number of tweets to show and set additional options', 'ditty-twitter-ticker'),
			'type' => 'container',
			'id' => 'mtphr-dnt-twitter-feed-options',
			'append' => array(
				
				/* !Limit - 2.0.0 */
				'limit' => array(
					'heading' => __('Limit', 'ditty-twitter-ticker'),
					'type' => 'number',
					'name' => '_mtphr_dnt_twitter_limit',
					'value' => $values['limit']
				),
				
				/* !Hide Retweets - 2.0.0 */
				'retweets' => array(
					'heading' => __('Hide retweets', 'ditty-twitter-ticker'),
					'type' => 'checkbox',
					'name' => '_mtphr_dnt_twitter_hide_retweets',
					'value' => $values['retweets'],
					'label' => __('Hide retweets', 'ditty-twitter-ticker')
				),
				
				/* !Hide Replies - 2.0.0 */
				'retweets' => array(
					'heading' => __('Hide replies', 'ditty-twitter-ticker'),
					'type' => 'checkbox',
					'name' => '_mtphr_dnt_twitter_hide_replies',
					'value' => $values['replies'],
					'label' => __('Hide replies', 'ditty-twitter-ticker')
				),
			
			)
		),
		
		/* !Direct link - 2.0.0 */
		'direct_link' => array(
			'heading' => __('Direct link', 'ditty-twitter-ticker'),
			'description' => __('Enabling this featured will disable all other links for the tick and hide the Tweet links', 'ditty-twitter-ticker'),
			'name' => '_mtphr_dnt_twitter_direct_link',
			'value' => $values['direct_link'],
			'type' => 'checkbox',
			'label' => __('Convert the full tick into a direct link to the original tweet', 'ditty-twitter-ticker'),
		),
		
		/* !Feed item arrangement - 2.0.0 */
		'arrangement' => array(
			'heading' => __('Twitter item arrangement', 'ditty-twitter-ticker'),
			'description' => __('Enable specific tweet item assets and set the order', 'ditty-twitter-ticker'),
			'type' => 'sort',
			'optional_fields' => true,
			'name' => '_mtphr_dnt_twitter_display_order',
			'value' => $values['display_order'],
			'items' => mtphr_dnt_twitter_arrangement_fields( $values )
		),

	);
	
	$fields = apply_filters( 'mtphr_dnt_twitter_fields', $fields, $values );
	
	
	if( !mtphr_dnt_twitter_check_access() ) {
		
		$link = admin_url().'edit.php?post_type=ditty_news_ticker&page=mtphr_dnt_settings&tab=twitter';
		
		$fields = array(
			
			/* !Error - 2.0.0 */
			'error' => array(
				'heading' => __('Please authorize your Twitter ticker', 'ditty-twitter-ticker'),
				'type' => 'html',
				'value' => '<p>'.__('You must authorize <strong>Ditty Twitter Ticker</strong> access through Twitter before you can display any feeds.', 'ditty-twitter-ticker').'<br/>'.sprintf( __('<a href="%s"><strong>Click here</strong></a> for instructions on creating an app and granting acces to <strong>Ditty Twitter Ticker</strong>.', 'ditty-twitter-ticker'), $link ).'</p>',
			),
		);
	}
	
	mtphr_dnt_metabox( 'mtphr-dnt-twitter-metabox', $fields );

}
}
add_action( 'mtphr_dnt_type_metaboxes', 'mtphr_dnt_twitter_render_metabox' );



/* --------------------------------------------------------- */
/* !Save the custom meta - 2.0.1 */
/* --------------------------------------------------------- */

function mtphr_dnt_twitter_metabox_save( $post_id ) {

	global $post;

	// verify nonce
	if (!isset($_POST['mtphr_dnt_twitter_nonce']) || !wp_verify_nonce($_POST['mtphr_dnt_twitter_nonce'], basename(__FILE__))) {
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
	if( isset($_POST['_mtphr_dnt_twitter_text_display']) ) {

		$limit = isset($_POST['_mtphr_dnt_twitter_limit']) ? intval($_POST['_mtphr_dnt_twitter_limit']) : 10;
		$retweets = isset($_POST['_mtphr_dnt_twitter_hide_retweets']) ? $_POST['_mtphr_dnt_twitter_hide_retweets'] : '';
		$replies = isset($_POST['_mtphr_dnt_twitter_hide_replies']) ? $_POST['_mtphr_dnt_twitter_hide_replies'] : '';
		$disbursement = isset($_POST['_mtphr_dnt_twitter_disbursement']) ? $_POST['_mtphr_dnt_twitter_disbursement'] : '';
		$direct_link = isset($_POST['_mtphr_dnt_twitter_direct_link']) ? $_POST['_mtphr_dnt_twitter_direct_link'] : '';
		$display_order = isset($_POST['_mtphr_dnt_twitter_display_order']) ? $_POST['_mtphr_dnt_twitter_display_order'] : '';
		$avatar = isset($_POST['_mtphr_dnt_twitter_avatar']) ? $_POST['_mtphr_dnt_twitter_avatar'] : '';
		$avatar_dimensions = isset($_POST['_mtphr_dnt_twitter_avatar_dimensions']) ? intval($_POST['_mtphr_dnt_twitter_avatar_dimensions']) : '';
		$avatar_left = isset($_POST['_mtphr_dnt_twitter_avatar_left']) ? $_POST['_mtphr_dnt_twitter_avatar_left'] : '';
		$avatar_link = isset($_POST['_mtphr_dnt_twitter_avatar_link']) ? $_POST['_mtphr_dnt_twitter_avatar_link'] : '';
		$avatar_display = isset($_POST['_mtphr_dnt_twitter_avatar_display']) ? $_POST['_mtphr_dnt_twitter_avatar_display'] : '';
		$name = isset($_POST['_mtphr_dnt_twitter_name']) ? $_POST['_mtphr_dnt_twitter_name'] : '';
		$name_handle = isset($_POST['_mtphr_dnt_twitter_handle']) ? $_POST['_mtphr_dnt_twitter_handle'] : '';
		$name_link = isset($_POST['_mtphr_dnt_twitter_name_link']) ? $_POST['_mtphr_dnt_twitter_name_link'] : '';
		$name_display = isset($_POST['_mtphr_dnt_twitter_name_display']) ? $_POST['_mtphr_dnt_twitter_name_display'] : '';
		$text = isset($_POST['_mtphr_dnt_twitter_text_display']) ? $_POST['_mtphr_dnt_twitter_text_display'] : '';
		$image_display = isset($_POST['_mtphr_dnt_twitter_image_display']) ? $_POST['_mtphr_dnt_twitter_image_display'] : '';
		$image_size = isset($_POST['_mtphr_dnt_twitter_image_size']) ? $_POST['_mtphr_dnt_twitter_image_size'] : '';
		$image_link = isset($_POST['_mtphr_dnt_twitter_image_link']) ? $_POST['_mtphr_dnt_twitter_image_link'] : '';
		$video_size = isset($_POST['_mtphr_dnt_twitter_video_size']) ? $_POST['_mtphr_dnt_twitter_video_size'] : '';
		$time = isset($_POST['_mtphr_dnt_twitter_time']) ? $_POST['_mtphr_dnt_twitter_time'] : '';
		$time_format = isset($_POST['_mtphr_dnt_twitter_time_format']) ? sanitize_text_field($_POST['_mtphr_dnt_twitter_time_format']) : '';
		$time_display = isset($_POST['_mtphr_dnt_twitter_time_display']) ? $_POST['_mtphr_dnt_twitter_time_display'] : '';
		$links = isset($_POST['_mtphr_dnt_twitter_links']) ? $_POST['_mtphr_dnt_twitter_links'] : array();
		$sanitaize_links = array(
			'reply' => isset($links['reply']) ? $links['reply'] : '',
			'retweet' => isset($links['retweet']) ? $links['retweet'] : '',
			'favorite' => isset($links['favorite']) ? $links['favorite'] : ''
		);
		$links_display = isset($_POST['_mtphr_dnt_twitter_links_display']) ? $_POST['_mtphr_dnt_twitter_links_display'] : '';		
		
		update_post_meta( $post_id, '_mtphr_dnt_twitter_limit', $limit );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_hide_retweets', $retweets );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_hide_replies', $replies );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_disbursement', $disbursement );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_direct_link', $direct_link );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_display_order', $display_order );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_avatar', $avatar );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_avatar_dimensions', $avatar_dimensions );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_avatar_left', $avatar_left );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_avatar_link', $avatar_link );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_avatar_display', $avatar_display );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_name', $name );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_handle', $name_handle );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_name_link', $name_link );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_name_display', $name_display );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_text_display', $text );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_image_display', $image_display );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_image_size', $image_size );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_image_link', $image_link );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_video_size', $video_size );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_time', $time );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_time_format', $time_format );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_time_display', $time_display );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_links', $sanitaize_links );
		update_post_meta( $post_id, '_mtphr_dnt_twitter_links_display', $links_display );
		
		// Save the twitter items
		$handle_data = isset($_POST['_mtphr_dnt_twitter_handles']) ? $_POST['_mtphr_dnt_twitter_handles'] : false;
		$sanitized_handles = array();
		if( is_array($handle_data) && count($handle_data) > 0 ) {
			foreach( $handle_data as $i=>$data ) {
				$sanitized_handles[] = array(
					'handle' => isset($data['handle']) ? sanitize_text_field($data['handle']) : '',
					'type' =>  isset($data['type']) ? $data['type'] : 'user_timeline'
				);
			}
		}
		
		if( $admin_javascript == 'ok' ) {
			update_post_meta( $post_id, '_mtphr_dnt_twitter_handles', $sanitized_handles );
		}
	}
}
add_action( 'save_post', 'mtphr_dnt_twitter_metabox_save' );
