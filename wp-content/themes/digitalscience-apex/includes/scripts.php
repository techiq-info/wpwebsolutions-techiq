<?php

/* --------------------------------------------------------- */
/* !Load the front end scripts - 1.1.0 */
/* --------------------------------------------------------- */

function apex_load_scripts() {

	global $wp_styles, $apex_general_settings;
	
	// Add comment reply scripts
	if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register bootstrap
  wp_register_style( 'bootstrap', APEX_URL.'/assets/bootstrap/css/bootstrap.min.css', false, APEX_VERSION );
  wp_enqueue_style( 'bootstrap' );
  wp_register_script( 'bootstrap', APEX_URL.'/assets/bootstrap/js/bootstrap.min.js', array('jquery'), APEX_VERSION, true );
  wp_enqueue_script( 'bootstrap' );


  	// Register Slick
  wp_register_style( 'slick-theme', APEX_URL.'/assets/css/slick-theme.css', false, APEX_VERSION );
  wp_enqueue_style( 'slick-theme' );
  wp_register_style( 'slick', APEX_URL.'/assets/css/slick.css', false, APEX_VERSION );
  wp_enqueue_style( 'slick' );
  wp_register_script( 'slick', APEX_URL.'/assets/js/slick.min.js', array('jquery'), APEX_VERSION, true );
  wp_enqueue_script( 'slick' );


	// Load the icon font
	wp_register_style( 'apex-font', APEX_URL.'/assets/fontastic/styles.css', false, APEX_VERSION );
  wp_enqueue_style( 'apex-font' );

	// Register modernizr
  wp_register_script( 'modernizr', APEX_URL.'/assets/js/modernizr-2.6.2.min.js', array('jquery'), APEX_VERSION );
  wp_enqueue_script( 'modernizr' );

	// Load google webfont.js
	wp_register_script( 'webfont', 'http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js', false, APEX_VERSION, false );
	wp_enqueue_script( 'webfont' );

  // Easing scripts
  wp_register_script( 'jquery-easing', APEX_URL.'/assets/js/jquery.easing.1.3.js', array('jquery'), APEX_VERSION, true );
  wp_enqueue_script( 'jquery-easing' );
  
  // Animate & WOW scripts
  wp_register_style( 'animate', APEX_URL.'/assets/css/animate.min.css', false, APEX_VERSION );
	wp_enqueue_style( 'animate' );
  wp_register_script( 'wow', APEX_URL.'/assets/js/wow.min.js', array('jquery'), APEX_VERSION, true );
  wp_enqueue_script( 'wow' );
  
  // Parallax scripts
  wp_register_script( 'mtphr-parallax', APEX_URL.'/assets/mtphr-parallax/mtphr-parallax.js', array('jquery'), APEX_VERSION, true );
  wp_enqueue_script( 'mtphr-parallax' );
  
  // Fitvids scripts
  wp_register_script( 'fitvids', APEX_URL.'/assets/js/jquery.fitvids.min.js', array('jquery'), APEX_VERSION, true );
  wp_enqueue_script( 'fitvids' );


  //Jes 
  //Added parallax for portfolio
  //5 12 17
  //  jquery.parallax-1.1.3  jquery.scrollTo-1.4.2-min
  wp_register_script( 'jquery-parallax', APEX_URL.'/assets/js/jquery.parallax-1.1.3.js', array('jquery'), APEX_VERSION, true );
  wp_enqueue_script( 'jquery-parallax' );

  wp_register_script( 'jquery-scrollTo', APEX_URL.'/assets/js/jquery.scrollTo-1.4.2-min.js', array('jquery'), APEX_VERSION, true );
  wp_enqueue_script( 'jquery-scrollTo' );
	
	//wp_register_script( 'mtphr-gallery', APEX_URL.'/assets/js/mtphr-gallery.js', array('jquery', 'isotope', 'images-loaded'), APEX_VERSION, true );
	//wp_enqueue_script( 'mtphr-gallery' );
  
  // Register the theme scripts
  $settings = apex_section_settings( true );
  wp_register_style( 'apex', APEX_URL.'/style.css', false, APEX_VERSION );
  wp_enqueue_style( 'apex' );
	if( is_rtl() ) {
	  wp_register_style( 'apex-rtl', APEX_URL.'/rtl.css', false, APEX_VERSION );
		wp_enqueue_style( 'apex-rtl' );
  }
  if( $apex_general_settings['color'] != '' ) {
	  wp_register_style( 'apex-color', APEX_URL.'/assets/css/colors/'.$apex_general_settings['color'].'.css', false, APEX_VERSION );
		wp_enqueue_style( 'apex-color' );
  }
  
  // Load metaphor gallery scripts
	wp_register_script( 'images-loaded', APEX_URL.'/assets/js/imagesloaded.pkgd.min.js', array('jquery'), APEX_VERSION, true );
	wp_enqueue_script( 'images-loaded' );
	
	wp_register_script( 'isotope', APEX_URL.'/assets/js/isotope.pkgd.min.js', array('jquery', 'images-loaded'), APEX_VERSION, true );
	wp_enqueue_script( 'isotope' );

  wp_register_script( 'apex', APEX_URL.'/assets/js/script.js', array('jquery'), APEX_VERSION, true );
  wp_enqueue_script( 'apex' );
  wp_localize_script( 'apex', 'apex_vars', array(
  		'security' => wp_create_nonce( 'apex' ),
			'home_url' => get_home_url(),
			'page_title' => get_the_title(),
			'menu_scroll' => true,
			'hide_nav' => $settings['autohide_nav'],
			'is_rtl' => is_rtl()
		)
	);
	
	// Force composer styles to load
	wp_enqueue_style( 'js_composer_front' );


	// JES - custom banner from tympanus

	 // Easing scripts

	wp_register_script( 'EasePack.min', APEX_URL.'/assets/js/EasePack.min.js', array('jquery'), APEX_VERSION, true );
	wp_enqueue_script( 'EasePack.min' );
	wp_register_script( 'TweenLite.min', APEX_URL.'/assets/js/TweenLite.min.js', array('jquery'), APEX_VERSION, true );
	wp_enqueue_script( 'TweenLite.min' );
	wp_register_script( 'custom-banner-tympa', APEX_URL.'/assets/js/custom-banner-tympa.js', array('jquery'), APEX_VERSION, true );
	wp_enqueue_script( 'custom-banner-tympa' );
  
}
add_action( 'wp_enqueue_scripts', 'apex_load_scripts' );


/* --------------------------------------------------------- */
/* !Add the ajaxurl to the frontend - 1.0.0 */
/* --------------------------------------------------------- */

function apex_ajaxurl() {
	?>
	<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>
	<?php
}
add_action( 'wp_head', 'apex_ajaxurl' );


/* --------------------------------------------------------- */
/* !Initiate scripts - 1.0.0 */
/* --------------------------------------------------------- */

function apex_class_scripts() {
	?>
	<script type="text/javascript">
		
		jQuery( document ).ready( function($) {
			(function() {
		    "use strict";
				var wow = new WOW({
					offset: 150,
					mobile: false
				});
				wow.init();		
				$('html.no-touch *[data-mtphr-parallax-speed]').mtphr_parallax();
				//$('.mtphr-gallery').mtphr_gallery();
				$('article').fitVids();
			}());
		});
		
		jQuery( window ).load( function() {
			(function() {
		    "use strict"; 
			  <?php
			  $settings = apex_section_settings();
			  if( $settings['hero_rotator'] != 'none' && get_post($settings['hero_rotator']) && $settings['hero_bg_rotator'] != 'none' && get_post($settings['hero_bg_rotator']) ) { ?> 
			  	jQuery('#hero-rotator .mtphr-dnt').on('mtphr_dnt_before_change_single', function( e, vars ) {
						jQuery('#hero-bg-rotator .mtphr-dnt').trigger('mtphr_dnt_goto', [vars.next_tick]);
					});
			  <?php } ?>	
			}());
		});
		
	</script>
	<?php
}
add_action( 'wp_footer', 'apex_class_scripts', 20 );



/* --------------------------------------------------------- */
/* !Add the custom javascript - 1.0.0 */
/* --------------------------------------------------------- */

function apex_custom_scripts() {

	global $apex_general_settings;

	if( $apex_general_settings['scripts'] != '' ) {
		$allowed_html = array(
			'script' => array(
				'type' => array(),
				'src' => array(),
				'language' => array()
			)
		);
		echo wp_kses( $apex_general_settings['scripts'], $allowed_html );
	}
}
add_action( 'wp_footer', 'apex_custom_scripts', 11 );

