<?php
$info = (object)[];
session_start();
//check if logged in
if (!isset($_SESSION['userid'])) {
    $info->logged_in = false;
    echo json_encode($info);
    die;
}

include 'connection/connection.php';
$info = (object)[];
$data = file_get_contents("php://input");
$data_obj = json_decode($data);
//process the data
if (isset($data_obj->data_type) && $data_obj->data_type == 'signup') {
    //signup
    include "includes/signup.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'user_info') {
    echo "user info";
}
