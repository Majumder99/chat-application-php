<?php



$info = (object)[];
// check if logged in
include 'connection/connection.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = $_SESSION['userid'];


$data_type = "";
$receiverid = "";
if (isset($_POST['user'])) {
    $receiverid = addslashes($_POST['user']);
}
if (isset($_POST['data_type'])) {
    $data_type = $_POST['data_type'];
}


$destination = "";
if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {

    if ($_FILES['file']['error'] == 0) {
        //good to go
        $folder = "uploads/";
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        $destination = $folder . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $destination);
    }
}




if ($data_type == 'change_profile_image') {
    if ($destination != "") {
        $sql = "UPDATE `usertable` SET `image`='$destination' WHERE userid = '$id' LIMIT 1;";
        $connection = mysqli_query($conn, $sql);
        if ($connection) {
            $info->message = "Image uploaded successfully";
            $info->data_type = $data_type;
            echo json_encode($info);
        } else {
            $info->message = mysqli_connect_error();
            $info->data_type = $data_type;
            echo json_encode($info);
        }
    }
} elseif ($data_type == 'send_files') {
    $message = '';
    $date = date('Y-m-d H:i:s');
    $sender = $_SESSION['userid'];
    $msgId = uniqid();
    $receiver = $receiverid;
    $file = $destination;

    $sql2 = "SELECT * FROM `message_table` WHERE (sender = '$sender' && receiver = '$receiver') OR (receiver = '$sender' && sender = '$receiver') LIMIT 1;";
    $connectagain = mysqli_query($conn, $sql2);

    if ($connectagain) {
        while ($result1 = mysqli_fetch_assoc($connectagain)) {
            $msgId = $result1['msg_id'];
        }
    }

    $sql3 = "INSERT INTO `message_table`( `sender`, `receiver`, `message`, `file`, `date`, `msg_id`) VALUES ('$sender', '$receiver','$message','$file','$date', '$msgId');";
    $connection = mysqli_query($conn, $sql3);
    if ($connection) {
        $info->message = 'Image sent';
        $info->data_type = $data_type;
        echo json_encode($info);
    } else {
        $info->message = 'Image doesn\'t send';
        $info->data_type = $data_type;
        echo json_encode($info);
    }
} elseif ($data_type == 'registration_files') {
    $info->destination = $destination;
    $info->data_type = $data_type;
    echo json_encode($info);
}
