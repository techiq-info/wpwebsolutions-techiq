<?php

/* --------------------------------------------------------- */
/* !Add the posts type to the ticker - 2.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_posts_type( $types ) {
	$types['posts'] = array(
		'button' => __('Posts', 'ditty-posts-ticker'),
		'metabox_id' => 'mtphr-dnt-posts-metabox',
		'icon' => 'dashicons dashicons-admin-post'
	);
	return $types;
}
add_filter( 'mtphr_dnt_types', 'mtphr_dnt_posts_type' );
