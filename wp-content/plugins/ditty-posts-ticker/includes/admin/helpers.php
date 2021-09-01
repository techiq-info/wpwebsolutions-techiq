<?php
	
/* --------------------------------------------------------- */
/* !Return an array of post types - 2.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_posts_types') ) {
function mtphr_dnt_posts_types() {
	
	$post_types = array();
	$pts = get_post_types(array('public' => true), 'objects');
	unset( $pts['ditty_news_ticker'] );
	if( is_array($pts) && count($pts) > 0 ) {
		foreach( $pts as $i=>$pt ) {
			$post_types[$i] = $pt->labels->name;
		}
	}
	
	return $post_types;	
}
}


/* --------------------------------------------------------- */
/* !Return an array of post formats - 2.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_posts_formats') ) {
function mtphr_dnt_posts_formats() {
	
	$post_formats = array(
		'' => __('All', 'ditty-posts-ticker'),
	);
	if( current_theme_supports('post-formats') ) { 
  	$pfs = get_theme_support( 'post-formats' );
		if( is_array($pfs[0]) ) {
			foreach( $pfs[0] as $i=>$pf ) {
				$post_formats[$pf] = ucfirst($pf);
			}
		}
	}
	
	return $post_formats;	
}
}


/* --------------------------------------------------------- */
/* !Return an array of orderby values - 2.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_posts_orderby') ) {
function mtphr_dnt_posts_orderby() {
	
	$values = array(
		'ID' => __('ID', 'ditty-posts-ticker'),
		'author' => __('Author', 'ditty-posts-ticker'),
		'title' => __('Title', 'ditty-posts-ticker'),
		'name' => __('Name', 'ditty-posts-ticker'),
		'date' => __('Date', 'ditty-posts-ticker'),
		'modified' => __('Modified', 'ditty-posts-ticker'),
		'parent' => __('Parent', 'ditty-posts-ticker'),
		'rand' => __('Random', 'ditty-posts-ticker'),
		'comment_count' => __('Comment Count', 'ditty-posts-ticker'),
		'menu_order' => __('Menu Order', 'ditty-posts-ticker'),
		'meta_value' => __('Meta Value', 'ditty-posts-ticker'),
		'meta_value_num' => __('Meta Value Number', 'ditty-posts-ticker'),
		'post__in' => __('Post In', 'ditty-posts-ticker')
	);
		
	return $values;	
}
}


/* --------------------------------------------------------- */
/* !Return an array of query parameters - 2.0.2 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_query_params') ) {
function mtphr_dnt_query_params() {
	
	$values = array(
		'' => __('Select a Parameter', 'ditty-posts-ticker'),
		__('Author Parameters', 'ditty-posts-ticker') => array(
			'author' => 'author (int):|:'.__('Use author id.', 'ditty-posts-ticker'),
			'author_name' => 'author_name (string):|:'.__('Use \'user_nicename\' - NOT name.', 'ditty-posts-ticker'),
			'author__in' => 'author__in (array):|:'.__('Use author ids, separated by commas.', 'ditty-posts-ticker'),
			'author__not_in' => 'author__not_in (array):|:'.__('Use author ids, separated by commas.', 'ditty-posts-ticker'),
		),
		__('Category Parameters', 'ditty-posts-ticker') => array(
			'cat' => 'cat (int):|:'.__('Use category id.', 'ditty-posts-ticker'),
			'category_name' => 'category_name (string):|:'.__('Use category slug.', 'ditty-posts-ticker'),
			'category__and' => 'category__and (array):|:'.__('Use category ids, separated by commas.', 'ditty-posts-ticker'),
			'category__in' => 'category__in (array):|:'.__('Use category ids, separated by commas.', 'ditty-posts-ticker'),
			'category__not_in' => 'category__not_in (array):|:'.__('Use category ids, separated by commas.', 'ditty-posts-ticker'),
		),
		__('Tag Parameters', 'ditty-posts-ticker') => array(
			'tag' => 'tag (string):|:'.__('Use tag slug.', 'ditty-posts-ticker'),
			'tag_id' => 'tag_id (int):|:'.__('Use tag id.', 'ditty-posts-ticker'),
			'tag__and' => 'tag__and (array):|:'.__('Use tag ids, separated by commas.', 'ditty-posts-ticker'),
			'tag__in' => 'tag__in (array):|:'.__('Use tag ids, separated by commas.', 'ditty-posts-ticker'),
			'tag__not_in' => 'tag__not_in (array):|:'.__('Use tag ids, separated by commas.', 'ditty-posts-ticker'),
			'tag_slug__and' => 'tag_slug__and (array):|:'.__('Use tag slugs, separated by commas.', 'ditty-posts-ticker'),
			'tag_slug__in' => 'tag_slug__in (array):|:'.__('Use tag slugs, separated by commas.', 'ditty-posts-ticker'),
		),
		__('Search Parameter', 'ditty-posts-ticker') => array(
			's' => 's (string):|:'.__('Search keyword.', 'ditty-posts-ticker'),
		),
		__('Post & Page Parameters', 'ditty-posts-ticker') => array(
			'p' => 'p (int):|:'.__('Use post id.', 'ditty-posts-ticker'),
			'name' => 'name (string):|:'.__('Use post slug.', 'ditty-posts-ticker'),
			'page_id' => 'page_id (int):|:'.__('Use page id.', 'ditty-posts-ticker'),
			'pagename' => 'pagename (string):|:'.__('Use page slug.', 'ditty-posts-ticker'),
			'post_parent' => 'post_parent (int):|:'.__('Use page id to return only child pages. Set to 0 to return only top-level entries.', 'ditty-posts-ticker'),
			'post_parent__in' => 'post_parent__in (array):|:'.__('Use post ids, separated by commas. Specify posts whose parent is in an array.', 'ditty-posts-ticker'),
			'post_parent__not_in' => 'post_parent__not_in (array):|:'.__('Use post ids, separated by commas. Specify posts whose parent is not in an array.', 'ditty-posts-ticker'),
			'post__in' => 'post__in (array):|:'.__('Use post ids, separated by commas. Specify posts to retrieve. ATTENTION If you use sticky posts, they will be included (prepended!) in the posts you retrieve whether you want it or not. To suppress this behaviour use ignore_sticky_posts.', 'ditty-posts-ticker'),
			'post__not_in' => 'post__not_in (array):|:'.__('Use post ids, separated by commas. Specify post NOT to retrieve.', 'ditty-posts-ticker'),
			'post_name__in' => 'post_name__in (array):|:'.__('Use post slugs, separated by commas. Specify posts to retrieve.', 'ditty-posts-ticker'),
		),
		__('Password Parameters', 'ditty-posts-ticker') => array(
			'has_password' => 'has_password (bool):|:'.__('True for posts with passwords; false for posts without passwords; null for all posts with and without passwords.', 'ditty-posts-ticker'),
			'post_password' => 'post_password (string):|:'.__('Show posts with a particular password.', 'ditty-posts-ticker'),
		),
		__('Type Parameters', 'ditty-posts-ticker') => array(
			'post_type' => 'post_type (string/array):|:'.__('Use post types, separated by commas. Retrieves posts by Post Types, default value is \'post\'.', 'ditty-posts-ticker'),
		),
		__('Status Parameters', 'ditty-posts-ticker') => array(
			'post_status' => 'post_status (string/array):|:'.__('Use post status, separated by commas. Retrieves posts by Post Status. Default value is \'publish\', but if the user is logged in, \'private\' is added.', 'ditty-posts-ticker'),
		),
		__('Pagination Parameters', 'ditty-posts-ticker') => array(
			'posts_per_page' => 'posts_per_page (int):|:'.__('The number of posts to show per page', 'ditty-posts-ticker'),
			'offset' => 'offset (int):|:'.__('The number of posts to displace or pass over', 'ditty-posts-ticker'),
			'paged' => 'paged (int):|:'.__('The number of page to display', 'ditty-posts-ticker'),
			'ignore_sticky_posts' => 'ignore_sticky_posts (boolean):|:'.__('Ignore post stickiness. Use \'0\' or \'1\' for the value', 'ditty-posts-ticker'),
		),
		__('Date Parameters', 'ditty-posts-ticker') => array(
			'year' => 'year (int):|:'.__('4 digit year (e.g. 2011).', 'ditty-posts-ticker'),
			'monthnum' => 'monthnum (int):|:'.__('Month number (from 1 to 12).', 'ditty-posts-ticker'),
			'w' => 'w (int):|:'.__('Week of the year (from 0 to 53). Uses MySQL WEEK command. The mode is dependent on the "start_of_week" option.', 'ditty-posts-ticker'),
			'day' => 'day (int):|:'.__('Day of the month (from 1 to 31).', 'ditty-posts-ticker'),
			'hour' => 'hour (int):|:'.__('Hour (from 0 to 23).', 'ditty-posts-ticker'),
			'minute' => 'minute (int):|:'.__('Minute (from 0 to 60).', 'ditty-posts-ticker'),
			'second' => 'second (int):|:'.__('Second (0 to 60).', 'ditty-posts-ticker'),
			'm' => 'm (int):|:'.__('YearMonth (For e.g.: 201307).', 'ditty-posts-ticker'),
		),
		__('Custom Field Parameters', 'ditty-posts-ticker') => array(
			'meta_key' => 'meta_key (string):|:'.__('Custom field key.', 'ditty-posts-ticker'),
			'meta_value' => 'meta_value (string):|:'.__('Custom field value.', 'ditty-posts-ticker'),
			'meta_value_num' => 'meta_value_num (number):|:'.__('Custom field value.', 'ditty-posts-ticker'),
			'meta_compare' => 'meta_compare (string):|:'.__('Possible values are \'=\', \'!=\', \'>\', \'>=\', \'<\', \'<=\', \'LIKE\', \'NOT LIKE\', \'IN\', \'NOT IN\', \'BETWEEN\', \'NOT BETWEEN\', \'NOT EXISTS\', \'REGEXP\', \'NOT REGEXP\' or \'RLIKE\'. Default value is \'=\'.', 'ditty-posts-ticker'),
		),
	);
		
	return $values;	
}
}

	
/* --------------------------------------------------------- */
/* !Return an array of thumbnail sizes - 2.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_posts_thumb_sizes') ) {
function mtphr_dnt_posts_thumb_sizes() {
	
	// Setup the thumb sizes
	$thumb_sizes = array();
	$thumb_sizes['thumbnail'] = __('Thumbnail Size', 'ditty-posts-ticker');
	$thumb_sizes['medium'] = __('Medium Size', 'ditty-posts-ticker');
	$thumb_sizes['large'] = __('Large Size', 'ditty-posts-ticker');
	$thumb_sizes['full'] = __('Full Size', 'ditty-posts-ticker');
	
	// Loop through custom image sizes
	global $_wp_additional_image_sizes;
	if( is_array($_wp_additional_image_sizes) ) {
		$temp_thumb_sizes = array();
		foreach( $_wp_additional_image_sizes as $name => $size ) {
			$temp_dimensions = $size['width'].' x '.$size['height'];
			$dimensions = $size['width'].' x '.$size['height'];
			if( $size['crop'] == 1 ) {
				$temp_dimensions .= ' cropped';
				$dimensions .= ' cropped';
			}
			if( !in_array($temp_dimensions, $temp_thumb_sizes) ) {
				$temp_thumb_sizes[$name] = $temp_dimensions;
				$thumb_sizes[$name] = $dimensions;
			}	
		}
	}
	
	return $thumb_sizes;	
}
}


/* --------------------------------------------------------- */
/* !Post arrangement field helpers - 2.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_posts_arrangement_field_defaults') ) {
function mtphr_dnt_posts_arrangement_field_defaults() {
	
	$defaults = array(
		'title' => 'on',
		'date' => 'on',
		'thumb' => 'off',
		'excerpt' => 'on',
		'content' => 'off'
	);
	return $defaults;
}
}

if( !function_exists('mtphr_dnt_posts_arrangement_fields') ) {
function mtphr_dnt_posts_arrangement_fields( $values ) {
	
	$fields = array(
		
		/* !Title - 2.0.0 */
		'title' => array(
			'heading' => __('Post title', 'ditty-posts-ticker'),
			'fields' => array(
				
				/* !Title link - 2.0.0 */
				'title_link' => array(
					'type' => 'checkbox',
					'name' => '_mtphr_dnt_posts_title_link',
					'value' => $values['title_link'],
					'label' => __('Link to post', 'ditty-posts-ticker')
				),
				
			)
		),
		
		/* !Date - 2.0.0 */
		'date' => array(
			'heading' => __('Post date', 'ditty-posts-ticker'),
			'fields' => array(
				
				/* !Format - 2.0.0 */
				'title_link' => array(
					'type' => 'text',
					'heading' => __('Date format', 'ditty-posts-ticker'),
					'name' => '_mtphr_dnt_posts_date_format',
					'value' => $values['date_format'],
				),
				
			)
		),
		
		/* !Thumb - 2.0.0 */
		'thumb' => array(
			'heading' => __('Post thumbnail', 'ditty-posts-ticker'),
			'fields' => array(
				
				/* !Dimensions - 2.0.0 */
				'thumb_dimensions' => array(
					'type' => 'select',
					'heading' => __('Thumbnail size', 'ditty-posts-ticker'),
					'name' => '_mtphr_dnt_posts_thumb_dimensions',
					'value' => $values['thumb_dimensions'],
					'options' => mtphr_dnt_posts_thumb_sizes()
				),
				
				/* !Link - 2.0.0 */
				'thumb_link' => array(
					'type' => 'checkbox',
					'heading' => __('Permalink', 'ditty-posts-ticker'),
					'name' => '_mtphr_dnt_posts_thumb_link',
					'value' => $values['thumb_link'],
					'label' => __('Link thumbnail to post', 'ditty-posts-ticker')
				),
				
			)
		),
		
		/* !Excerpt - 2.0.0 */
		'excerpt' => array(
			'heading' => __('Post excerpt', 'ditty-posts-ticker'),
			'fields' => array(
				
				/* !Length - 2.0.0 */
				'excerpt_length' => array(
					'type' => 'number',
					'heading' => __('Excerpt length', 'ditty-posts-ticker'),
					'name' => '_mtphr_dnt_posts_excerpt_length',
					'value' => $values['excerpt_length'],
				),
				
				/* !More - 2.0.0 */
				'excerpt_more' => array(
					'type' => 'text',
					'help' => __('Surround text with {curly brackets} to create a permalink to the post.', 'ditty-posts-ticker'),
					'heading' => __('Excerpt more', 'ditty-posts-ticker'),
					'name' => '_mtphr_dnt_posts_excerpt_more',
					'value' => $values['excerpt_more'],
				),
				
				/* !Link - 2.0.0 */
				'excerpt_link' => array(
					'type' => 'checkbox',
					'heading' => __('Permalink', 'ditty-posts-ticker'),
					'help' => __('Link full excerpt to post', 'ditty-posts-ticker'),
					'name' => '_mtphr_dnt_posts_excerpt_link',
					'value' => $values['excerpt_link'],
					'label' => __('Link to post', 'ditty-posts-ticker')
				),
				
			)
		),
		
		/* !Content - 2.0.0 */
		'content' => array(
			'heading' => __('Post content', 'ditty-posts-ticker')
		),
	
	);

	if( is_array($values['custom_fields']) && count($values['custom_fields']) > 0 ) {
		foreach( $values['custom_fields'] as $i=>$cf ) {
			$fields[$cf['value']] = array(
				'heading' => $cf['value']
			);
		}
	}
		
	return $fields;
}
}