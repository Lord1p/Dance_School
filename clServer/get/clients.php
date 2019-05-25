<?php
    include("connect.php");
    $projects = $dbh->prepare("SELECT * FROM clients");
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){
    $res = new R();
    $res->clientName = $row['clientName'];
    $res->email = $row['email'];
    $res->tellNumber = $row['tellNumber'];
    $res->password = $row['password'];
    $res->clientId = $row['clientId'];
    $res->avatarLink = $row['avatarLink'];
    $res->mailSending = $row['mailSending'];
    array_push($JSONres,$res);
    }
    $Res=array('clients'=>$JSONres);
    echo json_encode($Res);
?>