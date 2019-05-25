<?php
    include("connect.php");
    $id = $_REQUEST['id'];
    
    $projects = $dbh->prepare("SELECT 
    orders.orderId,
    orders.code,
    orders.courseId,
    clients.clientName,
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
    $res->orderId = $row['orderId'];
    $res->code = $row['code'];
    $res->courseId = $row['courseId'];
    $res->name = $row['clientName'];
    $res->email = $row['email'];
    $res->tellNumber = $row['tellNumber'];
    $res->clientId = $row['clientId'];
    $res->avatarLink = $row['avatarLink'];
    $res->mailSending = $row['mailSending'];

    array_push($JSONres,$res);
    }
    $Res=array('orders'=>$JSONres);
    echo json_encode($Res);
?>