<?php



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$id = $_SESSION['userid'];

$sql = "SELECT * FROM `usertable` WHERE userid != '$id' && userid != '62d696ce669';";
$connect = mysqli_query($conn, $sql);
if ($connect) {
    $num = mysqli_num_rows($connect);
    $myData = '<div class="new_div" style="text-align: center;">';
    while ($result = mysqli_fetch_assoc($connect)) {
        $userName = $result['username'];
        $mypersonalId = $result['userid'];
        $image = ($result['gender'] == 'Male')  ? 'ui/images/user1.jpg' : 'ui/images/user2.jpg';
        if (file_exists($result['image'])) {
            $image = $result['image'];
        }
        $myData .= "<div id='contact' userid='$mypersonalId' onclick='radio_chat(event)'>
                         <img src='$image' alt=''>
                         <br>$userName
                    </div>";
    }
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