<?php

$info = (object)[];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rowid = null;
if (isset($data_obj->find->rowid)) {
    $rowid = $data_obj->find->rowid;
}

$sql = "SELECT * FROM `message_table` WHERE id = $rowid LIMIT 1;";
// DELETE FROM `message_table` WHERE id = $rowid;
$connect = mysqli_query($conn, $sql);

if ($connect) {
    while ($result = mysqli_fetch_assoc($connect)) {
        $sender = $result['sender'];
        $receiver = $result['receiver'];
        if ($_SESSION['userid'] == $sender) {
            $sql = "UPDATE `message_table` SET deleted_sender = 1 WHERE id = $rowid LIMIT 1;";
            // DELETE FROM `message_table` WHERE id = $rowid;
            $connect = mysqli_query($conn, $sql);
        } else {
            $sql = "UPDATE `message_table` SET deleted_receiver = 1 WHERE id = $rowid LIMIT 1;";
            // DELETE FROM `message_table` WHERE id = $rowid;
            $connect = mysqli_query($conn, $sql);
        }
    }
} else {
    $info->user = "No contacts were found";
    $info->data_type = "chats";
    echo json_encode($info);
}
