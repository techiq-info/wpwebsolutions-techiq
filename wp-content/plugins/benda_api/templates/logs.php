<div>
	<h2>Benda API - Logs</h2>
</div>
<table style="width: 100%; border-collapse: collapse;" border="1">
	<tr>
		<th>Order ID</th>
		<th>Products</th>
		<th>Total Amount</th>
		<th>Transaction ID</th>
		<th>View details</th>
	</tr>
	<?php 
		global $wpdb;
		$sql = 'select * from '.$wpdb->prefix .$this->benda_api_table;
		$result = $wpdb->get_results($sql);
		/*echo "<pre>";
		print_r($result);
		exit;*/
	?>
</table>