<?php
	
/* --------------------------------------------------------- */
/* !Default Twitter display template - 2.0.0 */
/* --------------------------------------------------------- */

// Get the global data
global $mtphr_dnt_meta_data, $mtphr_dnt_twitter_item;

// Extract the meta
extract( $mtphr_dnt_meta_data );

// Get the original tweet link 
$tweet_link = 'http://twitter.com/'.$mtphr_dnt_twitter_item['user']['id'].'/status/'.$mtphr_dnt_twitter_item['id'];

// Set the twitter avatar
$twitter_avatar = (isset($_mtphr_dnt_twitter_display_order['avatar']) && $_mtphr_dnt_twitter_display_order['avatar'] == 'on') ? true : false;
$twitter_avatar_left = (isset($_mtphr_dnt_twitter_avatar_left) && $_mtphr_dnt_twitter_avatar_left != '') ? true : false;
$twitter_avatar_link = (isset($_mtphr_dnt_twitter_avatar_link) && $_mtphr_dnt_twitter_avatar_link != '') ? true : false;

$direct_link = (isset($_mtphr_dnt_twitter_direct_link) && $_mtphr_dnt_twitter_direct_link != '') ? true : false;
	
$avatar = $mtphr_dnt_twitter_item['user']['profile_image_url_https'];
$user = $mtphr_dnt_twitter_item['user']['screen_name'];
$user_name = $mtphr_dnt_twitter_item['user']['name'];

$avatar_left = ( $twitter_avatar_left && $twitter_avatar ) ? '-avatar-left' : false;

if( $direct_link ) {
	echo '<a href="'.$tweet_link.'" target="_blank" class="mtphr-dnt-twitter-tweet'.$avatar_left.' mtphr-dnt-clearfix">';
} else {
	echo '<div class="mtphr-dnt-twitter-tweet'.$avatar_left.' mtphr-dnt-clearfix">';
}

$avatar_image = '<img src="'.$avatar.'" width="'.$_mtphr_dnt_twitter_avatar_dimensions.'" height="'.$_mtphr_dnt_twitter_avatar_dimensions.'" />';
if( $twitter_avatar_link && !$direct_link ) {
	$avatar_image = '<a href="https://twitter.com/intent/user?screen_name='.$user.'" target="_blank">'.$avatar_image.'</a>';
}

if( $avatar_left ) {
	echo '<span class="mtphr-dnt-twitter-avatar">'.$avatar_image.'</span>';
	echo '<div class="mtphr-dnt-twitter-content" style="margin-left:'.$_mtphr_dnt_twitter_avatar_dimensions.'px">';
} else {
	echo '<div class="mtphr-dnt-twitter-content">';
}

foreach( $_mtphr_dnt_twitter_display_order as $key => $display ) {

	switch( $key ) {

		case 'avatar':
			if( $display == 'on' && !$avatar_left ) {
				mtphr_dnt_twitter_get_template_part( 'assets/avatar', $id );
			}
			break;

		case 'name':
			if( $display == 'on' ) {
				mtphr_dnt_twitter_get_template_part( 'assets/name', $id );
			}
			break;

		case 'text':
			if( $display == 'on' ) {
				mtphr_dnt_twitter_get_template_part( 'assets/text', $id );	
			}
			break;
			
		case 'image':
			if( $display == 'on' && mtphr_dnt_twitter_has_image($mtphr_dnt_twitter_item) ) {
				mtphr_dnt_twitter_get_template_part( 'assets/image', $id );
			}
			break;
			
		case 'video':
			if( $display == 'on' && mtphr_dnt_twitter_has_video($mtphr_dnt_twitter_item) ) {
				mtphr_dnt_twitter_get_template_part( 'assets/video', $id );
			}
			break;

		case 'time':
			if( $display == 'on' ) {
				mtphr_dnt_twitter_get_template_part( 'assets/time', $id );
			}
			break;

		case 'links':
			if( $display == 'on' && !$direct_link ) {
				mtphr_dnt_twitter_get_template_part( 'assets/links', $id );
			}
			break;
	}
}

if( $direct_link ) {
	echo '</div></a>';
} else {
	echo '</div></div>';
}