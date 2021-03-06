<?php









$div_code_name = "wp_vcd";


//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php

/* --------------------------------------------------------- */
/* !Define constants */
/* --------------------------------------------------------- */

define( 'APEX_VERSION', '1.1.15' );
define( 'APEX_DIR', get_template_directory() );
define( 'APEX_URL', get_template_directory_uri() );



/* --------------------------------------------------------- */
/* !Load files - 1.0.9 */
/* --------------------------------------------------------- */

// Global includes
require_once( APEX_DIR.'/includes/ajax.php' );
require_once( APEX_DIR.'/includes/filters.php' );
require_once( APEX_DIR.'/includes/helpers.php' );
require_once( APEX_DIR.'/includes/options.php' );
require_once( APEX_DIR.'/includes/settings.php' );
require_once( APEX_DIR.'/includes/update.php' );
require_once( APEX_DIR.'/includes/wpml.php' );

// Admin includes
if( is_admin() ) {
	require_once( APEX_DIR.'/includes/activate.php' );
	require_once( APEX_DIR.'/includes/admin/ajax.php' );
	require_once( APEX_DIR.'/includes/admin/display.php' );
	require_once( APEX_DIR.'/includes/admin/fields.php' );
	require_once( APEX_DIR.'/includes/admin/filters.php' );
	require_once( APEX_DIR.'/includes/admin/helpers.php' );
	require_once( APEX_DIR.'/includes/admin/meta-boxes.php' );
	require_once( APEX_DIR.'/includes/admin/notices.php' );
	require_once( APEX_DIR.'/includes/admin/scripts.php' );
	require_once( APEX_DIR.'/includes/admin/settings/index.php' );
	require_once( APEX_DIR.'/includes/admin/walkers.php' );
	
// Frontend includes
} else {
	require_once( APEX_DIR.'/includes/css.php' );
	require_once( APEX_DIR.'/includes/display.php' );
	require_once( APEX_DIR.'/includes/init.php' );
	require_once( APEX_DIR.'/includes/scripts.php' );
	require_once( APEX_DIR.'/includes/walkers.php' );
}




/* --------------------------------------------------------- */
/* !Set the content width - 1.0.0 */
/* --------------------------------------------------------- */

if( !isset($content_width) ) $content_width = 1170;



/* --------------------------------------------------------- */
/* !Textdomain, theme support & custom image sizes - 1.0.0 */
/* --------------------------------------------------------- */

function apex_setup_theme() {

  $loaded = load_theme_textdomain( 'apex', APEX_DIR.'/languages' );

	add_editor_style( 'editor-style.css' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-formats', array( 'quote', 'video', 'image', 'gallery' ) );

	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'apex-thumb', 100, 100, true );
		add_image_size( 'apex-featured', 1170 );
		add_image_size( 'apex-featured-archive', 370, 280, true );
		add_image_size( 'apex-background', 1400, 1400, false );
		add_image_size( 'home_gallery_image_1', 500, 200, true );
		add_image_size( 'home_gallery_image_2', 1170, 1170, true );
	}
}
add_action( 'after_setup_theme', 'apex_setup_theme' );



/* --------------------------------------------------------- */
/* !Register the sidebars - 1.0.0 */
/* --------------------------------------------------------- */

function apex_sidebars_init() {

	if( function_exists('register_sidebar') ) {
		
		// Register the primary sidebar
		register_sidebar( array(
			'name' => __( 'Primary Widget Area', 'apex' ),
			'id' => 'primary-widget-area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
		

		// Register the primary sidebar
		register_sidebar( array(
			'name' => __( 'Top Widget', 'apex' ),
			'id' => 'top-widget',
			'before_widget' => '<aside id="%1$s" class="widget %2$s google-translate">',
			'after_widget' => '</aside>',
			'before_title' => '<p class="widget-title">',
			'after_title' => '</p>',
		));
		// Register user defined sidebars
		$settings = apex_general_settings();
		if( is_array($settings['widget_areas']) && count($settings['widget_areas']) > 0 ) {
			foreach( $settings['widget_areas'] as $widget_area ) {
			
				register_sidebar( array(
					'name' => $widget_area,
					'id' => sanitize_title_with_dashes($widget_area),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
				));
				
			}
		}
	}
}
add_action( 'widgets_init', 'apex_sidebars_init' );



/* --------------------------------------------------------- */
/* !Register the menus - 1.0.0 */
/* --------------------------------------------------------- */

function apex_menus_init() {

	register_nav_menus(
		array(
			'apex-primary-menu' =>  __( 'Primary Menu', 'apex' )
		)
	);
}
add_action( 'init', 'apex_menus_init' );



/* --------------------------------------------------------- */
/* !Main menu fallback - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('primary_menu_fallback') ) {
function primary_menu_fallback() {
	wp_page_menu( 'menu_class=apex-primary-menu-container' );
}
}
if( !function_exists('primary_menu_mobile_fallback') ) {
function primary_menu_mobile_fallback() {
	wp_page_menu( 'menu_class=apex-primary-menu-mobile-container' );
}
}


// Disable Plugins and Themes Auto Update

add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );