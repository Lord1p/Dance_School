<?php
    include("../../server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("INSERT INTO
    styles(
    styleName)
    VALUES(
    :r)");
    $Insert->bindValue(':r',$data->styleName);
    $Insert->execute();
    
?>
