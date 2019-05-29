<?php
    include("./server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    trainers(
    trainerName,email,tellNumber,
    password,trainerDescription,avatarLink)
    VALUES(
    :n,:e,:t,:p,:d,:a)");
    $Insert->bindValue(':n',$data->trainerName);
    $Insert->bindValue(':e',$data->email);
    $Insert->bindValue(':t',$data->tellNumber);
    $Insert->bindValue(':p',$data->password);
    $Insert->bindValue(':d',$data->trainerDescription);
    $Insert->bindValue(':a',$data->avatarLink);
    $Insert->execute();
    
?>
