<?php

/* --------------------------------------------------------- */
/* !Load the admin scripts - 2.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_posts_admin_scripts( $hook ) {
	
	global $typenow;

	if ( $typenow == 'ditty_news_ticker' ) {
	
		// Load the news ticker posts style
		wp_register_style( 'ditty-posts-ticker', MTPHR_DNT_POSTS_URL.'assets/css/style-admin.css', false, MTPHR_DNT_POSTS_VERSION );
		wp_enqueue_style( 'ditty-posts-ticker' );
		
		// Load the news ticker posts script
		wp_register_script( 'ditty-posts-ticker', MTPHR_DNT_POSTS_URL.'assets/js/script-admin.js', array( 'jquery' ), MTPHR_DNT_POSTS_VERSION, true );
		wp_enqueue_script( 'ditty-posts-ticker' );
	}
}
add_action( 'admin_enqueue_scripts', 'mtphr_dnt_posts_admin_scripts' );