<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    orders(
    clientId,courseId,code)
    VALUES(
    :d,:h,:t)");
    $Insert->bindValue(':d',$data->clientId);
    $Insert->bindValue(':h',$data->courseId);
    $Insert->bindValue(':t',$data->code);
    $Insert->execute();
    
?>
