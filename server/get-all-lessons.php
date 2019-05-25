<?php
    include("connect.php");
    $id = $_REQUEST['id'];

    $test = $dbh->prepare("SELECT Count(email) FROM admins WHERE email=:id");
    $test->bindValue('id',$id);
    $test->execute();
    
    if($test->fetch(PDO::FETCH_NUM)[0] > 0)
    {
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
    trainers.photoLink,
    lessons.lessonId,
    lessons.date,
    rooms.roomId,
    rooms.roomNumber FROM
    trainers,courses,styles,lessons,rooms
    WHERE
    courses.teacherId = trainers.trainerId and
    styles.styleId = courses.styleId and
    courses.courseId = lessons.courseId and
    lessons.roomID = rooms.roomId
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
    $res->lessonId = $row['lessons.lessonId'];
    $res->date = $row['lessons.date'];
    $res->roomId = $row['rooms.roomId'];
    $res->roomNumber = $row['rooms.roomNumber'];
    

    array_push($JSONres,$res);
    }
    $Res=array('allLessons'=>$JSONres);
    echo json_encode($Res);
    }
    else
    {
        echo json_encode(array('error'=>array('msg'=>'Такого администратора не существует')));
    }
?>