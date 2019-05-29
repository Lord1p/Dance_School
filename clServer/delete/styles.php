<?php
    include("../../server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Delete = $dbh->prepare("DELETE FROM styles WHERE styleId = :id");
    $Delete->bindValue(':id',$data->styleId);
    $Delete->execute();

?>
