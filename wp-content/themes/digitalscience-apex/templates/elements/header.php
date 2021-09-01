<?php
global $post, $apex_page_type, $apex_general_settings;
$settings = apex_section_settings();
$header_id = $apex_page_type;
if( is_singular() ) {
	$header_id .= '-'.$post->ID;
}
?>

<div id="<?php echo $apex_general_settings['section_id_prefix']; ?><?php echo $header_id; ?>-header" <?php apex_header_class(); ?> <?php apex_parallax_attribute('header_bg'); ?>>
    	
	<!-- Background pattern overlay -->
  <div class="apex-section-overlay"></div>

  <div class="apex-section-inner">
    <div class="container">

    	<?php echo apex_section_title_tag(); ?>
      
      <?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs">','</p>');
			} ?>

    </div><!-- .container -->
  </div><!-- .apex-section-inner -->
</div><!-- .apex-section -->