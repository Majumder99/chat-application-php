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
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'chats') {
    //chats
    // include "includes/chats.php";
    $myId = $data_obj->find;
    $myData = '';
    $sql = "SELECT * FROM `usertable` WHERE userid = '$myId' LIMIT 1;";
    $connect = mysqli_query($conn, $sql);
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
            $info->message = $myData;
            $info->data_type = 'chats';
            echo json_encode($info);
        }
    } else {
        $info->message = "No contacts were found";
        $info->data_type = "Error";
        echo json_encode($info);
    }

    // $result = (object)mysqli_fetch_assoc($connect);
    // $info = (object)[];


} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'settings') {
    //settings
    include "includes/settings.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'save_settings') {
    //settings
    include "includes/save_settings.php";
} elseif (isset($data_obj->data_type) && $data_obj->data_type == 'change_profile_image') {
    //settings
    // include "includes/save_settings.php";
    echo "from file save";
}
