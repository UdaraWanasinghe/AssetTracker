<?php
/**
 * Created by PhpStorm.
 * User: Udara
 * Date: 2/6/2019
 * Time: 2:20 PM
 */

include 'Constants.php';

$response = array();

$user_id = $_POST['user_id'];


$query1 = "SELECT * FROM authres WHERE is_user_read=0 AND Response <>'no_response' AND user_id='$user_id'";
$query2 = "UPDATE authres SET is_user_read=1 WHERE is_user_read=0 AND Response <>'no_response' AND user_id='$user_id'";

$authres_rows = array();

if ($auth_res = mysqli_query($con, $query1)) {
    while ($r = mysqli_fetch_assoc($auth_res)) {
        $authres_rows[] = $r;
    }
    mysqli_query($con, $query2);
    echo json_encode(['auth_res' => $authres_rows]);

} else {
    //Whe some error occurs
    $response["success"] = 0;
    $response["message"] = mysqli_error($con);

}