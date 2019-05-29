<?php
    include("./server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Delete = $dbh->prepare("DELETE FROM admins WHERE email = :id");
    $Delete->bindValue(':id',$data->email);
    $Delete->execute();

?>
