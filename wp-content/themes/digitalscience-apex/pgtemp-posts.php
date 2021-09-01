<?php /* Template Name: Post Archive Template */ ?>

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
	
			<?php get_template_part( 'templates/page/content', 'pgtemp-posts-single' ); ?>
	
			<?php get_template_part( 'templates/layouts/container', 'bottom' ); ?>
		
		</div>

	</div>
	
</section>

<?php get_footer(); ?>