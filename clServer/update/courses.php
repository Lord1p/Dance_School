<?php
    include("../../server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("
    UPDATE 
        courses
    SET
        courseName = :n,
        trainerId = :t,
        countOfPlaces =:c,
        price = :p,
        styleId =:s,
        courseDescription =:de,
        duration =:du
    WHERE
        courseId = :i
    ");

    $Insert->bindValue(':n',$data->courseName);
    $Insert->bindValue(':t',$data->trainerId);
    $Insert->bindValue(':c',$data->countOfPlaces);
    $Insert->bindValue(':p',$data->price);
    $Insert->bindValue(':s',$data->styleId);
    $Insert->bindValue(':de',$data->courseDescription);
    $Insert->bindValue(':du',$data->duration);
    $Insert->bindValue(':i',$data->courseId);
    $Insert->execute();
    
?>
