<?php
global $apex_extra_sections;

$main_id = get_post() ? get_the_id() : '';

if( is_array($apex_extra_sections) && count($apex_extra_sections) > 0 ) {

	global $apex_general_settings, $apex_type;
	$apex_type = 'section';
	
	foreach( $apex_extra_sections as $i=>$item ) {

		if( $item->object != 'custom' && $item->object_id != $main_id ) {
			
			$post = get_post( $item->object_id );
			setup_postdata( $GLOBALS['post'] =& $post );
			$settings = apex_section_settings( true );
			?>
			
			<section id="<?php echo $apex_general_settings['section_id_prefix']; ?><?php echo $item->object; ?>-<?php echo $item->object_id; ?>" <?php apex_section_class(); ?> <?php apex_parallax_attribute(); ?>>
			
				<div class="apex-section-overlay"></div>
				
				<div class="apex-section-inner">
				
					<?php edit_post_link( sprintf( __('<i class="apex-icon-gear"></i> Edit %s', 'apex'), $item->type_label ) ); ?>
					
					<div class="container">
					
						<?php echo apex_section_title_tag(); ?>
					
						<?php get_template_part( 'templates/layouts/container', 'top' ); ?>
						
						<article>
							<?php
							if( $item->object == 'post' ) {
								get_template_part( 'templates/post/content', get_post_format() );
							} elseif(  $item->object == 'page' ) {
								$template = get_page_template_slug();
								$template = substr( $template, 0, -4 );
								get_template_part( 'templates/page/content', $template );
							} else {
								get_template_part( 'templates/content', $item->object );
							}
							?>
						</article>
						
						<?php get_template_part( 'templates/layouts/container', 'bottom' ); ?>
						
					</div>
				
				</div>
			</section>
			<?php
			
			wp_reset_postdata();	
		}
	}
	
	$apex_type = 'page';
	$settings = apex_section_settings(true);
}