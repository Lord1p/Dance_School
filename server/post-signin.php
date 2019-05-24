<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    //
    //Seach in clients
    //
    $Select = $dbh->prepare("SELECT
    password
    FROM
    clients
    WHERE
    email = :id
    ");
    $Select->bindValue(':id',$data->email);
    $Select->execute();

    $cl=$Select->fetch(PDO::FETCH_NUM)[0][0];

    if($cl != null)
    {
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
    email = :id
    ");
    $Select->bindValue(':id',$data->email);
    $Select->execute();

    $cl=$Select->fetch(PDO::FETCH_ASSOC)[0];

    $res = new R();
    $res->type = "client";
    $res->name = $cl['clients.name'];
    $res->email = $cl['clients.email'];
    $res->tellNumber = $cl['clients.tellNumber'];
    $res->clientId = $cl['clients.clientId'];
    $res->avatarLink = $cl['clients.avatarLink'];
    $res->mailSending = $cl['clients.mailSending'];
    
    echo json_encode($res);
    }
    //
    //Search in trainers
    //
    $Select = $dbh->prepare("SELECT
    password
    FROM
    trainers
    WHERE
    email = :id
    ");
    $Select->bindValue(':id',$data->email);
    $Select->execute();

    $cl=$Select->fetch(PDO::FETCH_NUM)[0][0];

    if($cl != null)
    {
    $Select = $dbh->prepare("SELECT
    name,
    email,
    tellNumber,
    description,
    photoLink,
    trainerId
    FROM
    trainers
    WHERE
    email = :id
    ");
    $Select->bindValue(':id',$data->email);
    $Select->execute();

    $cl=$Select->fetch(PDO::FETCH_ASSOC)[0];

    $res = new R();
    $res->type = "trainer";
    $res->name = $cl['trainers.name'];
    $res->email = $cl['trainers.email'];
    $res->tellNumber = $cl['trainers.tellNumber'];
    $res->trainerId = $cl['trainers.trainerId'];
    $res->avatarLink = $cl['trainers.photoLink'];
    $res->description = $cl['trainers.description'];
    
    echo json_encode($res);
    }
    //
    //Search in admins
    //
    $Select = $dbh->prepare("SELECT
    password
    FROM
    admins
    WHERE
    email = :id
    ");
    $Select->bindValue(':id',$data->email);
    $Select->execute();

    $cl=$Select->fetch(PDO::FETCH_NUM)[0][0];

    if($cl != null)
    {
    $Select = $dbh->prepare("SELECT
    name,
    email,
    avatarLink
    FROM
    admins
    WHERE
    email = :id
    ");
    $Select->bindValue(':id',$data->email);
    $Select->execute();

    $cl=$Select->fetch(PDO::FETCH_ASSOC)[0];

    $res = new R();
    $res->type = "admin";
    $res->name = $cl['admins.name'];
    $res->email = $cl['admins.email'];
    $res->avatarLink = $cl['admins.avatarLink'];
    
    echo json_encode($res);
    }
?>
