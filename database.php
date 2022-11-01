<?php
    //CONNECT TO MYSQL DATABASE USING MYSQLI
    $host   = "Localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "youcodescrumboard";

    $conn = mysqli_connect($host, $dbUser, $dbPass, $dbName);
    
    if(!$conn){
        die('Connection Failed!!'. mysqli_connect_error());
    }
    echo 'Connected successfully';
?>