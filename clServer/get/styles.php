<?php
    include("../../server/connect.php");
    $projects = $dbh->prepare("SELECT * FROM styles");
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){
    $res = new R();
    $res->styleId = $row['styleId'];
    $res->styleName = $row['styleName'];
    array_push($JSONres,$res);
    }
    $Res=array('styles'=>$JSONres);
    echo json_encode($Res);
?>