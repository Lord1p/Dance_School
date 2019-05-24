<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    orders(clientId,courseId,code)
    VALUES(:clI,:coI,:co)");
    $Insert->bindValue(':clI',$data->clientId);
    $Insert->bindValue(':coI',$data->courseId);
    $Insert->bindValue(':co',$data->code);
    $Insert->execute();
    $clientId = $Insert->insert_id;

    $Select = $dbh->prepare("SELECT
    lessonId,
    date,
    courseId,
    roomId,
    roomNumber
    FROM
    lessons,rooms
    WHERE
    courseId = :id and
    lessons.roomID = rooms.roomId
    ");
    $Select->bindValue(':id',$data->courseId);
    $Select->execute();
    
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC))
    {
    
    $res = new R();
    $res->lessonId = $row['lessonId'];
    $res->date = $row['date'];
    $res->courseId = $row['courseId'];
    $res->roomId = $row['roomId'];
    $res->roomNumber = $row['roomNumber'];
    
    array_push($JSONres,$res);
    }
    $Res=array('lessons'=>$JSONres);
    echo json_encode($Res);
    
?>
