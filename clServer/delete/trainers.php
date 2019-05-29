<?php
    include("../../server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Delete = $dbh->prepare("DELETE FROM trainers WHERE trainerId = :id");
    $Delete->bindValue(':id',$data->trainerId);
    $Delete->execute();

?>
