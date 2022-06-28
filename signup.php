<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>My Chat Application</title>
</head>

<body>
    <div id="header1">
        My Chat
        <div style="font-size: 20px; margin-bottom:20px;">Login</div>
    </div>
    <div id="wrapper1" style="color: grey;">
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
    </div>
</body>

<script type="text/javascript">
    function _(element) {
        return document.getElementById(element)
    }


    var label = _("label_chat");
    label.addEventListener('click', function() {
        var inner_pannel = _('inner_left_pannel');
        var ajax = new XMLHttpRequest();
        ajax.onload = function() {

            if (ajax.status === 200 || ajax.readyState === 4) {
                inner_pannel.innerHTML = ajax.responseText;
            }
        }
        ajax.open("POST", "file.txt", true);
        ajax.send();
    })
</script>

</html>