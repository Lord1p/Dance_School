<?php
    include("connect.php");
    $projects = $dbh->prepare("SELECT * FROM trainers");
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){
    $res = new R();
    $res->trainerName = $row['trainerName'];
    $res->email = $row['email'];
    $res->tellNumber = $row['tellNumber'];
    $res->password = $row['password'];
    $res->trainerDescription = $row['trainerDescription'];
    $res->avatarLink = $row['avatarLink'];
    $res->trainerId = $row['trainerId'];
    array_push($JSONres,$res);
    }
    $Res=array('trainers'=>$JSONres);
    echo json_encode($Res);
?>