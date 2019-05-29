<?php
    include("../../server/connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Insert = $dbh->prepare("
    UPDATE 
        news
    SET
        date = :d,
        header = :h,
        text =:t,
    WHERE
        newsId = :i
    ");
    $Insert->bindValue(':d',$data->date);
    $Insert->bindValue(':h',$data->header);
    $Insert->bindValue(':t',$data->text);
    $Insert->bindValue(':i',$data->newsId);
    $Insert->execute();
    
?>
