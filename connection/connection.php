<?php

//Start the connection
$conn = mysqli_connect('localhost', 'project', 'project', 'chat_box');
if (!$conn) {
    echo 'Connection is error' . mysqli_connect_error();
}
