<?php
include 'Constants.php';
$response = array();
 
//Check for mandatory parameters
if(isset($_POST['SerialNo'])&&isset($_POST['Type'])&&isset($_POST['Quantity'])&&isset($_POST['Department'])&&isset($_POST['Supplier'])&&isset($_POST['PDetails'])){
	$SerialNo = $_POST['SerialNo'];
	$Type = $_POST['Type'];
	$Quantity = $_POST['Quantity'];
	$Department = $_POST['Department'];
	$Supplier = $_POST['Supplier'];
	$PDetails = $_POST['PDetails'];
	
	//Query to update a movie
	$query = "UPDATE inventory SET Type=?,Quantity=?,Department=?,Supplier=?,PDetails=? WHERE SerialNo=?";
	//Prepare the query
	if($stmt = $con->prepare($query)){
		//Bind parameters
		$stmt->bind_param("sissss",$Type,$Quantity,$Department,$Supplier,$PDetails,$SerialNo);
		//Exceting MySQL statement
		$stmt->execute();
		//Check if data got updated
		if($stmt->affected_rows ==1){
			$response["success"] = 1;			
			$response["message"] = "Inventory successfully updated";
			
		}else{
			//When movie is not found
			$response["success"] = 0;
			$response["message"] = "Inventory not found";
		}					
	}else{
		//Some error while updating
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
	}
 
}else{
	//Mandatory parameters are missing
	$response["success"] = 0;
	$response["message"] = "missing mandatory parameters";
}
//Displaying JSON response
echo json_encode($response);
?>