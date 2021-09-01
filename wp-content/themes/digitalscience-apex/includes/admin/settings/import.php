<?php

/* --------------------------------------------------------- */
/* !Settings setup - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_import_settings_setup') ) {
function apex_import_settings_setup() {

	add_settings_section( 'apex_import_settings_section', __( 'Import content & settings', 'apex' ), false, 'apex_import_settings' );


	/* --------------------------------------------------------- */
	/* !Add the import settings - 1.0.0 */
	/* --------------------------------------------------------- */
	
	/* Import & export theme settings */
	$title = apex_settings_label( __( 'Theme settings', 'apex' ), __('Import & export Apex theme settings', 'apex') );
	add_settings_field( 'apex_import_export_theme_settings', $title, 'apex_import_export_theme_settings', 'apex_import_settings', 'apex_import_settings_section' );

	/* Sample widget content */
	$title = apex_settings_label( __( 'Widget data', 'apex' ), __('Import & export widgets and their data', 'apex') );
	add_settings_field( 'apex_import_export_widget_settings', $title, 'apex_import_export_widget_settings', 'apex_import_settings', 'apex_import_settings_section' );

	/* --------------------------------------------------------- */
	/* !Register the settings - 1.0.0 */
	/* --------------------------------------------------------- */

	if( false == get_option('apex_import_settings') ) {
		add_option( 'apex_import_settings' );
	}
	register_setting( 'apex_import_settings', 'apex_import_settings' );
}
}



/* --------------------------------------------------------- */
/* !Export theme setting - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_import_export_theme_settings') ) {
function apex_import_export_theme_settings() {
	echo '<div id="apex_import_export_theme_settings">';
		?>
		<div class="postbox">
			<h3><?php _e( 'Import theme settings', 'apex' ); ?></h3>
			<div class="inside">
				<p><?php _e( 'Import the theme settings from a .json file.', 'apex' ); ?></p>
				<p>
					<input type="file" name="import_settings_file"/>
				</p>
				<input type="hidden" name="apex_action" value="import_settings" />
				<?php wp_nonce_field( 'apex_import_nonce', 'apex_import_nonce' ); ?>
				<?php submit_button( __( 'Import Theme Settings', 'apex' ), 'primary', 'apex-import-settings', false ); ?>
			</div>
		</div>
		
		<div class="postbox">
			<h3><?php _e( 'Export theme settings', 'apex' ); ?></h3>
			<div class="inside">
				<p><?php _e( 'Export the theme settings for this site as a .json file.', 'apex' ); ?></p>
				<input type="hidden" name="apex_action" value="export_settings" />
				<?php wp_nonce_field( 'apex_export_nonce', 'apex_export_nonce' ); ?>
				<?php submit_button( __( 'Export Theme Settings', 'apex' ), 'secondary', 'apex-export-settings', false ); ?>
			</div>
		</div>
		<?php
	echo '</div>';
}
}

/* --------------------------------------------------------- */
/* !Export widget setting - 1.0.0 */
/* --------------------------------------------------------- */

if( !function_exists('apex_import_export_widget_settings') ) {
function apex_import_export_widget_settings() {
	echo '<div id="apex_import_export_widget_settings">';
		?>	
		<div class="postbox">
			<h3><?php _e( 'Import widget data', 'apex' ); ?></h3>
			<div class="inside">
				<p><?php _e( 'Import the widget data from a .json file.', 'apex' ); ?></p>
				<p>
					<input type="file" name="import_widgets_file"/>
				</p>
				<input type="hidden" name="apex_action" value="import_widgets" />
				<?php wp_nonce_field( 'apex_import_nonce', 'apex_import_nonce' ); ?>
				<?php submit_button( __( 'Import Widget Data', 'apex' ), 'primary', 'apex-import-widgets', false ); ?>
			</div>
		</div>

		<div class="postbox">
			<h3><?php _e( 'Export widget data', 'apex' ); ?></h3>
			<div class="inside">
				<p><?php _e( 'Export the widget data for this site as a .json file.', 'apex' ); ?></p>
				<input type="hidden" name="apex_action" value="export_widgets" />
				<?php wp_nonce_field( 'apex_export_nonce', 'apex_export_nonce' ); ?>
				<?php submit_button( __( 'Export Widget Data', 'apex' ), 'secondary', 'apex-export-widgets', false ); ?>
			</div>
		</div>
		<?php
	echo '</div>';
}
}

