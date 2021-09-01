<?php

/* --------------------------------------------------------- */
/* !Load a gallery via ajax - 1.0.4 */
/* --------------------------------------------------------- */

function apex_load_gallery_ajax() {

	// Get access to the database
	global $wpdb, $postid, $mtphr_galleries_scripts;

	// Check the nonce
	check_ajax_referer( 'apex', 'security' );
	
	// Get variables
	$postid = $_POST['postid'];
	
	// Create a data array
	$data = array();	
	ob_start();
	get_template_part( 'templates/elements/mtphr', 'gallery' );
	$data['html'] = ob_get_clean();
	if( is_array($mtphr_galleries_scripts) && count($mtphr_galleries_scripts) > 0  ) {
		$data['settings'] = $mtphr_galleries_scripts[0];
	}
	
	echo json_encode( $data );

	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_apex_load_gallery_ajax', 'apex_load_gallery_ajax' );
add_action( 'wp_ajax_nopriv_apex_load_gallery_ajax', 'apex_load_gallery_ajax' );


/*
function apex_gallery_json( $id ) {

	// Get access to the database
	global $postid, $mtphr_galleries_scripts;
	
	$postid = $id;
	
	// Create a data array
	$data = array();	
	ob_start();
	get_template_part( 'templates/elements/mtphr', 'gallery' );
	$data['html'] = ob_get_clean();
	if( is_array($mtphr_galleries_scripts) && count($mtphr_galleries_scripts) > 0  ) {
		$data['settings'] = $mtphr_galleries_scripts[0];
	}
	
	echo "<input type='hidden' value='".json_encode( $data )."' />";
}
*/



/* --------------------------------------------------------- */
/* !Load more gallery blocks via ajax - 1.1.0 */
/* --------------------------------------------------------- */

function apex_gallery_load_more_ajax() {

	// Get access to the database
	global $wpdb, $postid, $added_ids;

	// Check the nonce
	check_ajax_referer( 'apex', 'security' );
	
	// Get variables
	$postid = $_POST['postid'];
	$added_ids = $_POST['added_ids'];
	
	get_template_part( 'templates/elements/mtphr', 'gallery-blocks' );

	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_apex_gallery_load_more_ajax', 'apex_gallery_load_more_ajax' );
add_action( 'wp_ajax_nopriv_apex_gallery_load_more_ajax', 'apex_gallery_load_more_ajax' );



/* --------------------------------------------------------- */
/* !Load extra sidebars - 1.0.0 */
/* --------------------------------------------------------- */

function apex_sidebar_ajax() {

	// Get access to the database
	global $wpdb;

	// Check the nonce
	check_ajax_referer( 'apex', 'security' );
	
	// Get variables
	$postid = $_POST['postid'];
	
	$post = get_post( $postid );
	setup_postdata( $GLOBALS['post'] =& $post );
	
	get_sidebar();
	
	wp_reset_postdata();

	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_apex_sidebar_ajax', 'apex_sidebar_ajax' );

