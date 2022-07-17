<?php

$info = (object)[];
// check if logged in
include 'connection/connection.php';
$data = file_get_contents("php://input");
$data_obj = json_decode($data);


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['userid'])) {
    if (isset($data_obj->data_type) && $data_obj->data_type != 'login' && $data_obj->data_type != 'signup') {
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }
}

// // process the data
if (isset($data_obj->data_type) && $data_obj->data_type == 'signup') {
    //signup
    include "includes/signup.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'login') {
    //login
    include "includes/login.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'user_info') {
    //user_info
    include "includes/user_info.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'logout') {
    //logout
    include "includes/logout.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'contacts') {
    //contacts
    include "includes/contacts.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'chats' || $data_obj->data_type == 'chats_refresh') {
    //chats
    include "includes/chats.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'settings') {
    //settings
    include "includes/settings.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'save_settings') {
    //settings
    include "includes/save_settings.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'change_profile_image') {
    //settings
    include "includes/save_settings.php";
    // echo "from file save";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'send_message') {
    //settings
    include "includes/send_message.php";
}














function leftmessage($row1, $row2) {
    $userName = $row1['username'];
    $image = ($row1['gender'] == 'Male')  ? 'ui/images/user1.jpg' : 'ui/images/user2.jpg';
    if (file_exists($row1['image'])) {
        $image = $row1['image'];
    }
    $msg = $row2['message'];
    $dataNow = $row2['date'];
    return "<div id='message_left' style='height: 100px;
    margin: 10px;
    padding: 2px;
    padding-right: 10px;
    background-color: #eee;
    color: #444;
    float: left;
                box-shadow: 0px 0px 10px #aaa;
                border-bottom-left-radius: 50%;
                border-top-left-radius: 30%;
                position: relative;
                width:60%;
                margin-left: 12px;
                '>
                
                <div style=' width: 20px;
                height: 20px;
                background-color: #34474f;
                border-radius: 50%;
                position: absolute;
                left: -10px;
                top: 20px;  '>
                </div>
                
                    <img src = '$image' style=' width: 60px;
                    height: 60px;
                    float: left;
                    margin: 2px;
                    border-radius: 50%;
                    border: 2px solid white;'>
                    
                    <span style='font-size:10px;font-weight:bold;'>$userName</span> <br>
                    $msg <br>
                    <span style='font-size:11px;color:#999;'>$dataNow</span>
                    </div>";
}


function rightmessage($row1, $row2) {
    $userName = $row1['username'];
    $image = ($row1['gender'] == 'Male')  ? 'ui/images/user1.jpg' : 'ui/images/user2.jpg';
    if (file_exists($row1['image'])) {
        $image = $row1['image'];
    }
    $msg = $row2['message'];
    $dataNow = $row2['date'];
    return "<div id='message_right' 
                        style='height: 100px;
                        margin: 10px;
                        padding: 2px;
                        padding-right: 10px;
                        background-color: #fbffee;
                        color: #444;
                        float: right;
                        box-shadow: 0px 0px 10px #aaa;
                        border-bottom-right-radius: 50%;
                        border-top-right-radius: 30%;
                        position: relative;
                        width:60%;
                '>

                    <div style=' width: 20px;
                            height: 20px;
                            background-color: #34474f;
                            border-radius: 50%;
                            position: absolute;
                            right: -10px;
                            top: 20px;  '>
                    </div>

                    <img src = '$image' style='  width: 60px;
                            height: 60px;
                            float: right;
                            margin: 2px;
                            border-radius: 50%;
                            border: 2px solid white;'>

                    <span style='font-size:10px;font-weight:bold;'>$userName</span> <br>
                    $msg <br>
                    <span style='font-size:11px;color:#999;'>$dataNow</span>
                </div>";
}



function messagecontrol() {

    return
        "
            <div style='style=text-align:center;height:40px;display: flex;position: absolute;bottom: 0;width: 100%;'>
                <label for='message_file'><img src='ui/icons/clip.png' style='opacity:0.8; width:30px;cursor:pointer;margin:5px;'></label>
                <input type='file' name='file' id='message_file' style='display:none'/>
                <input onkeypress='send_on_enter(event)' id='message_text' style='flex:6; border:none;font-size:14px;padding:4px;' type='text' placeholder='Type your message'>
                <input style='flex:1; cursor:pointer' type='button' value='Send' onclick='send_message(event)'>
            </div>
        </div>";
}
