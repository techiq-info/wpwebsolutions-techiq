<?php
// Get the global data
global $mtphr_dnt_meta_data, $mtphr_dnt_twitter_item;

// Extract the meta
extract( $mtphr_dnt_meta_data );

// Set variables
$direct_link = (isset($_mtphr_dnt_twitter_direct_link) && $_mtphr_dnt_twitter_direct_link != '') ? true : false;
$user = $mtphr_dnt_twitter_item['user']['screen_name'];
$user_name = $mtphr_dnt_twitter_item['user']['name'];
$twitter_name = (isset($_mtphr_dnt_twitter_display_order['name']) && $_mtphr_dnt_twitter_display_order['name'] == 'on') ? true : false;
$twitter_handle = (isset($_mtphr_dnt_twitter_handle) && $_mtphr_dnt_twitter_handle != '') ? true : false;
$twitter_name_link = (isset($_mtphr_dnt_twitter_name_link) && $_mtphr_dnt_twitter_name_link != '') ? true : false;

$name = '';
if( $twitter_name ) {
	$name .= $user_name;
}
if( $twitter_name && $twitter_handle ) {
	$name .= ' ';
}
if( $twitter_handle ) {
	$name = $name.'<span class="mtphr-dnt-twitter-handle">@'.$user.'</span>';
}
if( $twitter_name_link && !$direct_link ) {
	$name = '<a href="https://twitter.com/intent/user?screen_name='.$user.'" target="_blank">'.$name.'</a>';
}
if( $name != '' ) { 
	echo '<span style="display:'.$_mtphr_dnt_twitter_name_display.'" class="mtphr-dnt-twitter-name">'.$name.'</span>';
}