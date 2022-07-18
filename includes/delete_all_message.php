<?php

$info = (object)[];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rowid = null;
if (isset($data_obj->find->rowid)) {
    $rowid = $data_obj->find->rowid;
}

$sql = "DELETE FROM `message_table` WHERE id = $rowid LIMIT 1;";
// DELETE FROM `message_table` WHERE id = $rowid;
$connect = mysqli_query($conn, $sql);

if ($connect) {
} else {
    $info->user = "Message don't exist";
    $info->data_type = "chats";
    echo json_encode($info);
}
