<?php

$info = (object)[];

// if (isset($data_obj->find)) {
// } else {
//     $connect = false;
// }

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$myId = $data_obj->find->userid;
$sql = "SELECT * FROM `usertable` WHERE userid = '$myId' LIMIT 1;";
$connect = mysqli_query($conn, $sql);



if ($connect) {
    while ($result = mysqli_fetch_assoc($connect)) {
        $message = $data_obj->find->message;
        $date = date('Y-m-d H:i:s');
        $sender = $_SESSION['userid'];

        $sql = "INSERT INTO `message_table`( `sender`, `receiver`, `message`, `date`) VALUES ($sender, $myId,'$message','$date');";
        $connection = mysqli_query($conn, $sql);

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




        // $message .= leftmessage($result);
        // $message .= rightmessage($result);


        $message .= "
        <div style='style=text-align:center;height:40px;display: flex;position: absolute;bottom: 0;width: 100%;'>
            <label for='share_file'><img src='ui/icons/clip.png' style='opacity:0.8; width:30px;cursor:pointer;margin:5px;'></label>
            <input type='file' name='file' id='message_file' style='display:none'/>
            <input id='message_text' style='flex:6; border:none;font-size:14px;padding:4px;' type='text' placeholder='Type your message'>
            <input style='flex:1; cursor:pointer' type='button' value='Send' onclick='send_message(event)'>
        </div>
        </div>";


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
