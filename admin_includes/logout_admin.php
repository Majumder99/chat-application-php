<?php
$info = (object)[];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['admin_id'])) {
    unset($_SESSION['admin_id']);
}

$info->logged_in = false;
echo json_encode($info);
