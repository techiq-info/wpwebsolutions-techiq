<?php
// Get the global data
global $mtphr_dnt_meta_data, $mtphr_dnt_twitter_item;

// Extract the meta
extract( $mtphr_dnt_meta_data );

// Set the link displays
$reply = (isset($_mtphr_dnt_twitter_links['reply']) && $_mtphr_dnt_twitter_links['reply'] != '') ? true : false;
$retweet = (isset($_mtphr_dnt_twitter_links['retweet']) && $_mtphr_dnt_twitter_links['retweet'] != '') ? true : false;
$favorite = (isset($_mtphr_dnt_twitter_links['favorite']) && $_mtphr_dnt_twitter_links['favorite'] != '') ? true : false;

echo '<span style="display:'.$_mtphr_dnt_twitter_links_display.'" class="mtphr-dnt-twitter-links">';
if( $reply ) {
	echo '<a href="https://twitter.com/intent/tweet?in_reply_to='.$mtphr_dnt_twitter_item['id_str'].'" target="_blank"><i class="mtphr-dnt-twtr-icon-reply"></i></a>';
}
if( $retweet ) {
	echo '<a href="https://twitter.com/intent/retweet?tweet_id='.$mtphr_dnt_twitter_item['id_str'].'" target="_blank"><i class="mtphr-dnt-twtr-icon-retweet"></i> '.$mtphr_dnt_twitter_item['retweet_count'].'</a>';
}
if( $favorite ) {
	echo '<a href="https://twitter.com/intent/favorite?tweet_id='.$mtphr_dnt_twitter_item['id_str'].'" target="_blank"><i class="mtphr-dnt-twtr-icon-heart"></i> '.$mtphr_dnt_twitter_item['favorite_count'].'</a>';
}
echo '</span>';