<?php
    include("../../server/connect.php");
    $projects = $dbh->prepare("SELECT * FROM courses");
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){
    $res = new R();
    $res->courseId = $row['courseId'];
    $res->courseName = $row['courseName'];
    $res->trainerId = $row['trainerId'];
    $res->countOfPlaces = $row['countOfPlaces'];
    $res->price = $row['price'];
    $res->styleId = $row['styleId'];
    $res->courseDescription = $row['courseDescription'];
    $res->duration = $row['duration'];
    array_push($JSONres,$res);
    }
    $Res=array('courses'=>$JSONres);
    echo json_encode($Res);
?>