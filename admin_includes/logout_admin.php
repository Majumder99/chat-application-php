<?php
$info = (object)[];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_COOKIE['email'])) {
    unset($_COOKIE['email']);
    setcookie('email', '', time() - 86400);
}
if (isset($_COOKIE['password'])) {
    unset($_COOKIE['password']);
    setcookie('password', '', time() - 86400);
}

if (isset($_SESSION['admin_id'])) {
    unset($_SESSION['admin_id']);
}

$info->logged_in = false;
echo json_encode($info);
