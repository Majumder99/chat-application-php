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
    const delete_user = (e) => {
        // alert(e.target.getAttribute('user_id'));
        var userid = e.target.getAttribute('user_id');
        send_data({
            user: userid
        }, 'delete_user');
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

            }
        }
    }
</script>

</html>