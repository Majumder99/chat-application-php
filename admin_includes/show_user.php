<?php

$info = (object)[];


$sql = "SELECT * FROM `usertable` WHERE userid != '62d696ce669';";

$connection = mysqli_query($conn, $sql);
$mydata = '';
if ($connection) {
    while ($result = mysqli_fetch_assoc($connection)) {
        $userid = $result['userid'];
        $username = $result['username'];
        $gender = $result['gender'];
        $image = ($result['gender'] == 'Male')  ? 'ui/images/user1.jpg' : 'ui/images/user2.jpg';
        if (file_exists($result['image'])) {
            $image = $result['image'];
        }
        $mydata .= "
                <div class='card me-3 mb-4' style='width: 18rem;'>
                    <img src='$image' class='card-img-top' alt='...' style='height:400px;width:100%'>
                    <div class='card-body'>
                        <h5 class='card-title'>$username</h5>
                        <p>Gender : <span>$gender</span></p>
                        <a href='#' class='btn btn-danger' user_id='$userid' onclick='delete_user(event)'>Delete</a>
                    </div>
                </div>";
    }
    $info->message = $mydata;
    $info->data_type = 'show_user';
    echo json_encode($info);
} else {
    $info->message = 'connect unsuccessfully';
    $info->data_type = 'show_user';
    echo json_encode($info);
}
