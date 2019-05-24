<?php
    include("connect.php");
    $id = $_REQUEST['id'];
    $projects = $dbh->prepare("SELECT lessons.courseId,
    lessons.lessonId,
    lessons.date,
    lessons.roomId,
    rooms.roomNumber
    FROM
    lessons,rooms
    WHERE
    lessons.courseId = :id and
    lessons.roomId = rooms.roomId
    ");
    $projects->bindValue('id',$id);
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){

    $res = new R();
    $res->courseId = $row['lessons.courseId'];
    $res->lessonId = $row['lessons.lessonId'];
    $res->date = $row['lessons.date'];
    $res->roomId = $row['lessons.roomId'];
    $res->roomNumber = $row['rooms.roomNumber'];
    
    array_push($JSONres,$res);
    }
    $Res=array('lessons'=>$JSONres);
    echo json_encode($Res);
?>