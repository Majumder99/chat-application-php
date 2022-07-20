<?php include 'header.php' ?>

<div id="wrapper">
    <div id="left_pannel">
        <div id="user_info" style="padding: 10px;">
            <img id="profile_img" class="img_edit" src="ui/images/user1.jpg" alt="No user" style="border-radius: 50%;width: 100px !important;height: 100px !important;">
            <br>
            <h1 id="username" style="font-size: 18px; margin-bottom:-20px;">Username</h1>
            <br>
            <span id="useremail" style="font-size: 15px; opacity:0.5;">email@gmail.com</span>
            <br>
            <br>
            <br>
            <div>
                <label style="display:none;" id="label_chat" for="radio_chat">Chat <img src="ui/icons/chat.png" alt=""></label>
                <label id="label_contacts" for="radio_contacts">Contacts <img src="ui/icons/contacts.png" alt=""></label>
                <label id="label_settings" for="radio_settings">Settings <img src="ui/icons/settings.png" alt=""></label>
                <label id="logout" for="radio_logout">Logout <img src="ui/icons/search-icon.png" alt=""></label>
            </div>
        </div>
    </div>
    <div id="right_pannel">
        <div id="header">
            <!-- <div id="loader_auto"><img src="ui/icons/giphy.gif" alt=""></div> -->
            <div id="image_viewer" class="image_off" onclick="close_image(event)"></div>
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
</div>

<?php include "footer.php"  ?>

<script type="text/javascript" src="assets/js/index.js"></script>


</html>