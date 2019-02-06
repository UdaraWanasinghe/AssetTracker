<?php
include 'Constants.php';
$response = array();
 
//Check for mandatory parameters
if(empty($_POST['SerialNo'])||empty($_POST['Type'])||empty($_POST['Quantity'])||empty($_POST['Department'])||empty($_POST['Supplier'])||empty($_POST['PDetails'])){
	//Mandatory parameters are missing
	$response["success"] = 0;
	$response["message"] = "missing mandatory parameters";
 
}else{
	
	$SerialNo = $_POST['SerialNo'];
	$Type = $_POST['Type'];
	$Quantity = $_POST['Quantity'];
	$Department = $_POST['Department'];
	$Supplier = $_POST['Supplier'];
	$PDetails = $_POST['PDetails'];
	
	//Query to insert a movie
	$query = "INSERT INTO inventory( SerialNo, Type, Quantity, Department, Supplier, PDetails) VALUES (?,?,?,?,?)";
	//Prepare the query
	if($stmt = $con->prepare($query)){
		//Bind parameters
		$stmt->bind_param("ssisss",$SerialNo,$Type,$Quantity,$Department,$Supplier,$PDetails);
		//Exceting MySQL statement
		$stmt->execute();
		//Check if data got inserted
		if($stmt->affected_rows == 1){
			$response["success"] = 1;			
			$response["message"] = "Item Successfully Added ";			
			
		}else{
			//Some error while inserting
			$response["success"] = 0;
			$response["message"] = "Error while adding item";
		}					
	}else{
		//Some error while inserting
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
	}
	
	
	
}
//Displaying JSON response
echo json_encode($response);    


?>