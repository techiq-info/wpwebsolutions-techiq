<?php
	
/* --------------------------------------------------------- */
/* !Twitter arrangement field helpers - 2.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_arrangement_field_defaults') ) {
function mtphr_dnt_twitter_arrangement_field_defaults() {
	
	$defaults = array(		
		'avatar' => 'on',
		'name' => 'on',
		'text' => 'on',
		'image' => 'off',
		'video' => 'off',
		'time' => 'on',
		'links' => 'off'
	);
	return $defaults;
}
}

if( !function_exists('mtphr_dnt_twitter_arrangement_fields') ) {
function mtphr_dnt_twitter_arrangement_fields( $values ) {
	
	$fields = array(
		
		/* !Avatar - 2.0.0 */
		'avatar' => array(
			'heading' => __('User avatar', 'ditty-twitter-ticker'),
			'fields' => array(
				
				/* !Dimensions - 2.0.0 */
				'avatar_dimensions' => array(
					'type' => 'number',
					'heading' => __('Dimensions', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_avatar_dimensions',
					'value' => $values['avatar_dimensions'],
					'after' => __('pixels wide', 'ditty-twitter-ticker')
				),
				
				/* !Lock left - 2.0.0 */
				'avatar_left' => array(
					'type' => 'checkbox',
					'heading' => __('Lock Left', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_avatar_left',
					'value' => $values['avatar_left'],
					'label' => __('Position avatar to the left', 'ditty-twitter-ticker')
				),
				
				/* !Link - 2.0.0 */
				'avatar_link' => array(
					'type' => 'checkbox',
					'heading' => __('Link', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_avatar_link',
					'value' => $values['avatar_link'],
					'label' => __('Create a link to the user', 'ditty-twitter-ticker')
				),
				
				/* !Display - 2.0.0 */
				'avatar_display' => array(
					'type' => 'radio_buttons',
					'heading' => __('Display', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_avatar_display',
					'value' => $values['avatar_display'],
					'options' => array(
						'inline' => __('Inline', 'ditty-twitter-ticker'),
						'block' => __('Block', 'ditty-twitter-ticker')
					)
				),
				
			)
		),
		
		/* !Name - 2.0.0 */
		'name' => array(
			'heading' => __('User name', 'ditty-twitter-ticker'),
			'fields' => array(
				
				/* !Handle - 2.0.0 */
				'name_handle' => array(
					'type' => 'checkbox',
					'heading' => __('Handle', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_handle',
					'value' => $values['name_handle'],
					'label' => __('Display the user\'s handle', 'ditty-twitter-ticker')
				),
				
				/* !Link - 2.0.0 */
				'name_link' => array(
					'type' => 'checkbox',
					'heading' => __('Link', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_name_link',
					'value' => $values['name_link'],
					'label' => __('Create a link to the user', 'ditty-twitter-ticker')
				),
				
				/* !Display - 2.0.0 */
				'name_display' => array(
					'type' => 'radio_buttons',
					'heading' => __('Display', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_name_display',
					'value' => $values['name_display'],
					'options' => array(
						'inline' => __('Inline', 'ditty-twitter-ticker'),
						'block' => __('Block', 'ditty-twitter-ticker')
					)
				),
				
			)
		),
		
		/* !Text - 2.0.0 */
		'text' => array(
			'heading' => __('Tweet Text', 'ditty-twitter-ticker'),
			'fields' => array(
				
				/* !Display - 2.0.0 */
				'text_display' => array(
					'type' => 'radio_buttons',
					'heading' => __('Display', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_text_display',
					'value' => $values['text_display'],
					'options' => array(
						'inline' => __('Inline', 'ditty-twitter-ticker'),
						'block' => __('Block', 'ditty-twitter-ticker')
					)
				),
				
			)
		),
		
		/* !Image - 2.0.1 */
		'image' => array(
			'heading' => __('Image embed', 'ditty-twitter-ticker'),
			'fields' => array(

				/* !Size - 2.0.0 */
				'image_size' => array(
					'type' => 'select',
					'heading' => __('Image size', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_image_size',
					'value' => $values['image_size'],
					'options' => array(
						'thumb' => __('Thumbnail', 'ditty-twitter-ticker'),
						'small' => __('Small', 'ditty-twitter-ticker'),
						'medium' => __('Medium', 'ditty-twitter-ticker'),
						'large' => __('Large', 'ditty-twitter-ticker')
					)
				),
				
				/* !Link - 2.0.0 */
				'image_link' => array(
					'type' => 'checkbox',
					'heading' => __('Link', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_image_link',
					'value' => $values['image_link'],
					'label' => __('Create a link to the tweet', 'ditty-twitter-ticker')
				),
				
				/* !Display - 2.0.0 */
				'image_display' => array(
					'type' => 'radio_buttons',
					'heading' => __('Display', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_image_display',
					'value' => $values['image_display'],
					'options' => array(
						'inline' => __('Inline', 'ditty-twitter-ticker'),
						'block' => __('Block', 'ditty-twitter-ticker')
					)
				),
				
			)
		),
		
		/* !Video - 2.0.1 */
		'video' => array(
			'heading' => __('Video embed', 'ditty-twitter-ticker'),
		),
		
		/* !Time - 2.0.0 */
		'time' => array(
			'heading' => __('Tweet time', 'ditty-twitter-ticker'),
			'fields' => array(
				
				/* !Format - 2.0.0 */
				'time_format' => array(
					'type' => 'text',
					'heading' => __('Format', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_time_format',
					'value' => $values['time_format'],
				),
				
				/* !Display - 2.0.0 */
				'time_display' => array(
					'type' => 'radio_buttons',
					'heading' => __('Display', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_time_display',
					'value' => $values['time_display'],
					'options' => array(
						'inline' => __('Inline', 'ditty-twitter-ticker'),
						'block' => __('Block', 'ditty-twitter-ticker')
					)
				),
				
			)
		),
		
		/* !Links - 2.0.0 */
		'links' => array(
			'heading' => __('Tweet links', 'ditty-twitter-ticker'),
			'fields' => array(
				
				/* !Reply - 2.0.0 */
				'reply' => array(
					'type' => 'checkbox',
					'heading' => __('Reply', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_links[reply]',
					'value' => $values['reply'],
					'label' => __('Display reply link', 'ditty-twitter-ticker')
				),
				
				/* !Retweet - 2.0.0 */
				'retweet' => array(
					'type' => 'checkbox',
					'heading' => __('Retweet', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_links[retweet]',
					'value' => $values['retweet'],
					'label' => __('Display retweet link', 'ditty-twitter-ticker')
				),
				
				/* !Favorite - 2.0.0 */
				'favorite' => array(
					'type' => 'checkbox',
					'heading' => __('Favorite', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_links[favorite]',
					'value' => $values['favorite'],
					'label' => __('Display favorite link', 'ditty-twitter-ticker')
				),
				
				/* !Display - 2.0.0 */
				'links_display' => array(
					'type' => 'radio_buttons',
					'heading' => __('Display', 'ditty-twitter-ticker'),
					'name' => '_mtphr_dnt_twitter_links_display',
					'value' => $values['links_display'],
					'options' => array(
						'inline' => __('Inline', 'ditty-twitter-ticker'),
						'block' => __('Block', 'ditty-twitter-ticker')
					)
				),
				
			)
		),
	
	);

	return $fields;
}
}