<?php



$info = (object)[];
// check if logged in
include 'connection/connection.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = $_SESSION['userid'];


$data_type = "";
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

        // $info->message = "Image uploaded successfully";
        // $info->data_type = $data_type;
        // echo json_encode($info);
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
}
