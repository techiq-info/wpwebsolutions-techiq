<?php
	
/* --------------------------------------------------------- */
/* !Default post display template - 2.0.1 */
/* --------------------------------------------------------- */

// Get the global data
global $post, $mtphr_dnt_posts_meta_data;

// Extract the meta
extract( $mtphr_dnt_posts_meta_data );

$tick = '<div '.mtphr_dnt_posts_class().'>';

foreach( $_mtphr_dnt_posts_display_order as $key => $display ) {

	switch( $key ) {
		case 'title':
			if( $display == 'on' ) {
				
				$title = function_exists('icl_object_id') ? get_the_title( icl_object_id(get_the_id(), get_post_type()) ) : get_the_title();
				$title = apply_filters( 'mtphr_dnt_posts_title', $title, $id, $mtphr_dnt_posts_meta_data );
				$tick_title = '<h4 class="mtphr-dnt-posts-title">'.$title.'</h4>';

				// Check for a link
				if( isset($_mtphr_dnt_posts_title_link) && $_mtphr_dnt_posts_title_link ) {
					$tick_title = '<h4 class="mtphr-dnt-posts-title"><a href="'.get_permalink().'">'.$title.'</a></h4>';
				}

				$tick .= $tick_title;
			}
			break;
		case 'thumb':
			if( $display == 'on' ) {

				// Check if it's an attachment
				if( $_mtphr_dnt_posts_type=='attachment' ) {
					$image = wp_get_attachment_image( $post->ID, $_mtphr_dnt_posts_thumb_dimensions );
				} else {
					$image = get_the_post_thumbnail( get_the_id(), $_mtphr_dnt_posts_thumb_dimensions );
				}
				$thumb = apply_filters( 'mtphr_dnt_posts_thumb', $image, $id, $mtphr_dnt_posts_meta_data );

				// Check for a link
				if( isset($_mtphr_dnt_posts_thumb_link) && $_mtphr_dnt_posts_thumb_link ) {
					$thumb = '<a class="mtphr-dnt-posts-thumb" href="'.get_permalink().'">'.$thumb.'</a>';
				}
				$tick .= $thumb;
			}
			break;
		case 'date':
			if( $display == 'on' ) {
				$date = apply_filters( 'mtphr_dnt_posts_date', get_the_time( $_mtphr_dnt_posts_date_format ), $id, $mtphr_dnt_posts_meta_data );
				$tick .= '<span class="mtphr-dnt-posts-date">'.$date.'</span>';
			}
			break;
		case 'excerpt':
			if( $display == 'on' ) {

				$excerpt = ( $post->post_excerpt != '' ) ? $post->post_excerpt : strip_shortcodes($post->post_content);
				$excerpt = wp_html_excerpt( $excerpt, intval($_mtphr_dnt_posts_excerpt_length) );
				$excerpt = esc_html( $excerpt );

				// Check for excerpt more
				$more = ( isset($_mtphr_dnt_posts_excerpt_more) ) ? $_mtphr_dnt_posts_excerpt_more : '&hellip;';

				// Check for link added to more
				$links = array();
				preg_match('/{(.*?)\}/s', $more, $links);
				if( isset($links[0]) ) {
					$more_link = '<a class="mtphr-dnt-posts-readmore" href="'.get_permalink().'">'.$links[1].'</a>';
					$more = preg_replace('/{(.*?)\}/s', $more_link, $more);
				}
				
				$excerpt .= $more;

				$excerpt = apply_filters( 'mtphr_dnt_posts_excerpt', $excerpt, $id, $mtphr_dnt_posts_meta_data );

				// Check for a link
				if( isset($_mtphr_dnt_posts_excerpt_link) && $_mtphr_dnt_posts_excerpt_link ) {
					$excerpt = '<a href="'.get_permalink().'">'.$excerpt.'</a>';
				}

				$tick .= '<p class="mtphr-dnt-posts-excerpt">'.$excerpt.'</p>';
			}
			break;
		case 'content':
			if( $display == 'on' ) {

				// Use the attachment description, if there is one
				if( $_mtphr_dnt_posts_type=='attachment' && $post->post_content != '' ) {
					$content = apply_filters( 'the_content', $post->post_content );
				} else {
					$content = apply_filters( 'the_content', get_the_content() );
				}

				$content = apply_filters( 'mtphr_dnt_posts_content', $content, $id, $mtphr_dnt_posts_meta_data );
				$tick .= '<div class="mtphr-dnt-posts-content">'.$content.'</div>';
			}
			break;
		default:
			if( $display == 'on' ) {
				$cf = get_post_meta( get_the_id(), $key, false );
				if( is_array($cf) && count($cf) > 0 ) {
					$element = $_mtphr_dnt_posts_custom_fields[$key]['element'];
					$links = isset($_mtphr_dnt_posts_custom_fields[$key]['links']) ? $_mtphr_dnt_posts_custom_fields[$key]['links'] : '';
					$link_new = isset($_mtphr_dnt_posts_custom_fields[$key]['link_new']) ? $_mtphr_dnt_posts_custom_fields[$key]['link_new'] : '';
					foreach( $cf as $i=>$field ) {
						if( $field != '' ) {
							if( $links ) {
								$field = make_clickable($field);
								if( $link_new ) {
									$field = preg_replace( '/<a /', '<a target="_blank" ', $field );
								}
							}
							$tick .= '<'.$element.' class="mtphr-dnt-posts-custom-field-'.$key.'">'.$field.'</'.$element.'>';
						}
					}
				}
			}
			break;
	}
}

$tick .= '</div>';

echo $tick;