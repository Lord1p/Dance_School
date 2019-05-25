<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);


    $Insert = $dbh->prepare("
    UPDATE 
        clients
    SET
        clientName = :n,
        email = :e,
        tellNumber =:t,
        password = :p,
        avatarLink =:a,
        mailSending =:m
    WHERE
        clientId = :i
    ");
    
    $Insert->bindValue(':n',$data->clientName);
    $Insert->bindValue(':e',$data->email);
    $Insert->bindValue(':t',$data->tellNumber);
    $Insert->bindValue(':p',$data->password);
    $Insert->bindValue(':a',$data->avatarLink);
    $Insert->bindValue(':m',$data->mailSending);
    $Insert->bindValue(':i',$data->clientId);
    $Insert->execute();
    
?>
