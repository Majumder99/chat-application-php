<!DOCTYPE html>

<?php include "header.php" ?>


<div id="wrapper">
    <div id="left_pannel">
        <div id="user_info" style="padding: 10px;">
            <img id="profile-img" src="ui/images/user1.jpg" alt="No user">
            <br>
            <h1 id="username" style="font-size: 18px; margin-bottom:-20px;">Username</h1>
            <br>
            <span id="useremail" style="font-size: 15px; opacity:0.5;">email@gmail.com</span>
            <br>
            <br>
            <br>

            <div>
                <label id="label_chat" for="radio_chat">Chat <img src="ui/icons/chat.png" alt=""></label>
                <label id="label_contacts" for="radio_contacts">Contacts <img src="ui/icons/contacts.png" alt=""></label>
                <label id="label_settings" for="radio_settings">Settings <img src="ui/icons/settings.png" alt=""></label>
            </div>
        </div>
        <input class="btn btn-primary btn-lg" type="button" value="Logout" id="logout">
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

<?php include "footer.php"  ?>

<script type="text/javascript">
    const get_element = (element) => {
        return document.getElementById(element)
    }
    var logout = get_element('logout');
    logout.addEventListener('click', () => {
        get_data({}, 'logout')
        // console.log('hello')
    })
    const get_data = (find, type) => {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                handle_result(xhttp.responseText, type);
            }
        };
        var data = {};
        data.find = find;
        data.data_type = type;
        data = JSON.stringify(data);
        xhttp.open("POST", "api.php", true);
        xhttp.send(data);
    }

    const handle_result = (result, type) => {
        if (result.trim() !== "") {
            let obj = JSON.parse(result);
            if (typeof(obj.logged_in) !== "undefined" && !obj.logged_in) {
                alert(result);
                window.location.assign("login.php")
            } else {
                // alert(result);
                switch (obj.data_type) {
                    case 'user_info':
                        var username = get_element('username');
                        var useremail = get_element('useremail');

                        username.innerText = obj.username;
                        useremail.innerText = obj.email;
                        break;
                }
            }
        }
    }
    get_data({}, "user_info");
</script>



</html>