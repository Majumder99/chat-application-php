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
<html>

<?php include "header1.php" ?>

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <form id="myForm" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <h3 class="mb-5">Sign in</h3>

                            <div class="form-outline mb-4">
                                <label class="form-label margin-label1" for="typeEmailX-2">Email</label>
                                <input name="email" value="<?php echo htmlspecialchars($email); ?>" type="email" id="typeEmailX-2" class="form-control form-control-lg" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label margin-label2" for="typePasswordX-2">Password</label>
                                <input name="password" value="<?php echo htmlspecialchars($password); ?>" type="password" id="typePasswordX-2" class="form-control form-control-lg" />
                            </div>

                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-start mb-4">
                                <input name="remember" class="form-check-input me-3" type="checkbox" value="" id="form1Example3" />
                                <label name="remember" class="form-check-label " for="form1Example3"> Remember password </label>
                            </div>

                            <input type="button" value="Login" name="submit" class="btn btn-primary btn-lg btn-block" id="login_button">
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "footer.php" ?>


<script>
    const documentId = (element) => {

        return document.getElementById(element);
    }
    var login_button = document.getElementById("login_button");
    login_button.addEventListener('click', collect_data);

    function collect_data() {
        login_button.disable = true;
        login_button.value = 'Loading.....';
        var myForm = documentId("myForm");
        var inputs = myForm.getElementsByTagName("INPUT");
        var data = {};
        for (var i = inputs.length - 1; i >= 0; i--) {
            var key = inputs[i].name;
            switch (key) {
                case "email":
                    data.email = inputs[i].value;
                    break;

                case "password":
                    data.password = inputs[i].value;
                    break;

            }
            send_data(data, "login");
        }
    }
    const send_data = (data, type) => {
        console.log("send data in");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                alert(xhttp.responseText);
                // handle_result(xhttp.responseText);
                login_button.disable = false;
                login_button.value = 'Login';
            }
        };
        data.data_type = type;
        var data_string = JSON.stringify(data);
        xhttp.open("POST", "api.php", true);
        xhttp.send(data_string);
    }
    const handle_result = (result) => {
        console.log("I am in handle result");
        var data = JSON.parse(result);
        if (data.data_type == "Successfull") {
            window.location.assign("index.php");
        } else {
            // var username = document.getElementById('username');
            // var email = document.getElementById('email');
            // var password = document.getElementById('password');
            // var repassword = document.getElementById('repassword');

            // username.innerHTML = data.message.username;
            // email.innerHTML = data.message.email;
            // password.innerHTML = data.message.password;
            // repassword.innerHTML = data.message.repassword;
            console.log("Error")
        }
    }
</script>


</html>