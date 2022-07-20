<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$info = (object)[];

$email = $data_obj->email;
$password = $data_obj->password;
$checked = $data_obj->check;



if ($conn && !empty($email)) {
    $sql = "SELECT * FROM `usertable` WHERE email = '$email';";
    $connect = mysqli_query($conn, $sql);
    if ($connect) {
        $num = mysqli_num_rows($connect);
        if ($num > 0) {
            while ($result = mysqli_fetch_assoc($connect)) {
                $newid = $result['userid'];
                if ($newid == '62d696ce669') {
                    // header("Location:http://localhost/Web%20Project/includes/admin_panel.php");
                    $info->email = "";
                    $info->password = "";
                    $info->message = "Connect Successfully admin";
                    $info->data_type = 'admin';
                    $_SESSION['admin_id'] = '62d696ce669';
                    if ($checked) {
                        setcookie('email', $email, time() + 86400);
                        setcookie('password', $password, time() + 86400);
                        $info->cookies = 'set cookies';
                    }
                    echo json_encode($info);
                } else {
                    if (empty($password)) {
                        $info->email = "";
                        $info->message = "Connect Unsuccessfully";
                        $info->password = "Password empty";
                        $info->data_type = 'Error';
                        echo json_encode($info);
                    } else {
                        if ($result['password'] == $password) {
                            $_SESSION['userid'] = $result['userid'];
                            $info->message = "Connect Successfully";
                            $info->email = "";
                            $info->password = "";
                            $info->data_type = 'Successfull';
                            if ($checked) {
                                setcookie('email', $email, time() + 86400);
                                setcookie('password', $password, time() + 86400);
                                $info->cookies = 'set cookies';
                            }
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
