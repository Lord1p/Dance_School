<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Delete = $dbh->prepare("DELETE FROM rooms WHERE roomId = :iD");
    $Delete->bindValue(':id',$data->roomId);
    $Delete->execute();

?>
