<?php
    include("./server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Delete = $dbh->prepare("DELETE FROM clients WHERE clientId = :id");
    $Delete->bindValue(':id',$data->clientId);
    $Delete->execute();

?>
