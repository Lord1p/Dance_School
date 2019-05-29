<?php
    include("../../server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Delete = $dbh->prepare("DELETE FROM courses WHERE courseId = :id");
    $Delete->bindValue(':id',$data->courseId);
    $Delete->execute();

?>
