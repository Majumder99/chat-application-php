<?php

$myData =
    '<div class="new_div" style="text-align: center;">
                    <div id="contact">
                        <img src="ui/images/user1.jpg" alt="">
                        <br>Username
                    </div>
                    <div id="contact">
                        <img src="ui/images/user2.jpg" alt="">
                        <br>Username
                    </div>
                    <div id="contact">
                        <img src="ui/images/user3.jpg" alt="">
                        <br>Username
                    </div>
                </div>';

// $result = (object)mysqli_fetch_assoc($connect);
$info = (object)[];

$info->message = $myData;
$info->data_type = 'contacts';
echo json_encode($info);

die;

$info->message = "No contacts were found";
$info->data_type = "Error";
echo json_encode($info);

?>


<html>


</html>