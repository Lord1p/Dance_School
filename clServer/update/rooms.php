<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("
    UPDATE 
        rooms
    SET
        roomNumber = :r
    WHERE
        roomId = :i
    ");
    $Insert->bindValue(':r',$data->roomNumber);
    $Insert->bindValue(':i',$data->roomId);
    $Insert->execute();
    
?>
