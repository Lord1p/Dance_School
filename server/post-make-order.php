<?php
    include("connect.php");

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $Select = $dbh->prepare("SELECT
    COUNT(orders.courseId),
    courses.countOfPlaces
    FROM
    orders,courses
    WHERE
    orders.courseId = courses.courseId and
    orders.courseId = :coI
    ");
    $Select->bindValue(':coI',$data->courseId);
    $Select->execute();
    $limit = $Select->fetch(PDO::FETCH_NUM);

    if($limit[0] != $limit[1])
{
    $Select = $dbh->prepare("SELECT
    COUNT(code)
    FROM
    orders
    WHERE
    clientId = :clI and
    courseId = :coI
    ");
    $Select->bindValue(':clI',$data->clientId);
    $Select->bindValue(':coI',$data->courseId);
    $Select->execute();
    $count = $Select->fetch(PDO::FETCH_NUM);
    
    if($count[0] == 0)
    {
        $Insert = $dbh->prepare("INSERT INTO
        orders(clientId,courseId,code)
        VALUES(:clI,:coI,:co)");
        $Insert->bindValue(':clI',$data->clientId);
        $Insert->bindValue(':coI',$data->courseId);
        $Insert->bindValue(':co',$data->code);
        $Insert->execute();
    

    $Select = $dbh->prepare("SELECT
    lessonId,
    date,
    courseId,
    rooms.roomId,
    roomNumber
    FROM
    lessons,rooms
    WHERE
    courseId = :id and
    lessons.roomID = rooms.roomId
    ");
    $Select->bindValue(':id',$data->courseId);
    $Select->execute();
    
    $JSONres=array();

    while($row = $Select->fetch(PDO::FETCH_ASSOC))
    {
    
    $res = new R();
    $res->lessonId = $row['lessonId'];
    $res->date = $row['date'];
    $res->courseId = $row['courseId'];
    $res->roomId = $row['roomId'];
    $res->roomNumber = $row['roomNumber'];
    
    array_push($JSONres,$res);
    }
    $Res=array('lessons'=>$JSONres);
    echo json_encode($Res);
    }
    else
    {
    echo json_encode(array('error'=>array('msg'=>'"Заказ уже был сделан!"')));
    }
} 
else
    {
    echo json_encode(array('error'=>array('msg'=>'"Курс заполнен!"')));
    }
?>
