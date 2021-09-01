<div class="entry-header">
	<div class="entry-featured">
		<?php the_post_thumbnail( 'apex-featured' ); ?>
	</div>
	<?php if( is_single() ) { ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	<?php } else { ?>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php } ?>
	<div class="entry-meta">
		<?php
		$title = get_post_meta( get_the_id(), '_mtphr_members_title', true );
		if( $title != '' ) {
			echo '<span><span class="entry-meta-title">'.$title.'</span></span>';
		}
		?>
	</div>
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