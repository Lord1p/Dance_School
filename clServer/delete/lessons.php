<?php
    include("../../server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Delete = $dbh->prepare("DELETE FROM lessons WHERE lessonId = :id");
    $Delete->bindValue(':id',$data->lessonId);
    $Delete->execute();

?>
