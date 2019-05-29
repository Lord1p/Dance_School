<?php
    include("./server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    news(
    date,header,text)
    VALUES(
    :d,:h,:t)");
    $Insert->bindValue(':d',$data->date);
    $Insert->bindValue(':h',$data->header);
    $Insert->bindValue(':t',$data->text);
    $Insert->execute();
    
?>
