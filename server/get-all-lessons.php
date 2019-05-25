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
    courses.courseName,
    courses.trainerId,
    courses.countOfPlaces,
    courses.price,
    courses.courseDescription,
    courses.duration,
    styles.styeName,
    styles.styleId,
    trainers.tainerName,
    trainers.email,
    trainers.tellNumber,
    trainers.password,
    trainers.trainerDescription,
    trainers.avatarLink,
    lessons.lessonId,
    lessons.date,
    rooms.roomId,
    rooms.roomNumber FROM
    trainers,courses,styles,lessons,rooms
    WHERE
    courses.trainerId = trainers.trainerId and
    styles.styleId = courses.styleId and
    courses.courseId = lessons.courseId and
    lessons.roomId = rooms.roomId
    ");
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){

    $res = new R();
    $res->courseId = $row['courseId'];
    $res->courseName = $row['courseName'];
    $res->trainerId = $row['trainerId'];
    $res->countOfPlaces = $row['countOfPlaces'];
    $res->price = $row['price'];
    $res->courseDescription = $row['courseDescription'];
    $res->duration = $row['duration'];
    $res->styleId = $row['styleId'];
    $res->styleName = $row['styleName'];
    $res->trainerName = $row['trainerName'];
    $res->email = $row['email'];
    $res->tellNumber = $row['tellNumber'];
    $res->password = $row['password'];
    $res->trainerDescription = $row['trainerDescription'];
    $res->avatarLink = $row['avatarLink'];
    $res->lessonId = $row['lessonId'];
    $res->date = $row['date'];
    $res->roomId = $row['roomId'];
    $res->roomNumber = $row['roomNumber'];
    

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