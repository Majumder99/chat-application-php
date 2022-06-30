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
?>




<!DOCTYPE html>
<html lang="en">


<?php include "header1.php" ?>

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <h3 class="mb-5">Sign in</h3>

                            <div class="form-outline mb-4">
                                <input name="email" value="<?php echo htmlspecialchars($email); ?>" type="email" id="typeEmailX-2" class="form-control form-control-lg" />
                                <label class="form-label" for="typeEmailX-2">Email</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input name="password" value="<?php echo htmlspecialchars($password); ?>" type="password" id="typePasswordX-2" class="form-control form-control-lg" />
                                <label class="form-label" for="typePasswordX-2">Password</label>
                            </div>

                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-start mb-4">
                                <input name="remember" class="form-check-input me-3" type="checkbox" value="" id="form1Example3" />
                                <label name="remember" class="form-check-label " for="form1Example3"> Remember password </label>
                            </div>

                            <input type="submit" value="Login" name="submit" class="btn btn-primary btn-lg btn-block">
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <div id="wrapper1" style="color: grey;">
        <form action="">
            <input type="text" name="username" placeholder="Username"><br>
            <div style="padding: 10px;">
                Gender<br>
                <input type="radio" name="gender">Male</br>
                <input type="radio" name="gender">Female</br>
            </div>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="password" name="password2" placeholder="ReType Password"><br>
            <input type="submit" value="Sign Up"><br>
        </form>
    </div> -->

<?php include "footer.php" ?>

</html>