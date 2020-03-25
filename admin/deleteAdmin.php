<?php
    include_once("../Connect.php");

    $id = $_GET['user_id'];
    $result = mysqli_query($conn, "DELETE FROM user WHERE user_id=$id"); 

    header("Location:index.php");
?>