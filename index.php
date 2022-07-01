<!DOCTYPE html>

<?php include "header.php" ?>


<div id="wrapper">
    <div id="left_pannel">
        <div style="padding: 10px;">
            <img id="profile-img" src="ui/images/user1.jpg" alt="No user">
            <br>
            <h1 style="font-size: 18px; margin-bottom:-20px;">Keylly Hartmann</h1>
            <br>
            <span style="font-size: 15px; opacity:0.5;">keylly@gamil.com</span>
            <br>
            <br>
            <br>

            <div>
                <label id="label_chat" for="radio_chat">Chat <img src="ui/icons/chat.png" alt=""></label>
                <label id="label_contacts" for="radio_contacts">Contacts <img src="ui/icons/contacts.png" alt=""></label>
                <label id="label_settings" for="radio_settings">Settings <img src="ui/icons/settings.png" alt=""></label>
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

<?php include "footer.php"  ?>

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