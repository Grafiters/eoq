<?php
    $dbHost = 'us-iron-auto-sfo-04-bh.cleardb.net';
    $dbName = 'heroku_f83afe97daf80ea';
    $dbUser = 'b6453815cd9d37';
    $dbPass = 'a0e55fc6';

    $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

    if ($conn) {
        echo "connected";
    } else {
        echo "error";
    }
?>