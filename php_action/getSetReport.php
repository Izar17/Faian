<?php

require_once 'core.php';

$startDate = $_GET['startDate'];
$date = DateTime::createFromFormat('m/d/Y', $startDate);
$start_date = $date->format("m/d/Y");


$endDate = $_GET['endDate'];
$format = DateTime::createFromFormat('m/d/Y', $endDate);
$end_date = $format->format("m/d/Y");

$sql = "SELECT e.cash, e.ewallet, e.bank, e.credit_card, u.username, e.time_in, e.time_out FROM eod_revenue e
INNER JOIN users u on u.user_id = e.user_id
WHERE e.cur_date >= '$start_date' AND e.cur_date <= '$end_date' and e.status = 1";
$result = $connect->query($sql);

$sum = 0; // Initialize the sum variable

$output = array('data' => array());


while ($row = $result->fetch_array()) {
	// Extract and store the value from $row[4]
	$value = floatval($row[4]); // Convert to float to handle decimal values

	// Add the value to the sum
	$sum += $value;
	$output['data'][] = array(
		$row[4],
		$row[0],
		$row[1],
		$row[2],
		$row[3],
		$row[5],
		$row[6],
	);

}

$connect->close();
// Add the sum to the output array
$output['sum'] = $sum;

echo json_encode($output, JSON_PRETTY_PRINT);