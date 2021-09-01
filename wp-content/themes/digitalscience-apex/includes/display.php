<?php

/* --------------------------------------------------------- */
/* !Display the favicon - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_favicon') ) {
function apex_favicon() {

	global $apex_general_settings;

	if ( isset($apex_general_settings['favicon']) ) {
		if( get_post_mime_type($apex_general_settings['favicon']) == 'image/png' ) {
			$favicon = wp_get_attachment_image_src( $apex_general_settings['favicon'], 'full' );
			echo '<link rel="icon" type="image/png" href="'.$favicon[0].'">';
		} elseif( get_post_mime_type($apex_general_settings['favicon']) == 'image/x-icon' ) {
			$favicon = wp_get_attachment_image_src( $apex_general_settings['favicon'], 'full' );
			echo '<link rel="icon" type="image/x-icon" href="'.$favicon[0].'">';
		}
	}
}
}



/* --------------------------------------------------------- */
/* !Display the menu logo - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('get_apex_menu_logo') ) {
function get_apex_menu_logo() {

	if( is_front_page() ) {
		$link = '#top';
	} else {
		$link = home_url();
	}
	
	$arr = get_apex_menu_logo_src();
	if( $arr ) {
		return '<a id="logo" href="'.$link.'" class="clearfix"><img src="'.$arr[0].'" width="'.$arr[1].'" height="'.$arr[2].'" alt="'.get_bloginfo( 'name' ).'" /></a>';
	} else {
		return '<a id="logo" href="'.$link.'" class="clearfix"><span class="wrapper">'.get_bloginfo( 'name' ).'</span></a>';
	}
}
}

if( !function_exists('get_apex_menu_logo_src') ) {
function get_apex_menu_logo_src() {

	global $apex_general_settings;

	if( $img = $apex_general_settings['logo'] ) {
		return wp_get_attachment_image_src($img, 'full');
	}
	return false;
}
}



/* --------------------------------------------------------- */
/* !Display the hero logo - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_hero_logo') ) {
function apex_hero_logo() {
	echo get_apex_hero_logo();
}
}

if( !function_exists('get_apex_hero_logo') ) {
function get_apex_hero_logo() {
	$arr = get_apex_hero_logo_src();
	if( $arr ) {
		return '<div id="hero-logo" class="apex-hero-element"><a href="'.home_url().'" class="clearfix"><img src="'.$arr[0].'" width="'.$arr[1].'" height="'.$arr[2].'" alt="'.get_bloginfo( 'name' ).'" /></a></div>';
	}
}
}

if( !function_exists('get_apex_hero_logo_src') ) {
function get_apex_hero_logo_src() {

	$settings = apex_section_settings();

	if( $img = $settings['hero_logo'] ) {
		return wp_get_attachment_image_src($img, 'full');
	}
	return false;
}
}



/* --------------------------------------------------------- */
/* !Setup & display the hero rotator - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_hero_rotator') ) {
function apex_hero_rotator() {

	$settings = apex_section_settings();
	
	if( $settings['hero_rotator'] != '' && $settings['hero_rotator'] != 'none' && get_post($settings['hero_rotator']) ) {
		echo '<div id="hero-rotator" class="apex-hero-element">';
			if( function_exists('ditty_news_ticker') ){
				$atts = array(
					'mode' => 'rotate',
					'rotate_height' => 0,
					'rotate_padding' => 0,
					'rotate_margin' => 0,
					'rotate_directional_nav' => 0,
					'rotate_control_nav' => 1,
					'rotate_control_nav_type' => 'button',
					'unique_id' => 'apex-hero'
				);
				ditty_news_ticker( $settings['hero_rotator'], false, $atts  );
			}
		echo '</div>';
	}
}
}


/* --------------------------------------------------------- */
/* !Setup & display the hero bg rotator - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_hero_bg_rotator') ) {
function apex_hero_bg_rotator() {

	$settings = apex_section_settings();
	
	if( $settings['hero_bg_rotator'] != '' && $settings['hero_bg_rotator'] != 'none' && get_post($settings['hero_bg_rotator']) ) {
		echo '<div id="hero-bg-rotator">';
			if( function_exists('ditty_news_ticker') ){
				$atts = array(
					'mode' => 'rotate',
					'rotate_height' => 0,
					'rotate_padding' => 0,
					'rotate_margin' => 0,
					'rotate_directional_nav' => 0,
					'rotate_control_nav' => 0,
					'unique_id' => 'apex-hero'
				);
				if( $settings['hero_rotator'] != 'none' ) {
					$atts['auto_rotate'] = 0;
				}
				ditty_news_ticker( $settings['hero_bg_rotator'], false, $atts  );
			}
		echo '</div>';
	}
}
}



/* --------------------------------------------------------- */
/* !Set & return the page title - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_section_title') ) {
function apex_section_title() {

	global $apex_current_page_type;
	
	$title = apex_global_setting( 'title' );
	$title_display = apex_global_setting( 'title_display' );
	
	if( $ps = apex_single_setting() ) {
		if( isset($ps['title']) && $ps['title'] != '' ) {
			$title = $ps['title'];
		}
		if( isset($ps['title_display']) && $ps['title_display'] != '' && $ps['title_display'] != 'default' ) {
			$title_display = $ps['title_display'];
		}
	}
	if(get_post_type()  == "mtphr_gallery" ){

		$title = get_the_title();

	}
	if( $title == '' ) {
		
		switch( $apex_current_page_type ) {
			
			case 'blog':
				$title = get_bloginfo('name');
				break;
				
			case 'archive':
				$title = __('Archive', 'apex');
				break;
				
			case 'taxonomy':
				global $wp_query;
				$term = $wp_query->get_queried_object();
				if( isset($term->taxonomy) ) {
					$taxonomy = get_taxonomy( $term->taxonomy );
					$title = $taxonomy->labels->singular_name;
				}
				break;
				
			case 'search':
				$title = __('Search', 'apex');
				break;
				
			case 'error':
				$title = __('Error', 'apex');
				break;
				
			default:
				$title = get_the_title();
				break;
		}
	}

	if( $title_display == 'show' && $title != '' ) {
		return html_entity_decode( $title );
	}
}
}

/* --------------------------------------------------------- */
/* !Set & return the page tagline - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_section_tagline') ) {
function apex_section_tagline() {

	global $apex_current_page_type;
	
	$tagline = apex_global_setting( 'tagline' );
	$tagline_display = apex_global_setting( 'tagline_display' );
	
	if( $ps = apex_single_setting() ) {
		if( isset($ps['tagline']) && $ps['tagline'] != '' ) {
			$tagline = $ps['tagline'];
		}
		if( isset($ps['tagline_display']) && $ps['tagline_display'] != '' && $ps['tagline_display'] != 'default' ) {
			$tagline_display = $ps['tagline_display'];
		}
	}
	
	if( $tagline == '' ) {
		
		switch( $apex_current_page_type ) {
				
			case 'archive':
		    $tagline = single_month_title( ' ', false);
				break;
				
			case 'taxonomy':
				global $wp_query;
		    $term = $wp_query->get_queried_object();
		    $tagline = '"'.$term->name.'"';
				break;
				
			case 'search':
				$tagline = '"'.get_search_query().'"';
				break;
				
			default:
				$tagline = get_bloginfo('description');
				break;
		}
	}
	
	if( $tagline_display == 'show' && $tagline != '' ) {
		return html_entity_decode( $tagline );
	}
}
}

/* --------------------------------------------------------- */
/* !Display the page title & tagline - 1.1.7 */
/* --------------------------------------------------------- */

if( !function_exists('apex_section_title_tag') ) {
function apex_section_title_tag() {
	
	$html = '';
	$title = apex_section_title();
	$tagline = apex_section_tagline();
	if( $title != '' || $tagline != '' ) {
		
		$html .= '<div class="'.join( ' ', get_apex_section_header_class() ).'" '.apex_wow_attributes('header', false).'>';
		if( $title != '' ) {
			$html .= '<h1 class="section-title">'.$title.'</h1>';
		}
		if( $title != '' && $tagline != '' ) {
			$html .= '<div class="section-header-sep"><span></span></div>';
		}
		if( $tagline != '' ) {
			$html .= '<h2 class="section-tagline">'.$tagline.'</h2>';
		}
		$html .= '</div>';
	}
	return $html;
}
}



/* --------------------------------------------------------- */
/* !Set & display the post navigation - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_post_navigation') ) {
function apex_post_navigation() {

	global $apex_content_settings;
	$settings = $apex_content_settings['post_navigation'];
	$display = isset($settings['display']) ? $settings['display'] : '';
	$orderby = isset($settings['orderby']) ? $settings['orderby'] : 'date';
	$order = isset($settings['order']) ? $settings['order'] : 'DESC';
	$home = isset($settings['home']) ? $settings['home'] : '';
	$previous = isset($settings['previous']) ? $settings['previous'] : '';
	$next = isset($settings['next']) ? $settings['next'] : '';
	$home_link = isset($settings['home_link']) ? $settings['home_link'] : '';
	$html = '';

	if( is_single() && $display == 'show' ) {

		$query_args = array(
	    'post_type' => get_post_type(),
	    'numberposts' => -1,
	    'orderby' => $orderby,
	    'order' => $order
		);

		// Check for query args
		$taxonomy = isset($_GET['taxonomy']) ? $_GET['taxonomy'] : '';
		$terms = isset($_GET['terms']) ? $_GET['terms'] : '';
		if( $taxonomy && $terms ) {
			$tax_query = array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => explode(',', $terms)
			);
			$query_args['tax_query'] = array( $tax_query );
		}

		// Get the object IDs
		$p_objs = get_posts( $query_args );
		$p_ids = array();
		foreach( $p_objs as $p ) {
			$p_ids[] = $p->ID;
		}

		// Get the current position
		$current = array_search( get_the_id(), $p_ids );
		$prev_post = (($current-1) < 0) ? (count($p_ids)-1) : $current-1;
		$next_post = (($current+1) == count($p_ids)) ? 0 : $current+1;
		$prev_permalink = ( $taxonomy && $terms ) ? esc_url( add_query_arg(array('taxonomy' => $taxonomy, 'terms' => $terms), get_permalink($p_ids[$prev_post])) ) : esc_url( remove_query_arg(array('taxonomy', 'terms'), get_permalink($p_ids[$prev_post])) );
		$next_permalink = ( $taxonomy && $terms ) ? esc_url( add_query_arg(array('taxonomy' => $taxonomy, 'terms' => $terms), get_permalink($p_ids[$next_post])) ) : esc_url( remove_query_arg(array('taxonomy', 'terms'), get_permalink($p_ids[$next_post])) );

		$html .= '<nav class="apex-post-navigation">';
			$html .= '<ul>';
				if( $home != '' && $home_link != '' ) {
					$html .= '<li class="apex-post-navigation-home"><a href="'.$home_link.'">'.$home.'</a></li>';
				}
				if( $previous != '' ) {
					$html .= '<li class="apex-post-navigation-previous"><a href="'.$prev_permalink.'">'.$previous.'</a></li>';
				}
				if( $next != '' ) {
					$html .= '<li class="apex-post-navigation-next"><a href="'.$next_permalink.'">'.$next.'</a></li>';
				}
			$html .= '</ul>';
		$html .= '</nav>';
	}
	return $html;
}
}


/* --------------------------------------------------------- */
/* !Render the appropriate post format icon - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_get_post_format_icon') ) {
function apex_get_post_format_icon( $post_id=false ) {
	
	$post_id = $post_id ? $post_id : get_the_id();
	
	switch( get_post_format($post_id) ) {
		case 'video':
			return '<i class="apex-icon-film-1"></i>';
			break;
			
		case 'image':
			return '<i class="apex-icon-polaroid-1"></i>';
			break;
			
		case 'gallery':
			return '<i class="apex-icon-polaroid-2"></i>';
			break;
			
		case 'quote':
			return '<i class="apex-icon-quotes"></i>';
			break;
			
		default:
			return '<i class="apex-icon-file"></i>';
			break;
	}
}
}


/* --------------------------------------------------------- */
/* !Render the footer copyright - 1.0.9 */
/* --------------------------------------------------------- */

if( !function_exists('apex_footer_copyright') ) {
function apex_footer_copyright( $pull = '' ) {

	global $apex_general_settings;

	$html = '';
	if( $apex_general_settings['copyright'] != '' ) {
		if( $pull == '' ) {
			$html .= '<div id="apex-copyright" class="col-sm-6" role="complementary">';
		} else {
			if( is_rtl() ) {
				$html .= '<div id="apex-copyright" class="col-sm-6 col-sm-push-6" role="complementary">';
			} else {
				$html .= '<div id="apex-copyright" class="col-sm-6 col-sm-pull-6" role="complementary">';
			}
		}
			$html .= '<div class="wrapper clearfix">';
				$html .= do_shortcode(wpautop(convert_chars(wptexturize($apex_general_settings['copyright']))));
			$html .= '</div>';
		$html .= '</div>';
	}
	return $html;
}
}



/* --------------------------------------------------------- */
/* !Render the footer social links - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_footer_social_links') ) {
function apex_footer_social_links() {

	global $apex_general_settings;;

	$html = '';
	$links = apex_social_links();
	if( $links != '' ) {
		if( is_rtl() ) {
			$html .= '<div id="apex-social-links" class="col-sm-6 col-sm-pull-6 clearfix" role="complementary">';
		} else {
			$html .= '<div id="apex-social-links" class="col-sm-6 col-sm-push-6 clearfix" role="complementary">';
		}
			$html .= '<div class="wrapper clearfix">';
				$html .= $links;
			$html .= '</div>';
		$html .= '</div>';
	}
	return $html;
}
}



/* --------------------------------------------------------- */
/* !Render the social links - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_social_links') ) {
function apex_social_links() {
	
	if( function_exists('metaphor_widgets_social_links_display') ) {
	
		global $apex_general_settings;
		$sites = $apex_general_settings['social_links'];
		$new_tab = $apex_general_settings['social_target'];
	
		return metaphor_widgets_social_links_display( $sites, $new_tab );
	}
}
}



/* --------------------------------------------------------- */
/* !Render the archive navigation & pagination - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_post_archive_navigation') ) {
function apex_post_archive_navigation() {

	global $apex_general_settings;
	
	// Use pagination
	if( $apex_general_settings['archive_navigation'] == 'on' ) {
		apex_post_archive_pagination();

	// Use default navigation
	} else {
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) {
			?>
			<nav class="content-nav clearfix">
				<?php if( $prev = get_previous_posts_link('<i class="apex-icon-arrow-left-1"></i> '.__('Newer', 'apex')) ) { ?>
				<div class="nav-next"><?php echo $prev; ?></div>
				<?php } ?>
				<?php if( $next = get_next_posts_link(__('Older', 'apex').' <i class="apex-icon-arrow-right-1"></i>') ) { ?>
				<div class="nav-previous"><?php echo $next; ?></div>
				<?php } ?>
			</nav><!-- #nav-above -->
			<?php
		}
	}
}
}

if( !function_exists('apex_post_archive_pagination') ) {
function apex_post_archive_pagination() {

	// Get total number of pages
	global $wp_query;
	$total = $wp_query->max_num_pages;

	// If there is more than 1 page, display the links
	if ( $total > 1 )  {

		// Get the current page
		if ( !$current_page = get_query_var('paged') ) {
			$current_page = 1;
		}

		// Create the base structure
		$base = strtok(get_pagenum_link(1), '?').'%_%';

		// Get the user defined page structure
		$structure = get_option( 'permalink_structure' );
		$format = empty( $structure ) ? '&page=%#%' : 'page/%#%/';

		// Modify base structure if search or archive page
		if ( is_search() || is_archive() ) {
			$big = 999999999; // need an unlikely integer
			$base = str_replace( $big, '%#%', get_pagenum_link( $big ) );
		}

		$args = array(
			'base' => $base,
			'format' => $format,
			'current' => $current_page,
			'total' => $total,
			'mid_size' => 4,
			'type' => 'list',
			'prev_next' => false,
			'add_args' => $_GET
		);

		// Display the links
		echo '<div class="content-nav clearfix">'.paginate_links( $args ).'</div>';
	}
}
}


/* --------------------------------------------------------- */
/* !Link pages - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_link_pages') ) {
function apex_link_pages() {
	
	$args = array(
		'before' => '<div class="paginate-links clearfix">',
		'after' => '</div>',
		'link_before' => '<span class="paginate-links-number">',
		'link_after' => '</span>',
		'separator' => ''
	);
	wp_link_pages( $args );
}
}


/* --------------------------------------------------------- */
/* !Display the entry meta - 1.1.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_entry_meta') ) {
function apex_entry_meta() {
	?>
	<div class="entry-meta">
		<?php if( is_rtl() ) { ?>

  		<?php
  		$tags_list = get_the_tag_list( '', ', ', '' );
			if( $tags_list ) { ?>
  			<span><?php echo $tags_list; ?> <span class="entry-meta-title">:<?php _e('Tags', 'apex'); ?></span></span>
  		<?php } ?>
  		<?php
  		$categories_list = get_the_category_list( ', ' );
			if( $categories_list ) { ?>
  			<span><?php echo $categories_list; ?> <span class="entry-meta-title">:<?php _e('Category', 'apex'); ?></span></span>
  		<?php } ?>
  		<span><?php echo get_the_author_link(); ?> <span class="entry-meta-title">:<?php _e('By', 'apex'); ?></span></span>
			
		<?php } else { ?>
		
			<span><span class="entry-meta-title"><?php _e('By', 'apex'); ?>:</span> <?php echo get_the_author_link(); ?></span>
  		<?php
  		$categories_list = get_the_category_list( ', ' );
			if( $categories_list ) { ?>
  			<span><span class="entry-meta-title"><?php _e('Category', 'apex'); ?>:</span> <?php echo $categories_list; ?></span>
  		<?php } ?>
  		<?php
  		$tags_list = get_the_tag_list( '', ', ', '' );
			if( $tags_list ) { ?>
  			<span><span class="entry-meta-title"><?php _e('Tags', 'apex'); ?>:</span> <?php echo $tags_list; ?></span>
  		<?php } ?>
			
		<?php } ?>
	</div>
	<?php
}
}


/* --------------------------------------------------------- */
/* !Render the comment list - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_comment') ) {
function apex_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :
		case '' : ?>

			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <table id="comment-<?php comment_ID(); ?>" class="comment-container clearfix">
        	<tr>
	          <td class="comment-avatar">
	          	<?php echo get_avatar( $comment, 70 ); ?>
          	</td>
          	
						<?php if ( $comment->comment_approved == '0' ) : ?>
	            
	            <td class="comment-data">
		          	
		          	<div class="comment-header">
		          		<span class="comment-author"><a href="#"><?php echo get_comment_author_link(); ?></a></span>
									<span class="comment-date"><?php echo get_comment_date(get_option('date_format')); ?></span>
		          	</div>

	              <div class="comment-body">
	              	<p class="comment-awaiting-moderation"><?php _e( '* Your comment is awaiting moderation.', 'apex' ); ?></p>
	              	<?php comment_text(); ?>
              	</div>

	            </td><!-- #comment-data -->

						<?php else: ?>
	
		          <td class="comment-data">
		          	
		          	<div class="comment-header">
		          		<span class="comment-author"><a href="#"><?php echo get_comment_author_link(); ?></a></span>
									<span class="comment-date"><?php echo get_comment_date(get_option('date_format')); ?></span>
		          	</div>

	              <div class="comment-body">
	              	<?php comment_text(); ?>
              	</div>

								<?php
								if( comments_open() ) {
									comment_reply_link( array_merge($args, array('depth' => 1, 'max_depth' => 2, 'reply_text' => __( 'Reply', 'apex' ))) );
								}
								?>
	            </td><!-- #comment-data -->
	
						<?php endif; ?>
        	</tr>
        </table><!-- #comment-##  -->

		<?php break;

		case 'pingback'  :
		case 'trackback' : ?>

    		<li class="post pingback">
					<p class="pingback"><?php _e( 'Pingback:', 'apex' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'apex' ), ' ' ); ?></p>
		<?php break;

	endswitch;
}
}
