<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $link = 'avatars/'.$data->type.'s/'. $id;
        move_uploaded_file($_FILES['file']['tmp_name'], $link);
    
    // give callback to your angular code with the image src name
        echo json_encode($link);
    }
    else
    {
        echo json_encode(array('error'=>array('msg'=>'Файл не загружен')));
    }

?>