<?php

require_once 'core.php';

$startDate = $_GET['startDate'];
$date = DateTime::createFromFormat('m/d/Y', $startDate);
$start_date = $date->format("m/d/Y");


$endDate = $_GET['endDate'];
$format = DateTime::createFromFormat('m/d/Y', $endDate);
$end_date = $format->format("m/d/Y");

$sql = "SELECT order_id, order_date, client_name, client_contact, grand_total FROM orders WHERE order_date >= '$start_date' AND order_date <= '$end_date' and order_status = 1";
$result = $connect->query($sql);


$sql2 = "SELECT order_id, order_date, c.name, client_contact, grand_total FROM layaway_orders 
inner join customer c on c.id = layaway_orders.client_name
WHERE order_date >= '$start_date' AND order_date <= '$end_date' and order_status = 1";
$result2 = $connect->query($sql2);

$sum = 0; // Initialize the sum variable
$sum2 = 0;

$output = array('data' => array());


while ($row = $result->fetch_array()) {
	// Extract and store the value from $row[4]
	$value = floatval($row[4]); // Convert to float to handle decimal values

	// Add the value to the sum
	$sum += $value;
	$output['data'][] = array(
		$row[0],
		$row[1],
		$row[2],
		$row[3],
		$value,
	);

}


while ($row2 = $result2->fetch_array()) {
	// Extract and store the value from $row[4]
	$value = floatval($row2[4]); // Convert to float to handle decimal values

	// Add the value to the sum
	$sum2 += $value;
	$output['data'][] = array(
		$row2[0],
		$row2[1],
		$row2[2],
		$row2[3],
		$value,
	);

}

$connect->close();
// Add the sum to the output array
$output['sum'] = $sum;

echo json_encode($output, JSON_PRETTY_PRINT);