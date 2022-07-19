<?php


$info = (object)[];
$userid = $data_obj->find->user;


$sql = "DELETE FROM `usertable` WHERE userid = '$userid';";
$connection = mysqli_query($conn, $sql);

if ($connection) {
    $info->message = 'Delete successfully';
    $info->data_type = 'delete_user';
    echo json_encode($info);
} else {
    $info->message = 'Delete unsuccessfully';
    $info->data_type = 'delete_user';
    echo json_encode($info);
}
