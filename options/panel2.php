<?php
// Avoid direct access to this piece of code
if (strpos($_SERVER['SCRIPT_FILENAME'], basename(__FILE__))){
	header('Location: /');
	exit;
}

// Update the options
if (isset($_POST['options'])){
	$faulty_fields = '';
	if (isset($_POST['options']['convert_ip_addresses']) && !slimstat_update_option('convert_ip_addresses', $_POST['options']['convert_ip_addresses'], 'yesno')) $faulty_fields .= __('Convert IP addresses','wp-slimstat-options').', ';
	if (isset($_POST['options']['use_european_separators']) && !slimstat_update_option('use_european_separators', $_POST['options']['use_european_separators'], 'yesno')) $faulty_fields .= __('Number format','wp-slimstat-options').', ';
	if (isset($_POST['options']['rows_to_show']) && !slimstat_update_option('rows_to_show', $_POST['options']['rows_to_show'], 'integer')) $faulty_fields .= __('Limit results to','wp-slimstat-options').', ';
	if (isset($_POST['options']['rows_raw_data']) && !slimstat_update_option('rows_raw_data', $_POST['options']['rows_raw_data'], 'integer')) $faulty_fields .= __('Rows in Raw view','wp-slimstat-options').', ';
	if (isset($_POST['options']['ip_lookup_service']) && !slimstat_update_option('ip_lookup_service', $_POST['options']['ip_lookup_service'], 'text')) $faulty_fields .= __('IP Lookup','wp-slimstat-options').', ';
	if (isset($_POST['options']['refresh_interval']) && !slimstat_update_option('refresh_interval', $_POST['options']['refresh_interval'], 'integer')) $faulty_fields .= __('Refresh every','wp-slimstat-options').', ';
	
	slimstat_error_message($faulty_fields);
}
?>
<form action="admin.php?page=wp-slimstat/options/index.php&slimpanel=2" method="post">
<table class="form-table <?php echo $wp_locale->text_direction ?>">
<tbody>
	<tr>
		<th scope="row"><label for="convert_ip_addresses"><?php _e('Convert IP addresses','wp-slimstat-options') ?></label></th>
		<td>
			<input type="radio" name="options[convert_ip_addresses]" id="convert_ip_addresses" value="yes"<?php echo (slimstat_get_option('convert_ip_addresses','no') == 'yes')?' checked="checked"':''; ?>> <?php _e('Yes','wp-slimstat-options') ?> &nbsp; &nbsp; &nbsp;
			<input type="radio" name="options[convert_ip_addresses]" value="no" <?php echo (slimstat_get_option('convert_ip_addresses','no') == 'no')?'  checked="checked"':''; ?>> <?php _e('No','wp-slimstat-options') ?>
			<span class="description"><?php _e('View hostnames instead of IP addresses. It slows down the rendering of your metrics.','wp-slimstat-options') ?></span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="use_european_separators"><?php _e('Number format','wp-slimstat-options') ?></label></th>
		<td>
			<input type="radio" name="options[use_european_separators]" id="use_european_separators" value="yes"<?php echo (slimstat_get_option('use_european_separators','yes') == 'yes')?' checked="checked"':''; ?>> 1.234,50 &nbsp; &nbsp; &nbsp;
			<input type="radio" name="options[use_european_separators]" value="no" <?php echo (slimstat_get_option('use_european_separators','yes') == 'no')?'  checked="checked"':''; ?>> 1,234.50
			<span class="description"><?php _e('Choose what number format you want to use, European or American.','wp-slimstat-options') ?></span>
		</td>
	</tr>	
	<tr>
		<th scope="row"><label for="rows_to_show"><?php _e('Limit results to','wp-slimstat-options') ?></label></th>
		<td>
			<input type="text" name="options[rows_to_show]" id="rows_to_show" value="<?php echo slimstat_get_option('rows_to_show','20'); ?>" size="4"> <?php _e('rows','wp-slimstat-options') ?>
			<span class="description"><?php _e('Specify the number of results to return for each module. Please use a <strong>positive</strong> value.','wp-slimstat-options') ?></span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="rows_raw_data"><?php _e('Rows in Raw view','wp-slimstat-options') ?></label></th>
		<td>
			<input type="text" name="options[rows_raw_data]" id="rows_raw_data" value="<?php echo slimstat_get_option('rows_raw_data','50'); ?>" size="4"> <?php _e('rows','wp-slimstat-options') ?>
			<span class="description"><?php _e('Specify the number of rows per page to show in the Raw panel. Please use a <strong>positive</strong> value.','wp-slimstat-options') ?></span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="ip_lookup_service"><?php _e('IP Lookup','wp-slimstat-options') ?></label></th>
		<td>
			<input type="text" name="options[ip_lookup_service]" id="ip_lookup_service" value="<?php echo slimstat_get_option('ip_lookup_service','http://www.maxmind.com/app/lookup_city?ips='); ?>" size="60">
			<span class="description"><?php _e('Customize the IP lookup service URL.','wp-slimstat-options') ?></span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="refresh_interval"><?php _e('Refresh every','wp-slimstat-options') ?></label></th>
		<td>
			<input type="text" name="options[refresh_interval]" id="refresh_interval" value="<?php echo slimstat_get_option('refresh_interval','0'); ?>" size="4"> <?php _e('seconds','wp-slimstat-options') ?>
			<span class="description"><?php _e('Refresh the RAW DATA view every X seconds. Zero disables this feature.','wp-slimstat-options') ?></span>
		</td>
	</tr>
</tbody>
</table>
<p class="submit"><input type="submit" value="<?php _e('Save Changes') ?>" class="button-primary" name="Submit"></p>
</form>