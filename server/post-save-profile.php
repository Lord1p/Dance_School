<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if($data->type == 'client')
    {
    $Update = $dbh->prepare("UPDATE
    clients SET
    name=:n,
    email=:e,
    tellNumber=:t,
    password=:p,
    avatarLink=:a,
    mailSending=:m
    WHERE
    clientId=:id
    ");
    $Update->bindValue(':n',$data->name);
    $Update->bindValue(':e',$data->email);
    $Update->bindValue(':t',$data->tellNumber);
    $Update->bindValue(':p',$data->password);
    $Update->bindValue(':a',$data->avatarLink);
    $Update->bindValue(':m',$data->mailSending);
    $Update->bindValue(':id',$data->clientId);
    $Update->execute();

    $Select = $dbh->prepare("SELECT
    name,
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
    $res->name = $cl['clients.name'];
    $res->email = $cl['clients.email'];
    $res->tellNumber = $cl['clients.tellNumber'];
    $res->clientId = $cl['clients.clientId'];
    $res->avatarLink = $cl['clients.avatarLink'];
    $res->mailSending = $cl['clients.mailSending'];
    
    echo json_encode($res);
    }

    if($data->type == 'trainer')
    {
    $Update = $dbh->prepare("UPDATE
    trainers SET
    name=:n,
    email=:e,
    tellNumber=:t,
    password=:p,
    photoLink=:a,
    description=:d
    WHERE
    trainerId=:id
    ");
    $Update->bindValue(':n',$data->name);
    $Update->bindValue(':e',$data->email);
    $Update->bindValue(':t',$data->tellNumber);
    $Update->bindValue(':p',$data->password);
    $Update->bindValue(':a',$data->avatarLink);
    $Update->bindValue(':d',$data->description);
    $Update->bindValue(':id',$data->clientId);
    $Update->execute();

    $Select = $dbh->prepare("SELECT
    name,
    email,
    tellNumber,
    trainerId,
    photoLink,
    description
    FROM
    trainers
    WHERE
    trainerId = :id
    ");
    $Select->bindValue(':id',$data->trainerId);
    $Select->execute();

    $cl=$Select->fetch(PDO::FETCH_ASSOC)[0];

    $res = new R();
    $res->name = $cl['trainers.name'];
    $res->email = $cl['trainers.email'];
    $res->tellNumber = $cl['trainers.tellNumber'];
    $res->trainerId = $cl['trainers.trainerId'];
    $res->avatarLink = $cl['trainers.photoLink'];
    $res->description = $cl['trainers.description'];
    
    echo json_encode($res);
    }
?>
