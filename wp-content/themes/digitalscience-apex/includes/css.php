<?php


/* --------------------------------------------------------- */
/* !Add the global styles - 1.0.6 */
/* --------------------------------------------------------- */

function apex_global_styles() {

	global $apex_general_settings;
	
	$style = '';
	
	if( $apex_general_settings['custom_color'] != '' ) {
	
		$color = $apex_general_settings['custom_color'];
			
		/* !Highlight color - 1.0.0 */
		$elements = array(
			'.entry-content a',
			'.apex-style-dark a:hover *',
			'.no-touch a:hover',
			'.apex-post-format-quote .entry-title',
			'.apex-post-format-quote .entry-title a',
			'.mtphr-dnt-post-format-quote .mtphr-dnt-posts-title',
			'.mtphr-dnt-post-format-quote .mtphr-dnt-posts-title a',
			'.entry-meta a',
			'.entry-comments:hover i',
			'.mtphr-rotator-footer a:hover i',
			'.mtphr-posts-widget .readmore-wrapper a',
			'.mtphr-tabbed-posts-widget .entry-meta',
			'.search-container button[type="submit"]:hover',
			'#wp-calendar td a',
			'.mtphr-contact-widget a',
			'.mtphr-comments-date',
			'.mtphr-twitter-widget .mtphr-twitter-widget-date',
			'.widget_recent_comments a',
			'.widget_rss .rss-date',
			'.mtphr-post-slider-header i',
			'.entry-featured-data .entry-data',
			'.entry-featured-icons a:hover i',
			'.btn',
			'.gform_button',
			'.comment-reply-link',
			'.form-submit input[type="submit"]',
			'.mtphr-gallery-header i',
			'.widget_archive a:hover',
			'.widget_categories a:hover',
			'.mtphr-gallery-categories a:hover',
			'.mtphr-post-navigation a:hover',
			'.mtphr-comments-widget a:hover',
			'.widget_pages a:hover',
			'.widget_recent_entries a:hover',
			'.widget_nav_menu a:hover',
			'.widget_meta a:hover',
			'.content-nav li a:hover',
			'#comment-nav li a:hover',
			'.paginate-links a:hover span.paginate-links-number',
			'.apex-icon i',
			'.apex-icon-round i',
			'a.apex-icon-round:hover .apex-icon-title',
			'a.apex-icon:hover .apex-icon-title',
			'.apex-style-dark a.apex-icon-round:hover .apex-icon-title',
			'.apex-style-dark a.apex-icon:hover .apex-icon-title',
		);
		$style .= apex_css_color( $elements, $color );
		
		$elements = array(
			'.entry-title a:hover',
			'article.format-quote .entry-title',
			'article.format-quote .entry-title a',
			'.mtphr-dnt-post-format-quote .mtphr-dnt-posts-title',
			'.mtphr-dnt-post-format-quote .mtphr-dnt-posts-title a',
			'.mtphr-dnt-twitter-tick .mtphr-dnt-twitter-time',
			'.apex-readmore',
			'.apex-readmore *',
			'article.format-quote .entry-title',
			'article.format-quote .entry-title a',
			'.apex-post-format-quote .entry-title',
			'.apex-post-format-quote .entry-title a',
			'.mtphr-dnt-post-format-quote .mtphr-dnt-posts-title',
			'.mtphr-dnt-post-format-quote .mtphr-dnt-posts-title a',
			'.mtphr-dnt-twitter-tick .mtphr-dnt-twitter-time'
		);
		$style .= apex_css_color( $elements, $color, true );
		
		$elements = array(
			'.widget_archive a:hover span.count',
			'.widget_categories a:hover span.count',
			'.mtphr-gallery-categories a:hover span.count',
			'#wp-calendar td#today',
			'.mtphr-social-widget-site:hover i',
			'.tagcloud a:hover',
			'.mtphr-slide-graph-fill',
			'.content-nav li span',
			'#comment-nav li span',
			'.paginate-links > span.paginate-links-number',
			'a.apex-icon:hover i',
			'a.apex-icon-round:hover .apex-icon',
			'.btn:hover',
			'.btn:active',
			'.btn.active',
			'.gform_button:hover',
			'.gform_button:active',
			'.gform_button.active',
			'.gform_button:focus',
			'.comment-reply-link:hover',
			'.form-submit input[type="submit"]:hover',
			'.mtphr-post-slider-header a:hover i',
			'.mtphr-gallery-header a:hover i'
		);
		$style .= apex_css_background_color( $elements, $color );
		
		$elements = array(
			'.apex-post-format-quote .entry-featured img',
			'.apex-post-format-quote .entry-featured i',
			'.apex-dnt-posts-quote-thumb img',
			'.apex-dnt-posts-quote-thumb i',
			'.entry-featured-overlay',
			'article.format-quote .entry-featured img',
			'article.format-quote .entry-featured i',
			'.mtphr-dnt-post-format-quote .apex-dnt-posts-quote-thumb img',
			'.mtphr-dnt-post-format-quote .apex-dnt-posts-quote-thumb i',
			'.mtphr-dnt-twitter-tick .mtphr-dnt-twitter-avatar img',
			'.mtphr-dnt-twitter-tick .mtphr-dnt-twitter-avatar i'
			
		);
		$style .= apex_css_background_color( $elements, $color, 80 );
		
		$elements = array(
			'.mtphr-slide-graph-fill-bg'
		);
		$style .= apex_css_background_color( $elements, $color, 20 );
		
		$elements = array(
			'.apex-post-format-quote .entry-featured',
			'.apex-dnt-posts-quote-thumb',
			'blockquote',
			'.form-control:focus',
			'.ginput_container input:focus',
			'.ginput_container select:focus',
			'.ginput_container textarea:focus',
			'.widget_archive a:hover span.count',
			'.widget_categories a:hover span.count',
			'.mtphr-gallery-categories a:hover span.count',
			'.mtphr-rotator-footer a:hover',
			'.tagcloud a:hover',
			'article.format-quote .entry-featured',
			'.apex-post-format-quote .entry-featured',
			'.mtphr-dnt-post-format-quote .apex-dnt-posts-quote-thumb',
			'.mtphr-dnt-post-format-quote .apex-dnt-posts-quote-thumb',
			'.mtphr-dnt-twitter-tick .mtphr-dnt-twitter-avatar',
			'.btn',
			'.gform_button',
			'.comment-reply-link',
			'.form-submit input[type="submit"]',
			'.btn:hover',
			'.btn:active',
			'.btn.active',
			'.gform_button:hover',
			'.gform_button:active',
			'.gform_button.active',
			'.gform_button:focus',
			'.comment-reply-link:hover',
			'.form-submit input[type="submit"]:hover',
			'.mtphr-post-slider-header i',
			'.mtphr-gallery-header i',
			'.apex-style-dark .mtphr-dnt .mtphr-dnt-nav:hover',
			'.content-nav li a:hover',
			'#comment-nav li a:hover',
			'.paginate-links a:hover span.paginate-links-number',
			'.content-nav li span',
			'#comment-nav li span',
			'.paginate-links > span.paginate-links-number',
			'.apex-icon i',
			'.apex-icon-round .apex-icon',
			'a.apex-icon-round:hover .apex-icon'
		);
		$style .= apex_css_border_color( $elements, $color );
		
		$elements = array(
			'.section-header-sep span'
		);
		$style .= apex_css_border_color( $elements, $color, '', false, 'border-top-color' );

					
		/* --------------------------------------------------------- */
		/* !Header styles - 1.0.6 */
		/* --------------------------------------------------------- */
	
		$elements = array(
			'#breadcrumbs a:hover'
		);
		$style .= apex_css_color( $elements, $color );
		
		$elements = array(
			'.section-header-sep span'
		);
		$style .= apex_css_border_color( $elements, $color, '', false, 'border-top-color' );
			

		/* --------------------------------------------------------- */
		/* !Hero styles - 1.0.6 */
		/* --------------------------------------------------------- */

		$elements = array(
			'.apex-hero-menu-container a:hover'
		);
		$style .= apex_css_background_color( $elements, $color, 80 );
		$style .= apex_css_border_color( $elements, $color, 80 );
	}

	if( $style != '' ) {
		echo '<style id="apex-global-styles">'.$style.'</style>';
	}	
}
add_action( 'wp_head', 'apex_global_styles' );



/* --------------------------------------------------------- */
/* !Add the section styles - 1.0.11 */
/* --------------------------------------------------------- */

function apex_section_styles() {

	global $apex_all_section_settings, $apex_general_settings;
	$prefix = $apex_general_settings['section_id_prefix'];
	
	$style = '';
	
	if( is_array($apex_all_section_settings) && count($apex_all_section_settings) > 0 ) {
	
		$counter = 0;
		
		foreach( $apex_all_section_settings as $id=>$settings ) {
			
			/* !Highlight color - 1.0.0 */
			$color = $settings['highlight'];

			if( $color != '' ) {
			
				$elements = array(
					'#'.$prefix.$id.' .entry-content a',
					'.no-touch #'.$prefix.$id.' a:hover',
					'#'.$prefix.$id.' .apex-post-format-quote .entry-title',
					'#'.$prefix.$id.' .apex-post-format-quote .entry-title a',
					'#'.$prefix.$id.' .mtphr-dnt-post-format-quote .mtphr-dnt-posts-title',
					'#'.$prefix.$id.' .mtphr-dnt-post-format-quote .mtphr-dnt-posts-title a',
					'#'.$prefix.$id.' .entry-meta a',
					'#'.$prefix.$id.' .entry-comments:hover i',
					'#'.$prefix.$id.' .mtphr-rotator-footer a:hover i',
					'#'.$prefix.$id.' .mtphr-posts-widget .readmore-wrapper a',
					'#'.$prefix.$id.' .mtphr-tabbed-posts-widget .entry-meta',
					'#'.$prefix.$id.' .search-container button[type="submit"]:hover',
					'#'.$prefix.$id.' #wp-calendar td a',
					'#'.$prefix.$id.' .mtphr-contact-widget a',
					'#'.$prefix.$id.' .mtphr-comments-date',
					'#'.$prefix.$id.' .mtphr-twitter-widget .mtphr-twitter-widget-date',
					'#'.$prefix.$id.' .widget_recent_comments a',
					'#'.$prefix.$id.' .widget_rss .rss-date',
					'#'.$prefix.$id.' .mtphr-post-slider-header i',
					'#'.$prefix.$id.' .entry-featured-data .entry-data',
					'#'.$prefix.$id.' .entry-featured-icons a:hover i',
					'#'.$prefix.$id.' .btn',
					'#'.$prefix.$id.' .gform_button',
					'#'.$prefix.$id.' .comment-reply-link',
					'#'.$prefix.$id.' .form-submit input[type="submit"]',
					'#'.$prefix.$id.' .mtphr-gallery-header i',
					'#'.$prefix.$id.' .widget_archive a:hover',
					'#'.$prefix.$id.' .widget_categories a:hover',
					'#'.$prefix.$id.' .mtphr-gallery-categories a:hover',
					'#'.$prefix.$id.' .mtphr-post-navigation a:hover',
					'#'.$prefix.$id.' .mtphr-comments-widget a:hover',
					'#'.$prefix.$id.' .widget_pages a:hover',
					'#'.$prefix.$id.' .widget_recent_entries a:hover',
					'#'.$prefix.$id.' .widget_nav_menu a:hover',
					'#'.$prefix.$id.' .widget_meta a:hover',
					'#'.$prefix.$id.' .content-nav li a:hover',
					'#'.$prefix.$id.' #comment-nav li a:hover',
					'#'.$prefix.$id.' .paginate-links a:hover span.paginate-links-number',
					'#'.$prefix.$id.' .apex-icon i',
					'#'.$prefix.$id.' .apex-icon-round i',
					'#'.$prefix.$id.' .apex-style-dark a.apex-icon-round:hover .apex-icon-title'
				);
				$style .= apex_css_color( $elements, $color );
				
				$elements = array(
					'#'.$prefix.$id.' .entry-title a:hover',
					'#'.$prefix.$id.' article.format-quote .entry-title',
					'#'.$prefix.$id.' article.format-quote .entry-title a',
					'#'.$prefix.$id.' .mtphr-dnt-post-format-quote .mtphr-dnt-posts-title',
					'#'.$prefix.$id.' .mtphr-dnt-post-format-quote .mtphr-dnt-posts-title a',
					'#'.$prefix.$id.' .mtphr-dnt-twitter-tick .mtphr-dnt-twitter-time',
					'#'.$prefix.$id.' .apex-readmore',
					'#'.$prefix.$id.' .apex-readmore *',
					'#'.$prefix.$id.' article.format-quote .entry-title',
					'#'.$prefix.$id.' article.format-quote .entry-title a',
					'#'.$prefix.$id.'.apex-post-format-quote .entry-title',
					'#'.$prefix.$id.'.apex-post-format-quote .entry-title a',
					'#'.$prefix.$id.' .mtphr-dnt-post-format-quote .mtphr-dnt-posts-title',
					'#'.$prefix.$id.' .mtphr-dnt-post-format-quote .mtphr-dnt-posts-title a',
					'#'.$prefix.$id.' .mtphr-dnt-twitter-tick .mtphr-dnt-twitter-time'
				);
				$style .= apex_css_color( $elements, $color, true );
				
				$elements = array(
					'#'.$prefix.$id.' .widget_archive a:hover span.count',
					'#'.$prefix.$id.' .widget_categories a:hover span.count',
					'#'.$prefix.$id.' .mtphr-gallery-categories a:hover span.count',
					'#'.$prefix.$id.' #wp-calendar td#today',
					'#'.$prefix.$id.' .mtphr-social-widget-site:hover i',
					'#'.$prefix.$id.' .tagcloud a:hover',
					'#'.$prefix.$id.' .mtphr-slide-graph-fill',
					'#'.$prefix.$id.' .content-nav li span',
					'#'.$prefix.$id.' #comment-nav li span',
					'#'.$prefix.$id.' .paginate-links > span.paginate-links-number',
					'#'.$prefix.$id.' a.apex-icon:hover i',
					'#'.$prefix.$id.' a.apex-icon-round:hover .apex-icon',
					'#'.$prefix.$id.' .btn:hover',
					'#'.$prefix.$id.' .btn:active',
					'#'.$prefix.$id.' .btn.active',
					'#'.$prefix.$id.' .gform_button:hover',
					'#'.$prefix.$id.' .gform_button:active',
					'#'.$prefix.$id.' .gform_button.active',
					'#'.$prefix.$id.' .gform_button:focus',
					'#'.$prefix.$id.' .comment-reply-link:hover',
					'#'.$prefix.$id.' .form-submit input[type="submit"]:hover',
					'#'.$prefix.$id.' .mtphr-post-slider-header a:hover i',
					'#'.$prefix.$id.' .mtphr-gallery-header a:hover i'
				);
				$style .= apex_css_background_color( $elements, $color );
				
				$elements = array(
					'#'.$prefix.$id.' .apex-post-format-quote .entry-featured img',
					'#'.$prefix.$id.' .apex-post-format-quote .entry-featured i',
					'#'.$prefix.$id.' .apex-dnt-posts-quote-thumb img',
					'#'.$prefix.$id.' .apex-dnt-posts-quote-thumb i',
					'#'.$prefix.$id.' .entry-featured-overlay',
					'#'.$prefix.$id.' article.format-quote .entry-featured img',
					'#'.$prefix.$id.' article.format-quote .entry-featured i',
					'#'.$prefix.$id.' .mtphr-dnt-post-format-quote .apex-dnt-posts-quote-thumb img',
					'#'.$prefix.$id.' .mtphr-dnt-post-format-quote .apex-dnt-posts-quote-thumb i',
					'#'.$prefix.$id.' .mtphr-dnt-twitter-tick .mtphr-dnt-twitter-avatar img',
					'#'.$prefix.$id.' .mtphr-dnt-twitter-tick .mtphr-dnt-twitter-avatar i'
					
				);
				$style .= apex_css_background_color( $elements, $color, 80 );
				
				$elements = array(
					'#'.$prefix.$id.' .mtphr-slide-graph-fill-bg'
				);
				$style .= apex_css_background_color( $elements, $color, 20 );
				
				$elements = array(
					'#'.$prefix.$id.' .apex-post-format-quote .entry-featured',
					'#'.$prefix.$id.' .apex-dnt-posts-quote-thumb',
					'#'.$prefix.$id.' blockquote',
					'#'.$prefix.$id.' .form-control:focus',
					'#'.$prefix.$id.' .ginput_container input:focus',
					'#'.$prefix.$id.' .ginput_container select:focus',
					'#'.$prefix.$id.' .ginput_container textarea:focus',
					'#'.$prefix.$id.' .widget_archive a:hover span.count',
					'#'.$prefix.$id.' .widget_categories a:hover span.count',
					'#'.$prefix.$id.' .mtphr-gallery-categories a:hover span.count',
					'#'.$prefix.$id.' .mtphr-rotator-footer a:hover',
					'#'.$prefix.$id.' .tagcloud a:hover',
					'#'.$prefix.$id.' article.format-quote .entry-featured',
					'#'.$prefix.$id.'.apex-post-format-quote .entry-featured',
					'#'.$prefix.$id.' .mtphr-dnt-post-format-quote .apex-dnt-posts-quote-thumb',
					'#'.$prefix.$id.' .mtphr-dnt-post-format-quote .apex-dnt-posts-quote-thumb',
					'#'.$prefix.$id.' .mtphr-dnt-twitter-tick .mtphr-dnt-twitter-avatar',
					'#'.$prefix.$id.' .btn',
					'#'.$prefix.$id.' .gform_button',
					'#'.$prefix.$id.' .comment-reply-link',
					'#'.$prefix.$id.' .form-submit input[type="submit"]',
					'#'.$prefix.$id.' .btn:hover',
					'#'.$prefix.$id.' .btn:active',
					'#'.$prefix.$id.' .btn.active',
					'#'.$prefix.$id.' .gform_button:hover',
					'#'.$prefix.$id.' .gform_button:active',
					'#'.$prefix.$id.' .gform_button.active',
					'#'.$prefix.$id.' .gform_button:focus',
					'#'.$prefix.$id.' .comment-reply-link:hover',
					'#'.$prefix.$id.' .form-submit input[type="submit"]:hover',
					'#'.$prefix.$id.' .mtphr-post-slider-header i',
					'#'.$prefix.$id.' .mtphr-gallery-header i',
					'#'.$prefix.$id.' .apex-style-dark .mtphr-dnt .mtphr-dnt-nav:hover',
					'#'.$prefix.$id.' .content-nav li a:hover',
					'#'.$prefix.$id.' #comment-nav li a:hover',
					'#'.$prefix.$id.' .paginate-links a:hover span.paginate-links-number',
					'#'.$prefix.$id.' .content-nav li span',
					'#'.$prefix.$id.' #comment-nav li span',
					'#'.$prefix.$id.' .paginate-links > span.paginate-links-number',
					'#'.$prefix.$id.' .apex-icon i',
					'#'.$prefix.$id.' .apex-icon-round .apex-icon'
				);
				$style .= apex_css_border_color( $elements, $color );
				
				$elements = array(
					'#'.$prefix.$id.' .section-header-sep span'
				);
				$style .= apex_css_border_color( $elements, $color, '', false, 'border-top-color' );
			}
			
			/* !Content background - 1.0.0 */
			$content_bg = isset( $settings['content_bg'] ) ? $settings['content_bg'] : array();
			$content_bg_color = isset( $content_bg['color'] ) ? $content_bg['color'] : '';
			$content_bg_color_opacity = isset( $content_bg['color_opacity'] ) ? $content_bg['color_opacity'] : '';
			$content_bg_image = isset( $content_bg['image'] ) ? $content_bg['image'] : '';
			$content_bg_image_pattern = isset( $content_bg['image_pattern'] ) ? $content_bg['image_pattern'] : '';
			$content_bg_overlay = isset( $content_bg['overlay'] ) ? $content_bg['overlay'] : '';
			$content_bg_overlay_opacity = isset( $content_bg['overlay_opacity'] ) ? $content_bg['overlay_opacity'] : '';
			
			/* !Background color - 1.0.0 */
			if( $content_bg_color != '' ) {
				$elements = array(
					'#'.$prefix.$id
				);
				$style .= apex_css_background_color( $elements, $content_bg_color, $content_bg_color_opacity );
			}
			/* !Background image - 1.0.0 */
			if( $content_bg_image != '' ) {
				$elements = array(
					'#'.$prefix.$id
				);	
				$style .= apex_css_background_image( $elements, $content_bg_image, $content_bg_image_pattern );
			}
			/* !Background overlay - 1.0.0 */			
			if( $content_bg_overlay != '' ) {	
				$elements = array(
					'#'.$prefix.$id.' .apex-section-overlay'
				);
				$style .= apex_css_overlay( $elements, $content_bg_overlay, $content_bg_overlay_opacity );
			}
			
			if( $counter == 0 ) {
				
				/* --------------------------------------------------------- */
				/* !Header styles - 1.0.6 */
				/* --------------------------------------------------------- */
				
				/* !Highlight color - 1.0.0 */
				$color = $settings['header_highlight'];
				if( $color != '' ) {
				
					$elements = array(
						'#'.$prefix.$id.'-header #breadcrumbs a:hover'
					);
					$style .= apex_css_color( $elements, $color );
					
					$elements = array(
						'#'.$prefix.$id.'-header .section-header-sep span'
					);
					$style .= apex_css_border_color( $elements, $color, '', false, 'border-top-color' );
				}
				
				/* !Header background - 1.0.0 */
				$header_bg = isset( $settings['header_bg'] ) ? $settings['header_bg'] : array();
				$header_bg_color = isset( $header_bg['color'] ) ? $header_bg['color'] : '';
				$header_bg_color_opacity = isset( $header_bg['color_opacity'] ) ? $header_bg['color_opacity'] : '';
				$header_bg_image = isset( $header_bg['image'] ) ? $header_bg['image'] : '';
				$header_bg_image_pattern = isset( $header_bg['image_pattern'] ) ? $header_bg['image_pattern'] : '';
				$header_bg_overlay = isset( $header_bg['overlay'] ) ? $header_bg['overlay'] : '';
				$header_bg_overlay_opacity = isset( $header_bg['overlay_opacity'] ) ? $header_bg['overlay_opacity'] : '';
				
				/* !Header background color - 1.0.0 */
				if( $header_bg_color != '' ) {
					$elements = array(
						'#'.$prefix.$id.'-header'
					);
					$style .= apex_css_background_color( $elements, $header_bg_color, $header_bg_color_opacity );
				}
				/* !Header background image - 1.0.0 */
				if( $header_bg_image != '' ) {
					$elements = array(
						'#'.$prefix.$id.'-header'
					);
					$style .= apex_css_background_image( $elements, $header_bg_image, $header_bg_image_pattern );
				}
				/* !Header background overlay - 1.0.0 */			
				if( $header_bg_overlay != '' ) {
					$elements = array(
						'#'.$prefix.$id.'-header .apex-section-overlay'
					);
					$style .= apex_css_overlay( $elements, $header_bg_overlay, $header_bg_overlay_opacity );
				}

				/* --------------------------------------------------------- */
				/* !Hero styles - 1.0.6 */
				/* --------------------------------------------------------- */
				
				/* !Highlight color - 1.0.0 */
				$color = $settings['hero_highlight'];
				if( $color != '' ) {
				
					$elements = array(
						'#'.$prefix.$id.'-hero .apex-hero-menu-container a:hover'
					);
					$style .= apex_css_background_color( $elements, $color, 80 );
					$style .= apex_css_border_color( $elements, $color, 80 );
				}
				
				/* !Hero background - 1.0.0 */
				$hero_bg = isset( $settings['hero_bg'] ) ? $settings['hero_bg'] : array();
				$hero_bg_color = isset( $hero_bg['color'] ) ? $hero_bg['color'] : '';
				$hero_bg_color_opacity = isset( $hero_bg['color_opacity'] ) ? $hero_bg['color_opacity'] : '';
				$hero_bg_image = isset( $hero_bg['image'] ) ? $hero_bg['image'] : '';
				$hero_bg_image_pattern = isset( $hero_bg['image_pattern'] ) ? $hero_bg['image_pattern'] : '';
				$hero_bg_overlay = isset( $hero_bg['overlay'] ) ? $hero_bg['overlay'] : '';
				$hero_bg_overlay_opacity = isset( $hero_bg['overlay_opacity'] ) ? $hero_bg['overlay_opacity'] : '';
				
				/* !Hero background color - 1.0.0 */
				if( $hero_bg_color != '' ) {
					$elements = array(
						'#'.$prefix.$id.'-hero'
					);
					$style .= apex_css_background_color( $elements, $hero_bg_color, $hero_bg_color_opacity );
				}
				/* !Hero background image - 1.0.0 */
				if( $hero_bg_image != '' && !($settings['hero_bg_rotator'] != '' && $settings['hero_bg_rotator'] != 'none') ) {
					$elements = array(
						'#'.$prefix.$id.'-hero'
					);
					$style .= apex_css_background_image( $elements, $hero_bg_image, $hero_bg_image_pattern );
				}
				/* !Hero background overlay - 1.0.0 */			
				if( $hero_bg_overlay != '' ) {
					$elements = array(
						'#'.$prefix.$id.'-hero #apex-hero-overlay'
					);
					$style .= apex_css_overlay( $elements, $hero_bg_overlay, $hero_bg_overlay_opacity );
				}
			}
			
			$counter++;
		}
	}

	if( $style != '' ) {
		echo '<style id="apex-section-styles">'.$style.'</style>';
	}	
}
add_action( 'wp_head', 'apex_section_styles' );



/* --------------------------------------------------------- */
/* !Add the navigation & footer custom styles - 1.0.3 */
/* --------------------------------------------------------- */

function apex_nav_footer_styles() {

	global $apex_general_settings;
	
	$style = '';
	
	/* !Navigation - 1.0.0 */
	$color = ($apex_general_settings['navigation_highlight'] != '') ? $apex_general_settings['navigation_highlight'] : $apex_general_settings['custom_color'];
	if( $color != '' ) {
	
		$elements = array(
			'.apex-primary-menu-container li.active > a',
			'.apex-primary-menu-container a:hover',
			'.apex-primary-menu-container a:hover i'
		);
		$style .= apex_css_color( $elements, $color );
		
		$style .= '@media (min-width: 768px) {';
		
			$elements = array(
				'.apex-primary-menu-container ul ul a:hover'
			);
			$style .= apex_css_background_color( $elements, $color );
			
			$elements = array(
				'.apex-primary-menu-container > ul > li > ul > li:first-child > a:hover .sub-menu-arrow'
			);
			$style .= apex_css_border_color( $elements, $color, '', false, 'border-bottom-color' );
			
		$style .= '}';
	}
	
	/* !Footer - 1.0.0 */
	$color = ($apex_general_settings['footer_highlight'] != '') ? $apex_general_settings['footer_highlight'] : $apex_general_settings['custom_color'];
	if( $color != '' ) {
	
		$elements = array(
			'#site-footer a:hover',
			'a#apex-totop-float:hover i'
		);
		$style .= apex_css_color( $elements, $color );

		$elements = array(
			'#site-footer .mtphr-social-widget-site:hover i'
		);
		$style .= apex_css_background_color( $elements, $color );
	}
	
	if( $style != '' ) {
		echo '<style id="apex-footer-styles">'.$style.'</style>';
	}
}
add_action( 'wp_head', 'apex_nav_footer_styles' );



/* --------------------------------------------------------- */
/* !Add the custom typography - 1.0.0 */
/* --------------------------------------------------------- */

function apex_custom_typography_scripts() {

	if( function_exists('apex_typography_scripts') ) {
		apex_typography_scripts();
	}
}
add_action( 'wp_head', 'apex_custom_typography_scripts' );



/* --------------------------------------------------------- */
/* !Add the global & custom styles - 1.0.0 */
/* --------------------------------------------------------- */

function apex_custom_styles() {

	global $apex_general_settings;
	
	$style = '';
	
	if( $apex_general_settings['css'] != '' ) {
		$style .= html_entity_decode(sanitize_text_field($apex_general_settings['css']));
	}
	
	if( $style != '' ) {
		echo '<style id="apex-custom-styles">'.$style.'</style>';
	}
}
add_action( 'wp_head', 'apex_custom_styles' );
