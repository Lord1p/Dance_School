<?php
    include("connect.php");

    $projects = $dbh->prepare("SELECT 
    courses.courseId,
    courses.name,
    courses.teacherId,
    courses.countOfPlace,
    courses.price,
    courses.description,
    courses.duration,
    style.name,
    style.id,
    trainers.name,
    trainers.email,
    trainers.tellNumber,
    trainers.password,
    trainers.description,
    trainers.photoLink FROM
    trainers,courses,styles
    WHERE
    courses.teacherId = trainers.trainerId and
    styles.styleId = courses.styleId
    ");
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){

    $res = new R();
    $res->courseId = $row['courses.courseId'];
    $res->courseName = $row['courses.name'];
    $res->teacherId = $row['courses.teacherId'];
    $res->countOfPlace = $row['courses.countOfPlace'];
    $res->price = $row['courses.price'];
    $res->courseDescription = $row['courses.description'];
    $res->duration = $row['courses.duration'];
    $res->styleId = $row['styles.styleId'];
    $res->styleName = $row['styles.name'];
    $res->trainerName = $row['trainers.name'];
    $res->email = $row['trainers.email'];
    $res->tellNumber = $row['trainers.tellNumber'];
    $res->password = $row['trainers.password'];
    $res->trainerDescription = $row['trainers.description'];
    $res->avatarLink = $row['trainers.photoLink'];
    

    array_push($JSONres,$res);
    }
    $Res=array('courses'=>$JSONres);
    echo json_encode($Res);
    
?>