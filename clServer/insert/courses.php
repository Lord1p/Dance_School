<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    courses(
    name,teacherId,countOfPlaces
    price,styleId,description,duration)
    VALUES(
    :n,:t,:c,:p,:s,:de,:du)");
    $Insert->bindValue(':n',$data->name);
    $Insert->bindValue(':t',$data->teacherId);
    $Insert->bindValue(':c',$data->countOfPlaces);
    $Insert->bindValue(':p',$data->price);
    $Insert->bindValue(':s',$data->styleId);
    $Insert->bindValue(':de',$data->description);
    $Insert->bindValue(':du',$data->duration);
    $Insert->execute();
    
?>
