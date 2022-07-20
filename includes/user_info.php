<?php


$info = (object)[];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userid = $_SESSION['userid'];


if ($conn) {
    $sql = "SELECT * FROM `usertable` WHERE userid = '$userid';";
    $connect = mysqli_query($conn, $sql);
    if ($connect) {
        $num = mysqli_num_rows($connect);
        if ($num > 0) {
            $result = (object)mysqli_fetch_assoc($connect);
            $image = ($result->{'gender'} == 'Male')  ? 'ui/images/user1.jpg' : 'ui/images/user2.jpg';
            if (file_exists($result->{'image'})) {
                $image = $result->{'image'};
            }
            $result->data_type = 'user_info';
            $result->pro_image = $image;
            echo json_encode($result);
        } else {
            $info->email = "Userid doesn't exist";
            $info->password = "";
            $info->message = "Wrong email";
            $info->data_type = 'Error';
            echo json_encode($info);
        }
    }
} else {
    $info->email = "email is empty";
    $info->password = "";
    $info->message = "email is empty";
    $info->data_type = 'Error';
    echo json_encode($info);
}
