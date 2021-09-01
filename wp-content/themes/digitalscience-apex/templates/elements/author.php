<?php if( $description = get_the_author_meta('description') ) { ?>
<div id="author-info">
	<table>
		<tr>
			<td class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 70 ); ?>
			</td>
			<td class="author-data">
				<div class="author-header">
					<?php $author = get_the_author(); ?>
					<span class="author-name"><?php printf( __('About %s', 'apex'), $author ); ?></span>
				</div>
				<div class="author-body">
					<?php echo $description; ?>
				</div>
			</td>
		</tr>
	</table>
</div>
<?php }