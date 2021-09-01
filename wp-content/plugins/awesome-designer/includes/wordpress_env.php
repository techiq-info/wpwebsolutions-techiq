<?php


	function the_awe_des_check_is_admin_w(){
		 if( is_user_logged_in() ){ // check if user is logged in
			$get_user_id = get_current_user_id(); // get user ID
			$get_user_data = get_userdata($get_user_id); // get user data
			$get_roles = implode($get_user_data->roles);
			if( $get_roles =='administrator' ) return true;
			else return false;
		} else return false;
	}

	ob_start();
	$wpenv = preg_replace( "/wp-content.*/", "wp-load.php", __FILE__ );
	$wpfile = str_replace( "wp-load.php", "wp-admin" . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "file.php", $wpenv );
	require_once( $wpenv );
	require_once( $wpfile );
	ob_end_clean();
	
	global $wpdb;
	
	$url_dossier_awesome = THE_AWE_DES_AWESOME_URL;
	
?>