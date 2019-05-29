<?php
    include("./server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Delete = $dbh->prepare("DELETE FROM orders WHERE orderId = :id");
    $Delete->bindValue(':id',$data->orderId);
    $Delete->execute();

?>
