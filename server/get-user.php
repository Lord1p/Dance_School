<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    if($data->type == 'client')
    {
        
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
        $Select->bindValue(':id',$data->clientId);
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
    else{
    if($data->type == 'trainer')
    {
        
        $Select = $dbh->prepare("SELECT
        trainerName,
        email,
        tellNumber,
        trainerId,
        avatarLink,
        trainerDescription
        FROM
        trainers
        WHERE
        trainerId = :id
        ");
        $Select->bindValue(':id',$data->trainerId);
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
    else{
        echo json_encode(array('error'=>array('msg'=>'Учетная запись неизвестного типа')));
    }}
?>
