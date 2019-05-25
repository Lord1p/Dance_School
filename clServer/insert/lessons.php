<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    lessons(
    date,courseId,roomId)
    VALUES(
    :d,:c,:r)");
    $Insert->bindValue(':d',$data->date);
    $Insert->bindValue(':c',$data->courseId);
    $Insert->bindValue(':r',$data->roomId);
    $Insert->execute();
    
?>
