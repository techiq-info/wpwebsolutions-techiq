<?php

/* --------------------------------------------------------- */
/* !Load the admin scripts - 1.0.0 */
/* --------------------------------------------------------- */

function apex_admin_scripts( $hook ) {

	global $typenow, $wp_styles;
	
	wp_register_style( 'apex', APEX_URL.'/assets/css/admin/style.css', false, APEX_VERSION );
	wp_enqueue_style( 'apex' );

	if( $hook == 'nav-menus.php' ) {
		wp_register_style( 'apex-menus', APEX_URL.'/assets/css/admin/menus.css', false, APEX_VERSION );
		wp_enqueue_style( 'apex-menus' );
		wp_register_script( 'apex-menus', APEX_URL.'/assets/js/admin/menus.js', false, APEX_VERSION, true );
		wp_enqueue_script( 'apex-menus' );
	}
	
	if( $hook == 'appearance_page_apex' || $hook == 'post.php' || $hook == 'post-new.php' || $hook == 'nav-menus.php' ) {

		// Load scipts for the media uploader
		if( function_exists('wp_enqueue_media') ) {
	    wp_enqueue_media();
		} else {
	    wp_enqueue_script( 'media-upload' );
		}
		
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-mouse' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-tabs' );

		// Load google webfont.js
		wp_register_script( 'webfont', 'http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js', false, APEX_VERSION, true );
		wp_enqueue_script( 'webfont' );
		
		// Load the jquery ui stylesheet
		wp_register_style( 'jquery-ui-smoothness', '//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css', false, APEX_VERSION );
	  wp_enqueue_style( 'jquery-ui-smoothness' );

		// Load the icon font
		wp_register_style( 'apex-font', APEX_URL.'/assets/fontastic/styles.css', false, APEX_VERSION );
	  wp_enqueue_style( 'apex-font' );

		// Load the MiniColors plugin
		wp_register_style( 'minicolors', APEX_URL.'/assets/css/admin/jquery.minicolors.css', false, APEX_VERSION );
		wp_enqueue_style( 'minicolors' );
		wp_register_script( 'minicolors', APEX_URL.'/assets/js/admin/jquery.minicolors.min.js', array('jquery'), APEX_VERSION, true );
		wp_enqueue_script( 'minicolors' );

		// Load the CodeMirror plugin
		wp_register_style( 'codemirror', APEX_URL.'/assets/css/admin/codemirror.css', false, APEX_VERSION );
		wp_enqueue_style( 'codemirror' );
		wp_register_script( 'codemirror', APEX_URL.'/assets/js/admin/codemirror.js', array('jquery'), APEX_VERSION, true );
		wp_enqueue_script( 'codemirror' );
		wp_register_script( 'codemirror-css', APEX_URL.'/assets/js/admin/codemirror/css.js', array('jquery', 'codemirror'), APEX_VERSION, true );
		wp_enqueue_script( 'codemirror-css' );
		wp_register_script( 'codemirror-javascript', APEX_URL.'/assets/js/admin/codemirror/javascript.js', array('jquery', 'codemirror'), APEX_VERSION, true );
		wp_enqueue_script( 'codemirror-javascript' );
		wp_register_script( 'codemirror-xml', APEX_URL.'/assets/js/admin/codemirror/xml.js', array('jquery', 'codemirror'), APEX_VERSION, true );
		wp_enqueue_script( 'codemirror-xml' );
		wp_register_script( 'codemirror-htmlmixed', APEX_URL.'/assets/js/admin/codemirror/htmlmixed.js', array('jquery', 'codemirror'), APEX_VERSION, true );
		wp_enqueue_script( 'codemirror-htmlmixed' );
		
		// Easing scripts
	  wp_register_script( 'jquery-easing', APEX_URL.'/assets/js/jquery.easing.1.3.js', array('jquery'), APEX_VERSION, true );
	  wp_enqueue_script( 'jquery-easing' );

		// Load the admin scripts
		wp_register_script( 'apex', APEX_URL.'/assets/js/admin/script.js', false, APEX_VERSION, true );
		wp_enqueue_script( 'apex' );
		wp_localize_script( 'apex', 'apex_vars', array(
				'security' => wp_create_nonce( 'apex' ),
				'img_title' => __( 'Upload or select an image', 'apex' ),
				'img_button' => __( 'Use Image', 'apex' ),
				'remove_widgets' => __( 'Are you sure you want to delete all existing widgets?', 'apex' )
			)
		);
	}
}
add_action( 'admin_enqueue_scripts', 'apex_admin_scripts' );



/* --------------------------------------------------------- */
/* !Add the page icons modal - 1.1.0 */
/* --------------------------------------------------------- */

function apex_page_icons() {
	
	global $pagenow;

	if( ($pagenow == 'post.php' || $pagenow == 'post-new.php' || $pagenow == 'nav-menus.php') && function_exists('mtphr_shortcodes_modal') && function_exists('mtphr_shortcodes_icon_admin_display') ) {

		$content = '<div id="apex-icon-selects">';
			$content .= mtphr_shortcodes_icon_admin_display();
		$content .= '</div>';
		
		$args = array(
			'id' => 'apex-page-icons-modal',
			'title' => __('Select an icon', 'apex'),
			'button' => __('Use icon', 'apex')
		);			
		mtphr_shortcodes_modal( $content, $args );
	}
}
add_action( 'admin_footer', 'apex_page_icons' );
