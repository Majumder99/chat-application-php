<?php

$info = (object)[];

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
        <div id='message_holder_parent' style='height:100%;'>
            <div id='message_holder' style='height:748px; overflow-y:scroll;'>
        
                <div id='message_left' style='height: 100px;
                margin: 10px;
                padding: 2px;
                padding-right: 10px;
                background-color: #eee;
                color: #444;
                float: left;
                box-shadow: 0px 0px 10px #aaa;
                border-bottom-left-radius: 50%;
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
                    This is a test message <br>
                    <span style='font-size:11px;color:#999;'>20 Jan 2022 10:00 am</span>
                </div>


                <div id='message_right' 
                        style='height: 100px;
                        margin: 10px;
                        padding: 2px;
                        padding-right: 10px;
                        background-color: #fbffee;
                        color: #444;
                        float: right;
                        box-shadow: 0px 0px 10px #aaa;
                        border-bottom-right-radius: 50%;
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
                    This is a test message <br>
                    <span style='font-size:11px;color:#999;'>20 Jan 2022 10:00 am</span>
                </div>

                <div id='message_left' style='height: 100px;
                margin: 10px;
                padding: 2px;
                padding-right: 10px;
                background-color: #eee;
                color: #444;
                float: left;
                box-shadow: 0px 0px 10px #aaa;
                border-bottom-left-radius: 50%;
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
                    This is a test message <br>
                    <span style='font-size:11px;color:#999;'>20 Jan 2022 10:00 am</span>
                </div>
                
                <div id='message_right' 
                        style='height: 100px;
                        margin: 10px;
                        padding: 2px;
                        padding-right: 10px;
                        background-color: #fbffee;
                        color: #444;
                        float: right;
                        box-shadow: 0px 0px 10px #aaa;
                        border-bottom-right-radius: 50%;
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
                    This is a test message <br>
                    <span style='font-size:11px;color:#999;'>20 Jan 2022 10:00 am</span>
                </div>

            </div>
        <div style='display: flex; text-align:center;height:40px;'>
            <input style='flex:6; border:none;font-size:14px;padding:4px;' type='text' placeholder='Type your message'>
            <input style='flex:1; cursor:pointer' type='button' value='Send'>
        </div>
        </div>
        ";
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
