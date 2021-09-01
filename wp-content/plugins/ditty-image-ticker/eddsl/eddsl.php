<?php
	
/* --------------------------------------------------------- */
/* !Add the plugin updater - 2.1.0 */
/* --------------------------------------------------------- */

if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

function mtphr_dnt_image_plugin_updater() {

	// retrieve our license key from the DB
	$mtphr_edd_licenses = get_option( 'mtphr_edd_licenses', array() );
	$license_key = isset($mtphr_edd_licenses['ditty-image-ticker']) ? trim($mtphr_edd_licenses['ditty-image-ticker']) : '';

	// setup the updater
	$edd_updater = new EDD_SL_Plugin_Updater( MTPHR_DNT_IMAGE_STORE_URL, 'ditty-image-ticker/ditty-image-ticker.php', array(
			'version' 	=> MTPHR_DNT_IMAGE_VERSION, 		// current version number
			'license' 	=> $license_key, 								// license key (used get_option above to retrieve from DB)
			'item_name' => MTPHR_DNT_IMAGE_ITEM_NAME, 	// name of this plugin
			'author' 	=> 'Metaphor Creations'  					// author of this plugin
		)
	);

}
add_action( 'admin_init', 'mtphr_dnt_image_plugin_updater', 0 );



/* --------------------------------------------------------- */
/* !Create the settings page - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_edd_settings_menu() {
	
	global $mtphr_edd_license_page;
	
	if( empty($mtphr_edd_license_page) ) {
		
		$mtphr_edd_license_page = 'ditty-image-ticker';
		
		add_options_page(
			__('Metaphor Licenses', 'ditty-image-ticker'),
			__('Metaphor Licenses', 'ditty-image-ticker'),
			'manage_options',
			'mtphr_licenses',
			'mtphr_dnt_image_licenses_display'
		);
	}
}
add_action( 'admin_menu', 'mtphr_dnt_image_edd_settings_menu', 9 );



/* --------------------------------------------------------- */
/* !Render the settings page with tabs - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_licenses_display( $active_tab = null ) {
	?>
	<!-- Create a header in the default WordPress 'wrap' container -->
	<div class="wrap">

		<h2><?php _e('Metaphor Creations Licenses', 'ditty-image-ticker'); ?></h2>
		<?php //settings_errors(); ?>

		<br class="clear" />

		<form method="post" action="options.php">
			<?php
			settings_fields( 'mtphr_edd_licenses' );
			do_settings_sections( 'mtphr_edd_licenses' );		
			?>
		</form>

	</div><!-- /.wrap -->
	<?php
}



/* --------------------------------------------------------- */
/* !Setup the settings - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_edd_initialize_settings() {
	
	global $mtphr_edd_license_page;
	
	
	/* --------------------------------------------------------- */
	/* !Add the setting sections - 2.1.0 */
	/* --------------------------------------------------------- */
	
	if( $mtphr_edd_license_page == 'ditty-image-ticker' ) {
		add_settings_section( 'mtphr_edd_licenses_section', false, false, 'mtphr_edd_licenses' );
	}
	
	
	/* --------------------------------------------------------- */
	/* !Add the settings - 2.1.0 */
	/* --------------------------------------------------------- */

	/* License */
	add_settings_field( 'mtphr_dnt_image_license', MTPHR_DNT_IMAGE_ITEM_NAME, 'mtphr_dnt_image_license', 'mtphr_edd_licenses', 'mtphr_edd_licenses_section' );


	
	/* --------------------------------------------------------- */
	/* !Register the settings - 2.1.0 */
	/* --------------------------------------------------------- */

	if( $mtphr_edd_license_page == 'ditty-image-ticker' ) {
		if( false == get_option('mtphr_edd_licenses') ) {
			add_option( 'mtphr_edd_licenses' );
		}
		register_setting( 'mtphr_edd_licenses', 'mtphr_edd_licenses', 'mtphr_edd_licenses_sanitize' );
	}
}
add_action( 'admin_init', 'mtphr_dnt_image_edd_initialize_settings' );



/* --------------------------------------------------------- */
/* !License field render - 2.1.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_dnt_image_license') ) {
function mtphr_dnt_image_license() {

	$mtphr_edd_licenses = get_option( 'mtphr_edd_licenses', array() );
	$mtphr_edd_license_data = get_option( 'mtphr_edd_license_data', array() );
		
	$license = '';
	$data = array();
	$status = false;
	$expires = false;
	if( isset($mtphr_edd_licenses['ditty-image-ticker']) ) {
		$license = isset( $mtphr_edd_licenses['ditty-image-ticker'] ) ? $mtphr_edd_licenses['ditty-image-ticker'] : '';
		$data = isset( $mtphr_edd_license_data['ditty-image-ticker'] ) ? $mtphr_edd_license_data['ditty-image-ticker'] : array();
		$status = isset( $data->license ) ? $data->license : false;
		$expires = isset( $data->expires ) ? date( 'F j, Y', strtotime($data->expires) ) : false;
		$expires = ( isset($data->expires) && $data->expires == 'lifetime' ) ? $data->expires : $expires;
		$activations_left = ( isset($data->activations_left) && $data->activations_left <= 0 ) ? 'none' : '';
	}
	$customer_dashboard = 'https://www.metaphorcreations.com/customer-dashboard/';
	?>
	<div>
		<?php wp_nonce_field( 'mtphr_dnt_image_license_nonce', 'mtphr_dnt_image_license_nonce' ); ?>
		<input id="mtphr_dnt_image_license_key" name="mtphr_edd_licenses[ditty-image-ticker]" type="text" class="regular-text" placeholder="<?php _e('Add your license key here', 'ditty-image-ticker'); ?>" value="<?php esc_attr_e( $license ); ?>" />
		
		<?php if( $status !== false && $status == 'valid' ) { ?>
			<input type="submit" class="button-secondary" name="mtphr_dnt_image_license_deactivate" value="<?php _e('Deactivate License', 'ditty-image-ticker'); ?>"/>
			<?php if( $expires == 'lifetime' ) { ?>
				<p><em><?php _e('Your license is activated!', 'ditty-image-ticker'); ?></em></p>
			<?php } else { ?>
				<p><em><?php printf( __('Your license key expires on %s', 'ditty-image-ticker'), $expires); ?></em></p>
			<?php } ?>
		<?php } elseif( $status !== false && $status == 'invalid' ) { ?>
			<input type="submit" class="button-primary" name="mtphr_dnt_image_license_activate" value="<?php _e('Activate License', 'ditty-image-ticker'); ?>"/>
			<?php
			$error = isset( $data->error ) ? $data->error : false;
			switch( $error ) {
				case 'no_activations_left':
					echo '<p><em>'.__('Sorry, it looks like all of your licenses have already been activated.', 'ditty-image-ticker').'</em></p>';
					echo '<p><em>'.sprintf(__('View your license activations <a href="%s" target="_blank">here</a>', 'ditty-image-ticker'), $customer_dashboard).'</em></p>';
					break;
					
				default:
					if( $license != '' ) {
						echo '<p><em>'.sprintf(__('Sorry, this license is not valid. View your licenses <a href="%s" target="_blank">here</a>', 'ditty-image-ticker'), $customer_dashboard).'</em></p>';
					}
					break;
			}
		} elseif( $status !== false ) {
			echo '<input type="submit" class="button-primary" name="mtphr_dnt_image_license_activate" value="'.__('Activate License', 'ditty-image-ticker').'"/>';
			switch( $status ) {
				
				case 'expired':
					echo '<p><em>'.sprintf(__('Sorry, your license has expired. Update your license <a href="%s" target="_blank">here</a>', 'ditty-image-ticker'), $customer_dashboard).'</em></p>';
					break;
					
				case 'disabled':
					echo '<p><em>'.__('Sorry, your license has been disabled.', 'ditty-image-ticker').'</em></p>';
					break;
					
				case 'site_inactive':
					if( $activations_left == 'none' ) {
						echo '<p><em>'.__('Sorry, it looks like all of your licenses have already been activated.', 'ditty-image-ticker').'</em></p>';
						echo '<p><em>'.sprintf(__('View your license activations <a href="%s" target="_blank">here</a>', 'ditty-image-ticker'), $customer_dashboard).'</em></p>';
					}
					break;
					
				default:
					break;
			}
			
		} else { ?>
			<input type="submit" class="button-primary" name="mtphr_dnt_image_license_activate" value="<?php _e('Activate License', 'ditty-image-ticker'); ?>"/>
		<?php } ?>
	</div>
	<?php
}
}



/* --------------------------------------------------------- */
/* !Sanitize the setting fields - 2.1.0 */
/* --------------------------------------------------------- */

if( !function_exists('mtphr_edd_licenses_sanitize') ) {
function mtphr_edd_licenses_sanitize( $new ) {
	
	$mtphr_edd_licenses = get_option( 'mtphr_edd_licenses', array() );
	$mtphr_edd_license_data = get_option( 'mtphr_edd_license_data', array() );
	
	if( is_array($new) && count($new) > 0 ) {
		foreach( $new as $product=>$license ) {
			
			// If there is a new license, reset the data
			if( isset($mtphr_edd_licenses[$product]) && $mtphr_edd_licenses[$product] !== $license ) {
				unset( $mtphr_edd_license_data[$product] );
			}	
		}
	}
	
	return $new;
}
}



/* --------------------------------------------------------- */
/* !Activate the license key - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_activate_license() {

	// listen for our activate button to be clicked
	if( isset($_POST['mtphr_dnt_image_license_activate']) && isset($_POST['mtphr_edd_licenses']) && isset($_POST['mtphr_edd_licenses']['ditty-image-ticker']) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'mtphr_dnt_image_license_nonce', 'mtphr_dnt_image_license_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( sanitize_text_field($_POST['mtphr_edd_licenses']['ditty-image-ticker']) );
		
		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'activate_license',
			'license' 	=> $license,
			'item_name' => urlencode( MTPHR_DNT_IMAGE_ITEM_NAME ), // the name of our product in EDD
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( MTPHR_DNT_IMAGE_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
		
		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;
		
		// Decode the response
		$data = json_decode( wp_remote_retrieve_body( $response ) );
		$status = isset( $data->license ) ? $data->license : false;
		
		// Store the license
		$mtphr_edd_license_data = get_option( 'mtphr_edd_license_data', array() );
		$mtphr_edd_license_data['ditty-image-ticker'] = $data;
		update_option( 'mtphr_edd_license_data', $mtphr_edd_license_data );

		// Store the license notice
		if( $status !== false && $status == 'valid' ) {
			$mtphr_edd_license_notices = get_option( 'mtphr_edd_license_notices', array() );
			$mtphr_edd_license_notices['ditty-image-ticker'] = '1';
			update_option( 'mtphr_edd_license_notices', $mtphr_edd_license_notices );
		}
	}
}
add_action('admin_init', 'mtphr_dnt_image_activate_license');



/* --------------------------------------------------------- */
/* !Deactivate the license key - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['mtphr_dnt_image_license_deactivate'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'mtphr_dnt_image_license_nonce', 'mtphr_dnt_image_license_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$mtphr_edd_licenses = get_option( 'mtphr_edd_licenses', array() );
		$license = isset( $mtphr_edd_licenses['ditty-image-ticker'] ) ? trim( $mtphr_edd_licenses['ditty-image-ticker'] ) : '';

		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( MTPHR_DNT_IMAGE_ITEM_NAME ), // the name of our product in EDD
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( MTPHR_DNT_IMAGE_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' ) {
			$mtphr_edd_license_data = get_option( 'mtphr_edd_license_data', array() );
			if( isset($mtphr_edd_license_data['ditty-image-ticker']) ) {
				unset($mtphr_edd_license_data['ditty-image-ticker']);
				update_option( 'mtphr_edd_license_data', $mtphr_edd_license_data );
			}
		}

	}
}
add_action('admin_init', 'mtphr_dnt_image_deactivate_license');



/* --------------------------------------------------------- */
/* !Check licenses daily - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_license_check() {
	
	global $wp_version;

	$mtphr_edd_licenses = get_option( 'mtphr_edd_licenses', array() );
	$license_key = isset($mtphr_edd_licenses['ditty-image-ticker']) ? trim($mtphr_edd_licenses['ditty-image-ticker']) : '';

	$api_params = array(
		'edd_action' 	=> 'check_license',
		'license' 		=> $license_key,
		'item_name' 	=> urlencode( MTPHR_DNT_IMAGE_ITEM_NAME ),
		'url'       	=> home_url()
	);

	// Call the custom API.
	$response = wp_remote_post( MTPHR_DNT_IMAGE_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

	if ( is_wp_error( $response ) )
		return false;

	// decode & store the license data
	$mtphr_edd_license_data = get_option( 'mtphr_edd_license_data', array() );
	$mtphr_edd_license_data['ditty-image-ticker'] = json_decode( wp_remote_retrieve_body( $response ) );
	
	update_option( 'mtphr_edd_license_data', $mtphr_edd_license_data );
}
add_action( 'mtphr_dnt_image_license_check_action', 'mtphr_dnt_image_license_check' );



/* --------------------------------------------------------- */
/* !Enable daily license check - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_enable_daily_license_check() {
	if(	!wp_next_scheduled('mtphr_dnt_image_license_check_action') ) {
		wp_schedule_event( time(), 'daily', 'mtphr_dnt_image_license_check_action' );
	}
}
register_activation_hook('ditty-image-ticker/ditty-image-ticker.php', 'mtphr_dnt_image_enable_daily_license_check');



/* --------------------------------------------------------- */
/* !Disable daily license check - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_disable_daily_license_check() {
	wp_clear_scheduled_hook( 'mtphr_dnt_image_license_check_action' );
}
register_deactivation_hook('ditty-image-ticker/ditty-image-ticker.php', 'mtphr_dnt_image_disable_daily_license_check');



/* --------------------------------------------------------- */
/* !Add a license check notice - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_license_bug() {
	
	// Check if the notice has been disabled
	$mtphr_edd_license_notices = get_option( 'mtphr_edd_license_notices', array() );
	if( !isset($mtphr_edd_license_notices['ditty-image-ticker']) ) {
  ?>
  <div id="ditty-image-ticker-license-notice" class="notice notice-warning is-dismissible">
	  <?php $url = admin_url('options-general.php?page=mtphr_licenses'); ?>
	  <p><?php printf( __('Don\'t forget to <a href="%1s">activate your license</a> for <strong>%2s</strong>!', 'ditty-image-ticker'), $url, MTPHR_DNT_IMAGE_ITEM_NAME); ?></p>
  </div>
  <?php
  }
}
add_action('admin_notices', 'mtphr_dnt_image_license_bug' );


/* --------------------------------------------------------- */
/* !Load a gallery via ajax - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_license_bug_dismiss() {

	// Check the nonce
	check_ajax_referer( 'ditty-image-ticker', 'security' );
	
	$mtphr_edd_license_notices = get_option( 'mtphr_edd_license_notices', array() );
	$mtphr_edd_license_notices['ditty-image-ticker'] = '1';
	update_option( 'mtphr_edd_license_notices', $mtphr_edd_license_notices );

	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_mtphr_dnt_image_license_bug_dismiss', 'mtphr_dnt_image_license_bug_dismiss' );



/* --------------------------------------------------------- */
/* !Admin footer scripts - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_license_bug_ajax() {
	?>
	<script>jQuery(document).ready(function($){$('#ditty-image-ticker-license-notice').click(function(e){if($(e.target).is('.notice-dismiss')){var data={action:'mtphr_dnt_image_license_bug_dismiss',security:'<?php echo wp_create_nonce( 'ditty-image-ticker' ); ?>'};jQuery.post(ajaxurl,data,function(response){});}});});</script>
	<?php
}
add_action( 'admin_footer', 'mtphr_dnt_image_license_bug_ajax' );



/* --------------------------------------------------------- */
/* !Add an Envato notice check - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_envato_bug() {
	
	// Check if the notice has been disabled
	$mtphr_edd_envato_notices = get_option( 'mtphr_edd_envato_notices', array() );
	if( !isset($mtphr_edd_envato_notices['ditty-image-ticker']) ) {
  ?>
  <div id="ditty-image-ticker-envato-notice" class="notice notice-warning is-dismissible">
	  <?php
		$link = '<a href="https://www.metaphorcreations.com" target="_blank">metaphorcreations.com</a>';
		$url = 'https://www.metaphorcreations.com/envato-customers/';
		?>
	  <?php printf( __('<h3 style="margin-bottom:0;">Notice to Envato customers:</h3><p><strong>%1s</strong> is no longer sold on the Envato market and will now be sold solely on %2s. <br/>Please <a href="%3s" target="_blank">view this page</a> for more information on this transition and your currently licensed Envato products. Thank you!</p>'), MTPHR_DNT_IMAGE_ITEM_NAME, $link, $url); ?>
  </div>
  <?php
  }
}
add_action('admin_notices', 'mtphr_dnt_image_envato_bug' );


/* --------------------------------------------------------- */
/* !Load a gallery via ajax - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_envato_bug_dismiss() {

	// Check the nonce
	check_ajax_referer( 'ditty-image-ticker', 'security' );
	
	$mtphr_edd_envato_notices = get_option( 'mtphr_edd_envato_notices', array() );
	$mtphr_edd_envato_notices['ditty-image-ticker'] = '1';
	update_option( 'mtphr_edd_envato_notices', $mtphr_edd_envato_notices );

	die(); // this is required to return a proper result
}
add_action( 'wp_ajax_mtphr_dnt_image_envato_bug_dismiss', 'mtphr_dnt_image_envato_bug_dismiss' );



/* --------------------------------------------------------- */
/* !Admin footer scripts - 2.1.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_image_envato_bug_ajax() {
	?>
	<script>jQuery(document).ready(function($){$('#ditty-image-ticker-envato-notice').click(function(e){if($(e.target).is('.notice-dismiss')){var data={action:'mtphr_dnt_image_envato_bug_dismiss',security:'<?php echo wp_create_nonce( 'ditty-image-ticker' ); ?>'};jQuery.post(ajaxurl,data,function(response){});}});});</script>
	<?php
}
add_action( 'admin_footer', 'mtphr_dnt_image_envato_bug_ajax' );