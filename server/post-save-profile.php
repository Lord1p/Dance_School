<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if($data->type == 'client')
    {
    $Update = $dbh->prepare("UPDATE
    clients SET
    clientName=:n,
    email=:e,
    tellNumber=:t,
    password=:p,
    avatarLink=:a,
    mailSending=:m
    WHERE
    clientId=:id
    ");
    $Update->bindValue(':n',$data->clientName);
    $Update->bindValue(':e',$data->email);
    $Update->bindValue(':t',$data->tellNumber);
    $Update->bindValue(':p',$data->password);
    $Update->bindValue(':a',$data->avatarLink);
    $Update->bindValue(':m',$data->mailSending);
    $Update->bindValue(':id',$data->clientId);
    $Update->execute();

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

    $cl=$Select->fetch(PDO::FETCH_ASSOC)[0];

    $res = new R();
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
    $Update = $dbh->prepare("UPDATE
    trainers SET
    trainerName=:n,
    email=:e,
    tellNumber=:t,
    password=:p,
    avatarLink=:a,
    trainerDescription=:d
    WHERE
    trainerId=:id
    ");
    $Update->bindValue(':n',$data->trainerName);
    $Update->bindValue(':e',$data->email);
    $Update->bindValue(':t',$data->tellNumber);
    $Update->bindValue(':p',$data->password);
    $Update->bindValue(':a',$data->avatarLink);
    $Update->bindValue(':d',$data->trainerDescription);
    $Update->bindValue(':id',$data->clientId);
    $Update->execute();

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
    $res->name = $cl['trainerName'];
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
