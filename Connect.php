<?php
    $dbHost = 'localhost';
    $dbName = 'eoq2';
    $dbUser = 'admin';
    $dbPass = 'admin15342';

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    if ($conn->connect_error) {
        echo "Connection Error ".$conn->connect_error;
    }
?>
