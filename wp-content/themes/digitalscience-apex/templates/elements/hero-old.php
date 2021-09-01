<?php
global $post, $apex_page_type, $apex_general_settings;
$settings = apex_section_settings();
$hero_id = $apex_page_type;
if( is_singular() ) {
	$hero_id .= '-'.$post->ID;
}
?>

<div id="<?php echo $apex_general_settings['section_id_prefix']; ?><?php echo $hero_id; ?>-hero" <?php apex_hero_class(); ?> <?php apex_parallax_attribute('hero_bg'); ?>>
	<div id="apex-hero-inner">
	
		<?php apex_hero_bg_rotator(); ?>
	
	  <div id="apex-hero-gradient"></div>
    <div id="apex-hero-overlay"></div>
	    
		<div class="container">
			<div class="apex-hero-content">
				
				<?php apex_hero_logo(); ?>
				<?php apex_hero_rotator(); ?>
				
				<?php
				if($settings['hero_menu'] != 'none' ) {
					$args = array(
						'menu'							=> $settings['hero_menu'],
						'menu_class'				=> 'apex-hero-menu clearfix',
						'container'					=> 'nav',
						'container_class'		=> 'apex-hero-menu-container apex-hero-element',
						'walker'  					=> new Apex_Icon_Menu_Walker()
					);
					wp_nav_menu( $args );
				}
				?>
			</div>
		</div>
	</div>
</div>