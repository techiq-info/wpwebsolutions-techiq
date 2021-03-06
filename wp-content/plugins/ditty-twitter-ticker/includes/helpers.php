<?php

/* --------------------------------------------------------- */
/* !Get the feed - 1.2.8 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_get_feed') ) {
function mtphr_dnt_twitter_get_feed( $data, $settings ) {

	$settings = mtphr_dnt_twitter_settings();

	// Get the access token
	if( $data['type'] == 'mentions_timeline' ) {
		$response = mtphr_dnt_twitter_mentions_timeline( $data['handle'], $settings );
	} elseif( $data['type'] == 'user_timeline' ) {
		$response = mtphr_dnt_twitter_user_timeline( $data['handle'], $settings );
	} elseif( $data['type'] == 'home_timeline' ) {
		$response = mtphr_dnt_twitter_home_timeline( $data['handle'], $settings );
	} elseif( $data['type'] == 'retweets_of_me' ) {
		$response = mtphr_dnt_twitter_retweets_timeline( $data['handle'], $settings );
	} elseif( $data['type'] == 'search' ) {
		$response = mtphr_dnt_twitter_search( $data['handle'], $settings );
	} elseif( $data['type'] == 'list' ) {
		$response = mtphr_dnt_twitter_list( $data['handle'], $settings );
	}
	
	if( $response ) {
		return json_encode($response);
	}
}
}


/* --------------------------------------------------------- */
/* !Get a mentions timeline - 2.0.2 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_mentions_timeline') ) {
function mtphr_dnt_twitter_mentions_timeline( $handle, $settings=false ) {

	$settings = $settings ? $settings : mtphr_dnt_twitter_settings();

	$url = 'https://api.twitter.com/1.1/statuses/mentions_timeline.json';
	$args = $fields = array(
		'count' => 100,
		'oauth_token' => $settings['access_token'],
	);
	$twitter = mtphr_dnt_twitter_oauth( $url, $args, $fields );
	
	if( is_wp_error($twitter) ) {
   
   $error_string = $twitter->get_error_message();
   return '<div id="message" class="error"><p>' . $error_string . '</p></div>';
   
	} elseif( $twitter['response']['code'] == '200' ) {
		
		$response = json_decode($twitter['body'], true);
		return $response;
		
	} else {
		return '<div id="message" class="error"><p>'.sprintf(__('Error: %s', 'ditty-twitter-ticker'), $twitter['body']).'</p></div>';	
	}
}
}


/* --------------------------------------------------------- */
/* !Get a user timeline - 2.0.2 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_user_timeline') ) {
function mtphr_dnt_twitter_user_timeline( $handle, $settings=false ) {

	$settings = $settings ? $settings : mtphr_dnt_twitter_settings();

	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$args = $fields = array(
		'screen_name' => urlencode( $handle ),
		'count' => 100,
		'oauth_token' => $settings['access_token'],
	);
	$fields['screen_name'] = $handle;
	$twitter = mtphr_dnt_twitter_oauth( $url, $args, $fields );
	
	if( is_wp_error($twitter) ) {
   
   $error_string = $twitter->get_error_message();
   return '<div id="message" class="error"><p>' . $error_string . '</p></div>';
   
	} elseif( $twitter['response']['code'] == '200' ) {
		
		$response = json_decode($twitter['body'], true);
		return $response;
		
	} else {
		return '<div id="message" class="error"><p>'.sprintf(__('Error: %s', 'ditty-twitter-ticker'), $twitter['body']).'</p></div>';	
	}
}
}


/* --------------------------------------------------------- */
/* !Get a users home timeline - 2.0.2 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_home_timeline') ) {
function mtphr_dnt_twitter_home_timeline( $handle, $settings=false ) {

	$settings = $settings ? $settings : mtphr_dnt_twitter_settings();

	$url = 'https://api.twitter.com/1.1/statuses/home_timeline.json';
	$args = $fields = array(
		'count' => 100,
		'oauth_token' => $settings['access_token'],
	);
	$twitter = mtphr_dnt_twitter_oauth( $url, $args, $fields );
	
	if( is_wp_error($twitter) ) {
   
   $error_string = $twitter->get_error_message();
   return '<div id="message" class="error"><p>' . $error_string . '</p></div>';
   
	} elseif( $twitter['response']['code'] == '200' ) {
		
		$response = json_decode($twitter['body'], true);
		return $response;
		
	} else {
		return '<div id="message" class="error"><p>'.sprintf(__('Error: %s', 'ditty-twitter-ticker'), $twitter['body']).'</p></div>';	
	}
}
}


/* --------------------------------------------------------- */
/* !Get a retweets timeline - 2.0.2 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_retweets_timeline') ) {
function mtphr_dnt_twitter_retweets_timeline( $handle, $settings=false ) {

	$settings = $settings ? $settings : mtphr_dnt_twitter_settings();

	$url = 'https://api.twitter.com/1.1/statuses/retweets_of_me.json';
	$args = $fields = array(
		'count' => 50,
		'oauth_token' => $settings['access_token'],
	);
	$twitter = mtphr_dnt_twitter_oauth( $url, $args, $fields );
	
	if( is_wp_error($twitter) ) {
   
   $error_string = $twitter->get_error_message();
   return '<div id="message" class="error"><p>' . $error_string . '</p></div>';
   
	} elseif( $twitter['response']['code'] == '200' ) {
		
		$response = json_decode($twitter['body'], true);
		return $response;
		
	} else {
		return '<div id="message" class="error"><p>'.sprintf(__('Error: %s', 'ditty-twitter-ticker'), $twitter['body']).'</p></div>';	
	}
}
}




/* --------------------------------------------------------- */
/* !Get a search - 2.0.2 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_search') ) {
function mtphr_dnt_twitter_search( $handle, $settings=false ) {

	$settings = $settings ? $settings : mtphr_dnt_twitter_settings();
	
	$handle = preg_replace('% %', '+', $handle);
	$handle = preg_replace('%#%', '%23', $handle);

	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$args = $fields = array(
		'q' => urlencode( $handle ),
		'count' => 50,
		'oauth_token' => $settings['access_token'],
	);
	$fields['q'] = $handle;
	$twitter = mtphr_dnt_twitter_oauth( $url, $args, $fields );
	
	if( is_wp_error($twitter) ) {
   
   $error_string = $twitter->get_error_message();
   return '<div id="message" class="error"><p>' . $error_string . '</p></div>';
   
	} elseif( $twitter['response']['code'] == '200' ) {
		
		$response = json_decode($twitter['body'], true);
		return $response;
		
	} else {
		return '<div id="message" class="error"><p>'.sprintf(__('Error: %s', 'ditty-twitter-ticker'), $twitter['body']).'</p></div>';	
	}
}
}


/* --------------------------------------------------------- */
/* !Get a list - 2.0.2 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_list') ) {
function mtphr_dnt_twitter_list( $handle, $settings=false ) {

	$settings = $settings ? $settings : mtphr_dnt_twitter_settings();

	$url = 'https://api.twitter.com/1.1/lists/statuses.json';
	$args = $fields = array(
		'slug' => urlencode( $handle ),
		'owner_screen_name' => $settings['username'],
		'owner_id' => $settings['userid'],
	  'count' => 100,
	  'include_rts' => true,
		'oauth_token' => $settings['access_token'],
	);
	$fields['slug'] = $handle;
	$twitter = mtphr_dnt_twitter_oauth( $url, $args, $fields );
	
	if( is_wp_error($twitter) ) {
   
   $error_string = $twitter->get_error_message();
   return '<div id="message" class="error"><p>' . $error_string . '</p></div>';
   
	} elseif( $twitter['response']['code'] == '200' ) {
		
		$response = json_decode($twitter['body'], true);
		return $response;
		
	} else {
		return '<div id="message" class="error"><p>'.sprintf(__('Error: %s', 'ditty-twitter-ticker'), $twitter['body']).'</p></div>';	
	}
}
}


/* --------------------------------------------------------- */
/* !Get a users info - 1.2.7 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_userinfo') ) {
function mtphr_dnt_twitter_userinfo( $username, $settings=false ) {

	$settings = $settings ? $settings : mtphr_dnt_twitter_settings();

	$url = 'https://api.twitter.com/1.1/users/show.json';
	$args = $fields = array(
		'screen_name' => urlencode( $username ),
		'oauth_token' => $settings['access_token'],
	);
	$fields['screen_name'] = $username;
	$twitter = mtphr_dnt_twitter_oauth( $url, $args, $fields );
	if( $twitter['response']['code'] == '200' ) {
		$response = json_decode($twitter['body'], true);
		return $response;
	}
}
}



/* --------------------------------------------------------- */
/* !Get an embedded video - 2.0.1 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_video_oembed') ) {
function mtphr_dnt_twitter_video_oembed( $id, $settings=false ) {

	$settings = $settings ? $settings : mtphr_dnt_twitter_settings();

	$url = 'https://api.twitter.com/1.1/statuses/oembed.json';
	$args = $fields = array(
		'id' => $id,
		'widget_type' => 'video',
		'oauth_token' => $settings['access_token'],
	);
	//$fields['url'] = 'https://twitter.com/twitter/status/'.$id;
	$twitter = mtphr_dnt_twitter_oauth( $url, $args, $fields );
		
	if( is_wp_error($twitter) ) {
   
   $error_string = $twitter->get_error_message();
   return '<div id="message" class="error"><p>' . $error_string . '</p></div>';
   
	} elseif( $twitter['response']['code'] == '200' ) {
		
		$response = json_decode($twitter['body'], true);
		return $response['html'];
		
	} else {
		return '<div id="message" class="error"><p>'.sprintf(__('Error: %s', 'ditty-twitter-ticker'), $twitter['body']).'</p></div>';	
	}
}
}



/* --------------------------------------------------------- */
/* !Twitter oauth - 1.2.7 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_oauth') ) {
function mtphr_dnt_twitter_oauth( $url, $args, $fields=false ) {

	$settings = mtphr_dnt_twitter_settings();
	$hash_key = $settings['secret'].'&'.$settings['token_secret'];
	$nonce = md5(microtime(true));
	$timestamp = time();
	
	// Add the to args and alphabetize
	$args['oauth_consumer_key'] = $settings['key'];
	$args['oauth_nonce'] = $nonce;
	$args['oauth_timestamp'] = $timestamp;
	$args['oauth_signature_method'] = 'HMAC-SHA1';
	$args['oauth_version'] = '1.0';
	ksort( $args );
	
	// Create the base string
	$base = '';
	foreach( $args as $key=>$value ) {
		$base .= $key.'='.$value.'&';
	}
	$base = rtrim( $base, '&' );

	// Create the signature
	$signature = 'GET&'.urlencode($url).'&'.urlencode($base);	
	$oauth_signature = base64_encode( hash_hmac('sha1',$signature,$hash_key,true) );
	
	// Add the fields and alphabetize
	if( !$fields ) {
		$fields = $args;
	} else {
		$fields['oauth_consumer_key'] = $settings['key'];
		$fields['oauth_nonce'] = $nonce;
		$fields['oauth_timestamp'] = $timestamp;
		$fields['oauth_signature_method'] = 'HMAC-SHA1';
		$fields['oauth_version'] = '1.0';
	}
	$fields['oauth_signature'] = $oauth_signature;
	ksort( $fields );
	
	// Create the fields string
	$fields_string = '';
	foreach( $fields as $key=>$value ) {
		$fields_string .= $key.'='.urlencode($value).'&';
	}
	$fields_string = rtrim( $fields_string, '&' );
	
	$args = apply_filters( 'mtphr_dnt_twitter_remote_get_args', array() );
	return wp_remote_get( $url.'?'.$fields_string, $args );
}
}



/* --------------------------------------------------------- */
/* !Return a tweet image - 2.0.1 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_image') ) {
function mtphr_dnt_twitter_image( $item, $meta ) {
	
	$html = '';
					
	// Check for media
	$entities = isset( $item['extended_entities'] ) ? $item['extended_entities'] : $item['entities'];
	
	// Get the chosen size
	$size = isset($meta['_mtphr_dnt_twitter_image_size']) ? $meta['_mtphr_dnt_twitter_image_size'] : 'medium';

	if( isset($entities['media']) && is_array($entities['media']) && count($entities['media']) > 0 ) {
		foreach( $entities['media'] as $i=>$media ) {
			if( $media['type'] == 'photo' ) {
				$html .= '<img src="'.$media['media_url_https'].':'.$size.'" />';
			}
		}
	}
	
	return $html;	
}
}


/* --------------------------------------------------------- */
/* !Check if a tweet contains an image - 2.0.1 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_has_image') ) {
function mtphr_dnt_twitter_has_image( $item ) {
	
	$has_image = false;
					
	// Check for media
	$entities = isset( $item['extended_entities'] ) ? $item['extended_entities'] : $item['entities'];

	if( isset($entities['media']) && is_array($entities['media']) && count($entities['media']) > 0 ) {
		foreach( $entities['media'] as $i=>$media ) {
			if( $media['type'] == 'photo' ) {
				$has_image = true;
			}
		}
	}
	
	return $has_image;	
}
}


/* --------------------------------------------------------- */
/* !Check if a tweet contains a video - 2.0.1 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_twitter_has_video') ) {
function mtphr_dnt_twitter_has_video( $item ) {
	
	$has_video = false;
					
	// Check for media
	$entities = isset( $item['extended_entities'] ) ? $item['extended_entities'] : $item['entities'];
	
	if( isset($entities['media']) && is_array($entities['media']) && count($entities['media']) > 0 ) {
		foreach( $entities['media'] as $i=>$media ) {
			if( $media['type'] == 'video' ) {
				if( is_array($media['video_info']['variants']) && count($media['video_info']['variants']) > 0 ) {
					$has_video = true;
				}
			}
		}
	}
	
	return $has_video;	
}
}


/* --------------------------------------------------------- */
/* !Trim tweet text of media links - 2.0.3 */
/* --------------------------------------------------------- */

function mtphr_dnt_twitter_text( $item, $meta ) {
	
	// Extract the meta
	extract( $meta );
	
	$text = $item['text'];
	
	if( (isset($_mtphr_dnt_twitter_display_order['image']) && $_mtphr_dnt_twitter_display_order['image'] == 'on' && mtphr_dnt_twitter_has_image($item)) || (isset($_mtphr_dnt_twitter_display_order['video']) && $_mtphr_dnt_twitter_display_order['video'] == 'on' && mtphr_dnt_twitter_has_video($item)) ) {
		$text = trim( preg_replace('%'.$item['entities']['media'][0]['url'].'%', '', $text) );
	}
	
	return $text;
}
