<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    if($data->type == 'client')
    {
    if(property_exists($data,'password'))
        $test = 1;
    else
        $test = 0;

    if($test == 0)
        $RequestSQL = "UPDATE
        clients SET
        clientName=:n,
        email=:e,
        tellNumber=:t,
        avatarLink=:a,
        mailSending=:m
        WHERE
        clientId=:id
        ";
    else
        $RequestSQL = "UPDATE
        clients SET
        clientName=:n,
        email=:e,
        tellNumber=:t,
        password=:p,
        avatarLink=:a,
        mailSending=:m
        WHERE
        clientId=:id
        ";
    $Update = $dbh->prepare($RequestSQL);
    $Update->bindValue(':n',$data->clientName);
    $Update->bindValue(':e',$data->email);
    $Update->bindValue(':t',$data->tellNumber);
    if($test == 1)
        $Update->bindValue(':p',$data->password);
    $Update->bindValue(':a',$data->avatarLink);
    $Update->bindValue(':m',$data->mailSending);
    $Update->bindValue(':id',$data->clientId);
    $Update->execute();

   
    }
    else{
    if($data->type == 'trainer')
    {
    if(property_exists($data,'password'))
        $test = 1;
    else
        $test = 0;

    if($test == 0)
        $RSQL = "UPDATE
        trainers SET
        trainerName=:n,
        email=:e,
        tellNumber=:t,
        avatarLink=:a,
        trainerDescription=:d
        WHERE
        trainerId=:id
        ";
    else 
        $RSQL = "UPDATE
        trainers SET
        trainerName=:n,
        email=:e,
        tellNumber=:t,
        password=:p,
        avatarLink=:a,
        trainerDescription=:d
        WHERE
        trainerId=:id
        ";
    $Update = $dbh->prepare($RSQL);
    $Update->bindValue(':n',$data->trainerName);
    $Update->bindValue(':e',$data->email);
    $Update->bindValue(':t',$data->tellNumber);
    if($test == 1)
        $Update->bindValue(':p',$data->password);
    $Update->bindValue(':a',$data->avatarLink);
    $Update->bindValue(':d',$data->trainerDescription);
    $Update->bindValue(':id',$data->trainerId);
    $Update->execute();

   
    }
    else{
        echo json_encode(array('error'=>array('msg'=>'Учетная запись неизвестного типа')));
    }}
?>
