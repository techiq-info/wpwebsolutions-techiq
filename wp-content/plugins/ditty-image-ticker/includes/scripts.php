<?php

/* --------------------------------------------------------- */
/* !Load the back-end scripts - 2.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_admin_scripts( $hook ) {

	global $typenow;

	if( $typenow == 'ditty_news_ticker' ) {
		wp_register_style( 'ditty-image-ticker', MTPHR_DNT_IMAGE_URL.'assets/css/style-admin.css', false, MTPHR_DNT_IMAGE_VERSION );
		wp_enqueue_style( 'ditty-image-ticker' );
		wp_register_script( 'ditty-image-ticker', MTPHR_DNT_IMAGE_URL.'assets/js/script-admin.js', array('jquery'), MTPHR_DNT_IMAGE_VERSION, true );
		wp_enqueue_script( 'ditty-image-ticker' );
		wp_localize_script( 'ditty-image-ticker', 'mtphr_dnt_image_vars', array(
				'security' => wp_create_nonce( 'ditty-image-ticker' ),
				'ml_image_title' => __('Add Images', 'ditty-image-ticker'),
				'ml_image_button' => __('Insert as new tick(s)', 'ditty-image-ticker')
			)
		);
	}
}
add_action( 'admin_enqueue_scripts', 'mtphr_dnt_image_admin_scripts', 11 );



/* --------------------------------------------------------- */
/* !Load the front-end scripts - 2.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_scripts() {

	wp_register_style( 'ditty-image-ticker', MTPHR_DNT_IMAGE_URL.'assets/css/style.css', false, MTPHR_DNT_IMAGE_VERSION );
	wp_enqueue_style( 'ditty-image-ticker' );
}
add_action( 'wp_enqueue_scripts', 'mtphr_dnt_image_scripts' );

