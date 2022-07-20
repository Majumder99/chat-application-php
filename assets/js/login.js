const get_element = (element) => {
  return document.getElementById(element);
};

var remember_check = get_element("remember_check");
var checking = false;
remember_check.addEventListener("change", (e) => {
  if (e.target.checked) {
    checking = true;
    console.log("we have cheked");
  } else {
    checking = false;
    console.log("we have uncheked");
  }
});

const collect_data = () => {
  login_button.disable = true;
  login_button.value = "Loading.....";
  var myForm = get_element("myForm");
  var inputs = myForm.getElementsByTagName("INPUT");
  var data = {};
  for (var i = inputs.length - 1; i >= 0; i--) {
    var key = inputs[i].name;
    switch (key) {
      case "email":
        data.email = inputs[i].value;
        break;

      case "password":
        data.password = inputs[i].value;
        break;
    }
  }
  data.check = checking;
  send_data(data, "login");
};

var login_button = get_element("login_button");
login_button.addEventListener("click", collect_data);

const send_data = (data, type) => {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = () => {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      handle_result(xhttp.responseText);
      login_button.disable = false;
      login_button.value = "Login";
    }
  };
  data.data_type = type;
  var data = JSON.stringify(data);
  xhttp.open("POST", "api.php", true);
  xhttp.send(data);
};
const handle_result = (result) => {
  console.log(result);
  var data = JSON.parse(result);
  if (data.data_type == "Successfull") {
    window.location.assign("index.php");
  } else if (data.data_type == "admin") {
    console.log("i am admin");
    window.location.assign("http://localhost/Web%20Project/admin_panel.php");
  } else {
    // alert(data.message);
    var email = get_element("email");
    var password = get_element("password");

    email.innerHTML = data.email;
    password.innerHTML = data.password;
  }
};
