		<?php
		get_template_part( 'templates/elements/extra', 'content' );
		
		global $apex_general_settings; ?>
		
		</div><!-- #main -->
	
		<footer id="site-footer" class="apex-style-<?php echo $apex_general_settings['footer_style']; ?>" role="contentinfo">
			<div class="container">
				<div class="row">
					<?php
					$social_links = apex_footer_social_links();
					$copyright = apex_footer_copyright( $social_links );
					if( is_rtl() ) {
						echo $copyright;
						echo $social_links;
					} else {
						echo $social_links;
						echo $copyright;
					}
					?>
				</div><!-- .row -->
				
			</div><!-- .container -->
		</footer><!-- #site-footer -->
		
	</div><!-- #wrapper -->
	
	<a id="apex-totop-float" href="#"><i class="apex-icon-arrow-up"></i></a>
	
<?php wp_footer(); ?>

<script type="text/javascript">
	// I know that the code could be better.
// If you have some tips or improvement, please let me know.

jQuery('.img-parallax').each(function(){
  var img = jQuery(this);
  var imgParent = jQuery(this).parent();
  function parallaxImg () {
    var speed = img.data('speed');
    var imgY = imgParent.offset().top;
    var winY = jQuery(this).scrollTop();
    var winH = jQuery(this).height();
    var parentH = imgParent.innerHeight();


    // The next pixel to show on screen      
    var winBottom = winY + winH;

    // If block is shown on screen
    if (winBottom > imgY && winY < imgY + parentH) {
      // Number of pixels shown after block appear
      var imgBottom = ((winBottom - imgY) * speed);
      // Max number of pixels until block disappear
      var imgTop = winH + parentH;
      // Porcentage between start showing until disappearing
      var imgPercent = ((imgBottom / imgTop) * 88) + (50 - (speed * 50));
    }
    img.css({
      top: imgPercent + '%',
      transform: 'translate(-50%, -' + imgPercent + '%)'
    });
  }
  jQuery(document).on({
    scroll: function () {
      parallaxImg();
    }, ready: function () {
      parallaxImg();
    }
  });
});


jQuery(document).ready(function(){
	
	// Slick JS for single gallery page
	jQuery('.protfolio-silde').slick({
        dots: true,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		adaptiveHeight: true,
   		vertical: true,
   		draggable: false
    });

});

</script>

</body>
</html>