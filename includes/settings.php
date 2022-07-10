<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userid1 = $_SESSION['userid'];
$sql = "SELECT * FROM `usertable` WHERE userid = '$userid1' LIMIT 1;";
$connect = mysqli_query($conn, $sql);
$myData = '';
if ($connect) {
    while ($result = mysqli_fetch_assoc($connect)) {
        $username = $result['username'];
        $useremail = $result['email'];
        $password = $result['password'];
        $image = ($result['gender'] == 'Male')  ? 'ui/images/user1.jpg' : 'ui/images/user2.jpg';
        if (file_exists($result['image'])) {
            $image = $result['image'];
        }
        $gender_male = "";
        $gender_female = "";
        if ($result['gender'] == 'Male') {
            $gender_male = "checked";
        } else {
            $gender_female = "checked";
        }
        $myData = '
<div class="card text-black" style="border-radius: 25px;margin:50px;">
        <div class="card-body p-md-5">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1"> 
                    <div style="display: flex;">
                            <div style="margin-left: -40px;">
                                <img src="' . $image . '" style="width:150px;height:150px;margin:10px;"/>   
                                <input id="signup_button" type="button" value="Change Image" name="submit" class="btn btn-primary btn-lg">
                            </div>                            
                            <div>
                                    <form id="myForm" class="mx-4 text-white">
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Username</label>
                                                <input name="username" placeholder="username" value="' . $username . '" type="text" id="form3Example1c" class="form-control" />
                                                <div class="red-text" id="username"></div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Your Email</label>
                                                <input name="email" placeholder="email" value="' . $useremail . '" type="email" id="form3Example3c" class="form-control" />
                                                <div class="red-text" id="email"></div>
                                            </div>
                                        </div>

                                        <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">

                                            <h6 class="mb-0 me-4 ms-3">Gender: </h6>

                                            <div class="form-check form-check-inline mb-0 me-4">
                                                <input class="form-check-input" type="radio" id="gender_male" value="Male" name="gender" ' . $gender_male . '/>
                                                <label class="form-check-label" for="gender_male">Male</label>
                                            </div>

                                            <div class="form-check form-check-inline mb-0 me-4">
                                                <input class="form-check-input" type="radio" id="gender_female" value="Female" name="gender" ' . $gender_female . '/>
                                                <label class="form-check-label" for="gender_female">Female</label>
                                            </div>
                                        </div>
                                        <div class="red-text" id="gender_part" style="margin-left: 14px;margin-top: -16px;margin-bottom: 30px;">
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4c">Password</label>
                                                <input name="password" placeholder="password" value="' . $password . '" type="password" id="form3Example4c" class="form-control" />
                                                <div class="red-text" id="password"></div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4cd">Repeat your password</label>
                                                <input name="repassword" placeholder="repassword" value="' . $password . '" type="password" id="form3Example4cd" class="form-control" />
                                                <div class="red-text" id="repassword"></div>
                                            </div>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5 terms-service">
                                            <input name="agreed" class="form-check-input me-2" type="checkbox" id="form2Example3c" />
                                            <label name="agreed" class="form-check-label" for="form2Example3c">
                                                I agree all statements in <a href="#!">Terms of service</a>
                                            </label>
                                        </div>
                                        <input id="save_settings_button" type="button" value="Save Settings" name="submit" class="btn btn-primary btn-lg">
                                    </form>
                            </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<script>
    const documentId = (element) => {

        return document.getElementById(element);
    }
    var save_settings_button = document.getElementById("save_settings_button");
    save_settings_button.addEventListener("click", collect_data);

    function collect_data() {
        save_settings_button.disable = true;
        save_settings_button.value = "Loading.....";
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
        send_data(data, "save_settings");
    }
    const send_data = (data, type) => {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                // alert(xhttp.responseText);
                handle_result(xhttp.responseText);
                signup_button.disable = false;
                signup_button.value = "Save Settings";
            }
        };
        data.data_type = type;
        var data_string = JSON.stringify(data);
        console.log(data_string)
        xhttp.open("POST", "api.php", true);
        xhttp.send(data_string);
    }
    const handle_result = (result) => {
        console.log(result);
        var data = JSON.parse(result);
        if (data.data_type == "Successfull") {
            alert("Settings saveed successfully");
        } else {
            var username = documentId("username");
            var email = documentId("email");
            var password = documentId("password");
            var repassword = documentId("repassword");
            var gender_part = documentId("gender_part");


            username.innerHTML = data.message.username;
            email.innerHTML = data.message.email;
            password.innerHTML = data.message.password;
            repassword.innerHTML = data.message.repassword;
            gender_part.innerHTML = data.message.gender;
        }
    }
</script>

';
    }
} else {
}




$info = (object)[];

$info->message = $myData;
$info->data_type = 'settings';
echo json_encode($info);

die;

$info->message = "No contacts were found";
$info->data_type = "Error";
echo json_encode($info);
?>


<html>

</html>