<?php
    include("../Connect.php");

    $status = $_GET['status'];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE status=$status");
?>