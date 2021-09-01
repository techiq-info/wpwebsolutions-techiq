<?php
// Get the global data
global $mtphr_dnt_meta_data, $mtphr_dnt_twitter_item;

// Extract the meta
extract( $mtphr_dnt_meta_data );
	
// Format the time
$time = preg_replace('/{time}/', human_time_diff(strtotime($mtphr_dnt_twitter_item['created_at']), current_time('timestamp', 1)), $_mtphr_dnt_twitter_time_format);
echo '<span style="display:'.$_mtphr_dnt_twitter_time_display.'" class="mtphr-dnt-twitter-time">'.$time.'</span>';