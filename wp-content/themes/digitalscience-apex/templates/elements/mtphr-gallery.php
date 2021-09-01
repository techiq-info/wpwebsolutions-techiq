<?php
global $postid;
if( empty($postid) ) {
	$postid = get_the_id();
} else {
	$post_object = get_post( $postid );
	setup_postdata( $GLOBALS['post'] =& $post_object );
}
?>
aqsdsad
<div class="apex-format-project">

	<div class="entry-header">

		<?php the_content(); ?>
		
	</div>
	
	<div class="entry-content clearfix">
    	<div class="entry-featured">

			<?php
			$args['slider_layout'] = array( 'gallery', 'navigation' );
			echo get_mtphr_gallery( $postid, false, false, $args ); ?>
			
		</div>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div class="entry-meta">
			<?php if( is_rtl() ) { ?>
				<span><?php echo get_the_time( get_option('date_format') ); ?> <span class="entry-meta-title">:<?php _e('Date', 'apex'); ?></span></span>
			<?php } else { ?>
				<span><span class="entry-meta-title"><?php _e('Date', 'apex'); ?>:</span> <?php echo get_the_time( get_option('date_format') ); ?></span>
			<?php } ?>
  		<?php
  		$categories_list = get_the_category_list( __( ', ', 'apex' ) );
  		if( $categories_list != '' ) { ?>
	  		<?php if( is_rtl() ) { ?>
					<span><?php echo $categories_list; ?> <span class="entry-meta-title">:<?php _e('Tags', 'apex'); ?></span></span>
				<?php } else { ?>
					<span><span class="entry-meta-title"><?php _e('Tags', 'apex'); ?>:</span> <?php echo $categories_list; ?></span>
				<?php } ?>
  		<?php } ?>
		</div>
    

  </div><!-- .entry-content -->
	
</div>

<?php
if( !empty($postid) ) {
	wp_reset_postdata();
}