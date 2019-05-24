<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Test = $dbh->prepare("SELECT
    COUNT(email) FROM clients
    WHERE email = :email");
    $Test->bindValue("email",$data->email);
    $Test->execute();
    $r = $Test->fetch(PDO::FETCH_NUM);


    if($r[0]==0)
    {
        $Insert = $dbh->prepare("INSERT INTO
        clients(name,email,tellNumber,password,mailSending)
        VALUES(:n,:e,:t,:p,:m)");
        $Insert->bindValue(':n',$data->name);
        $Insert->bindValue(':e',$data->email);
        $Insert->bindValue(':t',$data->tellNumber);
        $Insert->bindValue(':p',$data->password);
        $Insert->bindValue(':m',$data->mailSending);
        $Insert->execute();

        $Select = $dbh->prepare("SELECT
        name,
        email,
        tellNumber,
        clientId,
        avatarLink,
        mailSending
        FROM
        clients
        WHERE
        email = :id
        ");
        $Select->bindValue(':id',$data->email);
        $Select->execute();

        $row = $Select->fetch(PDO::FETCH_ASSOC);
        $res = new R();
        $res->name = $row['name'];
        $res->email = $row['email'];
        $res->tellNumber = $row['tellNumber'];
        $res->clientId = $row['clientId'];
        $res->avatarLink = $row['avatarLink'];
        $res->mailSending = $row['mailSending'];

        echo json_encode($res);
    }
    else
    {
        echo json_encode(array('error'=>array('msg'=>'Email уже используется')));
    }
?>
