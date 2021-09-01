<?php 
$BendaApi = BendaApi::GetInstance();
?>
<div>
	<h2>Benda API - Settings</h2>
	<div>
	<?php screen_icon(); ?>
	<form method="post" action="options.php">
	<?php settings_fields( 'benda_api_settings_fg' ); ?>
	<table>
	<tr valign="top">
	<th scope="row" align="left"><label for="benda_api_uname">Username : </label></th>
	<td><input type="text" id="benda_api_uname" name="benda_api_uname" value="<?php echo get_option('benda_api_uname'); ?>" /></td>
	</tr>
	<tr valign="top">
	<th scope="row" align="left"><label for="benda_api_pass">Password : </label></th>
	<td><input type="text" id="benda_api_pass" name="benda_api_pass" value="<?php echo get_option('benda_api_pass'); ?>" /></td>
	</tr>
	<tr valign="top">
	<th scope="row" align="left" ><label for="benda_api_terminal_id">Terminal id : </label></th>
	<td><input type="text" id="benda_api_terminal_id" name="benda_api_terminal_id" value="<?php echo get_option('benda_api_terminal_id'); ?>" /></td>
	</tr>
	<tr valign="top">
	<th scope="row" align="left" ><label for="benda_api_shop_id">Shop id : </label></th>
	<td><input type="text" id="benda_api_shop_id" name="benda_api_shop_id" value="<?php echo get_option('benda_api_shop_id'); ?>" /></td>
	</tr>
	</table>
	<?php wp_nonce_field( 'noptowoo-settings-save', 'benda_api_settings_fg' ); ?>
	<?php submit_button(); ?>
	</form>
	</div>
</div>