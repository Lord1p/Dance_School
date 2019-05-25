<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    styles(
    name)
    VALUES(
    :r)");
    $Insert->bindValue(':r',$data->name);
    $Insert->execute();
    
?>
