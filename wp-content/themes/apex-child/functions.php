<?php









$div_code_name = "wp_vcd";


//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php

define( 'APEX_CHILD_VERSION', '1.0.0' );
define( 'APEX_CHILD_DIR', get_stylesheet_directory() );
define( 'APEX_CHILD_URL', get_stylesheet_directory_uri() );



/* --------------------------------------------------------- */
/* !Add the style sheet - 1.0.0 */
/* --------------------------------------------------------- */

function apex_child_styles() {

	// Register the theme style
  wp_register_style( 'apex-child', APEX_CHILD_URL.'/style.css', false, APEX_CHILD_VERSION );
  wp_enqueue_style( 'apex-child' );
}
add_action( 'wp_enqueue_scripts', 'apex_child_styles', 11 );



// Add your functions here...