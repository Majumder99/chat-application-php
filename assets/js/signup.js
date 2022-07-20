const documentId = (element) => {
  return document.getElementById(element);
};

const collect_data = () => {
  // console.log(image_file);
  signup_button.disable = true;
  signup_button.value = "Loading.....";
  var myForm = documentId("myForm");
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
  data.files = image_file;
  send_data(data, "signup");
};
const send_data = (data, type) => {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = () => {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      // alert(xhttp.responseText);
      handle_result(xhttp.responseText);
      signup_button.disable = false;
      signup_button.value = "Signup";
    }
  };
  data.data_type = type;
  var data_string = JSON.stringify(data);
  console.log(data_string);
  xhttp.open("POST", "api.php", true);
  xhttp.send(data_string);
};

var signup_button = document.getElementById("signup_button");
signup_button.addEventListener("click", collect_data);

const handle_result = (result) => {
  console.log(result);
  var data = JSON.parse(result);

  if (data.data_type == "Successfull") {
    window.location.assign("login.php");
  } else {
    var username = documentId("username");
    var email = documentId("email");
    var password = documentId("password");
    var repassword = documentId("repassword");
    var gender_part = documentId("gender_part");

    username.innerHTML = data.message.username;
    email.innerHTML = data.message.email;
    password.innerHTML = data.message.password;
    repassword.innerHTML = data.message.repassword;
    gender_part.innerHTML = data.message.gender;
  }
};
var image_file = "";
const get_image = (s) => {
  s = JSON.parse(s);
  image_file = s.destination;
};
const send_files = (files) => {
  var filename = files[0].name;
  var ext_start = filename.lastIndexOf(".");
  var ext = filename.substr(ext_start + 1, 3);
  if (!(ext === "jpg" || ext === "JPG" || ext === "png" || ext === "PNG")) {
    alert("This file type is not allowed");
    return;
  }

  var myForm = new FormData();
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = () => {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      get_image(xhttp.responseText);
    }
  };

  myForm.append("file", files[0]);
  myForm.append("data_type", "registration_files");

  xhttp.open("POST", "reg_uploader.php", true);
  xhttp.send(myForm);
};
