<?php /* Default post template */ ?>

<?php get_header(); ?>

<div id="<?php echo $apex_general_settings['section_id_prefix']; ?><?php echo $header_id; ?>-header" <?php apex_header_class(); ?> <?php apex_parallax_attribute('header_bg'); ?>>
    	
	<!-- Background pattern overlay -->
  <div class="apex-section-overlay"></div>

<section class="iconix-banner" style="background: url(<?php echo get_field('banner_image'); ?>);">
	<div class="container">
		<div class="row">
			<div class="inner-content">
				<h1><?php echo get_the_title(); ?></h1>
				<?php echo get_field('banner_content'); ?>
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
				<span class="image-shop-scroll"></span>
			</span>
		</div>
		<div class="mobile-frame">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mob-frame.png" class="img-responsive">
		</div>
	</div>
</section>
<section class="about-project">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="about-content">
					<h2>About this Project</h2>
					<?php echo get_field('about_content'); ?>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="about-image">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/aboutimage1.png" class="img-responsive">
				</div>
			</div>
		</div>
	</div>
</section>
<div class="">
<section class="what-to-find">
	<div class="container">
		<div class="row">
			<div class="what-to-find-content">
				<h1>Want to find <br>out more about our <br>services?</h1>
				<a href="#" class="button-trans">contact us</a>
			</div>
		</div>
	</div>
</section>
<section class="end-to-end">
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
<section class="the-result clearfix">
			<div class="product-frame-image">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/frame-product-image.png" class="img-responsive" class="img-responsive">
			</div>
			<div class="col-sm-6 pull-right">
				<div class="the-result-content">
					<h1>the results</h1>
					<?php echo get_field('result_content'); ?>
					<a href="#">Request a Quote</a>
				</div>
			</div>
</section>



<section class="protfolio-design-slider">
	<div class="container">
		<div class="row">
		<div class="heading-portfolio-design">
			<h1>View Amazing Web Development <br>Portfolio Designs from Web Solutions</h1>
		</div>
			<div class="protfolio-silde">
			  <div>
				  	<div class="block">
					<a href="https://web.staging02.com/wp/websolutions/galleries/iconix/">
					  <img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2018/03/6.png" data-speed="-1" class="img-parallax" style="top: 16.2549%; transform: translate(-50%, -16.2549%);">
					  <div class="block_header">
						 <h2>Iconix</h2>
						 <p>Development, UX</p>

						 <div class="header_img">
						 	<img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2018/03/i_1.jpg">
						 </div>
					  </div>
					</a>

					</div>
			  </div>
			  <div>
					  <div class="block">
						<a href="https://web.staging02.com/wp/websolutions/galleries/mast/">
						  <img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2018/03/7.png" data-speed="-1" class="img-parallax" style="top: 60.078%; transform: translate(-50%, -60.078%);">
						  <div class="block_header">
							 <h2>Mast</h2>
							 <p>Design, Development, UI, UX</p>

							 <div class="header_img">
							 	<img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2018/03/mast_1.jpg">
							 </div>
						  </div>
						</a>

					 </div>
			  </div>
			  <div>
				  	<div class="block">
					<a href="https://web.staging02.com/wp/websolutions/galleries/twentyfour-seven-video/">
					  <img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2018/03/1.jpg" data-speed="-1" class="img-parallax" style="top: 54.8765%; transform: translate(-50%, -54.8765%);">
					  <div class="block_header">
						 <h2>Twentyfourseven Interactive Video and sound project</h2>
						 <p>Development, Interactive, UI, UX</p>

						 <div class="header_img">
						 	<img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2015/04/tfs1.jpg">
						 </div>
					  </div>
					</a>

				    </div>
			  </div>
			  <div>
			  		<div class="block">
				<a href="https://web.staging02.com/wp/websolutions/galleries/unidress/">
				  <img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2015/06/2.png" data-speed="-1" class="img-parallax" style="top: 20.026%; transform: translate(-50%, -20.026%);">
				  <div class="block_header">
					 <h2>Unidress Fashion Online Store</h2>
					 <p>Design, Development, UI, UX</p>

					 <div class="header_img">
					 	<img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2015/06/u_1.jpg">
					 </div>
				  </div>
				</a>

			</div>
			  </div>
			  <div>
				  	<div class="block">
					<a href="https://web.staging02.com/wp/websolutions/galleries/maccabi/">
					  <img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2014/07/3.png" data-speed="-1" class="img-parallax" style="top: 14.8244%; transform: translate(-50%, -14.8244%);">
					  <div class="block_header">
						 <h2>Maccabi Basketball Club</h2>
						 <p>Design, Development, Interactive, Strategy, UI, UX</p>

						 <div class="header_img">
						 	<img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2014/07/m_1.jpg">
						 </div>
					  </div>
					</a>

				   </div>
			  </div>
			  <div>
			  		<div class="block">
				<a href="https://web.staging02.com/wp/websolutions/galleries/easy-shuttle/">
				  <img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2015/07/4.png" data-speed="-1" class="img-parallax" style="top: 39.2718%; transform: translate(-50%, -39.2718%);">
				  <div class="block_header">
					 <h2>Easy Shuttle</h2>
					 <p>Design, Development, Interactive</p>

					 <div class="header_img">
					 	<img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2015/07/e_1.jpg">
					 </div>
				  </div>
				</a>

			</div>
			  </div>
			  <div>
			  		<div class="block">
				<a href="https://web.staging02.com/wp/websolutions/galleries/iiamo/">
				  <img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2015/07/5.png" data-speed="-1" class="img-parallax" style="top: 67.1001%; transform: translate(-50%, -67.1001%);">
				  <div class="block_header">
					 <h2>Iiamo E-commerce Website</h2>
					 <p>Design, Development</p>

					 <div class="header_img">
					 	<img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2015/07/l_1.jpg">
					 </div>
				  </div>
				</a>

			</div>
			  </div>
			  <div>
			  		<div class="block">
				<a href="https://web.staging02.com/wp/websolutions/galleries/castro-n/">
				  <img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2015/04/8.png" data-speed="-1" class="img-parallax" style="top: 54.4863%; transform: translate(-50%, -54.4863%);">
				  <div class="block_header">
					 <h2>CASTRO’s e-commerce Website</h2>
					 <p>Development, Interactive, UI, UX</p>

					 <div class="header_img">
					 	<img src="https://web.staging02.com/wp/websolutions/wp-content/uploads/2015/04/c_1.jpg">
					 </div>
				  </div>
				</a>

			</div>
			  </div>
			  <div>
			  		<div class="block">
				<a href="https://web.staging02.com/wp/websolutions/galleries/renuar-2/">
				  <img src="https://web.staging02.com/wp/websolutions/wp-content/themes/digitalscience-apex/assets/images/dummy/dummy2.png" data-speed="-1" class="img-parallax" style="top: 49.2848%; transform: translate(-50%, -49.2848%);">
				  <div class="block_header">
					 <h2>Renuar Marketing</h2>
					 <p>Development, Strategy, UI</p>

					 <div class="header_img">
					 	<img src="https://web.staging02.com/wp/websolutions/wp-content/themes/digitalscience-apex/assets/images/dummy/dummy_1.jpg">
					 </div>
				  </div>
				</a>

			</div>
			  </div>
			</div>
		</div>
	</div>
</section>



			
						

<?php get_footer(); ?>