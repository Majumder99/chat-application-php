<?php

$info = (object)[];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($data_obj->find)) {
    $myId = $data_obj->find;
    $sql = "SELECT * FROM `usertable` WHERE userid = '$myId' LIMIT 1;";
    $connect = mysqli_query($conn, $sql);
} else {
    $connect = false;
}

if ($connect) {
    while ($result = mysqli_fetch_assoc($connect)) {
        $userName = $result['username'];
        $image = ($result['gender'] == 'Male')  ? 'ui/images/user1.jpg' : 'ui/images/user2.jpg';
        if (file_exists($result['image'])) {
            $image = $result['image'];
        }
        $myData = "<h6>Now Chatting with '$userName'</h6>
            <div id='active_contact' style='
                    border: 1px solid #aaa;
                    width: 310px;
                    height: 115px;
                '>
                            <img src='$image' alt='' style='
                                width: 30%;
                                margin: 10px;
                                float: left;'>
                                <br>
                            $userName
                        </div>";

        $message = "
        <div id='message_holder_parent' style='height:100%;position:relative;'>
            <div id='message_holder' style='height:748px; overflow-y:scroll;'>";



        // read from db
        $receiver = $myId;
        $sender = $_SESSION['userid'];
        $sql4 = "SELECT * FROM `message_table` WHERE (sender = '$sender' && receiver = '$receiver') OR (receiver = '$sender' && sender = '$receiver');";
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
                    }
                }
            }
        }




        $message .= messagecontrol();


        $info->user = $myData;
        $info->messages = $message;
        $info->data_type = 'chats';
        echo json_encode($info);
    }
} else {
    $info->user = "No contacts were found";
    $info->data_type = "chats";
    echo json_encode($info);
}
