<?php
    include("../../server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("
    UPDATE 
        lessons
    SET
        date = :n,
        courseId = :c,
        roomID =:r
    WHERE
        lessonId = :i
    ");

    $Insert->bindValue(':d',$data->date);
    $Insert->bindValue(':c',$data->courseId);
    $Insert->bindValue(':r',$data->roomId);
    $Insert->bindValue(':i',$data->lessonId);
    $Insert->execute();
    
?>
