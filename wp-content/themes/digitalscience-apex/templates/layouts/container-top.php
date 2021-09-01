<?php $settings = apex_section_settings(); ?>

<?php if( is_singular() && get_post_type() == 'mtphr_gallery' ) {
	echo '<div class="entry-featured">';
		$args['slider_layout'] = array( 'gallery', 'navigation' );
		echo get_mtphr_gallery( get_the_id(), false, false, $args );
	echo '</div>';
} ?>


<div <?php apex_content_class('row'); ?> <?php apex_wow_attributes(); ?>>

<?php if( ($settings['layout'] == 'sidebar-left' && $settings['sidebar_pull'] != 'below') || ($settings['layout'] == 'sidebar-right' && $settings['sidebar_pull'] == 'above') ) {
	include( get_template_directory().'/sidebar.php');
} ?>
<div <?php echo apex_primary_class( 'primary' ); ?>>