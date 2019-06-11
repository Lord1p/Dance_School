<?php
    include("../server/connect.php");
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $projects = $dbh->prepare("
    SELECT * FROM clients WHERE
        clientId = :cli
    ");
    $projects->bindValue(":cli",$data->clientId);
    $projects->execute();
    $row = $projects->fetch(PDO::FETCH_ASSOC);
    $email =$row['email'];


    $projects = $dbh->prepare("
    SELECT * FROM courses WHERE
        courseId =:coi
    ");
    $projects->bindValue(":coi",$data->courseId);
    $projects->execute();
    $course = $projects->fetch(PDO::FETCH_ASSOC);

    $body = "
    <p>Здраствуйте, ".$row['clientName'].". Вы записались на курс ".$course['courseName'].".</p>
    <p>Цена: ".$coures['price']."грн.</p>
    <p>Количество мест:".$coures['countOfPlaces'].".</p>
    <p>Продолжительность: ".$coures['duration']."дней.</p>
    <p>Описание: \r\n".$coures['courseDescription']."</p>
    <p>Расписание: \r\n"."<table border='1'>
    <tr>
        <td>Дата и время</td>
        <td>Комната</td>
    </tr>";

    $projects = $dbh->prepare("
    SELECT date, roomNumber FROM lessons,rooms WHERE
        courseId =:coi and lessons.roomId = rooms.roomId
    ");
    $projects->bindValue(":coi",$data->courseId);
    $projects->execute();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){     
        $body .= "
        <tr>
            <td>".$row['date']."</td>
            <td>".$row['roomNumber']."</td>
        </tr>";
}

$body .="</table></p>";
$subject = "Вы записались на курс";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers = "From: autosender@danceschool.com";

if ( mail($email, $subject, $body, $headers)) {
   echo("Email successfully sent to $email...");
} else {
   echo("Email sending failed...");
}
   
?>