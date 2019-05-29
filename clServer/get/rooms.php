<?php
    include("../../server/connect.php");
    $projects = $dbh->prepare("SELECT * FROM rooms");
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){
    $res = new R();
    $res->roomId = $row['roomId'];
    $res->roomNumber = $row['roomNumber'];
    array_push($JSONres,$res);
    }
    $Res=array('rooms'=>$JSONres);
    echo json_encode($Res);
?>