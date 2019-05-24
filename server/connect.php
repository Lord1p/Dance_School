<?php
    header('Content-Type: text/html; charset=utf8');
    header("Content-type","application/x-www-form-urlencoded");
    $db_driver = "mysql";
    $host = "localhost";
    $database = "dance_school";
    $dsn = "$db_driver:host=$host;dbname=$database";
    $username = "root";
    $password = "";

    try{
        $dbh = new PDO($dsn,$username,$password);
        //echo "Connected to database<br>";
    }
    catch(PDOException $e){
        echo "Error!:". $e->getMessage()."<br/>";
        die();
    }
    class R{};
    $res = new R();
    $dbh->query("set names utf8");
