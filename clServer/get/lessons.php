<?php
    include("../../server/connect.php");
    $projects = $dbh->prepare("SELECT * FROM lessons");
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){
    $res = new R();
    $res->lessonId = $row['lessonId'];
    $res->date = $row['date'];
    $res->courseId = $row['courseId'];
    $res->roomId = $row['roomId'];
    array_push($JSONres,$res);
    }
    $Res=array('lessons'=>$JSONres);
    echo json_encode($Res);
?>