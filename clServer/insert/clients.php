<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    clients(
    clientName,email,tellNumber,
    password,avatarLink,mailSending)
    VALUES(
    :n,:e,:t,:p,:a,:m)");
    $Insert->bindValue(':n',$data->clientName);
    $Insert->bindValue(':e',$data->email);
    $Insert->bindValue(':t',$data->tellNumber);
    $Insert->bindValue(':p',$data->password);
    $Insert->bindValue(':a',$data->avatarLink);
    $Insert->bindValue(':m',$data->mailSending);
    $Insert->execute();
    
?>
