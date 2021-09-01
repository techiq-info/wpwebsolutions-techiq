<?php global $apex_general_settings; ?>

<?php get_header(); ?>

<section <?php apex_section_class(); ?> <?php apex_parallax_attribute(); ?>>
	
	<div class="apex-section-overlay"></div>
	
	<div class="apex-section-inner">
	
		<div class="container">
			
			<?php get_template_part( 'templates/layouts/container', 'top' ); ?>
			
			<article>
				<?php echo wpautop(convert_chars(wptexturize($apex_general_settings['error']))); ?>
				<?php get_search_form(); ?>
			</article>
			
			<?php get_template_part( 'templates/layouts/container', 'bottom' ); ?>
		
		</div>

	</div>
	
</section>

<?php get_footer(); ?>