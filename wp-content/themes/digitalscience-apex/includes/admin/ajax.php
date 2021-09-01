<?php

/* --------------------------------------------------------- */
/* !Display a single image field via ajax - 1.0.0 */
/* --------------------------------------------------------- */

function apex_single_image_ajax() {

	// Get access to the database
	global $wpdb;

	// Check the nonce
	check_ajax_referer( 'apex', 'security' );

	// Get variables
	$attachment = $_POST['attachment'];

	// Display the image
	if( $attachment['type'] == 'image' ) {
		apex_render_single_image( $attachment['id'] );
	}

	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_apex_single_image_ajax', 'apex_single_image_ajax' );


/* --------------------------------------------------------- */
/* !Reset the typography field - 1.0.0 */
/* --------------------------------------------------------- */

function apex_typography_settings_reset() {

	global $wpdb;
	check_ajax_referer( 'apex', 'security' );
	
	$id = $_POST['id'];
	$defaults = apex_typography_settings_defaults();
	echo json_encode( $defaults[$id] );

	die();
}
add_action( 'wp_ajax_apex_typography_settings_reset', 'apex_typography_settings_reset' );


/* --------------------------------------------------------- */
/* !Import widgets - 1.0.0 */
/* --------------------------------------------------------- */

function apex_widget_import_ajax() {

	// Get access to the database
	global $wpdb;

	// Check the nonce
	check_ajax_referer( 'apex', 'security' );

	// Get variables
	$remove_existing = $_POST['remove_existing'];

	if( $remove_existing == 'true' ) {		
		apex_remove_widgets();
	}
	apex_import_widgets();

	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_apex_widget_import_ajax', 'apex_widget_import_ajax' );


/* --------------------------------------------------------- */
/* !Member widgets setup - 1.0.0 */
/* --------------------------------------------------------- */

function apex_member_widgets_setup_ajax() {

	// Get access to the database
	global $wpdb;

	// Check the nonce
	check_ajax_referer( 'apex', 'security' );

	apex_member_widgets_setup();

	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_apex_member_widgets_setup_ajax', 'apex_member_widgets_setup_ajax' );


