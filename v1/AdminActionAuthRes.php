<?php
/**
 * Created by PhpStorm.
 * User: Udara
 * Date: 2/6/2019
 * Time: 11:40 PM
 */

include 'Constants.php';

$action = $_POST['isAccept'];
$resId = $_POST['resId'];

if ($action == 1) {
    $query = "UPDATE authres SET Response='accept' WHERE ResId='$resId'";
} else {
    $query = "UPDATE authres SET Response='reject' WHERE ResId='$resId'";
}

$response = array();

if(mysqli_query($con, $query)){
    $response['success'] = true;
}else{
    $response['success'] = false;
}


echo json_encode($response);