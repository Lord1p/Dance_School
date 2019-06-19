<?php
    include("../../server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    courses(
    courseName,trainerId,countOfPlaces,
    price,styleId,courseDescription,duration)
    VALUES(
    :n,:t,:c,:p,:s,:de,:du)");
    $Insert->bindValue(':n',$data->courseName);
    $Insert->bindValue(':t',$data->trainerId);
    $Insert->bindValue(':c',$data->countOfPlaces);
    $Insert->bindValue(':p',$data->price);
    $Insert->bindValue(':s',$data->styleId);
    $Insert->bindValue(':de',$data->courseDescription);
    $Insert->bindValue(':du',$data->duration);
    $Insert->execute();
    
?>
