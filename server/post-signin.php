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

    $cl=$Select->fetch(PDO::FETCH_NUM)[0];

    if($cl != null && $cl==$data->password)
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

    $cl=$Select->fetch(PDO::FETCH_ASSOC);

    $res = new R();
    $res->type = "client";
    $res->name = $cl['name'];
    $res->email = $cl['email'];
    $res->tellNumber = $cl['tellNumber'];
    $res->clientId = $cl['clientId'];
    $res->avatarLink = $cl['avatarLink'];
    $res->mailSending = $cl['mailSending'];
    
    echo json_encode($res);
    }
    else{
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

    $cl=$Select->fetch(PDO::FETCH_NUM)[0];

    if($cl != null && $cl==$data->password)
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

    $cl=$Select->fetch(PDO::FETCH_ASSOC);

    $res = new R();
    $res->type = "trainer";
    $res->name = $cl['name'];
    $res->email = $cl['email'];
    $res->tellNumber = $cl['tellNumber'];
    $res->trainerId = $cl['trainerId'];
    $res->avatarLink = $cl['photoLink'];
    $res->description = $cl['description'];
    
    echo json_encode($res);
    }
    else{
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

    $cl=$Select->fetch(PDO::FETCH_NUM)[0];

    if($cl != null && $cl==$data->password)
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

    $cl=$Select->fetch(PDO::FETCH_ASSOC);

    $res = new R();
    $res->type = "admin";
    $res->name = $cl['name'];
    $res->email = $cl['email'];
    $res->avatarLink = $cl['avatarLink'];
    
    echo json_encode($res);
    } 
    else
    {
        echo json_encode(array('error'=>array('msg'=>'Ошибка авторизации. Данные введены не верно')));
    }}}
?>
