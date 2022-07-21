<?php

$info = (object)[];
include 'connection/connection.php';
$data = file_get_contents("php://input");
$data_obj = json_decode($data);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    if (isset($data_obj->data_type) && $data_obj->data_type != 'login' && $data_obj->data_type != 'signup') {
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }
}
if (isset($data_obj->data_type) && $data_obj->data_type == 'show_user') {
    //show_user
    include "admin_includes/show_user.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'delete_user') {
    //delete_user
    include "admin_includes/delete_user.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'logout_admin') {
    //logout_admin
    include "admin_includes/logout_admin.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'change_settings') {
    //change_settings
    include "admin_includes/change_settings.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'admin_save_settings') {
    //admin_save_settings
    include "admin_includes/admin_save_settings.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'show_messages') {
    //show_messages
    include "admin_includes/show_messages.php";
}
