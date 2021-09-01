<?php
// Get the global data
global $mtphr_dnt_meta_data, $mtphr_dnt_twitter_item;

// Extract the meta
extract( $mtphr_dnt_meta_data );

// Set variables
$user_name = $mtphr_dnt_twitter_item['user']['name'];
$avatar = $mtphr_dnt_twitter_item['user']['profile_image_url_https'];
$avatar_image = '<img src="'.$avatar.'" width="'.$_mtphr_dnt_twitter_avatar_dimensions.'" height="'.$_mtphr_dnt_twitter_avatar_dimensions.'" alt="'.$user_name.'" />';

echo '<span style="display:'.$_mtphr_dnt_twitter_avatar_display.'" class="mtphr-dnt-twitter-avatar">'.$avatar_image.'</span>';