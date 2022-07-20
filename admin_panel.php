<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>My Chat Application</title>
</head>

<body>
    <div id="header1">
        <h1>Admin panel</h1>
        <button class="btn btn-secondary" style="font-family:fangsong;" onclick="logout_admin(event)">Logout</button>
        <button class="btn btn-secondary" style="font-family:fangsong;" onclick="show_users()">User</button>
        <button class="btn btn-secondary" style="font-family:fangsong;" onclick="change_settings()">Settings</button>
    </div>

    <section class="vh-300">
        <div class="mt-5 p-5">
            <div id="card_id" class='d-flex flex-wrap'>
            </div>
        </div>
    </section>

    <div id="footer" style="
    width: 100%;
    height: 30px;
    background-color: #485B6C;
    color: white;
    text-align: center;
    padding-top:30px;
    padding-bottom:30px;
    margin-top: 400px;
">
        <p>Sourav Majumder &copy; 2022-23</p>
    </div>
</body>

<script>
    const get_element = (element) => {

        return document.getElementById(element);
    }

    const send_data = (find, type) => {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                handle_result(xhttp.responseText);
            }
        };
        data = {};
        data.find = find;
        data.data_type = type;
        var data = JSON.stringify(data);
        xhttp.open("POST", "admin_api.php", true);
        xhttp.send(data);
    }
    const logout_admin = (e) => {
        send_data({}, 'logout_admin');
    }
    const change_settings = () => {
        send_data({}, 'change_settings');
    }
    const delete_user = (e) => {
        // alert(e.target.getAttribute('user_id'));
        var userid = e.target.getAttribute('user_id');
        send_data({
            user: userid
        }, 'delete_user');
        send_data({}, 'show_user');
    }
    const show_users = () => {
        send_data({}, 'show_user');
    }
    send_data({}, 'show_user');
    const handle_result = (result) => {
        console.log(result);
        var data = JSON.parse(result);
        if (typeof(data.logged_in) !== "undefined" && !data.logged_in) {
            alert(result);
            window.location.assign("login.php");
        } else {
            switch (data.data_type) {
                case 'show_user':
                    var card_id = get_element('card_id');
                    card_id.innerHTML = data.message;
                    break;
                case 'delete_user':
                    alert(data.message);
                    break;

                case 'change_settings':
                    var card_id = get_element('card_id');
                    card_id.innerHTML = data.message;
                    break;
                case 'admin_save_settings':
                    // alert('save settings');
                    send_data({}, 'change_settings');
                    break;
                case 'change_profile_image':
                    // alert('save settings');
                    send_data({}, 'change_settings');
                    break;
            }
        }
    }

    const collect_data = () => {
        var save_settings_button = get_element("save_settings_button");
        save_settings_button.disable = true;
        save_settings_button.value = "Loading.....";
        var myForm = get_element("myForm");
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
        send_data(data, "admin_save_settings");
    }
    const upload_images = (files) => {
        // console.log(files[0]);

        var filename = files[0].name;
        var ext_start = filename.lastIndexOf(".");
        var ext = filename.substr(ext_start + 1, 3);
        if (!(ext === 'jpg' || ext === 'JPG' || ext === 'png' || ext === 'PNG')) {
            alert("This file type is not allowed");
            return;
        }

        var change_image_input = get_element("change_image_input");
        change_image_input.disable = true;
        change_image_input.innerHTML = "Uploading Image....";

        // console.log("after var");

        var myForm = new FormData();

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                // console.log(xhttp.responseText);
                handle_result(xhttp.responseText);
                change_image_input.disable = false;
                change_image_input.innerHTML = "Save Settings";
            }
        };

        myForm.append('data_type', "change_profile_image");
        myForm.append('file', files[0]);

        // console.log(data_string)
        // console.log("sending files");
        xhttp.open("POST", "admin_uploader.php", true);
        xhttp.send(myForm);
    }

    const handle_drag_image = (e) => {
        // console.log(e.type);
        if (e.type === 'dragover') {
            e.preventDefault();
            e.target.className = 'dragging';
        } else if (e.type === 'dragleave') {
            e.preventDefault();
            e.target.className = 'nodragging';
        } else if (e.type === 'drop') {
            e.preventDefault();
            e.target.className = 'dragging';
            // console.log(e.dataTransfer.files);
            upload_images(e.dataTransfer.files);
        } else {
            e.target.className = '';
        }
    }
</script>

</html>