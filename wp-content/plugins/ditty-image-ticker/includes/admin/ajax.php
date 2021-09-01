<?php

/* --------------------------------------------------------- */
/* !Display a gallery image field via ajax - 1.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_data_image_ajax() {

	// Get access to the database
	global $wpdb;

	// Check the nonce
	check_ajax_referer( 'ditty-image-ticker', 'security' );

	// Get variables
	$attachments = $_POST['attachments'];

	// Display the files
	foreach( $attachments as $attachment ) {
		if( $attachment['type'] == 'image' ) {

			$data = array(
				'image' => $attachment['id'],
				'title' => $attachment['title'],
				'description' => $attachment['description'],
				'link' => $attachment['link'],
			);
			mtphr_dnt_image_render_fields( $data );
		}
	}

	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_mtphr_dnt_data_image_ajax', 'mtphr_dnt_data_image_ajax' );