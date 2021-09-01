<!DOCTYPE html>
<html <?php language_attributes(); ?> style="overflow-x: hidden">
<head>
	<meta name="google-site-verification" content="h_J21dHZODy7HZmmnUsdH4Vc9qH4UlArgiwl4bUyK6M" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
<?php apex_favicon(); ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>

<!-- Hotjar Tracking Code for websolutions.co.il -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:876122,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

</head>

<body <?php body_class("scroll-assist parallax-2d"); ?> >

	<?php
	if(!is_singular('mtphr_gallery')){
		$settings = apex_section_settings();
		if( $settings['page_top'] == 'header' ) {
			get_template_part( 'templates/elements/header' );
		} elseif( $settings['page_top'] == 'hero' ) {
			get_template_part( 'templates/elements/hero' );
		}
	}
	?>
	
	<?php global $apex_general_settings; ?>

	<header id="site-navigation" class="apex-style-<?php echo $apex_general_settings['navigation_style']; ?>">
    <div id="site-navigation-contents">
      <div class="row">
      		<div class="container">
				<div class="col-md-3">
					<?php echo get_apex_menu_logo(); ?>
				</div>
				<a id="mobile-menu-toggle" href="#"><i class="apex-icon-mobile-menu"></i></a>
				<div class="col-md-8">
					<?php
					$args = array(
						'theme_location'		=> 'apex-primary-menu',
						'menu_class'				=> 'apex-primary-menu clearfix',
						'container'					=> 'nav',
						'container_class'		=> 'apex-primary-menu-container',
						'fallback_cb'				=> 'primary_menu_fallback',
						'walker'  					=> new Apex_Icon_Menu_Walker()
					);
					wp_nav_menu( $args );
					?>
				</div>
				<div class="col-md-1">
					<?php
					if ( ! dynamic_sidebar( 'top-widget' ) ) :
						echo dynamic_sidebar( 'top-widget' );
					endif;
					?>
				</div>
			</div><!-- .container -->
		</div>
    </div><!-- #site-navigation-contents -->
  </header><!-- #site-navigation -->
  
  <div id="wrapper">

		<div id="main" role="main">