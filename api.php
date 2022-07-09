<?php

$info = (object)[];
// check if logged in
include 'connection/connection.php';
$data = file_get_contents("php://input");
$data_obj = json_decode($data);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['userid'])) {
    if (!isset($data_obj->data_type) && $data_obj->data_type != 'login') {
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }
}

// // process the data
if (isset($data_obj->data_type) && $data_obj->data_type == 'signup') {
    //signup
    include "includes/signup.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'login') {
    //login
    include "includes/login.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'user_info') {
    //user info
    include "includes/user_info.php";
    // echo $_SESSION['userid'];
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'logout') {
    //user info
    include "includes/logout.php";
    // echo $_SESSION['userid'];
}
