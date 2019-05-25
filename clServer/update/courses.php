<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("
    UPDATE 
        courses
    SET
        name = :n,
        teacherId = :t,
        countOfPlaces =:c,
        price = :p,
        styleId =:s,
        description =:de,
        duration =:du
    WHERE
        courseId = :i
    ");

    $Insert->bindValue(':n',$data->name);
    $Insert->bindValue(':t',$data->teacherId);
    $Insert->bindValue(':c',$data->countOfPlaces);
    $Insert->bindValue(':p',$data->price);
    $Insert->bindValue(':s',$data->styleId);
    $Insert->bindValue(':de',$data->description);
    $Insert->bindValue(':du',$data->duration);
    $Insert->bindValue(':i',$data->courseId);
    $Insert->execute();
    
?>
