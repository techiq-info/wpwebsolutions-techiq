<?php

/* --------------------------------------------------------- */
/* !Load the front end scripts - 2.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_posts_scripts() {
	
	// Load the css
	wp_register_style( 'ditty-posts-ticker', MTPHR_DNT_POSTS_URL.'assets/css/style.css', false, MTPHR_DNT_POSTS_VERSION );
	wp_enqueue_style( 'ditty-posts-ticker' );
}
add_action( 'wp_enqueue_scripts', 'mtphr_dnt_posts_scripts' );

