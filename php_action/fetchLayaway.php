<?php 	

require_once 'core.php';
$contId = $_GET['contId'];

$sql = "SELECT distinct lo.order_id, c.name, c.address, c.contact_number, lo.payment_status, lo.due_date, lo.release_date FROM customer c
 inner join layaway_orders lo on c.id = lo.client_name
 where lo.order_status !=0 and lo.order_type = '$contId' order by lo.due_date asc";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 
 // $row = $result->fetch_array();
 while($row = $result->fetch_array()) {
	$orderId = $row[0];
	$rel_date = $row[6];

 	// active 
 	if($row[4] == 1) { 		
		$paymentStatus = "<label class='label label-success'>Fully Paid</label>";
	} else if($row[4] == 2) { 		
		$paymentStatus = "<label class='label label-info'>Advance Payment</label>";
	} else if($row[4] == 4){ 		
	   $paymentStatus = "<label class='label label-success'>Fully Paid</label> <label class='label label-info'>Released Date: $rel_date</label>";
   } else { 		
	   $paymentStatus = "<label class='label label-warning'>Installment</label>";
   } // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	  <li><a  type="button" onclick="manageLayaway('.$orderId.','.$contId.')"><i class="glyphicon glyphicon-plus-sign"></i> Manage Payment</a></li>
	  <li><a type="button" data-toggle="modal" data-target="#editCustomerModel" onclick="editCustomer('.$orderId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	  <li><a type="button" data-toggle="modal" data-target="#removeCustomerModal" onclick="removeCustomer('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 			
		$row[1], 	
		$row[2], 	
		$row[3], 	
		$row[5], 	
		$paymentStatus, 
		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output, JSON_PRETTY_PRINT);