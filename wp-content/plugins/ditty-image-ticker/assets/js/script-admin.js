jQuery(document).ready( function($) {
	
	/* --------------------------------------------------------- */
	/* !Data image upload - 2.0.0 */
	/* --------------------------------------------------------- */

	// Delete an image
	$('.mtphr-dnt-data-image').find('.mtphr-dnt-delete').live( 'click', function(e) {
		e.preventDefault();

		var $image = $(this).parent(),
				$button = $image.siblings('.mtphr-dnt-data-image-upload'),
				$input = $image.siblings('input');

		$input.val('');
		$image.remove();
		$button.show();
	});

	// Add an image
	$('.mtphr-dnt-data-image-upload').live( 'click', function(e) {
	  e.preventDefault();

	  // Save the container
	  var $button = $(this),
	  		$list = $button.parents('.mtphr-dnt-list'),
	  		$list_item = $button.parents('.mtphr-dnt-list-item'),
	  		$add = $button.find('.mtphr-dnt-list-add'),
	  		$container = $button.parent(),
	  		$input = $container.children('input');

	  // Create a custom uploader
	  var uploader;
	  if( uploader ) {
	    uploader.open();
	    return;
	  }

	  // Set the uploader attributes
	  uploader = wp.media({
	    title: ditty_news_ticker_vars.img_title,
	    button: { text: ditty_news_ticker_vars.img_button, size: 'small' },
	    multiple: true,
	    library : {
	    	type : 'image'
    	}
	  });

	  uploader.on( 'select', function() {

			attachments = uploader.state().get('selection').toJSON();
			if( attachments.length > 0 ) {
				
				$(attachments).each( function(index) {
					
					var id = $(this)[0].id,
							title = $(this)[0].title,
							description = $(this)[0].description,
							link = $(this)[0].link,
							url = $(this)[0].sizes.thumbnail ? $(this)[0].sizes.thumbnail.url : $(this)[0].sizes.full.url;
					
					if( index == 0 ) {
						$list_item.find('.mtphr-dnt-field-mtphr_dnt_image_ticks_image input').val(id);
						$list_item.find('.mtphr-dnt-field-mtphr_dnt_image_ticks_title input').val(title);
						$list_item.find('.mtphr-dnt-field-mtphr_dnt_image_ticks_description textarea').val(description);
						$list_item.find('.mtphr-dnt-field-mtphr_dnt_image_ticks_link input').val(link);
						$list_item.find('.mtphr-dnt-data-image-preview').html('<img src="'+url+'" /><a href="#" class="mtphr-dnt-data-image-upload"><i class="dashicons dashicons-no"></i></a>');
					} else {
						$list.trigger('mtphr_dnt_list_add_item', [$list_item, 'new-data-image']);
						
						var $dup_item = $('.new-data-image').first();
						$dup_item.find('.mtphr-dnt-field-mtphr_dnt_image_ticks_image input').val(id);
						$dup_item.find('.mtphr-dnt-field-mtphr_dnt_image_ticks_title input').val(title);
						$dup_item.find('.mtphr-dnt-field-mtphr_dnt_image_ticks_description textarea').val(description);
						$dup_item.find('.mtphr-dnt-field-mtphr_dnt_image_ticks_link input').val(link);
						$dup_item.find('.mtphr-dnt-data-image-preview').html('<img src="'+url+'" /><a href="#" class="mtphr-dnt-data-image-upload"><i class="dashicons dashicons-no"></i></a>');
						$dup_item.removeClass('new-data-image');
					}
				});
			}
	  });

	  //Open the uploader dialog
	  uploader.open();

	  return false;
	});
	
	$('.mtphr-dnt-field-mtphr_dnt_image_ticks').on('mtphr_dnt_list_item_added', function( e, item, unique_class ) {
	
		var $preview = item.find('.mtphr-dnt-data-image-preview');
				
		if( unique_class != 'new-data-image' ) {
			$preview.html('<a href="#" class="mtphr-dnt-data-image-upload"><i class="dashicons dashicons-plus"></i></a>');
		}
	});
	
	
	/* --------------------------------------------------------- */
	/* !Adjust the hover checkbox - 2.0.1 */
	/* --------------------------------------------------------- */
	
	function mtphr_dnt_image_set_hover( $select ) {
	
		var $hover = $select.parent().next();

		if( $select.val() == 'top' || $select.val() == 'bottom' ) {
			$hover.show();
		} else {
			$hover.hide();
		}
	}
	
	$('.mtphr-dnt-field-mtphr_dnt_image_options_data_display select').each( function(index) {
		mtphr_dnt_image_set_hover( $(this) );
	});
		
	$('.mtphr-dnt-field-mtphr_dnt_image_options_data_display select').change( function() {
		mtphr_dnt_image_set_hover( $(this) );
	});



});