<?php get_header(); ?>

<?php global $apex_page_type; ?>

<?php global $apex_general_settings; ?>

<section id="<?php echo $apex_general_settings['section_id_prefix']; ?><?php echo $apex_page_type; ?>" <?php apex_section_class(); ?> <?php apex_parallax_attribute(); ?>>

	<div class="apex-section-overlay"></div>
	
	<div class="apex-section-inner">
	
		<div class="container">
			
			<?php get_template_part( 'templates/layouts/container', 'top' ); ?>
			
			<?php while ( have_posts() ) : the_post(); ?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
					$post_type = get_post_type();
					if( $post_type == 'post' ) {
						get_template_part( 'templates/post/content', get_post_format() );
					} else {
						get_template_part( 'templates/content', $post_type );
					}
					?>
				</article>
			
			<?php endwhile; // end of the loop. ?>
			
			<?php apex_post_archive_navigation(); ?>
			
			<?php get_template_part( 'templates/layouts/container', 'bottom' ); ?>
		
		</div>
		
	</div>

</section>

<?php get_footer(); ?>