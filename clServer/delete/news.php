<?php
    include("../../server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Delete = $dbh->prepare("DELETE FROM news WHERE newsId = :id");
    $Delete->bindValue(':id',$data->newsId);
    $Delete->execute();

?>
