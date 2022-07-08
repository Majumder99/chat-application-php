<?php


        $errors = array('email' => '', 'password' => '');
        $email = $password = '';
        if (isset($_POST['submit'])) {

            if (empty($_POST['email'])) {
                // echo 'Email is empty <br>';
                $errors['email'] = 'Email is empty <br>';
            } else {
                // echo htmlspecialchars($_POST['email']);
                $email = $_POST['email'];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // echo "Email must be a valid email address";
                    $errors['email'] = "Email must be a valid email address";
                }
            }


            if (empty($_POST['password'])) {
                // echo 'Ingredients is empty <br>';
                $errors['password']  = 'Password is empty <br>';
            } else {
                // echo htmlspecialchars($_POST['ingredients']);
                $password = $_POST['password'];
                if (!preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password)) {
                    // echo 'Ingredients must be comma separated <br>';
                    $errors['password']  = 'Password must be filled <br>';
                }
            }

            if (array_filter($errors)) {
                // echo 'There is error';
                foreach ($errors as $key => $val) {
                    echo "Error in $key => $val <br>";
                }
            } else {
                if (isset($_POST['remember'])) {
                    setcookie('email', $email, time() + 3600);
                    setcookie('password', $password, time() + 3600);
                    session_start();
                    $_SESSION['email'] = $email;
                    header('Location:http://localhost/Web%20Project/index.php');
                }
            }
        }
