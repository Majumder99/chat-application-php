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

if (isset($_SESSION['userid'])) {
    unset($_SESSION['userid']);
}

$info->logged_in = false;
echo json_encode($info);
