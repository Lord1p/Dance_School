<?php
    include("connect.php");
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $projects = $dbh->prepare("SELECT email FROM clients WHERE mailSending = 1");
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