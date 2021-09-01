<?php /* Search form template */ ?>

<form method="get" class="search-form clearfix" action="<?php echo esc_url( home_url('/') ); ?>">
	<label for="s" class="assistive-text"><?php _e( 'Search', 'apex' ); ?></label>
	
	<div class="search-container">
		<input class="form-control" type="text" name="s" id="s" placeholder="<?php _e( 'Search', 'apex' ); ?>" />
		<button type="submit" name="submit"><i class="apex-icon-zoom"></i></button>
	</div>

</form>