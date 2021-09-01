<?php
/**
 * General functions
 *
 * @package Ditty Twitter Ticker
 */



add_filter( 'mtphr_dnt_tick_array', 'mtphr_dnt_twitter_ticks', 10, 3 );
/**
 * Modify the ticker ticks
 *
 * @since 2.0.1
 */
function mtphr_dnt_twitter_ticks( $ticks, $id, $meta_data ) {

	// Extract the meta
	extract( $meta_data );

	$type = $_mtphr_dnt_type;

	if( $type == 'twitter' ) {
		
		// Create a global for the metadata
		global $mtphr_dnt_meta_data, $mtphr_dnt_twitter_item;
		$mtphr_dnt_meta_data = $meta_data;

		// Create a new ticks array
		$new_ticks = array();

		// Check for access
		if( mtphr_dnt_twitter_check_access() ) {
			if( is_array($_mtphr_dnt_twitter_handles) ) {
				
				$settings = mtphr_dnt_twitter_settings();
				
				$tweets = array();

				$retweet = true;
				if( isset($_mtphr_dnt_twitter_hide_retweets) && $_mtphr_dnt_twitter_hide_retweets ) {
					$retweet = false;;
				}

				$replies = true;
				if( isset($_mtphr_dnt_twitter_hide_replies) && $_mtphr_dnt_twitter_hide_replies ) {
					$replies = false;
				}

				// Set the handle limit
				$handle_count = count($_mtphr_dnt_twitter_handles);
				$handle_limit = $_mtphr_dnt_twitter_limit;
				if( isset($_mtphr_dnt_twitter_disbursement) && $_mtphr_dnt_twitter_disbursement ) {
					$handle_limit = ceil($handle_limit/$handle_count);
				}

				foreach( $_mtphr_dnt_twitter_handles as $i=>$data ) {
		
					if( !isset($data['type']) ) {
						$data['type'] = $_mtphr_dnt_twitter_type;
					}
					if( $data['handle'] == '' ) {
						$data['handle'] = $settings['username'];
					}
					$handle_tweets = mtphr_dnt_twitter_feed( $data, $settings );
					if( $data['type'] == 'search' ) {
						$handle_tweets = $handle_tweets['statuses'];
					}

					if( is_array($handle_tweets) ) {

						// Filter out retweets and replies
						$ht_trim = array();
						foreach( $handle_tweets as $ht ) {

							if( !$replies && $ht['in_reply_to_screen_name'] != '' ) {
							} elseif( !$retweet && isset($ht['retweeted_status']) ) {
							} else {
								$ht_trim[] = $ht;
							}
						}

						// Even out the feeds
						if( $handle_limit != $_mtphr_dnt_twitter_limit ) {
							$ht_trim = array_slice( $ht_trim, 0, $handle_limit );
						}
						$tweets = array_merge( $tweets, $ht_trim );
					}
				}

				// Sort the feeds
				usort( $tweets, 'mtphr_dnt_twitter_feed_sort' );

				// Trim the fees to the limit
				$tweets = array_slice( $tweets, 0, $_mtphr_dnt_twitter_limit );
				
				foreach( $tweets as $tweet ) {
					
					$mtphr_dnt_twitter_item = $tweet;
					
					ob_start();
					mtphr_dnt_twitter_get_template_part( 'twitter', $id );
					$tick = ob_get_clean();
	
					$tick = apply_filters( 'mtphr_dnt_twitter_tick', $tick, get_the_id(), $meta_data );
					$new_ticks[] = $tick;

				}
			}
		} else {
			$new_ticks[] = '<p>'.__('Twitter access not yet configured.', 'ditty-twitter-ticker').'</p>';
		}

		// Return the new ticks
		return $new_ticks;
	}

	return $ticks;
}




/**
 * Sort the feed arrays
 *
 * @since 1.0.0
 */
function mtphr_dnt_twitter_feed_sort( $a, $b ) {
	$t1 = strtotime($a['created_at']);
  $t2 = strtotime($b['created_at']);
  return $t2 - $t1;
}




/**
 * Display the feed
 *
 * @since 1.1.8
 */
function mtphr_dnt_twitter_feed( $data, $settings ) {

	if ( $data['type'] != '' && $data['handle'] != '' ) {

		// Create variables for the cache file and cache time
		$cachefile = MTPHR_DNT_TWITTER_DIR.'assets/cache/'.$data['type'].'-'.urlencode($data['handle']).'-twitter-cache';
		$settings = get_option('mtphr_dnt_twitter_settings');
		$cachetime = isset($settings['cache_time']) ? intval($settings['cache_time'])*60 : 600;
		if( $cachetime < 60 ) {
			$cachetime = 60;
		}

		// if the file exists & the time it was created is less then cache time
		if ( (file_exists($cachefile)) && ( time() - $cachetime < filemtime($cachefile) ) ) {

			// Get the cache file contents & return the tweets
			$feed = file_get_contents( $cachefile );
			return json_decode( $feed, true );

		} else {

			// Save the feed
			$feed = mtphr_dnt_twitter_get_feed( $data, $settings );

			// If errors, use old file
			if( !$feed ) {

				if( (file_exists($cachefile)) ) {

					// Get the cached file
					$feed = file_get_contents( $cachefile );

					// Resave the feed to reset the cache time
					$fp = fopen( $cachefile, 'w' );
					fwrite( $fp, $feed );
					fclose( $fp );

					// Return the tweets
					return json_decode( $feed, true );
				}

			} else {

				// Create or open the cache file
				$fp = fopen( $cachefile, 'w' );

				// Write the twitter feed to the cache file
				fwrite( $fp, $feed );

				// Close the file
				fclose( $fp );

				// Return the tweets
				return json_decode( $feed, true );
			}
		}
	}
}


/**
 * Check for Twitter access
 *
 * @since 1.2.4
 */
function mtphr_dnt_twitter_check_access() {

	$settings = mtphr_dnt_twitter_settings();
	if( $settings['access_token'] == '' ) {
		return false;
	} else {
		return true;
	}
}




/**
 * Delete the cached feeds
 *
 * @since 1.1.4
 */
function mtphr_dnt_twitter_delete_cache() {

	$directory = MTPHR_DNT_TWITTER_DIR.'assets/cache/';
	$files = scandir($directory);
	$files = array_slice( $files, 2 );
	if( is_array($files) && count($files) > 0 ) {
		foreach ( $files as $file ) {
			if( file_exists($directory.$file) ) {
				unlink($directory.$file);
			}
		}
	}
}




/**
 * Return a modified string with twitter links
 *
 * @since 1.1.3
 */
function mtphr_dnt_twitter_links( $string ) {

	$string = make_clickable( $string );
	$string = preg_replace('/<a /','<a target="_blank" ', $string );
	$string = preg_replace("/ [@]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/\\1\" target=\"_blank\">\\0</a>", $string );
	$string = preg_replace("/^[@]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/\\1\" target=\"_blank\">\\0</a>", $string );
	$string = preg_replace("/ [#]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/search?q=%23\\1\" target=\"_blank\">\\0</a>", $string );
	$string = preg_replace("/^[#]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/search?q=%23\\1\" target=\"_blank\">\\0</a>", $string );

  return $string;
}

