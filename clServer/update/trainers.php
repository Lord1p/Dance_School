<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("
    UPDATE 
        trainers
    SET
        name = :n,
        email = :e,
        tellNumber =:t,
        password = :p,
        description = :d,
        photoLink =:a
    WHERE
        trainerId = :i
    ");

    $Insert->bindValue(':n',$data->name);
    $Insert->bindValue(':e',$data->email);
    $Insert->bindValue(':t',$data->tellNumber);
    $Insert->bindValue(':p',$data->password);
    $Insert->bindValue(':d',$data->description);
    $Insert->bindValue(':a',$data->avatarLink);
    $Insert->bindValue(':i',$data->trainerId);
    $Insert->execute();
    
?>
