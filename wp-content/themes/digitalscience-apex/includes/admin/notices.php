<?php

/* --------------------------------------------------------- */
/* !Create admin notices - 1.1.0 */
/* --------------------------------------------------------- */

function apex_admin_notices() {
	
	global $current_user ;
  $user_id = $current_user->ID;
  
  $nag_ignores = get_user_meta( $user_id, 'apex_nag_ignores', true );
  $nag_ignores = is_array( $nag_ignores ) ? $nag_ignores : array();
  
	
	/* --------------------------------------------------------- */
	/* !Give warning about updated page icon functionality - 1.1.0 */
	/* --------------------------------------------------------- */
	
	if( !isset($nag_ignores['page_icon_warning']) ) {
	  echo '<div class="updated"><p>'; 
	  	$menu_url = admin_url( 'nav-menus.php' );
	  	_e( '<strong>Apex 1.1.0 Notice:</strong> Apex page icons have been removed from individual posts.', 'apex' );
	  	echo '<br/>';
	  	printf( __('Icons are now individually selected for each menu item within the <a href="%1$s">Appearance > Menus</a> page.', 'apex'), $menu_url );
	  	echo '<a class="apex-dismiss-notice" href="?apex_nag_ignore=page_icon_warning"><i class="dashicons dashicons-dismiss"></i>'.__('Dismiss', 'apex').'</a>';
	  echo "</p></div>";
	}
}
add_action( 'admin_notices', 'apex_admin_notices' );



/* --------------------------------------------------------- */
/* !Save the notice nags ignores - 1.1.0 */
/* --------------------------------------------------------- */

function example_nag_ignore() {
	
	global $current_user ;
  $user_id = $current_user->ID;
  
  $nag_ignores = get_user_meta( $user_id, 'apex_nag_ignores', true );
  $nag_ignores = is_array( $nag_ignores ) ? $nag_ignores : array();

  if( isset($_GET['apex_nag_ignore']) && 'page_icon_warning' == $_GET['apex_nag_ignore'] ) {
	  $nag_ignores['page_icon_warning'] = 'true';
		update_user_meta( $user_id, 'apex_nag_ignores', $nag_ignores );
	}
}
add_action('admin_init', 'example_nag_ignore');