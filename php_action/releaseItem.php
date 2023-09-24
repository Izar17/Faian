<?php

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$orderId = $_POST['orderId'];

if ($orderId) {

	$sql = "UPDATE layaway_orders SET payment_status = 4, release_date = '$curDate' WHERE order_id = {$orderId}";

	//$orderItem = "UPDATE order_item SET order_item_status = 2 WHERE  order_id = {$orderId}";


	// $sqlOrder = "SELECT lo.payment_status, loi.quantity, p.brand_id, p.product_id
	// FROM layaway_orders lo 
	// INNER JOIN layaway_order_item loi ON lo.order_id = loi.order_id
	// INNER JOIN product p ON loi.product_id = p.product_id
	// WHERE lo.order_id = {$orderId}";

	// $resultOrder = $connect->query($sqlOrder);

	// while ($rowOrder = $resultOrder->fetch_array()) {
	// 		$quantity = $rowOrder['quantity'];
	// 		$brandId = $rowOrder['brand_id'];
	// 		$productId = $rowOrder['product_id'];

	// 		// Calculate total weight and update the brands table
	// 		$sql2 = "UPDATE brands SET actual_weight = actual_weight - $quantity WHERE brand_id = $brandId";
	// 		$connect->query($sql2);

			
	// 		// Calculate total weight and update the product table
	// 		$sql3 = "UPDATE product SET quantity = quantity - $quantity WHERE product_id = $productId";
	// 		$connect->query($sql3);
	// }

	if ($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Item Successfully Released";
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while releasing the Item";
	}

	$connect->close();

	echo json_encode($valid);

} // /if $_POST