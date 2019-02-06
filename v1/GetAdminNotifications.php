<?php
/**
 * Created by PhpStorm.
 * User: Udara
 * Date: 2/6/2019
 * Time: 2:20 PM
 */

include 'Constants.php';

$response = array();

$query1 = "SELECT * FROM genres WHERE is_admin_read=0";
$query2 = "SELECT * FROM authres WHERE is_admin_read=0";
$query3 = "UPDATE genres SET is_admin_read=1 WHERE is_admin_read=0";
$query4 = "UPDATE authres SET is_admin_read=1 WHERE is_admin_read=0";

$genres_rows = array();
$authres_rows = array();

if (($gen_res = mysqli_query($con, $query1)) && ($auth_res = mysqli_query($con, $query2))) {
    while ($r = mysqli_fetch_assoc($gen_res)) {
        $genres_rows[] = $r;
    }
    while ($r = mysqli_fetch_assoc($auth_res)) {
        $authres_rows[] = $r;
    }
    mysqli_query($con, $query3);
    mysqli_query($con, $query4);
    echo json_encode(['gen_res' => $genres_rows, 'auth_res' => $authres_rows]);

} else {
    //Whe some error occurs
    $response["success"] = 0;
    $response["message"] = mysqli_error($con);

}