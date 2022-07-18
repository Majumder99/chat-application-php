<?php include 'header.php' ?>

<div id="wrapper">
    <div id="left_pannel">
        <div id="user_info" style="padding: 10px;">
            <img id="profile_img" class="img_edit" src="ui/images/user1.jpg" alt="No user" style="
    border-radius: 50%;
    width: 100px !important;
    height: 100px !important;
">
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

<script type="text/javascript">
    var current_chat_user = "";
    var seen_status = false;

    var sent_audio = new Audio("ui/sounds/message_sent.mp3");
    var received_audio = new Audio("ui/sounds/message_received.mp3");

    const get_element = (element) => {
        return document.getElementById(element)
    }


    var label_contacts = get_element('label_contacts');
    label_contacts.addEventListener('click', () => {
        get_data({}, 'contacts');
    })

    var label_chat = get_element('label_chat');
    label_chat.addEventListener('click', () => {
        get_data({}, 'chats');
    })

    var label_settings = get_element('label_settings');
    label_settings.addEventListener('click', () => {
        get_data({}, 'settings');
    })


    var logout = get_element('logout');
    logout.addEventListener('click', () => {
        var answer = confirm("Are you sure you want to log out?");
        if (answer) {
            get_data({}, 'logout')
        }
        // console.log('hello')
    })
    const get_data = (find, type) => {
        var xhttp = new XMLHttpRequest();
        // var loader_auto = get_element('loader_auto');
        // loader_auto.className = 'loader_on';
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                // loader_auto.className = 'loader_off';
                handle_result(xhttp.responseText, type);
            }
        };
        var data = {};
        data.find = find;
        data.data_type = type;
        // console.log(data);
        data = JSON.stringify(data);
        // console.log(data);
        xhttp.open("POST", "api.php", true);
        xhttp.send(data);
    }
    const get_data_user = (find, type) => {
        var xhttp = new XMLHttpRequest();
        // var loader_auto = get_element('loader_auto');
        // loader_auto.className = 'loader_on';
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                // loader_auto.className = 'loader_off';
                handle_result(xhttp.responseText, type);
            }
        };
        var data = {};
        data.find = find.user;
        data.data_type = type;
        // console.log(data);
        data = JSON.stringify(data);
        // console.log(data);
        xhttp.open("POST", "api.php", true);
        xhttp.send(data);
    }

    const handle_result = (result, type) => {
        console.log(result);
        if (result.trim() !== "") {
            var inner_right_pannel = get_element('inner_right_pannel');
            inner_right_pannel.style.overflow = 'hidden';
            let obj = JSON.parse(result);
            // console.log(result);
            // typeof(obj.logged_in) !== "undefined" &&
            if (typeof(obj.logged_in) !== "undefined" && !obj.logged_in) {
                alert(result);
                window.location.assign("login.php")
            } else {
                // alert(result);
                switch (obj.data_type) {
                    case 'user_info':
                        var username = get_element('username');
                        var useremail = get_element('useremail');
                        var profile_img = get_element('profile_img');

                        profile_img.src = obj.pro_image;
                        username.innerText = obj.username;
                        useremail.innerText = obj.email;
                        break;

                    case 'contacts':
                        seen_status = false;
                        var inner_left_pannel = get_element('inner_left_pannel');


                        inner_right_pannel.style.overflow = 'hidden';
                        inner_left_pannel.innerHTML = obj.message;
                        break;

                    case 'chats_refresh':
                        // seen_status = false;
                        var message_holder = get_element('message_holder');
                        message_holder.innerHTML = obj.messages;

                        if (typeof obj.new_message != 'undefined') {
                            if (obj.new_message) {
                                received_audio.play();
                                setTimeout(() => {
                                    message_holder.scrollTo(0, message_holder.scrollHeight);
                                    var message_text = get_element('message_text');
                                    message_text.focus();
                                }, 100)
                            }
                        }
                        // console.log(obj.messages);
                        break;

                    case 'send_message':
                        sent_audio.play();
                    case 'chats':
                        seen_status = false;
                        var inner_left_pannel = get_element('inner_left_pannel');

                        inner_left_pannel.innerHTML = obj.user;
                        inner_right_pannel.innerHTML = obj.messages;

                        var message_holder = get_element('message_holder');

                        setTimeout(() => {
                            message_holder.scrollTo(0, message_holder.scrollHeight);
                            var message_text = get_element('message_text');
                            message_text.focus();
                        }, 100)
                        if (typeof obj.new_message != 'undefined') {
                            if (obj.new_message) {
                                received_audio.play();
                            }
                        }
                        break;


                    case 'settings':
                        var inner_left_pannel = get_element('inner_left_pannel');
                        inner_left_pannel.innerHTML = obj.message;
                        break;
                    case 'save_settings':
                        // alert(obj.message);
                        console.log(obj.message);
                        get_data({}, "user_info");
                        get_data({}, 'settings');
                        // window.location.assign("index.php")
                        break;
                    case 'change_profile_image':
                        // alert(obj.message);
                        // console.log(obj.message);
                        get_data({}, "user_info");
                        get_data({}, 'settings');
                        // window.location.assign("index.php")
                        break;
                    case 'send_files':
                        alert(obj.message);
                        break;
                }
            }
        }
    }
    get_data({}, "user_info");
    get_data({}, "contacts");

    var radio_contacts = get_element('radio_contacts');
    radio_contacts.checked = true;

    setInterval(() => {
        if (current_chat_user !== "") {

            get_data({
                user: current_chat_user,
                seen: seen_status
            }, 'chats_refresh');
        }
    }, 5000)
    const set_seen = (e) => {
        seen_status = true;
    }
    const delete_message = (e) => {
        if (confirm("Are you sure you want to delete this message?")) {
            var msgid = e.target.getAttribute('msgid');
            get_data({
                rowid: msgid
            }, 'delete_message');
            get_data({
                user: current_chat_user,
                seen: seen_status
            }, 'chats_refresh');
        }
    }
</script>

<script>
    function collect_data() {
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
        send_data(data, "save_settings");
    }
    const send_data = (data, type) => {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                // alert(xhttp.responseText);
                var save_settings_button = get_element("save_settings_button");
                handle_result(xhttp.responseText);
                save_settings_button.disable = false;
                save_settings_button.value = "Save Settings";
            }
        };
        data.data_type = type;
        var data_string = JSON.stringify(data);
        // console.log(data_string)
        xhttp.open("POST", "api.php", true);
        xhttp.send(data_string);
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
        xhttp.open("POST", "uploader.php", true);
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


    const radio_chat = (e) => {
        var userid = e.target.getAttribute('userid');
        if (e.target.id === "") {
            userid = e.target.parentNode.getAttribute('userid');
        }
        // console.log(userid)
        current_chat_user = userid;
        var radio_chat = get_element("radio_chat");
        radio_chat.checked = true;
        // console.log("Chat")
        get_data({
            user: current_chat_user
        }, 'chats');
    }

    const send_message = (e) => {
        var message_text = get_element('message_text');
        if (message_text.value.trim() === '') {
            console.log("Please type something to send");
            return;
        }
        // console.log(message_text.value);
        get_data({
            message: message_text.value.trim(),
            userid: current_chat_user,
        }, 'send_message');
    }

    const send_on_enter = (e) => {
        if (e.type === 'keypress') {
            if (e.key === "Enter") {
                e.preventDefault();
                send_message(e);
                // console.log(555);
            }
        }
        seen_status = true;
    }

    const send_files = (files) => {
        // alert(files[0].name);
        // if multiple file then use for loop video part 57 06 minute

        var filename = files[0].name;
        var ext_start = filename.lastIndexOf(".");
        var ext = filename.substr(ext_start + 1, 3);
        if (!(ext === 'jpg' || ext === 'JPG' || ext === 'png' || ext === 'PNG')) {
            alert("This file type is not allowed");
            return;
        }

        var myForm = new FormData();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                alert(xhttp.responseText);
                get_data({
                    user: current_chat_user,
                    seen: seen_status
                }, 'chats_refresh');
                // handle_result(xhttp.responseText);
                // change_image_input.disable = false;
                // change_image_input.innerHTML = "Save Settings";
            }
        };

        myForm.append('file', files[0]);
        myForm.append('data_type', "send_files");
        myForm.append('user', current_chat_user);

        // console.log(data_string)
        // console.log("sending files");
        xhttp.open("POST", "uploader.php", true);
        // xhttp.open("POST", "api.php", true);
        xhttp.send(myForm);
    }
    const close_image = (e) => {
        e.target.className = 'image_off';
    }
    const image_show = (e) => {
        var image = e.target.src;
        var image_viewer = get_element('image_viewer');

        image_viewer.innerHTML = "<img src ='" + image + "' style='width:100%;height:100%;' />";
        image_viewer.className = 'image_on';
    }
</script>


</html>