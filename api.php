<?php
include 'connection/connection.php';
$info = (object)[];
$data = file_get_contents("php://input");
$data_obj = json_decode($data);
//process the data
if (isset($data_obj->data_type) && $data_obj->data_type == 'signup') {
    //signup
    $errors = array('email' => '', 'username' => '', 'password' => '', 'repassword' => '');
    $userid = uniqid();
    $username = $data_obj->username;
    if (empty($username)) {
        $errors['username'] =  'Username is empty <br>';
    } else {
        if (!preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/', $username)) {

            $errors['username'] =  'Username must be letters and spaces only <br>';
        }
    }
    $email = $data_obj->email;
    if (empty($email)) {
        $errors['email'] = 'Email is empty <br>';
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email must be a valid email address";
        }
    }
    $password = $data_obj->password;
    if (empty($password)) {
        $errors['password']  = 'Password is empty <br>';
    } else {
        if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/', $password)) {

            $errors['password']  = 'Password must according to the rules <br>';
        }
    }
    $repassword = $data_obj->repassword;
    if (empty($repassword)) {
        $errors['repassword']  = 'Re-Password is empty <br>';
    } else {
        if (strcmp($password, $repassword)) {
            $errors['repassword']  = 'Repassword and password must be equal <br>';
        }
    }

    $date = date("Y-m-d H:i:s");

    if (array_filter($errors)) {
        // foreach ($errors as $key => $val) {
        //     echo "Error in $key => $val <br>";
        // }
        $info->message = $errors;
        $info->data_type = 'Error';
        echo json_encode($info);
    } else {
        $sql = "INSERT INTO `usertable`( `userid`, `username`, `email`, `password`, `date`) VALUES ('$userid','$username','$email','$password','$date')";
        $connect = mysqli_query($conn, $sql);

        if ($connect) {
            $info->message = "Connect successful";
            $info->data_type = 'Successfull';
            echo json_encode($info);
        } else {
            $info->message = mysqli_connect_error();
            $info->data_type = 'Error';
            echo json_encode($info);
        }
    }
}
