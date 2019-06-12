<?php

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
    <p>Цена: ".$course['price']."грн.</p>
    <p>Код: ".$data->code.". Этот код вы должны показать на входе!</p>
    <p>Количество мест:".$course['countOfPlaces'].".</p>
    <p>Продолжительность: ".$course['duration']."дней.</p>
    <p>Описание: \r\n".$course['courseDescription']."</p>
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
$headers = "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: autosender@danceschool.com";

if ( mail($email, $subject, $body, $headers)) {
   echo("Email successfully sent to $email...");
} else {
   echo("Email sending failed...");
}
   
?>