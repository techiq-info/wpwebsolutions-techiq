<?php
// Get the global data
global $mtphr_dnt_meta_data, $mtphr_dnt_twitter_item;

// Extract the meta
extract( $mtphr_dnt_meta_data );

// Get the username
$user = $mtphr_dnt_twitter_item['user']['screen_name'];

echo '<div class="mtphr-dnt-twitter-video">';
	//echo mtphr_dnt_twitter_video_oembed($mtphr_dnt_twitter_item['id']);
	echo '<blockquote class="twitter-video"><a href="https://twitter.com/'.$user.'/status/'.$mtphr_dnt_twitter_item['id'].'"></a></blockquote>';
echo '</div>';