<?php



$info = (object)[];

$data_type = "";
if (isset($_POST['data_type'])) {
    $data_type = $_POST['data_type'];
}

$destination = "";
if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {

    if ($_FILES['file']['error'] == 0) {
        //good to go
        $folder = "uploads/";
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        $destination = $folder . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $destination);
    }
}


if ($data_type == 'registration_files') {
    $info->destination = $destination;
    $info->data_type = $data_type;
    echo json_encode($info);
}
