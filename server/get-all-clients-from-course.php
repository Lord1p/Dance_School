<?php
    include("connect.php");
    $id = $_REQUEST['id'];
    
    $projects = $dbh->prepare("SELECT 
    orders.orderId,
    orders.code,
    orders.courseId,
    clients.name,
    clients.email,
    clients.tellNumber,
    clients.clientId,
    clients.avatarLink,
    clients.mailSending
    FROM
    orders,clients
    WHERE
    orders.courseId = :id and
    orders.clientId = clients.clientId
    ");
    $projects->bindValue('id',$id);
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){

    $res = new R();
    $res->orderId = $row['orders.orderId'];
    $res->code = $row['orders.code'];
    $res->courseId = $row['orders.courseId'];
    $res->name = $row['clients.name'];
    $res->email = $row['clients.email'];
    $res->tellNumber = $row['clients.tellNumber'];
    $res->clientId = $row['clients.clientId'];
    $res->avatarLink = $row['clients.avatarLink'];
    $res->mailSending = $row['clients.mailSending'];

    array_push($JSONres,$res);
    }
    $Res=array('orders'=>$JSONres);
    echo json_encode($Res);
?>