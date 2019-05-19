<?php
    include("connect.php");
    $projects = $dbh->prepare("SELECT * FROM trainers");
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){
    $res = new R();
    $res->name = $row['name'];
    $res->email = $row['email'];
    $res->tellNumber = $row['tellNumber'];
    $res->password = $row['password'];
    $res->description = $row['description'];
    $res->photoLink = $row['photoLink'];
    $res->trainerId = $row['trainerId'];
    array_push($JSONres,$res);
    }
    $Res=array('teachers'=>$JSONres);
    echo json_encode($Res);
?>