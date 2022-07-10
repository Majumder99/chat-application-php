<?php

// while ($result = mysqli_fetch_assoc($connect))

$sql = 'SELECT * FROM `usertable` LIMIT 10;';
$connect = mysqli_query($conn, $sql);
if ($connect) {
    // $result = mysqli_fetch_assoc($connect);
    $num = mysqli_num_rows($connect);
    $myData = '<div class="new_div" style="text-align: center;">';


    while ($result = mysqli_fetch_assoc($connect)) {
        $userName = $result['username'];
        $image = ($result['gender'] == 'Male')  ? 'ui/images/user1.jpg' : 'ui/images/user2.jpg';
        if (file_exists($result['image'])) {
            $image = $result['image'];
        }
        $myData .= "<div id='contact'>
                         <img src='$image' alt=''>
                        <br>$userName
                     </div>";
    }
    // for ($i = 0; $i < $num; $i++) {
    //     $myData .= '<div id="contact">
    //                     <img src="ui/images/user1.jpg" alt="">
    //                     <br>Username
    //                 </div>';
    // }

    $myData .= '</div>';
}


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