<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    trainers(
    name,email,tellNumber,
    password,description,photoLink)
    VALUES(
    :n,:e,:t,:p,:d,:a)");
    $Insert->bindValue(':n',$data->name);
    $Insert->bindValue(':e',$data->email);
    $Insert->bindValue(':t',$data->tellNumber);
    $Insert->bindValue(':p',$data->password);
    $Insert->bindValue(':d',$data->description);
    $Insert->bindValue(':a',$data->avatarLink);
    $Insert->execute();
    
?>
