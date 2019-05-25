<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    admins(
    name,email,password,avatarLink)
    VALUES(
    :n,:e,:p,:a)");
    $Insert->bindValue(':n',$data->name);
    $Insert->bindValue(':e',$data->email);
    $Insert->bindValue(':p',$data->password);
    $Insert->bindValue(':a',$data->avatarLink);
    $Insert->execute();
    
?>
