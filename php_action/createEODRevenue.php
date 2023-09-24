<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$actualCash = $_POST['actualCash'];
	$actualEwallet = $_POST['actualEwallet'];
	$actualBank = $_POST['actualBank'];
	$actualCc = $_POST['actualCc'];
	$userId = $_POST['userId'];



	$sql2 = "SELECT * FROM eod_revenue WHERE cur_date = '$curDate' and user_id = '$user_id' and status != 1";
	$result = $connect->query($sql2);

	if($result->num_rows == 1) {
 		$sql = "UPDATE eod_revenue SET 
		cash = $actualCash,
		ewallet = $actualEwallet,
		bank = $actualBank,
		credit_card = $actualCc,
		user_id = $userId,
		time_out = '$curDate $curTime',
		status = 1
		WHERE cur_date = '$curDate' and user_id = '$user_id' and status != 1";
			if($connect->query($sql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Successfully Updated";	
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while adding the members";
			}
	} else {		
		$sql = "INSERT INTO eod_revenue (cash, ewallet, bank, credit_card, user_id, cur_date, time_in) VALUES ('$actualCash', '$actualEwallet','$actualBank','$actualCc','$userId','$curDate','$curDate $curTime')";		
			if($connect->query($sql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Successfully Added";	
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while adding the members";
			}
	} // /else
	$connect->close();

	echo json_encode($valid);
 
} 