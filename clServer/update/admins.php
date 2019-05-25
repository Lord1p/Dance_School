<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);


    $Insert = $dbh->prepare("
    UPDATE 
        admins
    SET
        name = :n,
        password = :p,
        avatarLink =:a
    WHERE
        email = :e
    ");

    $Insert->bindValue(':n',$data->name);
    $Insert->bindValue(':e',$data->email);
    $Insert->bindValue(':p',$data->password);
    $Insert->bindValue(':a',$data->avatarLink);
    $Insert->execute();
    
?>
