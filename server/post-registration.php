<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    clients(name,email,tellNumber,password,mailSending)
    VALUES(:n,:e,:t,:p,:m)");
    $Insert->bindValue(':n',$data->name);
    $Insert->bindValue(':e',$data->email);
    $Insert->bindValue(':t',$data->tellNumber);
    $Insert->bindValue(':p',$data->password);
    $Insert->bindValue(':m',$data->mailSending);
    $Insert->execute();

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
    $res->name = $cl['clients.name'];
    $res->email = $cl['clients.email'];
    $res->tellNumber = $cl['clients.tellNumber'];
    $res->clientId = $cl['clients.clientId'];
    $res->avatarLink = $cl['clients.avatarLink'];
    $res->mailSending = $cl['clients.mailSending'];
    
    echo json_encode($res);
    
?>
