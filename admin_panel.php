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

<script src="assets/js/admin_panel.js"></script>

</html>