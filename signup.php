<?php

$email = $username = $password = $repassword = '';

?>



<html>

<?php include "header1.php" ?>

<section class="vh-100 mb-5 mt-5">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div id="error"></div>
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                                <form id="myForm" class="mx-1 mx-md-4" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example1c">Username</label>
                                            <input name="username" value="<?php echo htmlspecialchars($username); ?>" type="text" id="form3Example1c" class="form-control" />
                                            <div class="red-text" id="username"></div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example3c">Your Email</label>
                                            <input name="email" value="<?php echo htmlspecialchars($email); ?>" type="email" id="form3Example3c" class="form-control" />
                                            <div class="red-text" id="email"></div>
                                        </div>
                                    </div>

                                    <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">

                                        <h6 class="mb-0 me-4 ms-3">Gender: </h6>

                                        <div class="form-check form-check-inline mb-0 me-4">
                                            <input class="form-check-input" type="radio" id="femaleGender" value="Female" name="gender" />
                                            <label class="form-check-label" for="femaleGender">Female</label>
                                        </div>

                                        <div class="form-check form-check-inline mb-0 me-4">
                                            <input value="Male" class="form-check-input" type="radio" id="maleGender" value="Male" name="gender" />
                                            <label class="form-check-label" for="maleGender">Male</label>
                                        </div>

                                        <div class="form-check form-check-inline mb-0">
                                            <input value="Female" class="form-check-input" type="radio" id="otherGender" value="Other" name="gender" />
                                            <label class="form-check-label" for="otherGender">Other</label>
                                        </div>

                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4c">Password</label>
                                            <input name="password" value="<?php echo htmlspecialchars($password); ?>" type="password" id="form3Example4c" class="form-control" />
                                            <div class="red-text" id="password"></div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4cd">Repeat your password</label>
                                            <input name="repassword" value="<?php echo htmlspecialchars($repassword); ?>" type="password" id="form3Example4cd" class="form-control" />
                                            <div class="red-text" id="repassword"></div>
                                        </div>
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-5 terms-service">
                                        <input name="agreed" class="form-check-input me-2" type="checkbox" id="form2Example3c" />
                                        <label name="agreed" class="form-check-label" for="form2Example3">
                                            I agree all statements in <a href="#!">Terms of service</a>
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <input id="signup_button" type="button" value="Register" name="submit" class="btn btn-primary btn-lg">
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

<script>
    const documentId = (element) => {

        return document.getElementById(element);
    }
    var signup_button = document.getElementById("signup_button");
    signup_button.addEventListener('click', collect_data);

    function collect_data() {
        signup_button.disable = true;
        signup_button.value = 'Loading.....';
        var myForm = documentId("myForm");
        var inputs = myForm.getElementsByTagName("INPUT");
        var data = {};
        for (var i = inputs.length - 1; i >= 0; i--) {
            var key = inputs[i].name;
            switch (key) {
                case "username":
                    data.username = inputs[i].value;
                    break;

                case "email":
                    data.email = inputs[i].value;
                    break;

                case "gender":
                    if (inputs[i].checked) {
                        data.gender = inputs[i].value;
                    }
                    break;

                case "password":
                    data.password = inputs[i].value;
                    break;

                case "repassword":
                    data.repassword = inputs[i].value;
                    break;
            }
        }
        send_data(data, "signup");
    }
    const send_data = (data, type) => {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                // alert(xhttp.responseText);
                handle_result(xhttp.responseText);
                signup_button.disable = false;
                signup_button.value = 'Signup';
            }
        };
        data.data_type = type;
        var data_string = JSON.stringify(data);
        xhttp.open("POST", "api.php", true);
        xhttp.send(data_string);
    }
    const handle_result = (result) => {
        console.log(result);
        var data = JSON.parse(result);
        if (data.data_type == "Successfull") {
            window.location.assign("index.php");
        } else {
            var username = document.getElementById('username');
            var email = document.getElementById('email');
            var password = document.getElementById('password');
            var repassword = document.getElementById('repassword');

            username.innerHTML = data.message.username;
            email.innerHTML = data.message.email;
            password.innerHTML = data.message.password;
            repassword.innerHTML = data.message.repassword;
        }
    }
</script>

</html>