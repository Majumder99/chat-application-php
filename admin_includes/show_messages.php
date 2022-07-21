<?php

$sql = "SELECT m.message, u.image, u.username,m.file,u.gender FROM usertable u JOIN message_table m ON u.userid = m.sender;";
$connection = mysqli_query($conn, $sql);

$info = (object)[];

$a = '';

if ($connection) {
    while ($result = mysqli_fetch_assoc($connection)) {
        $message = $result['message'];
        $image = ($result['gender'] == 'Male')  ? 'ui/images/user1.jpg' : 'ui/images/user2.jpg';
        if (file_exists($result['image'])) {
            $image = $result['image'];
        }
        $username = $result['username'];
        $file = $result['file'];
        $a .= "<div style='width:100%;height:100px; margin-bottome:100px;'>";

        $a .=  "<div id='message_right' 
                        style='
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
                            top: 20px;  '>";


        $a .= " </div>

                    <img id='prof_img' src = '$image' style='width: 60px;
                            height: 60px;
                            float: right;
                            margin: 2px;
                            border-radius: 50%;
                            border: 2px solid white;'>

                    <span style='font-size:10px;font-weight:bold;'>$username</span> <br>
                    $message <br>";
        if ($file != '' && file_exists($file)) {
            $a .= "<img src='$file' style='width:10%;cursor:pointer;' /> <br>";
        }
        $a .= "</div>";
    }
    $info->messages = $a;
    $info->data_type = 'show_messages';
    echo json_encode($info);
}
