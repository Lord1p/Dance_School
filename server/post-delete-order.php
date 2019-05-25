<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Select = $dbh->prepare("DELETE
    FROM
    orders
    WHERE
    clientId = :clid and 
    courseId = :coid
    ");
    $Select->bindValue(':clid',$data->clientId);
    $Select->bindValue(':coid',$data->courseId);
    $Select->execute();

    $projects = $dbh->prepare("SELECT courses.courseId,
    courses.courseName,
    courses.trainerId,
    courses.countOfPlaces,
    courses.price,
    courses.courseDescription,
    courses.duration,
    styles.styleName,
    styles.styleId,
    trainers.trainerName,
    trainers.email,
    trainers.tellNumber,
    trainers.password,
    trainers.trainerDescription,
    trainers.avatarLink FROM
    orders,trainers,courses,styles
    WHERE
    orders.clientId = :id and
    orders.courseId = Courses.courseId and
    styles.styleId = courses.styleId and
    courses.trainerId = trainers.teacherId
    ");
    $projects->bindValue('id',$data->clientId);
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){

    $res = new R();
    $res->courseId = $row['courseId'];
    $res->courseName = $row['courseName'];
    $res->trainerId = $row['teacherId'];
    $res->countOfPlaces = $row['countOfPlaces'];
    $res->price = $row['price'];
    $res->courseDescription = $row['courseDescription'];
    $res->duration = $row['duration'];
    $res->styleId = $row['styleId'];
    $res->styleName = $row['styleName'];
    $res->trainerName = $row['trainerName'];
    $res->email = $row['trainers.email'];
    $res->tellNumber = $row['trainers.tellNumber'];
    $res->password = $row['trainers.password'];
    $res->trainerDescription = $row['trainerDescription'];
    $res->avatarLink = $row['avatarLink'];
    
    array_push($JSONres,$res);
    }
    $Res=array('clCourses'=>$JSONres);
    echo json_encode($Res);
?>
