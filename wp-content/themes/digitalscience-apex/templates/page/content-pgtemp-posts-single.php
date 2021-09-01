<?php
$atts = get_post_meta( get_the_id(), '_apex_post_archive_settings', true );
$orderby = isset($atts['orderby']) ? $atts['orderby'] : '';
$order = isset($atts['order']) ? $atts['order'] : '';
$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
	'post_type'=> 'post',
	'paged' => $page,
	'orderby' => $orderby,
	'order' => $order,
	'posts_per_page' => get_option('posts_per_page')
);

// Check for tax queries
$tax_query = array();

// Add category taxonomies
$operator = isset($atts['category_operator']) ? $atts['category_operator'] : '';
if( $operator != '' && isset($atts['categories']) ) {	
	$tax_query[] = array(
		'taxonomy' => 'category',
		'field' => 'id',
		'terms' => $atts['categories'],
		'operator' => $operator
	);
}

// Add tag taxonomies
$operator = isset($atts['tag_operator']) ? $atts['tag_operator'] : '';
if( $operator != '' && isset($atts['tags']) ) {
	$tax_query[] = array(
		'taxonomy' => 'post_tag',
		'field' => 'id',
		'terms' => $atts['tags'],
		'operator' => $operator
	);
}

if( count($tax_query) > 0 ) {
	$args['tax_query'] = $tax_query;
}

// Save the original query & create a new one
global $wp_query;
$original_query = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
$wp_query->query( $args );
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php get_template_part( 'templates/post/content', get_post_format() ); ?>

	</article><!-- #post-<?php the_ID(); ?> -->

<?php
endwhile;
else :
endif;
?>

<?php apex_post_archive_navigation(); ?>

<?php
$wp_query = null;
$wp_query = $original_query;
wp_reset_postdata();