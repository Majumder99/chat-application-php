<?php

$info = (object)[];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// if (isset($data_obj->find->user)) {
// } else {
//     $connect = false;
// }
$myId = $data_obj->find->user;
$sql = "SELECT * FROM `usertable` WHERE userid = '$myId' LIMIT 1;";
$connect = mysqli_query($conn, $sql);

$refresh = false;
$seen = false;
if ($data_obj->data_type == 'chats_refresh') {
    $refresh = true;
    $seen = $data_obj->find->seen;
}


if ($connect) {
    while ($result = mysqli_fetch_assoc($connect)) {
        $userName = $result['username'];
        $image = ($result['gender'] == 'Male')  ? 'ui/images/user1.jpg' : 'ui/images/user2.jpg';
        if (file_exists($result['image'])) {
            $image = $result['image'];
        }
        $myData = "";
        if (!$refresh) {
            $myData = "<h6>Now Chatting with $userName</h6>
            <div id='active_contact' style='border: 1px solid #aaa;width: 310px;height: 200px;text-align:center;'>
                <img src='$image' alt='' style='width: 150px;height: 150px;margin: 10px;float: left;'>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div style='margin-right:100px;'>$userName</div>
            </div>";
        }

        $message = '';
        $new_message = false;
        if (!$refresh) {
            $message = "
            <div id='message_holder_parent' onclick='set_seen(event)' style='height:100%;position:relative;'>
                <div id='message_holder' style='height:748px; overflow-y:scroll;'>";
        }



        // read from db
        $receiver = $myId;
        $sender = $_SESSION['userid'];
        $sql4 = "SELECT * FROM `message_table` WHERE (sender = '$sender' && receiver = '$receiver' && deleted_sender = 0) OR (receiver = '$sender' && sender = '$receiver' && deleted_receiver = 0);";
        $connectagain1 = mysqli_query($conn, $sql4);
        if ($connectagain1) {
            while ($result2 = mysqli_fetch_assoc($connectagain1)) {
                $senderId = $result2['sender'];

                $sql5 = "SELECT * FROM `usertable` WHERE userid = '$senderId' LIMIT 1;";
                $connectDB = mysqli_query($conn, $sql5);
                while ($result3 = mysqli_fetch_assoc($connectDB)) {

                    if ($_SESSION['userid'] == $senderId) {
                        $message .= rightmessage($result3, $result2);
                    } else {
                        $message .= leftmessage($result3, $result2);
                        $id = $result2['id'];
                        if ($result2['received'] == 1 && $seen) {
                            $sql6 = "UPDATE `message_table` SET `seen`= 1 WHERE id = $id LIMIT 1;";
                            $connnectsql6 = mysqli_query($conn, $sql6);
                        }
                        $sql6 = "UPDATE `message_table` SET `received`= 1 WHERE id = $id LIMIT 1;";
                        $connnectsql6 = mysqli_query($conn, $sql6);
                        if ($result2['received'] == 0) {
                            $new_message = true;
                        }
                    }
                }
            }
        }


        if (!$refresh) {
            $message .= messagecontrol();
            // $message .= 'without refresh';
        }


        $info->user = $myData;
        $info->messages = $message;
        $info->data_type = 'chats';
        $info->new_message = $new_message;
        if ($refresh) {
            $info->data_type = 'chats_refresh';
        }
        echo json_encode($info);
    }
} else {
    $info->user = "No contacts were found";
    $info->data_type = "chats";
    echo json_encode($info);
}
