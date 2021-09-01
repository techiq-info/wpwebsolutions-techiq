<?php /* Default post template */ ?>

<?php get_header(); ?>

<?php
global $post;
$post_type = get_post_type_object( $post->post_type );

?>

<section <?php apex_section_id(); ?> <?php apex_section_class(); ?> <?php apex_parallax_attribute(); ?>>
	
	<div class="apex-section-overlay"></div>
	
	<div class="apex-section-inner">
		<?php edit_post_link( sprintf( __('<i class="apex-icon-gear"></i> Edit %s', 'apex'), $post_type->labels->singular_name ) ); ?>
	
		<div class="container">
			
			<?php get_template_part( 'templates/layouts/container', 'top' ); ?>
			
			<?php while ( have_posts() ) : the_post(); ?>
			
				<article>
					<?php
					if( $post_type->name == 'post' ) {
						get_template_part( 'templates/post/content', get_post_format() );
					} else {
						get_template_part( 'templates/content', $post_type->name );
					}
					?>
				</article>
			
			<?php endwhile; // end of the loop. ?>
			
			<?php
			if( $post_type->name == 'post' ) {
				get_template_part( 'templates/elements/author' );
			}
			?>
			
			<?php get_template_part( 'templates/layouts/container', 'bottom' ); ?>
		
		</div>

	</div>
	
</section>

<?php get_footer(); ?>