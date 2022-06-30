<?php


$errors = array('email' => '', 'name' => '', 'password' => '', 'repassword' => '');
$email = $name = $password = $repassword = '';
if (isset($_POST['submit'])) {

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is empty <br>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email must be a valid email address";
        }
    }

    if (empty($_POST['name'])) {
        $errors['name'] =  'Name is empty <br>';
    } else {
        $name = $_POST['name'];
        if (!preg_match('/(^[A-Za-z]{3,16})([ ]{0,1})([A-Za-z]{3,16})?([ ]{0,1})?([A-Za-z]{3,16})?([ ]{0,1})?([A-Za-z]{3,16})/', $name)) {

            $errors['name'] =  'Name must be letters and spaces only <br>';
        }
    }

    if (empty($_POST['password'])) {
        $errors['password']  = 'Password is empty <br>';
    } else {
        $password = $_POST['password'];
        if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/', $password)) {

            $errors['password']  = 'Password must be comma separated <br>';
        }
    }

    if (empty($_POST['repassword'])) {
        $errors['repassword']  = 'Re-Password is empty <br>';
    } else {
        $repassword = $_POST['repassword'];
        if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/', $password)) {

            $errors['repassword']  = 'Repassword must be comma separated <br>';
        }
    }

    if (array_filter($errors)) {
        foreach ($errors as $key => $val) {
            echo "Error in $key => $val <br>";
        }
    } else {
        if (isset($_POST['aggred'])) {
            session_start();
            $_SESSION['email'] = $email;
            header('Location:http://localhost/Web%20Project/index.php');
        } else {
            echo "Please check the accept checkbox";
        }
    }
}
?>



<html>

<?php include "header1.php" ?>

<section class="vh-100 mb-5 mt-5">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                <form class="mx-1 mx-md-4" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input name="name" value="<?php echo htmlspecialchars($name); ?>" type="text" id="form3Example1c" class="form-control" />
                                            <label class="form-label" for="form3Example1c">Your Name</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input name="email" value="<?php echo htmlspecialchars($email); ?>" type="email" id="form3Example3c" class="form-control" />
                                            <label class="form-label" for="form3Example3c">Your Email</label>
                                        </div>
                                    </div>

                                    <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">

                                        <h6 class="mb-0 me-4 ms-3">Gender: </h6>

                                        <div class="form-check form-check-inline mb-0 me-4">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender" value="option1" />
                                            <label class="form-check-label" for="femaleGender">Female</label>
                                        </div>

                                        <div class="form-check form-check-inline mb-0 me-4">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender" value="option2" />
                                            <label class="form-check-label" for="maleGender">Male</label>
                                        </div>

                                        <div class="form-check form-check-inline mb-0">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="otherGender" value="option3" />
                                            <label class="form-check-label" for="otherGender">Other</label>
                                        </div>

                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input name="password" value="<?php echo htmlspecialchars($password); ?>" type="password" id="form3Example4c" class="form-control" />
                                            <label class="form-label" for="form3Example4c">Password</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input name="repassword" value="<?php echo htmlspecialchars($repassword); ?>" type="password" id="form3Example4cd" class="form-control" />
                                            <label class="form-label" for="form3Example4cd">Repeat your password</label>
                                        </div>
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-5 terms-service">
                                        <input name="aggred" class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                                        <label name="aggred" class="form-check-label" for="form2Example3">
                                            I agree all statements in <a href="#!">Terms of service</a>
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <input type="submit" value="Register" name="submit" class="btn btn-primary btn-lg">
                                    </div>

                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="https://images.pexels.com/photos/6207368/pexels-photo-6207368.jpeg?cs=srgb&dl=pexels-skylar-kang-6207368.jpg&fm=jpg" class="img-fluid" alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include "footer.php" ?>


</html>