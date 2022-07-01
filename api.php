<?php
include 'connection/connection.php';
$data = file_get_contents("php://input");
$data = json_decode($data);
print_r($data);
