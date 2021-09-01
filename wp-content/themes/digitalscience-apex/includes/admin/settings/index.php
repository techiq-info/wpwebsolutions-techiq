<?php

/* --------------------------------------------------------- */
/* !Load the settings files - 1.0.0 */
/* --------------------------------------------------------- */

require_once( APEX_DIR.'/includes/admin/settings/general.php' );
require_once( APEX_DIR.'/includes/admin/settings/content.php' );
require_once( APEX_DIR.'/includes/admin/settings/typography.php' );
require_once( APEX_DIR.'/includes/admin/settings/import.php' );



/* --------------------------------------------------------- */
/* !Create the settings page - 1.0.0 */
/* --------------------------------------------------------- */

function apex_theme_menu() {

	 $page = add_theme_page(
		__( 'Apex Settings', 'apex' ), 		// The title to be displayed in the browser window for this page.
		__( 'Theme Settings', 'apex' ),		// The text to be displayed for this menu item
		'administrator',											// Which type of users can see this menu item
		'apex',															// The unique ID - that is, the slug - for this menu item
		'apex_settings_display'							// The name of the function to call when rendering this menu's page
	);
}
add_action( 'admin_menu', 'apex_theme_menu', 9 );



/* --------------------------------------------------------- */
/* !Initialize the settings - 1.0.0 */
/* --------------------------------------------------------- */

function apex_initialize_theme_options() {

	// Load the settings
	apex_general_settings_setup();
	apex_content_settings_setup();
	apex_typography_settings_setup();
	apex_import_settings_setup();
}
add_action( 'admin_init', 'apex_initialize_theme_options' );



/* --------------------------------------------------------- */
/* !Render the settings page */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_display') ) {
function apex_settings_display( $active_tab = null ) {
	?>
	<div class="wrap">
		<div id="icon-themes" class="icon32"></div>
		<h2><?php _e( 'Apex Theme Settings', 'apex' ); ?></h2>
		<?php settings_errors(); ?>
		<?php $active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general'; ?>
		<h2 class="nav-tab-wrapper">
			<a href="?page=apex&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>"><?php _e( 'General Settings', 'apex' ); ?></a>
			<a href="?page=apex&tab=content" class="nav-tab <?php echo $active_tab == 'content' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Content Settings', 'apex' ); ?></a>
			<a href="?page=apex&tab=typography" class="nav-tab <?php echo $active_tab == 'typography' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Typography', 'apex' ); ?></a>
			<a href="?page=apex&tab=import" class="nav-tab <?php echo $active_tab == 'import' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Import/Export', 'apex' ); ?></a>
		</h2>
		<?php
		$sub = isset( $_GET['sub'] ) ? $_GET['sub'] : 'all';

		if( $active_tab == 'typography' ) {
			echo '<ul class="subsubsub">';
				echo '<li><a class="'.($sub == 'all' ? 'current' : '').'" href="'.esc_url( remove_query_arg(array('sub')) ).'">'.__( 'All', 'apex' ).'</a> |</li>';
				echo '<li><a class="'.($sub == 'generic' ? 'current' : '').'" href="'.esc_url(add_query_arg(array('sub' => 'generic')) ).'">'.__( 'Generic', 'apex' ).'</a> |</li>';
				echo '<li><a class="'.($sub == 'class' ? 'current' : '').'" href="'.esc_url(add_query_arg(array('sub' => 'class')) ).'">'.__( 'Classes', 'apex' ).'</a></li>';
			echo '</ul>';

		} elseif( $active_tab == 'content' ) {
		
			// Get the sections the user has selected to display
			$general_settings = apex_general_settings();	
			$global_setting_sections = $general_settings['global_setting_sections'];

			$post_types = get_apex_posttype_labels( false, true );
			$post_types = array_intersect_key( $post_types, $global_setting_sections );
			
			reset( $post_types );
			$sub = isset( $_GET['sub'] ) ? $_GET['sub'] : key( $post_types );
			
			echo '<ul class="subsubsub">';
				$count = count($post_types);
				$counter = 1;
				foreach( $post_types as $i => $pt ) {
					$sep = ($counter < $count) ? ' |' : '';
					echo '<li><a class="'.($sub == $i ? 'current' : '').'" href="'.esc_url( add_query_arg(array('sub' => $i)) ).'">'.$pt['name'].'</a>'.$sep.'</li>';
					$counter++;
				}
			echo '</ul>';

		} elseif( $active_tab == 'general' ) {
			echo '<ul class="subsubsub">';
				echo '<li><a class="'.($sub == 'all' ? 'current' : '').'" href="'.esc_url( remove_query_arg(array('sub')) ).'">'.__( 'All', 'apex' ).'</a> |</li>';
				echo '<li><a class="'.($sub == 'general' ? 'current' : '').'" href="'.esc_url( add_query_arg(array('sub' => 'general')) ).'">'.__( 'General', 'apex' ).'</a> |</li>';
				echo '<li><a class="'.($sub == 'style' ? 'current' : '').'" href="'.esc_url( add_query_arg(array('sub' => 'style')) ).'">'.__( 'Style', 'apex' ).'</a> |</li>';
				echo '<li><a class="'.($sub == 'social' ? 'current' : '').'" href="'.esc_url( add_query_arg(array('sub' => 'social')) ).'">'.__( 'Social', 'apex' ).'</a> |</li>';
				echo '<li><a class="'.($sub == 'widgets' ? 'current' : '').'" href="'.esc_url( add_query_arg(array('sub' => 'widgets')) ).'">'.__( 'Widget Areas', 'apex' ).'</a> |</li>';
				echo '<li><a class="'.($sub == 'content' ? 'current' : '').'" href="'.esc_url( add_query_arg(array('sub' => 'content')) ).'">'.__( 'Content Setting Sections', 'apex' ).'</a></li>';
			echo '</ul>';

		} ?>
		<form method="post" action="options.php" enctype="multipart/form-data">
			<?php
			if( $active_tab == 'import' ) {
				settings_fields( 'apex_import_settings' );
				do_settings_sections( 'apex_import_settings' );
				
			} elseif( $active_tab == 'typography' ) {
				settings_fields( 'apex_typography_settings' );
				do_settings_sections( 'apex_typography_settings' );

			} elseif( $active_tab == 'content' ) {
				settings_fields( 'apex_content_settings' );
				do_settings_sections( 'apex_content_settings' );

			} else {
				settings_fields( 'apex_general_settings' );
				do_settings_sections( 'apex_general_settings' );
			}
			
			if( $active_tab != 'import' ) {
				submit_button();
			}
			?>
		</form>
	</div>
	<?php
}
}



/* --------------------------------------------------------- */
/* !Create a settings label - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_settings_label') ) {
function apex_settings_label( $title, $description = '' ) {

	$label = '<div class="apex-label-alt">';
		$label .= '<label>'.$title.'</label>';
		if( $description != '' ) {
			$label .= '<small>'.$description.'</small>';
		}
	$label .= '</div>';

	return $label;
}
}


