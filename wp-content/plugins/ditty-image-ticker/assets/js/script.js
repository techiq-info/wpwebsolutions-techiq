jQuery( document ).ready( function($) {


	var preload_limit = 10;
			currently_preloading = 0;


	/* --------------------------------------------------------- */
	/* !Preload images */
	/* --------------------------------------------------------- */
	
	function mtphr_dnt_image_preload() {
		
		var start = currently_preloading;
		for( var i=start; i<preload_limit; i++ ) {
			
			var $placeholder = $('.mtphr-dnt-image-placeholder:visible:first');
			if( $placeholder.length == 0 ) {
				$placeholder = $('.mtphr-dnt-image-placeholder:first');
			}
			
			if( $placeholder.length > 0 ) {
			
				// Add 1 to the currently preloading var
				currently_preloading++;
				
				// Replace the placeholder class
				$placeholder.attr('class', 'mtphr-dnt-image-placeholder-loading');
				
				// Load the image
				mtphr_dnt_image_preload_image( $placeholder );
	    }
    }
	}
	
	function mtphr_dnt_image_preload_image( $placeholder ) {

		var path = $placeholder.attr('data-src');
		
		var img = new Image();
	  $(img).load(function () {

			var $img = $(this);
	  	$placeholder.after( $img );
	  	$placeholder.css('position', 'absolute').fadeOut( function() {

	  		// Remove the placeholder
		  	$(this).remove();
		  	
		  	// Trigger a ticker resize
		  	$('body').trigger('mtphr_dnt_resize', [$img.parents('.mtphr-dnt').attr('id')]);
		  	
		  	// Resize the placeholders
		  	mtphr_dnt_image_resize_placeholders();
		  	
		  	// Subtract 1 to the currently preloading var
				currently_preloading--;

		  	// Preload the next image
		  	if( $('.mtphr-dnt-image-placeholder').length > 0 ) {
					mtphr_dnt_image_preload();
				}
	  	}); 	
	  	$(this).fadeIn();
	  	
    }).attr('src', path);
	}
	
	mtphr_dnt_image_preload();
	
	
	
	
	
	/* --------------------------------------------------------- */
	/* !Resize the placholders - 1.0.0 */
	/* --------------------------------------------------------- */
	
	function mtphr_dnt_image_resize_placeholders() {
		
		$('.mtphr-dnt-image-placeholder, .mtphr-dnt-image-placeholder-loading').each( function(index) {
		
			var init_w = $(this).attr('data-width'),
					init_h = $(this).attr('data-height'),
					percent = init_h/init_w,
					w = $(this).width(),
					h = w*percent;

			$(this).height(h).css( 'display', 'block' );
		});
	}
	
	
	
	
	/* --------------------------------------------------------- */
	/* !Data hovers */
	/* --------------------------------------------------------- */
	
	$('.mtphr-dnt-image-tick').hover(
	  function () {
	    $(this).find('.mtphr-dnt-image-data-hover').stop(true,true).fadeIn();
	  }, 
	  function () {
	    $(this).find('.mtphr-dnt-image-data-hover').stop(true,true).fadeOut();
	  }
	);



	
	
	$(window).resize( function() {
		mtphr_dnt_image_resize_placeholders();
	});
	mtphr_dnt_image_resize_placeholders();
	
});