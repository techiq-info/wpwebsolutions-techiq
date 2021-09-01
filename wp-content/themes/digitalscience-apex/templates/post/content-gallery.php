<div class="entry-left entry-icons">
	<div class="entry-icon-date">
		<div class="entry-icon-date-day"><?php echo get_the_time('j'); ?></div>
		<div class="entry-icon-date-month"><?php echo get_the_time('M'); ?></div>
	</div>
	<div class="entry-icon-icon">
		<?php echo apex_get_post_format_icon(); ?>
	</div>
</div><!-- .entry-left -->

<div class="entry-right">
	<div class="entry-header">
		<div class="entry-featured">
			<?php
			$args['slider_layout'] = array( 'gallery', 'navigation' );
			echo get_mtphr_gallery( get_the_id(), false, false, $args );
			?>
		</div>
		<?php if( is_single() ) { ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php } else { ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php } ?>
		<?php apex_entry_meta(); ?>
	</div>

	<div class="entry-content clearfix">
	
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

</div>