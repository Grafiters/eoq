<?php
    $dbHost = 'localhost';
    $dbName = 'eoq2';
    $dbUser = 'root';
    $dbPass = '';

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    if ($conn->connect_error) {
        echo "Connection Error ".$conn->connect_error;
    }
?>
