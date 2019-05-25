<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("
    UPDATE 
        styles
    SET
        name = :r
    WHERE
        styleId = :i
    ");
    $Insert->bindValue(':r',$data->name);
    $Insert->bindValue(':i',$data->styleId);
    $Insert->execute();
    
?>
