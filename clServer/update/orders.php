<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("
    UPDATE 
        orders
    SET
        clientId = :d,
        courseId = :h,
        code =:t,
    WHERE
        orderId = :i
    ");
    $Insert->bindValue(':d',$data->clientId);
    $Insert->bindValue(':h',$data->courseId);
    $Insert->bindValue(':t',$data->code);
    $Insert->bindValue(':i',$data->orderId);
    $Insert->execute();
    
?>
