<?php
include 'Constants.php';
$response = array();

//Check for mandatory parameters
if (empty($_POST['Name']) || empty($_POST['AType']) || empty($_POST['Start']) || empty($_POST['End']) || empty($_POST['Quantity']) || empty($_POST['Reason'])) {
    //Mandatory parameters are missing
    $response["success"] = 0;
    $response["message"] = "missing mandatory parameters";

} else {

    $Name = $_POST['Name'];
    $AType = $_POST['AType'];
    $Start = $_POST['Start'];
    $End = $_POST['End'];
    $Quantity = $_POST['Quantity'];
    $Reason = $_POST['Reason'];
    $User_Id = $_POST['user_id'];

    //Query to insert a movie
    $query = "INSERT INTO authres( Name, AType, Start, End, Quantity, Reason, user_id) VALUES (?,?,?,?,?,?,?)";
    //Prepare the query
    if ($stmt = $con->prepare($query)) {
        //Bind parameters
        $stmt->bind_param("ssssiss", $Name, $AType, $Start, $End, $Quantity, $Reason, $User_Id);
        //Exceting MySQL statement
        $stmt->execute();
        //Check if data got inserted

//        if (mysqli_error($con)) {
//            echo json_encode(['error' => mysqli_error($con)]);
//        } else
            if ($stmt->affected_rows == 1) {
            $response["success"] = 1;
            $response["message"] = "Reservation Successfully Submitted ";

        } else {
            //Some error while inserting
            $response["success"] = 0;
            $response["message"] = "Error while submitting";
        }
    } else {
        //Some error while inserting
        $response["success"] = 0;
        $response["message"] = mysqli_error($con);
    }


}
//Displaying JSON response
echo json_encode($response);
?>