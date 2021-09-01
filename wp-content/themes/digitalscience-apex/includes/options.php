<?php

/* --------------------------------------------------------- */
/* !Update site options - 1.0.7 */
/* --------------------------------------------------------- */

function apex_update_site_options() {

	$latest_version = get_option( 'apex_version', '1.0.0' );
	
	// Update the icon classes
	if( version_compare($latest_version, '1.0.7', '<') ) {

		// Update the icons
		apex_update_icons();
		
		// Update the latest version
		update_option( 'apex_version', '1.0.7' ); 
	}
}
add_action( 'admin_init', 'apex_update_site_options' );



/* --------------------------------------------------------- */
/* !Update the icon classes - 1.0.7 */
/* --------------------------------------------------------- */

if( !function_exists('apex_update_icons') ) {
function apex_update_icons() {

	if( function_exists('mtphr_shortcodes_parse_fontastic_css') ) {
	
		$stylesheet = APEX_DIR.'/assets/fontastic/styles.css';
		$data = mtphr_shortcodes_parse_fontastic_css( $stylesheet );
		
		// Update the icons
		update_option( 'apex_icons', $data );	
	}
}
}