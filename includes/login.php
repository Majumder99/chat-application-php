<?php
$info = (object)[];

$email = $data_obj->email;
$password = $data_obj->password;
if ($conn && !empty($email)) {
    $sql = "SELECT * FROM `usertable` WHERE email = '$email';";
    $connect = mysqli_query($conn, $sql);
    if ($connect) {
        $num = mysqli_num_rows($connect);
        if ($num > 0) {
            while ($result = mysqli_fetch_assoc($connect)) {
                if (empty($password)) {
                    $info->email = "";
                    $info->message = "Connect Unsuccessfully";
                    $info->password = "Password empty";
                    $info->data_type = 'Error';
                    echo json_encode($info);
                } else {
                    if ($result['password'] == $password) {
                        $info->message = "Connect Successfully";
                        $info->email = "";
                        $info->password = "";
                        $info->data_type = 'Successfull';
                        echo json_encode($info);
                    } else {
                        $info->email = "";
                        $info->message = "Connect Unsuccessfully";
                        $info->password = "Wrong Password";
                        $info->data_type = 'Error';
                        echo json_encode($info);
                    }
                }
            }
        } else {
            $info->email = "Email doesn't exist";
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
