<div class="entry-header">
	<?php if( is_single() ) { ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	<?php } else { ?>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php } ?>
	<div class="entry-meta">
		<?php if( !is_single() ) { ?>
			<?php if( is_rtl() ) { ?>
				<span><?php echo get_the_time( get_option('date_format') ); ?> <span class="entry-meta-title">:<?php _e('Date', 'apex'); ?></span></span>
			<?php } else { ?>
				<span><span class="entry-meta-title"><?php _e('Date', 'apex'); ?>:</span> <?php echo get_the_time( get_option('date_format') ); ?></span>
			<?php } ?>
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
</div>

<div class="entry-content clearfix "> 

	<?php
	if( is_single() ) {
		the_content();
		apex_link_pages();
		
	} else {
		the_excerpt();
		
		echo '<a href="'.get_permalink().'" class="btn apex-readmore">'.__('Read More', 'apex').'</a>';
		if( comments_open() ) {
			echo '<a href="'.get_comments_link().'" class="entry-comments"><i class="apex-icon-speech-bubble-1"></i>'.get_comments_number().'</a>';
		}
	}
	?>

</div><!-- .entry-content -->

<!-- 
JES
override header background based on the demo site : http://doingart.co.il/portfolio/unidress/
-->

<style type="text/css">
	
	body.single.single-mtphr_gallery  .apex-header{
		background-image:url('<?php echo get_the_post_thumbnail_url( get_the_id() )?>') !important;
		
	}
	
</style>