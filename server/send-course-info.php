<?php
    include("../server/connect.php");
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $projects = $dbh->prepare("
    SELECT email FROM clients,orders WHERE
        orders.courseId = :course 
        AND clients.clientId = orders.clientId
    UNION
    SELECT email FROM trainers,courses WHERE
       courses.courseId = :course
       AND courses.trainerId = trainers.trainerId 
    ");
    $projects->bindValue(":course",$data->courseId);
    $projects->execute();

    while($row = $projects->fetch(PDO::FETCH_ASSOC)){

        $to_email = $row['email'];
        $subject = $data->header;
        $body = $data->description;
        $headers = "From: autosender@danceschool.com";
      
        if ( mail($to_email, $subject, $body, $headers)) {
           echo("Email successfully sent to $to_email...");
        } else {
           echo("Email sending failed...");
        }
    
}

   
?>