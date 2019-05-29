<?php
    include("../../server/connect.php");
    $projects = $dbh->prepare("SELECT * FROM orders");
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){
    $res = new R();
    $res->orderId = $row['orderId'];
    $res->clientId = $row['clientId'];
    $res->courseId = $row['courseId'];
    $res->code = $row['code'];
    array_push($JSONres,$res);
    }
    $Res=array('orders'=>$JSONres);
    echo json_encode($Res);
?>