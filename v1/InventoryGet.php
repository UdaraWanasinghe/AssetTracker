<?php
include 'Constants.php';
$itemArray = array();
$response = array();

	$query = "SELECT SerialNo,Type,Quantity,Department,Supplier,PDetails FROM inventory";
	$rows = array();

	if($sth = mysqli_query($con, $query)){
		$rows = array();
		while($r = mysqli_fetch_assoc($sth)) {
			$rows[] = $r;
		}
		echo json_encode(['items' => $rows]);
		
	}else{
		//Whe some error occurs
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
		
	}

//Display JSON response

?>