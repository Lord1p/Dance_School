<?php
    include("./server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    rooms(
    roomNumber)
    VALUES(
    :r)");
    $Insert->bindValue(':r',$data->roomNumber);
    $Insert->execute();
    
?>
