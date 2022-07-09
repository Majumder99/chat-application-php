<?php

$myData =
    'settings go here';

// $result = (object)mysqli_fetch_assoc($connect);
$info = (object)[];

$info->message = $myData;
$info->data_type = 'settings';
echo json_encode($info);

die;

$info->message = "No contacts were found";
$info->data_type = "Error";
echo json_encode($info);

?>


<html>


</html>