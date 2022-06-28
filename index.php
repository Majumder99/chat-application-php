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
    <div id="wrapper">
        <div id="left_pannel">
            <div style="padding: 10px;">
                <img id="profile-img" src="ui/images/user3.jpg" alt="No user">
                <br>
                Keylly Hartmann
                <br>
                <span style="font-size: 12px; opacity:0.5;">keylly@gamil.com</span>
                <br>
                <br>
                <br>

                <div>
                    <label for="radio_chat">Chat <img src="ui/icons/chat.png" alt=""></label>
                    <label for="radio_contacts">Contacts <img src="ui/icons/contacts.png" alt=""></label>
                    <label for="radio_settings">Settings <img src="ui/icons/settings.png" alt=""></label>
                </div>
            </div>
        </div>
        <div id="right_pannel">
            <div id="header">
                My Chat
            </div>
            <div id="container">
                <div style="text-align: center ;" id="inner_left_pannel">
                </div>
                <input type="radio" name="myradio" id="radio_chat" style="display:none;">
                <input type="radio" name="myradio" id="radio_contacts" style="display:none;">
                <input type="radio" name="myradio" id="radio_settings" style="display:none;">
                <div id="inner_right_pannel">
                </div>
            </div>
        </div>
    </div>
</body>

</html>