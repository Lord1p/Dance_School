<?php
    include("./server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("
    UPDATE 
        trainers
    SET
        trainerName = :n,
        email = :e,
        tellNumber =:t,
        password = :p,
        trainerDescription = :d,
        avatarLink =:a
    WHERE
        trainerId = :i
    ");

    $Insert->bindValue(':n',$data->trainerName);
    $Insert->bindValue(':e',$data->email);
    $Insert->bindValue(':t',$data->tellNumber);
    $Insert->bindValue(':p',$data->password);
    $Insert->bindValue(':d',$data->trainerDescription);
    $Insert->bindValue(':a',$data->avatarLink);
    $Insert->bindValue(':i',$data->trainerId);
    $Insert->execute();
    
?>
