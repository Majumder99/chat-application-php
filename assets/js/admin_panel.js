const get_element = (element) => {
  return document.getElementById(element);
};

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
};
const logout_admin = (e) => {
  send_data({}, "logout_admin");
};
const change_settings = () => {
  send_data({}, "change_settings");
};
const delete_user = (e) => {
  var userid = e.target.getAttribute("user_id");
  send_data(
    {
      user: userid,
    },
    "delete_user"
  );
  send_data({}, "show_user");
};
const show_users = () => {
  send_data({}, "show_user");
};
send_data({}, "show_user");
const handle_result = (result) => {
  console.log(result);
  var data = JSON.parse(result);
  if (typeof data.logged_in !== "undefined" && !data.logged_in) {
    alert(result);
    window.location.assign("login.php");
  } else {
    switch (data.data_type) {
      case "show_user":
        var card_id = get_element("card_id");
        card_id.innerHTML = data.message;
        break;
      case "delete_user":
        alert(data.message);
        break;

      case "change_settings":
        var card_id = get_element("card_id");
        card_id.innerHTML = data.message;
        break;
      case "admin_save_settings":
        send_data({}, "change_settings");
        break;
      case "change_profile_image":
        send_data({}, "change_settings");
        break;
      case "show_messages":
        var card_id = get_element("card_id");
        card_id.innerHTML = data.messages;
        break;
    }
  }
};

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
};
const upload_images = (files) => {
  var filename = files[0].name;
  var ext_start = filename.lastIndexOf(".");
  var ext = filename.substr(ext_start + 1, 3);
  if (!(ext === "jpg" || ext === "JPG" || ext === "png" || ext === "PNG")) {
    alert("This file type is not allowed");
    return;
  }

  var change_image_input = get_element("change_image_input");
  change_image_input.disable = true;
  change_image_input.innerHTML = "Uploading Image....";

  var myForm = new FormData();

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = () => {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      handle_result(xhttp.responseText);
      change_image_input.disable = false;
      change_image_input.innerHTML = "Save Settings";
    }
  };

  myForm.append("data_type", "change_profile_image");
  myForm.append("file", files[0]);

  xhttp.open("POST", "admin_uploader.php", true);
  xhttp.send(myForm);
};
const show_messages = () => {
  send_data({}, "show_messages");
};

const handle_drag_image = (e) => {
  if (e.type === "dragover") {
    e.preventDefault();
    e.target.className = "dragging";
  } else if (e.type === "dragleave") {
    e.preventDefault();
    e.target.className = "nodragging";
  } else if (e.type === "drop") {
    e.preventDefault();
    e.target.className = "dragging";
    upload_images(e.dataTransfer.files);
  } else {
    e.target.className = "";
  }
};
