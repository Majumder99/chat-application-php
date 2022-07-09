<?php
$info = (object)[];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['userid'])) {
    unset($_SESSION['userid']);
}

$info->logged_in = false;
echo json_encode($info);
