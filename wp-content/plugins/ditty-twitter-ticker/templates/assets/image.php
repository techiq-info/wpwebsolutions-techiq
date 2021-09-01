<?php
// Get the global data
global $mtphr_dnt_meta_data, $mtphr_dnt_twitter_item;

// Extract the meta
extract( $mtphr_dnt_meta_data );

// Set variables
$tweet_link = 'http://twitter.com/'.$mtphr_dnt_twitter_item['user']['id'].'/status/'.$mtphr_dnt_twitter_item['id'];

echo '<span style="display:'.$_mtphr_dnt_twitter_image_display.'" class="mtphr-dnt-twitter-image">';
	if( $_mtphr_dnt_twitter_image_link ) {
		echo '<a href="'.$tweet_link.'" target="_blank">';
	}
	echo mtphr_dnt_twitter_image( $mtphr_dnt_twitter_item, $mtphr_dnt_meta_data );
	if( $_mtphr_dnt_twitter_image_link ) {
		echo '</a>';
	}
echo '</span>';