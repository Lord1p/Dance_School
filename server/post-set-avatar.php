<?php
    include("connect.php");

    $type = $_POST['UserType'];
    error_reporting(E_ERROR);

    if (isset($_FILES['file'])) {
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fn = $_FILES['file']['name'];
        $file_ext = strtolower(end(explode('.', $fn)));
        $file_size = $_FILES['file']['size'];

        if (in_array($file_ext, $extensions)) {
            if ($file_size <= 2097152) {  
                if($type = "client")
                    $link = '/avatars/'.$type.'s/'. $_POST['clientId'].'.'.$file_ext;
                else  
                    $link = '/avatars/'.$type.'s/'. $_POST['trainerId'].'.'.$file_ext;
                
                move_uploaded_file($_FILES['file']['tmp_name'], realpath(dirname(getcwd())).$link);
            
            // give callback to your angular code with the image src name
            if($type = "client"){
                $Insert = $dbh->prepare("
                UPDATE 
                    clients
                SET
                    avatarLink =:a
                WHERE
                    clientId = :i
                ");
                
                $Insert->bindValue(':a','.'.$link);
                $Insert->bindValue(':i',$_POST['clientId']);
                $Insert->execute();

                $Select = $dbh->prepare("SELECT
                clientName,
                email,
                tellNumber,
                clientId,
                avatarLink,
                mailSending
                FROM
                clients
                WHERE
                clientId = :id
                ");

                $Select->bindValue(':id',$_POST['clientId']);
                $Select->execute();
            
                $cl=$Select->fetch(PDO::FETCH_ASSOC);
            
                $res = new R();
                $res->type = "client";
                $res->clientName = $cl['clientName'];
                $res->email = $cl['email'];
                $res->tellNumber = $cl['tellNumber'];
                $res->clientId = $cl['clientId'];
                $res->avatarLink = $cl['avatarLink'];
                $res->mailSending = $cl['mailSending'];
                
                echo json_encode($res);
                }
                else
                {
                    $Insert = $dbh->prepare("
                    UPDATE 
                        trainers
                    SET
                        avatarLink =:a
                    WHERE
                        trainerId = :i
                    ");
                    
                    $Insert->bindValue(':a','.'.$link);
                    $Insert->bindValue(':i',$_POST['trainerId']);
                    $Insert->execute();

                    $Select = $dbh->prepare("SELECT
                    trainerName,
                    email,
                    tellNumber,
                    trainerDescription,
                    avatarLink,
                    trainerId
                    FROM
                    trainers
                    WHERE
                    trainerId = :id
                    ");
                    $Select->bindValue(':id',$_POST['trainerId']);
                    $Select->execute();
                
                    $cl=$Select->fetch(PDO::FETCH_ASSOC);
                
                    $res = new R();
                    $res->type = "trainer";
                    $res->trainerName = $cl['trainerName'];
                    $res->email = $cl['email'];
                    $res->tellNumber = $cl['tellNumber'];
                    $res->trainerId = $cl['trainerId'];
                    $res->avatarLink = $cl['avatarLink'];
                    $res->trainerDescription = $cl['trainerDescription'];
                    
                    echo json_encode($res);
                }
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