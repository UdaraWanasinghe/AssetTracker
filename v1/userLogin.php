<?php

require_once '../includes/DbOperations.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        $db = new DbOperations();

        if ($db->userLogin($_POST['username'], $_POST['password'])) {
            $token = bin2hex(random_bytes(64));
            $user = $db->getUserByUsername($_POST['username']);
            $response['error'] = false;
            $response['userid'] = $user['userid'];
            $response['username'] = $user['username'];
            $response['user_type'] = $user['usertype'];
            $response['access_token'] = $token;
            $db->saveAccessToken($user['userid'], $token);
        } else {
            $response['error'] = true;
            $response['message'] = "Invalid username or password";
        }

    } else {
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
    }
}

echo json_encode($response);