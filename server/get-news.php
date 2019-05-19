<?php
    include("connect.php");
    $projects = $dbh->prepare("SELECT * FROM news");
    $projects->execute();
    $JSONres=array();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){
    $res = new R();
    $res->idNews = $row['idNews'];
    $res->date = $row['date'];
    $res->header = $row['header'];
    $res->text = $row['text'];
    array_push($JSONres,$res);
    }
    $Res=array('news'=>$JSONres);
    echo json_encode($Res);
?>