<?php
    include("connect.php");
    $projects = $dbh->prepare("SELECT * FROM admins");
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){
    $res = new R();
    $res->name = $row['name'];
    $res->email = $row['email'];
    $res->password = $row['password'];
    $res->avatarLink = $row['avatarLink'];
    array_push($JSONres,$res);
    }
    $Res=array('admins'=>$JSONres);
    echo json_encode($Res);
?>