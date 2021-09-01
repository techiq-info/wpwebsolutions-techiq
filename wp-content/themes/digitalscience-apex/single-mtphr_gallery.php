<?php /* Default post template */ ?>

<?php get_header(); ?>

<div id="<?php echo $apex_general_settings['section_id_prefix']; ?><?php echo $header_id; ?>-header" <?php apex_header_class(); ?> <?php apex_parallax_attribute('header_bg'); ?>>
    	
	<!-- Background pattern overlay -->
  <div class="apex-section-overlay"></div>

<section class="iconix-banner" style="background: url(<?php echo get_field('banner_image'); ?>); background-position: center; background-size: cover; background-repeat: no-repeat;">
	<div class="container">
		<div class="row">
			<div class="inner-content">
				<h1><?php echo get_the_title(); ?></h1>
				<p><?php echo get_field('banner_content'); ?></p>
			</div>
		</div>
	</div>
</section>
</div>
<section class="iconix-slider">
	<div class="container">
		<div class="slider-frame">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/frame.png" class="img-responsive">
			<span class="image-bg">
				<span class="image-shop-scroll" style="background: url(<?php echo get_field('banner_laptop_image'); ?>); background-size: cover; background-position: center 0; background-repeat: no-repeat;"></span>
			</span>
		</div>
		<div class="mobile-frame">
			<img src="<?php echo get_field('laptop_image_mobile'); ?>" class="img-responsive">
		</div>
	</div>
</section>
<section class="about-project" style="background: url(<?php echo get_field('about_background_image'); ?>);background-position-x: 0%; background-position-y: 0%; background-position: center; background-size: contain; background-repeat: no-repeat;">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="about-content");>
					<h2>About this Project</h2>
					<p><?php echo get_field('about_content'); ?></p>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="about-image">
					<img src="<?php echo get_field('about_image'); ?>" class="img-responsive">
				</div>
			</div>
		</div>
	</div>
</section>
<div class="">
<section class="what-to-find" style="background: <?php echo get_field('left_triangle_color'); ?>">
	<div class="container">
		<div class="row">
			<div class="what-to-find-content">
				<h1>Want to find <br>out more about our <br>services?</h1>
				<a href="#" class="button-trans">contact us</a>
			</div>
		</div>
	</div>
</section>
<section class="end-to-end" style="background: url(<?php echo get_field('about_right_triangle_image'); ?>); background-position: 100%">
	<div class="container">
		<div class="row">
			<div class="what-to-find-content text-right">
				<h1>End-to-End Web <br>Development and Marketing <br>Services</h1>
				<p>Web Solutions centralizes on professional interactive development <br>and ecommerce solutions</p>
				<a href="#" class="button-trans">learn more</a>
			</div>
		</div>
	</div>
</section>  
</div>
<section class="the-result clearfix" style="background: url(<?php echo get_field('about_background_image'); ?>);">
			<div class="product-frame-image">
				<img src="<?php echo get_field('result_laptop_image'); ?>" class="img-responsive" class="img-responsive">
			</div>
			<div class="col-sm-6 pull-right">
				<div class="the-result-content">
					<h1>the results</h1>
					<p><?php echo get_field('result_content'); ?></p>
					<a href="#">Request a Quote</a>
				</div>
			</div>
</section>


<?php
$args = array(
	'post_type'	=> 'mtphr_gallery',
	'posts_per_page'	=> -1,
	'orderby'	=> 'rand',
	'post__not_in'	=> array(get_the_id())
);

// print_r($args);

$query = new WP_Query($args);

if($query->have_posts()): ?>

	<section class="protfolio-design-slider">
		<div class="container">
			<div class="row">
				<div class="heading-portfolio-design">
					<h1>View Amazing Web Development <br>Portfolio Designs from Web Solutions</h1>
				</div>
				<div class="protfolio-silde">
				  	<?php while($query->have_posts()): $query->the_post();
				  		$terms = ( get_the_terms( get_the_id(), 'mtphr_gallery_category' ) );
						// print_r($terms);						
						if( $terms && !is_wp_error($terms) ) {
							
							$term_links = array();
							$terms_html = '';
							foreach( $terms as $term ) {
								$term_links[] = $term->name;
							}					
							$term_list = join( ', ', $term_links );
							
							$terms_html .= $term_list;
						}

						$get_image_1 = get_field('image_1');
						if(!empty($get_image_1)){
							$image_1_id = get_field('image_1');
						 	$image_1_url = wp_get_attachment_image_url($image_1_id, 'home_gallery_image_1');
						}else{
						 	$image_1_url = get_stylesheet_directory_uri() . '/assets/images/dummy_images/dummy_1.jpg';
						 }

						$get_image_2 = get_field('image_2');
						if(!empty($get_image_2)){
							$image_2_id = get_field('image_2');
							$image_2_url = wp_get_attachment_image_url($image_2_id, 'home_gallery_image_2');
						}else{
							$image_2_url = get_stylesheet_directory_uri() . '/assets/images/dummy_images/dummy2.png';
						}
				  	?>
					  	<div>
						  	<div class="block">
								<a href="<?php echo get_the_permalink(); ?>">
							  		<img src="<?php echo $image_2_url;  ?>" data-speed="-1" class="img-parallax">
							  		<div class="block_header">
								 		<h2><?php echo get_the_title(); ?></h2>
									 	<p><?php echo $terms_html; ?></p>
									 	<div class="header_img">
									 		<img src="<?php echo $image_1_url;  ?>">
									 	</div>
							  		</div>
								</a>
							</div>
					  	</div>
				  	<?php endwhile; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; wp_reset_postdata(); ?>



			
						

<?php get_footer(); ?>