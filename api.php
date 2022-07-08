<?php

include 'connection/connection.php';
$data = file_get_contents("php://input");
$data_obj = json_decode($data);
// process the data
if (isset($data_obj->data_type) && $data_obj->data_type == 'signup') {
    //signup
    include "includes/signup.php";
}
