<?php
    include("connect.php");
    $id = $_REQUEST['id'];
    $projects = $dbh->prepare("SELECT courses.courseId,
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
    orders,trainers,courses,styles
    WHERE
    orders.clientId = :id and
    orders.courseId = Courses.courseId and
    styles.styleId = courses.styleId and
    courses.teacherId = trainers.teacherId
    ");
    $projects->bindValue('id',$id);
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){

    $res = new R();
    $res->courses->courseId = $row['courses.courseId'];
    $res->courses->name = $row['courses.name'];
    $res->courses->teacherId = $row['courses.teacherId'];
    $res->courses->countOfPlace = $row['courses.countOfPlace'];
    $res->courses->price = $row['courses.price'];
    $res->courses->description = $row['courses.description'];
    $res->courses->duration = $row['courses.duration'];
    $res->style->styleId = $row['style.styleId'];
    $res->style->name = $row['style.name'];
    $res->trainers->name = $row['trainers.name'];
    $res->trainers->email = $row['trainers.email'];
    $res->trainers->tellNumber = $row['trainers.tellNumber'];
    $res->trainers->password = $row['trainers.password'];
    $res->trainers->description = $row['trainers.description'];
    $res->trainers->photoLink = $row['trainers.photoLink'];
    
    array_push($JSONres,$res);
    }
    $Res=array('clCourses'=>$JSONres);
    echo json_encode($Res);
?>