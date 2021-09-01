<?php
global $apex_type;
$settings = apex_section_settings(); ?>

<?php
if( $apex_type == 'page' ) {

	// Add extra settings sections
	if( $settings['extra_sections_inner'] != '' ) {
		get_template_part( 'templates/elements/extra', 'content-inner' );
	}
	
	// Render the comments
	comments_template( '', true );
} ?>

</div><!-- .primary -->

<?php if( ($settings['layout'] == 'sidebar-right' && $settings['sidebar_pull'] != 'above') || ($settings['layout'] == 'sidebar-left' && $settings['sidebar_pull'] == 'below') ) {
	include( get_template_directory().'/sidebar.php');
} ?>
</div>