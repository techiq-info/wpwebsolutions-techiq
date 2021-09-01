jQuery( document ).ready( function($) {

	/* --------------------------------------------------------- */
	/* !Initiate the page tabs - 1.0.0 */
	/* --------------------------------------------------------- */

	$( '#apex-page-tabs' ).tabs({ active: 0 });


	/* --------------------------------------------------------- */
	/* !Initiate MiniColors fields - 1.0.0 */
	/* --------------------------------------------------------- */

	$('.apex-minicolors').each( function(i) {

		var $input = $(this).children('input')
		$input.minicolors();
	});
	
	
	/* --------------------------------------------------------- */
	/* !Initiate the ui sliders - 1.0.0 */
	/* --------------------------------------------------------- */
	
	$('.apex-opacity-slider').each( function(i) {

		var $input = $(this).parent().prev().find('input'),
				$span = $(this).parent().next().children('span');
		
		$(this).slider({
			min: 0,
      max: 100,
      value: $input.val(),
      slide: function( event, ui ) {
        $input.val( ui.value );
        $span.text( ui.value+'%' );
      }
		});
	});
	
	$('.apex-parallax-slider').each( function(i) {

		var $input = $(this).parent().prev().find('input'),
				$span = $(this).parent().next().children('span');
		
		$(this).slider({
			min: 0,
      max: 10,
      value: $input.val(),
      slide: function( event, ui ) {
        $input.val( ui.value );
        $span.text( ui.value );
      }
		});
	});


	/* --------------------------------------------------------- */
	/* !Initiate the CodeMirror fields - 1.0.0 */
	/* --------------------------------------------------------- */

	$('.apex-codemirror-css').each( function(i) {

		var $textarea = $(this).children('textarea');
		var myCodeMirror = CodeMirror.fromTextArea($textarea[0], {
			'mode' : 'css',
			'lineNumbers' : true,
			'lineWrapping' : true
		});
		myCodeMirror.setSize( false, 140 );
	});

	$('.apex-codemirror-js').each( function(i) {

		var $textarea = $(this).children('textarea');
		var myCodeMirror = CodeMirror.fromTextArea($textarea[0], {
			'mode' : 'htmlmixed',
			'lineNumbers' : true,
			'lineWrapping' : true
		});
		myCodeMirror.setSize( false, 140 );
	});


	/* --------------------------------------------------------- */
	/* !Setup the image selects - 1.0.0 */
	/* --------------------------------------------------------- */

	$('.apex-image-select a').click( function(e) {
		e.preventDefault();

		$(this).siblings().removeClass('active');
		$(this).addClass('active');

		var value = $(this).attr('href');
		value = value.substr(1, value.length);
		$(this).parent().siblings('input').val( value );
	});


	/* --------------------------------------------------------- */
	/* !Single image upload - 1.0.0 */
	/* --------------------------------------------------------- */

	// List - delete item click
	$('.apex-single-image').find('.apex-delete').live( 'click', function(e) {
		e.preventDefault();

		var $image = $(this).parent(),
				$button = $image.siblings('.apex-single-image-upload'),
				$input = $image.siblings('input');

		$input.val('');
		$image.remove();
		$button.show();
	});

	// Add an image
	$('.apex-single-image-upload').click( function(e) {
	  e.preventDefault();

	  // Save the container
	  var $button = $(this),
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
	    title: apex_vars.img_title,
	    button: { text: apex_vars.img_button, size: 'small' },
	    multiple: false,
	    library : {
	    	type : 'image'
    	}
	  });

	  uploader.on( 'select', function() {

			attachments = uploader.state().get('selection').toJSON();
			if( attachments.length > 0 ) {

				$input.val(attachments[0].id);

				// Create the display
				var data = {
					action: 'apex_single_image_ajax',
					attachment: attachments[0],
					security: apex_vars.security
				};
				jQuery.post( ajaxurl, data, function( response ) {
					$button.hide();
					$container.append( response );
				});
			}
	  });

	  //Open the uploader dialog
	  uploader.open();

	  return false;
	});


	/* --------------------------------------------------------- */
	/* !Typography - 1.0.0 */
	/* --------------------------------------------------------- */

	$('.apex-typography-settings-render').each( function() {
		apex_typography_settings_update( $(this) );
	});

	/*
$('.apex-typography-settings-size-unit').children('select').change( function() {

		switch( $(this).val() ) {
			case 'px':
				$(this).parent().siblings('.apex-typography-settings-size-px').show();
				$(this).parent().siblings('.apex-typography-settings-height-px').show();
				$(this).parent().siblings('.apex-typography-settings-size-em').hide();
				$(this).parent().siblings('.apex-typography-settings-height-em').hide();
				break;
			case 'em':
				$(this).parent().siblings('.apex-typography-settings-size-px').hide();
				$(this).parent().siblings('.apex-typography-settings-height-px').hide();
				$(this).parent().siblings('.apex-typography-settings-size-em').show();
				$(this).parent().siblings('.apex-typography-settings-height-em').show();
				break;
		}
	});
*/

	$('.apex-typography-settings-render').find('input, select').change( function() {
		apex_typography_settings_update( $(this).parents('.apex-typography-settings-render') );
	});

	$('.apex-typography-settings-reset a').click( function(e) {
		e.preventDefault();

		var $target = $(this).parents('.apex-typography-settings-render'),
				id = $(this).attr('href');

		id = id.substr(1, id.length);

		var data = {
			action: 'apex_typography_settings_reset',
			id: id,
			security: apex_vars.security
		};
		$.post( ajaxurl, data, function( response ) {

			$target.find('.apex-typography-settings-size-px').children('select').val( response.size_px );
			$target.find('.apex-typography-settings-height-px').children('select').val( response.height_px );
			$target.find('.apex-typography-settings-font-family').children('select').val( response.font_family );
			$target.find('.apex-typography-settings-font-weight').children('select').val( response.font_weight );
			$target.find('.apex-typography-settings-font-style').children('select').val( response.font_style );
			$target.find('.apex-typography-settings-color').find('input').val( response.color );
			$target.find('.apex-typography-settings-color').find('.minicolors-swatch-color').css( 'background-color', response.color );

			var font_size = response.size_px,
					line_height = response.height_px;

			$target.find('.apex-typography-settings-preview').children('textarea').css({
				'font-family': response.font_family,
				'font-size': font_size+'px',
				'line-height': line_height+'px',
				'font-weight': response.font_weight,
				'font-style': response.font_style,
				'color': response.color
			});
		}, 'json');

		apex_typography_settings_update( $(this).parents('.apex-typography-settings-render') );
	});

	function apex_typography_settings_update( $target ) {

		if( $target.find('.apex-typography-settings-enable').children('input').is(':checked') ) {
			$target.find('.apex-typography-settings-preview').fadeIn();
			var font_size = $target.find('.apex-typography-settings-size-px').children('select').val();
			var line_height = $target.find('.apex-typography-settings-height-px').children('select').val();
			var font_family = $target.find('.apex-typography-settings-font-family').children('select').val();
			var font_weight = $target.find('.apex-typography-settings-font-weight').children('select').val();
			var font_style = $target.find('.apex-typography-settings-font-style').children('select').val();
			var color = $target.find('.apex-typography-settings-color').find('input').val();
			$target.find('.apex-typography-settings-preview').children('textarea').css({
				'font-family': font_family,
				'font-size': font_size+'px',
				'line-height': line_height+'px',
				'font-weight': font_weight,
				'font-style': font_style,
				'color': color
			});

			WebFont.load({
				google: {
					families: [font_family]
				}
			});

		} else {
			$target.find('.apex-typography-settings-preview').fadeOut();
		}
	}


	
	/* --------------------------------------------------------- */
	/* !Widget Import - 1.0.0 */
	/* --------------------------------------------------------- */

	$('#apex-widgets-import').click( function(e) {
		e.preventDefault();
		
		var remove_existing = $('input[name="apex_remove_widgets"]').is(':checked');
		if( remove_existing ) {
			if (confirm(apex_vars.remove_widgets)) {
				apex_import_widgets(remove_existing);
			}
		} else {			
			apex_import_widgets(remove_existing);
		}
	});
	
	function apex_import_widgets(remove_existing) {
		
		var $notification = $('#apex-widgets-imported');
		
		var data = {
			action: 'apex_widget_import_ajax',
			remove_existing: remove_existing,
			security: apex_vars.security
		};
		jQuery.post( ajaxurl, data, function( response ) {
			$notification.fadeIn( function() {
				$(this).delay(2000).fadeOut();
				$('input[name="apex_remove_widgets"]').removeAttr('checked');
			});
		});
	}
	
	
	
	/* --------------------------------------------------------- */
	/* !Member widget overrides - 1.0.0 */
	/* --------------------------------------------------------- */

	$('#apex-member-widgets-setup').click( function(e) {
		e.preventDefault();		
		apex_member_widgets_setup();
	});
	
	function apex_member_widgets_setup() {
		
		var $notification = $('#apex-member-widgets-update');
		
		var data = {
			action: 'apex_member_widgets_setup_ajax',
			security: apex_vars.security
		};
		jQuery.post( ajaxurl, data, function( response ) {	
			$notification.fadeIn( function() {
				$(this).delay(2000).fadeOut();
			});
		});
	}
	
	
	
	/* --------------------------------------------------------- */
	/* !Taxonomy Options - 1.0.0 */
	/* --------------------------------------------------------- */
	
	function apex_taxonomy_filter_display( $select ) {
	
		var $options = $select.parent().siblings('.apex-taxonomy-filter-options');
				
		if( $select.val() == '' ) {	
			$options.slideUp( 500, 'easeOutExpo' );
		} else {
			$options.slideDown( 500, 'easeOutExpo' );
		}
	}
	
	$('.apex-taxonomy-filter').each( function() {
		apex_taxonomy_filter_display( $(this).children('select') );
	});
	
	$('.apex-taxonomy-filter select').change( function() {
		apex_taxonomy_filter_display( $(this) );
	});
	
	
	
	/* --------------------------------------------------------- */
	/* !Apex list - 1.0.0 */
	/* --------------------------------------------------------- */
	
	if( $('.apex-list').length > 0 ) {

		function apex_list_handle_toggle( $table ) {
		
			if( $table.find('.apex-list-item').length > 1 ) {
				$table.find('.apex-list-handle').show();
				$table.find('.apex-list-delete').show();
			} else {
				$table.find('.apex-list-handle').hide();
				$table.find('.apex-list-delete').hide();
			}
		}
	
		function apex_list_set_order( $table ) {
			
			$table.find('.apex-list-item').each( function(index) {	
				$(this).find('textarea, input, select').each( function() {
					
					if( $(this).data('name') ) {
						var name = $(this).data('name'),
								key = $(this).data('key');
						
						$(this).attr('name', name+'['+index+']['+key+']');
					}
				});
			});
			
			apex_list_handle_toggle( $table );
		}
		
		$('.apex-list').sortable( {
			handle: '.apex-list-handle',
			items: '.apex-list-item',
			axis: 'y',
		  helper: function(e, tr) {
		    var $originals = tr.children();
		    var $helper = tr.clone();
		    $helper.children().each(function(index) {
		      $(this).width($originals.eq(index).width());
		      $(this).height($originals.eq(index).height());
		    });
		    return $helper;
		  }
		});
		
		// Delete list item
		$('.apex-list').find('.apex-list-delete').live( 'click', function(e) {
			e.preventDefault();
			
			var $table = $(this).parents('.apex-list');

			// Fade out the item
			$(this).parents('.apex-list-item').fadeOut( function() {
				$(this).remove();
				apex_list_set_order( $table );
			});
		});
		
		// Add new row
		$('.apex-list').find('.apex-list-add').live( 'click', function(e) {
		  e.preventDefault();

		  // Save the container
		  var $table = $(this).parents('.apex-list'),
		  		$container = $(this).parents('.apex-list-item'),
		  		$dup = $container.clone();
		  		
		  // Reset the duplicate
		  $dup.find('textarea, input, select').each( function() {
			  $(this).val('');
		  });
		  
		  // Add the duplicate
		  $dup.hide();
		  $container.after( $dup );
		  $dup.fadeIn();
		  
		  // Set the order
		  apex_list_set_order( $table );
		});	
		
		$('.apex-list').each( function(index) {
			apex_list_set_order( $(this) );
		});
	}
	
	
	/* --------------------------------------------------------- */
	/* !Background options - 1.0.0 */
	/* --------------------------------------------------------- */
	
	$('input[name="_apex_page_settings[content_bg][default]"], input[name="_apex_page_settings[header_bg][default]"], input[name="_apex_page_settings[hero_bg][default]"]').click( function(e) {
		
		var val = $(this).val(),
				$table = $(this).parents('div').next('.apex-bg-options');
		
		if( val == 'default' ) {
			$table.hide();
		} else {
			$table.show();
		}
		
	});
	
	
	/* --------------------------------------------------------- */
	/* !Page top options - 1.0.0 */
	/* --------------------------------------------------------- */
	
	function apex_page_top_tabs() {
		var val = $('input[name="_apex_page_settings[page_top]"]:checked').val();
		if( val == 'header' ) {
			$('li[aria-controls="apex-page-tabs-4"]').show();
			$('li[aria-controls="apex-page-tabs-5"]').hide();	
		} else if( val == 'hero' ) {
			$('li[aria-controls="apex-page-tabs-4"]').hide();
			$('li[aria-controls="apex-page-tabs-5"]').show();
		} else {
			$('li[aria-controls="apex-page-tabs-4"]').hide();
			$('li[aria-controls="apex-page-tabs-5"]').hide();
		}
	}

	$('input[name="_apex_page_settings[page_top]"]').click( function() {
		apex_page_top_tabs();
	});
	
	apex_page_top_tabs();
	
	
	/* --------------------------------------------------------- */
	/* !Icon select - 1.0.0 */
	/* --------------------------------------------------------- */

/*
	if( $('.apex-page-icon').length > 0 ) {
	
		var $modal = $('#apex-page-icons-modal'),
				$icon = $('.apex-page-icon').children('i'),
				$input = $('.apex-page-icon').siblings('input'),
				current_icon = $icon.attr('class'),
				new_icon = '';
				
		$modal.children('.mtphr-shortcodes-icon-select').removeClass('active');
		$modal.find('.'+current_icon).parent().addClass('active');
		
		$modal.find('.mtphr-shortcodes-icon-select').live( 'click', function(e) {
			e.preventDefault();

			var new_class = $(this).data('prefix')+'-'+$(this).data('id');
			var $submit = $('.mtphr-shortcodes-modal-submit');
			$submit.removeAttr('disabled');
			$submit.click( function() {
				$icon.attr( 'class', new_class );
				$input.val( new_class );
			});
		});
	}
*/
	
	
	var $icon, $input;
	
	$('.apex-menu-item-icon').live( 'click', function() {
		
		$icon = $(this).children('i');
		$input = $(this).parents('.menu-item-bar').siblings('.menu-item-settings').find('.menu-item-data-icon');
		
		var $modal = $('#apex-page-icons-modal'),
				current_icon = $icon.attr('class'),
				new_icon = '';
				
		$modal.children('.mtphr-shortcodes-icon-select').removeClass('active');
		$modal.find('.'+current_icon).parent().addClass('active');

		$modal.find('.mtphr-shortcodes-icon-select').live( 'click', function(e) {
			e.preventDefault();

			var new_class = $(this).data('prefix')+'-'+$(this).data('id');
			var $submit = $('.mtphr-shortcodes-modal-submit');
			$submit.removeAttr('disabled');
			$submit.click( function() {
				$icon.attr( 'class', new_class );
				$input.val( new_class );
			});
		});
	});
	
	
});