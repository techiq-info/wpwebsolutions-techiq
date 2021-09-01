jQuery( document ).ready( function($) {
	
	
	/* --------------------------------------------------------- */
	/* !Menu icon click - 1.0.0 */
	/* --------------------------------------------------------- */
	
	$('.apex-menu-toggle-link').live('click', function(e) {
		e.preventDefault();
		
		if( !$(this).hasClass('disabled') ) {
			
			var $item = $(this).parents('.menu-item'),
					$input = $item.find('.menu-item-data-disable-link'),
					hidden = $input.val();
	
			if( hidden == 'true' ) {
				
				$(this).children('i').attr('class', $(this).data('disabled'));
				$item.removeClass('apex-menu-link-disabled').addClass('apex-menu-link-enabled');
				$input.val('');
					
			} else {
				
				$(this).children('i').attr('class', $(this).data('active'));
				$item.removeClass('apex-menu-link-enabled').addClass('apex-menu-link-disabled');
				$input.val('true');
			}
		}
	});
	
	$('.apex-menu-toggle-section').live('click', function(e) {
		e.preventDefault();
		
		if( !$(this).hasClass('disabled') ) {
				
			var $item = $(this).parents('.menu-item'),
					$input = $item.find('.menu-item-data-hide-section'),
					hidden = $input.val();
	
			if( hidden == 'true' ) {
				
				$(this).children('i').attr('class', 'apex-icon-visible');
				$item.removeClass('apex-menu-section-hidden').addClass('apex-menu-section-visible');
				$input.val('');
					
			} else {
				
				$(this).children('i').attr('class', 'apex-icon-hidden');
				$item.removeClass('apex-menu-section-visible').addClass('apex-menu-section-hidden');
				$input.val('true');
			}
		}
	});

});