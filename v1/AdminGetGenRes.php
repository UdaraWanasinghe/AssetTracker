<?php
/**
 * Created by PhpStorm.
 * User: Udara
 * Date: 2/6/2019
 * Time: 2:20 PM
 */

include 'Constants.php';

$response = array();

$query1 = "SELECT * FROM genres ORDER BY is_admin_read";

$genres_rows = array();

if ($gen_res = mysqli_query($con, $query1)) {
    while ($r = mysqli_fetch_assoc($gen_res)) {
        $genres_rows[] = $r;
    }
    echo json_encode(['result' => $genres_rows]);

} else {
    $response["success"] = 0;
    $response["message"] = mysqli_error($con);

}