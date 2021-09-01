<?php
/*
  Plugin Name: Block Spam Comments
  Plugin URI: http://hizbul.com/category/plugins/block-spam-comments
  Description: Detect spam comments and block before submit. No need extra work just activate this plugin.
  Version: 1.0
  Author: Al Hizbul Bahar
  Author URI: http://www.hizbul.com/
 */

if(!function_exists('add_action')) {
	echo 'Hi there!!, i am just a plugin, not much i can do when you call directly';
	exit;
}

add_action('wp_head', 'block_spam_comments_js');

function block_spam_comments_js() {?>
	<script type="text/javascript">
		(function($) {
				$( "#commentform" ).on('submit', function(e){
				$( this ).append( '<input type="hidden" name="is_legal_comment" value="1">' );
			});
		})(jQuery);
	</script>
<?php }


add_filter( 'preprocess_comment', 'verify_block_spam_comment' );

function verify_block_spam_comment( $commentdata ) {
	if ( ! isset( $_POST['is_legal_comment'] ) )
		wp_die( __( 'You are bullshit user' ) );

	return $commentdata;
}