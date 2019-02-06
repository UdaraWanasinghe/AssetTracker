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

$query1 = "SELECT * FROM genres WHERE user_id='$user_id' ORDER BY is_user_read";

$rows = array();

if ($res = mysqli_query($con, $query1)) {
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    echo json_encode(['result' => $rows]);

} else {
    $response["success"] = 0;
    $response["message"] = mysqli_error($con);

}