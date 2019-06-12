<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if (isset($_FILES['files']) && $_FILES['files']['error'] == 0) {
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][0])));
        $file_size = $_FILES['files']['size'][0];

        if (in_array($file_ext, $extensions)) {
            if ($file_size <= 2097152) {  
                if($data->type = "client")
                    $link = 'avatars/'.$data->type.'s/'. $data->clientId;
                else  
                    $link = 'avatars/'.$data->type.'s/'. $data->trainerId;
                
                move_uploaded_file($_FILES['files']['tmp_name'][0], $link);
            
            // give callback to your angular code with the image src name
                echo json_encode($link);
            }
            else
            {
            echo json_encode(array('error'=>array('msg'=>'Файл слишком большой')));
            }
        }
        else
        {
            echo json_encode(array('error'=>array('msg'=>'Расширение не поддерживается')));
        }
    }
    else
    {
        echo json_encode(array('error'=>array('msg'=>'Файл не загружен')));
    }

?>