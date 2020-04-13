<?php
    $dbHost = '172.18.0.2';
    $dbName = 'eoq2';
    $dbUser = 'root';
    $dbPass = 'admin123';

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    if ($conn->connect_error) {
        echo "Connection Error ".$conn->connect_error;
    }
?>
