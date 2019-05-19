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
    $res->lessons->courseId = $row['lessons.courseId'];
    $res->lessons->lessonId = $row['lessons.lessonId'];
    $res->lessons->date = $row['lessons.date'];
    $res->lessons->roomId = $row['lessons.roomId'];
    $res->rooms->roomNumber = $row['rooms.roomNumber'];
    
    array_push($JSONres,$res);
    }
    $Res=array('lessons'=>$JSONres);
    echo json_encode($Res);
?>