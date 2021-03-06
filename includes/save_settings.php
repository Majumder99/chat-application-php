<?php

$info = (object)[];

$errors = array('email' => '', 'username' => '', 'password' => '', 'repassword' => '', 'gender' => '');



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userid = $_SESSION['userid'];

$username = $data_obj->username;
if (empty($username)) {
    $errors['username'] = 'Username is empty <br>';
} else {
    if (!preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/', $username)) {

        $errors['username'] = 'Username must be letters and spaces only <br>';
    }
}

$gender = isset($data_obj->gender) ? $data_obj->gender : null;
if (empty($gender)) {
    $errors['gender'] = 'Please select a gender';
}

$email = $data_obj->email;
if (empty($email)) {
    $errors['email'] = 'Email is empty';
} else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email must be a valid email address";
    }
}
$password = $data_obj->password;
if (empty($password)) {
    $errors['password'] = 'Password is empty';
} else {
    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/', $password)) {

        $errors['password'] = 'Password must according to the rules';
    }
}
$repassword = $data_obj->repassword;
if (empty($repassword)) {
    $errors['repassword'] = 'Re-Password is empty';
} else {
    if (strcmp($password, $repassword)) {
        $errors['repassword'] = 'Repassword and password must be equal';
    }
}


if (array_filter($errors)) {
    $info->message = $errors;
    $info->data_type = 'Error';
    echo json_encode($info);
} else {

    $sql = "UPDATE `usertable` SET `username`= '$username',`email`= '$email',`gender`= '$gender',`password`= '$password' WHERE userid = '$userid';";
    $connect = mysqli_query($conn, $sql);

    if ($connect) {
        $info->message = "Updated successfully";
        $info->data_type = 'save_settings';
        echo json_encode($info);
    } else {
        $info->message = mysqli_connect_error();
        $info->data_type = 'save_settings';
        echo json_encode($info);
    }
}
