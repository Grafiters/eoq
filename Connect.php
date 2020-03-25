<?php
    $dbHost = 'localhost';
    $dbName = 'eoq';
    $dbUser = 'root';
    $dbPass = '';

    $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

    if (!$conn) {
        echo "Connection Error";
    }
?>