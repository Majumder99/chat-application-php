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
    if (isset($data_obj->data_type) && $data_obj->data_type != 'login' && $data_obj->data_type != 'signup') {
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
    //user_info
    include "includes/user_info.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'logout') {
    //logout
    include "includes/logout.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'contacts') {
    //contacts
    include "includes/contacts.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'chats') {
    //chats
    include "includes/chats.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'settings') {
    //settings
    include "includes/settings.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'save_settings') {
    //settings
    include "includes/save_settings.php";
}
